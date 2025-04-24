# Corporate Hub - Laravel Assessment Project

A minimalist Laravel application for managing companies, built with basic Laravel features and Tailwind CSS. This project demonstrates the use of core Laravel functionality without relying on additional packages like Breeze or Jetstream for authentication.

## Features

-   Custom Authentication System (without Breeze/Jetstream)
-   Company Management (CRUD operations)
-   Responsive Design with Tailwind CSS
-   File Upload Handling
-   Form Validation
-   Clean and Modern UI

## Requirements

-   PHP >= 8.1
-   Composer
-   Node.js & NPM
-   MySQL

## Installation

1. Clone the repository

```bash
git clone <repository-url>
cd corporate_hub_assessment
```

2. Install PHP dependencies

```bash
composer install
```

3. Install and compile frontend dependencies

```bash
npm install
npm run dev
```

4. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env` file

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations

```bash
php artisan migrate
```

7. Create storage link for company logos

```bash
php artisan storage:link
```

## Project Structure

-   Custom Authentication in `AuthController.php`
-   Company Management in `CompanyController.php`
-   Blade Views for all pages (no Livewire)
-   Tailwind CSS for styling
-   Form Requests for validation
-   Custom Components for reusability

## Technologies Used

-   Laravel 10.x
-   Tailwind CSS
-   Alpine.js (minimal usage for dropdowns)
-   SweetAlert2 for notifications
-   Basic Blade Templates
-   MySQL

## Why Basic Laravel?

This project intentionally uses basic Laravel features without additional packages to demonstrate:

-   Understanding of core Laravel concepts
-   Custom authentication implementation
-   Manual CRUD operations
-   Basic Blade templating skills
-   Form handling and validation
-   File upload management

No additional packages were used for:

-   Authentication (no Breeze/Jetstream)
-   Admin panels (no Nova/Filament)
-   Frontend frameworks (no Livewire/Inertia)

## Development Decisions

1. **Authentication**: Custom implementation using Laravel's basic auth features
2. **Frontend**: Pure Blade with Tailwind CSS for simplicity
3. **Database**: Eloquent ORM with basic relationships
4. **Validation**: Form Request classes for clean controller code
5. **File Storage**: Laravel's built-in storage system

## Running the Application

```bash
# Start the development server
php artisan serve

# In another terminal, run Vite for asset compilation
npm run dev
```

Visit `http://localhost:8000` in your browser.

## Contributing

This is an assessment project, but feel free to fork and modify for your needs.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
