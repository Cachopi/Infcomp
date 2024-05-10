<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PayPalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),
                env('PAYPAL_CLIENT_SECRET')
            )
        );
        $this->apiContext->setConfig([
            'mode' => env('PAYPAL_MODE')
        ]);
    }

    public function processPayment()
    {
        $usuario = Auth::user();
        $cesta = $usuario->cesta;

        $productos = $cesta->productos;
        $cursos = $cesta->cursos;

        // Verificar si hay productos en la cesta
        if ($productos->isEmpty() && $cursos->isEmpty()) {
            return redirect()->back()->withErrors('No hay productos en la cesta.');
        }

        $sum = 0;

        // Sumar el precio de los productos en la cesta
        foreach ($productos as $producto) {
            $sum += $producto->precio * $producto->pivot->cantidad;
        }

        // Sumar el precio de los cursos en la cesta
        foreach ($cursos as $curso) {
            $sum += $curso->precio * $curso->pivot->cantidad;
        }

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.success'))
            ->setCancelUrl(route('paypal.cancel'));

        $amount = new Amount();
        $amount->setCurrency("EUR")
            ->setTotal($sum);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription("Descripción de la compra");

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->apiContext);
            return redirect($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    }


    public function paymentSuccess(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);
            $cestaController = new CestaController();
            $cestaController->generarFactura();

            // Aquí actualizamos la cesta del usuario para reflejar que los productos han sido comprados
            $usuario = Auth::user();
            $cesta = $usuario->cesta;

            // Eliminar los productos de la cesta
            $cesta->productos()->detach();
            // Eliminar los cursos de la cesta
            $cesta->cursos()->detach();



                session()->flash('success', '¡Su pago se ha realizado con éxito!');
                return redirect()->route('cesta.mostrar');

        } catch (PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    }

    public function paymentcancel()
    {
        return redirect()->route('cesta.mostrar')->with('error', 'Pago cancelado');
    }
}
