# CRUD Application with Laravel

Este proyecto implementa un CRUD completo para la gestión de productos y órdenes utilizando Laravel. También incluye documentación generada con Swagger, manejo robusto de errores, Dockerización, y funcionalidades opcionales como la exportación de datos a Excel.

## Tabla de Contenidos

- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Uso](#uso)
- [Dockerización](#dockerización)
- [Documentación API](#documentación-api)
- [Manejo de Errores](#manejo-de-errores)
- [Funcionalidades Opcionales](#funcionalidades-opcionales)
- [Despliegue](#despliegue)

---

## Requisitos

- PHP >= 8.1
- Composer >= 2.0
- Laravel >= 10.x
- Docker y Docker Compose
- Node.js y NPM

---

## Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/tu_usuario/tu_repositorio.git
   cd tu_repositorio
Instala las dependencias de PHP:

bash
Copiar código
composer install
Configura tu archivo .env: Copia el archivo .env.example como .env:

bash
Copiar código
cp .env.example .env
Configura la base de datos, servidor y otras variables en el archivo .env.

Genera la clave de la aplicación:

bash
Copiar código
php artisan key:generate
Ejecuta las migraciones y semillas:

bash
Copiar código
php artisan migrate --seed
Instala las dependencias de Node.js:

bash
Copiar código
npm install
npm run dev
Uso
Ejecuta el servidor local:

bash
Copiar código
php artisan serve
La aplicación estará disponible en: http://127.0.0.1:8000.

Dockerización
Construye y levanta los contenedores:

bash
Copiar código
docker-compose up --build
La aplicación estará disponible en: http://127.0.0.1:8000.

Para ejecutar comandos dentro del contenedor:

bash
Copiar código
docker exec -it app-container-name bash
Documentación API
La documentación API está generada utilizando Swagger.

Genera la documentación Swagger:

bash
Copiar código
php artisan l5-swagger:generate
Accede a la documentación en: http://127.0.0.1:8000/api/documentation.

Manejo de Errores
El proyecto implementa un manejo robusto de errores utilizando:

Excepciones personalizadas.
Respuestas claras y consistentes para los usuarios de la API.
Registro de errores en los archivos de log de Laravel.
Ejemplo de respuesta de error:

json
Copiar código
{
  "error": "Recurso no encontrado",
  "message": "El producto con el ID proporcionado no existe.",
  "status_code": 404
}
Funcionalidades Opcionales
Exportación a Excel
Exporta los productos a un archivo Excel:

Endpoint: GET /api/products/export
Respuesta: Archivo .xlsx descargable.
Requiere la instalación de maatwebsite/excel:

bash
Copiar código
composer require maatwebsite/excel
Autenticación
El sistema incluye autenticación básica con Laravel Sanctum para proteger los endpoints.

CI/CD Pipeline
Se puede configurar un pipeline de CI/CD utilizando GitHub Actions.

Despliegue
El proyecto puede ser desplegado utilizando servicios como Vercel, AWS, o GCP. Sigue estos pasos para despliegue básico:

Configura las variables de entorno en tu proveedor de nube.
Sube el código al servicio y asegúrate de tener configurado un entorno de ejecución compatible (PHP >= 8.1, MySQL).
Realiza las migraciones:
bash
Copiar código
php artisan migrate --force
Contribución
Haz un fork del proyecto.
Crea una rama para tu funcionalidad:
bash
Copiar código
git checkout -b feature/nueva-funcionalidad
Realiza los cambios y haz commits pequeños y claros.
Crea un pull request.