<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://laravel-livewire.com" target="_blank"><img src="https://nyan.blog/wp-content/uploads/2024/09/livewire-logo.png" width="200" alt="Livewire Logo"></a>
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Requirements

Before starting, ensure you have the following installed on your system:
- PHP >= 8.0
- Composer
- Node.js and npm
- A web server (e.g., Apache or Nginx)

## Installation

Follow these steps to set up the project:

1. Clone the repository:
   ```bash
   git clone git@github.com:steliuz/course-test.git
   cd test-ecuador
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Create a `.env` file by copying the example:
   ```bash
   cp .env.example .env
   ```

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

5. Configure your `.env` file with the correct database credentials.

6. Run database migrations:
   ```bash
   php artisan migrate:fresh --seed
   ```

7. Install JavaScript dependencies:
   ```bash
   npm install
   ```

## Running the Application

To run the application, follow these steps:

1. Start the Laravel development server:
   ```bash
   php artisan serve
   ```

2. Compile the frontend assets:
   ```bash
   npm run dev
   ```

3. Open your browser and navigate to `http://127.0.0.1:8000`.

## Features

This project uses Laravel with Livewire for building dynamic and reactive interfaces. Ensure both the backend and frontend are running for proper functionality.

## Ejemplos de uso de la API

### Iniciar sesión

**Endpoint**: `POST /api/login`

**Descripción**: Este endpoint permite autenticar a un usuario y obtener un token de acceso.

**Parámetros**:
- `email` (string, requerido): Correo electrónico del usuario.
- `password` (string, requerido): Contraseña del usuario.

**Ejemplo de solicitud**:
```bash
curl -X POST http://127.0.0.1:8000/api/login \
-H "Content-Type: application/json" \
-d '{
  "email": "john.doe@example.com",
  "password": "securepassword"
}'
```

**Ejemplo de respuesta**:
```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
}
```

### Obtener todos los cursos

**Endpoint**: `GET /api/courses`

**Descripción**: Este endpoint permite obtener una lista de todos los cursos disponibles.

**Encabezados**:
- `Authorization` (string, requerido): Token de acceso en el formato `Bearer {token}`.

**Ejemplo de solicitud**:
```bash
curl -X GET http://127.0.0.1:8000/api/courses \
-H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
```

**Ejemplo de respuesta**:
```json
[
  {
    "id": 1,
    "title": "Curso de Laravel",
    "description": "Aprende Laravel desde cero",
    "cost": 49.99,
    "duration": "10 horas",
    "modality": "Online",
    "status": "Activo",
    "academy_id": 1,
    "created_at": "2023-10-01T12:00:00.000000Z",
    "updated_at": "2023-10-01T12:00:00.000000Z"
  },
  {
    "id": 2,
    "title": "Curso de Vue.js",
    "description": "Aprende Vue.js avanzado",
    "cost": 59.99,
    "duration": "15 horas",
    "modality": "Presencial",
    "status": "Activo",
    "academy_id": 2,
    "created_at": "2023-10-02T12:00:00.000000Z",
    "updated_at": "2023-10-02T12:00:00.000000Z"
  }
]
```

### Crear un curso

**Endpoint**: `POST /api/courses`

**Descripción**: Este endpoint permite crear un nuevo curso. Requiere autenticación mediante un token.

**Encabezados**:
- `Authorization` (string, requerido): Token de acceso en el formato `Bearer {token}`.

**Parámetros**:
- `title` (string, requerido): Título del curso.
- `description` (string, opcional): Descripción del curso.
- `price` (number, requerido): Precio del curso.
- `academy_id` (integer, requerido): ID de la academia asociada al curso.

**Ejemplo de solicitud**:
```bash
curl -X POST http://127.0.0.1:8000/api/courses \
-H "Content-Type: application/json" \
-H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..." \
-d '{
  "title": "Curso de Laravel",
  "description": "Aprende Laravel desde cero",
  "price": 49.99,
  "academy_id": 1
}'
```

**Ejemplo de respuesta**:
```json
{
  "id": 1,
  "title": "Curso de Laravel",
  "description": "Aprende Laravel desde cero",
  "price": 49.99,
  "academy_id": 1,
  "created_at": "2023-10-01T12:00:00.000000Z",
  "updated_at": "2023-10-01T12:00:00.000000Z"
}
```
