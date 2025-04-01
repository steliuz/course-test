<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://laravel-livewire.com" target="_blank"><img src="https://livewire-framework.com/img/logo.svg" width="200" alt="Livewire Logo"></a>
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
   php artisan migrate
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
