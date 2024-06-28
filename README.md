# INFCOMP

INFCOMP es un proyecto de Ecommerce desarrollado con LARAVEL, enfocado en la venta de productos y cursos, con un panel de administración completo para una gestión eficiente.

## Características

- **Dirigido a:** Usuarios, visitantes y administradores.
- **Registro de usuarios:** Fácil y rápido.
- **Sistema de roles:** Interacciones personalizadas según el rol (usuario, visitante, administrador).
- **Pasarela de pago:** Integración con PAYPAL.

## Tecnologías Utilizadas

- **Framework:** LARAVEL
- **Estilos:** Tailwind y DaisyUI
- **Base de datos:** MYSQL
- **Contenerización:** Docker

## Instalación y Ejecución

Sigue estos pasos para descargar y ejecutar el proyecto:

1. **Clona el repositorio:**
    ```bash
    git clone https://github.com/Cachopi/Infcomp.git
    cd Infcomp
    ```

2. **Instala las dependencias de PHP con Composer:**
    ```bash
    composer install
    ```

3. **Instala las dependencias de JavaScript con npm:**
    ```bash
    npm install
    ```

4. **Configura el archivo `.env`:**
    - Copia el archivo `.env.example` y renómbralo a `.env`.
    - Configura las variables de entorno según tus necesidades (base de datos, mail, etc.).

5. **Genera la clave de la aplicación:**
    ```bash
    php artisan key:generate
    ```

6. **Ejecuta las migraciones y seedea la base de datos:**
    ```bash
    php artisan migrate --seed
    ```

7. **Compila los assets:**
    ```bash
    npm run dev
    ```

8. **Inicia el servidor local:**
    ```bash
    php artisan serve
    ```

## Manual de Usuario

### Página Principal
La página principal ofrece tres opciones: explorar productos y cursos, iniciar sesión si ya tienes cuenta, o registrarte para poder realizar compras.

![Página Principal](https://github.com/Cachopi/Infcomp/assets/135831739/cc0b16b1-627a-4d4b-88e1-556a884c5506)

### Registro de Usuarios
Proceso sencillo para crear una nueva cuenta.

![Registro de Usuarios](image.png)

### Productos
Buscador dinámico para encontrar fácilmente lo que buscas.

![Buscador de Productos](image-1.png)

### Cesta de Compras
Visualiza y gestiona tus productos seleccionados.

![Cesta de Compras](image-2.png)

### Facturas
Revisa tus compras y descarga tus facturas.

![Facturas](image-3.png)
![Detalle de Factura](image-4.png)

### Mis Cursos
Accede a los cursos que has comprado.

![Mis Cursos](image-5.png)

## Administrador

### Gestión de Productos
Administra los productos disponibles en la tienda.

![Gestión de Productos](image-6.png)

### Modificar Productos y Cursos
Edita los detalles de productos y cursos.

![Modificar Productos y Cursos](image-7.png)

### Crear Productos y Cursos
Añade nuevos productos y cursos al catálogo.

![Crear Productos y Cursos](image-8.png)

### Gestión de Usuarios
Administra y controla los usuarios registrados en la plataforma.

![Gestión de Usuarios](image-9.png)

### Administrar Usuarios
Modifica y gestiona roles y permisos de los usuarios.

![Administrar Usuarios](image-10.png)
