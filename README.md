<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## 📋 Requisitos del Sistema

- PHP 8.2 o superior  
- Composer 2.5 o superior  
- MySQL 8.0 o superior  
- Node.js 22+ (para la compilación de assets)  
- Entorno de desarrollo local recomendado: Laragon (también compatible con XAMPP, WAMP)

## ⚙️ Instalación del Proyecto

1. Clonar el repositorio o descargar el código.

2. Instalar dependencias de backend:  
   composer install

3. Instalar dependencias de frontend (si aplica):  
   npm install  
   npm run dev

4. Copiar el archivo de entorno y generar la clave de la aplicación:  
   cp .env.example .env  
   php artisan key:generate

5. Modificar el archivo `.env` con los datos de conexión a tu base de datos, por ejemplo:
   DB_CONNECTION=mysql  
   DB_HOST=127.0.0.1  
   DB_PORT=3306  
   DB_DATABASE=nombre_de_tu_base  
   DB_USERNAME=tu_usuario  
   DB_PASSWORD=tu_contraseña

6. Ejecutar las migraciones:  
   php artisan migrate

7. Ejecutar el seeder de la base de datos:  
   php artisan db:seed

8. Crear el enlace simbólico para los archivos de almacenamiento:  
   php artisan storage:link

9. Levantar el servidor (si no usas Laragon):  
   php artisan serve

## 🔑 Acceso al Sistema

- Correo: admin@gmail.com  
- Contraseña: 12345678

## 🌐 Consideraciones

- Si estás usando Laragon, asegúrate de colocar el proyecto en la carpeta `C:\laragon\www\` o la que tengas configurada.
- Si usas XAMPP/WAMP, ubica el proyecto en `htdocs` o la ruta equivalente.
- Si vas a subirlo a un servidor de hosting, asegúrate de configurar correctamente la ruta pública (`/public`) como raíz del sitio.


## License

This software is the property of **Business Manager** and is protected by copyright. 
You may not copy, modify, distribute or resell this software without express written permission from **Business Manager**. 

For more information, please see the [User License](https:walkyngamingyt.com).

