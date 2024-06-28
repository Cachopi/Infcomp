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

![Registro de Usuarios](![image](https://github.com/Cachopi/Infcomp/assets/135831739/4a4f8524-6c3e-455b-b278-12a392fd8492)
)

### Productos
Buscador dinámico para encontrar fácilmente lo que buscas.

![image-1](https://github.com/Cachopi/Infcomp/assets/135831739/eeb281ef-2356-4287-ae80-2352d65f365c)


### Cesta de Compras
Visualiza y gestiona tus productos seleccionados.

![image-2](https://github.com/Cachopi/Infcomp/assets/135831739/0e33c359-050b-4f0d-9b60-b2ab4e11e5b7)


### Facturas
Revisa tus compras y descarga tus facturas.

![image-3](https://github.com/Cachopi/Infcomp/assets/135831739/46548e92-0914-4f5f-9d96-fa2b36480e64)

![image-4](https://github.com/Cachopi/Infcomp/assets/135831739/ceff9027-c359-40b4-8a05-d7536051e2a3)


### Mis Cursos
Accede a los cursos que has comprado.

![image-5](https://github.com/Cachopi/Infcomp/assets/135831739/88ac6696-6474-445f-a236-e959c596eadf)


## Administrador

### Gestión de Productos
Administra los productos disponibles en la tienda.

![image-6](https://github.com/Cachopi/Infcomp/assets/135831739/ab7aca77-8450-440e-aa4f-5cfed42e24d6)


### Modificar Productos y Cursos
Edita los detalles de productos y cursos.

![image-7](https://github.com/Cachopi/Infcomp/assets/135831739/9458fbd6-28b0-452b-b1a6-9ba1d67f6578)


### Crear Productos y Cursos
Añade nuevos productos y cursos al catálogo.

![image-8](https://github.com/Cachopi/Infcomp/assets/135831739/50bb6a7e-9fe0-4b44-8aac-bfd5f8feea13)


### Gestión de Usuarios
Administra y controla los usuarios registrados en la plataforma.

![image-9](https://github.com/Cachopi/Infcomp/assets/135831739/cf2498d3-e49d-4d38-882c-da0058e55532)


### Administrar Usuarios
Modifica y gestiona roles y permisos de los usuarios.

![image-10](https://github.com/Cachopi/Infcomp/assets/135831739/0ac6c0d4-16f4-4184-9b8b-10606bc98ae5)

