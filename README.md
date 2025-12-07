# 🚗 AutoHub — Car Factory Management System

**Author:** Oleksii Hubkin  
**Course:** Advanced Web Development
**Date:** December 2025
**AutoHub** — Laravel Vehicle Management System
**CA2** — Full Application Implementation (Laravel 12, MySQL, Blade, Bootstrap)

AutoHub is a full-featured Laravel web application for managing Cars, Factories, Dealers, and User Reviews.
The system includes authentication, role-based access (Admin/User), CRUD operations, many-to-many relationships, and a modern UI.

📌 Key Features
👥 User Roles
Role Permissions:
Admin Full CRUD for Cars, Factories, Dealers; assign Dealers to Factories; delete any data

User Create/Edit/Delete only their own Reviews; view all resources

🔧 Main Application Functionality
Users:

View Cars

View Factories

View Dealers

View Reviews

Authenticated Users

Edit personal profile

Create reviews on cars

Edit & delete their own reviews

Admin Only:

Create / Update / Delete Cars

Create / Update / Delete Factories

Create / Update / Delete Dealers

Assign Dealers to Factories (many-to-many relation)

🏗 Project Architecture
📁 Folder Structure Overview
app/
├── Http/
│ ├── Controllers/
│ ├── Middleware/ // EnsureAdmin.php
│ ├── Requests/
│ └── Kernel.php
├── Models/
├── Policies/ // ReviewPolicy.php
├── Providers/
database/
├── migrations/ // Database schema
├── factories/ // Model Factories (faker)
└── seeders/ // DatabaseSeeder.php
resources/
├── views/ // Blade templates (Cars/Dealers/Factories)
└── css/js // Assets (Vite)
routes/
└── web.php // Routing

🔐 Authentication & Admin Role

Admin role is stored in the role column on the users table:

$table->string('role')->default('user');

Admin Middleware

EnsureAdmin.php:

public function handle($request, Closure $next)
{
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        abort(403, 'Admins only');
    }
    return $next($request);
}

Route Protection
Route::middleware(['auth', 'admin'])->group(function () {
Route::resource('cars', CarController::class)->except(['index', 'show']);
});

🗄 Database Schema (Migrations)
Tables

users

cars (belongsTo Factory)

factories

dealers

dealer_factory (pivot many-to-many)

reviews (belongsTo Car, belongsTo User)

🌱 Database Seeding

DatabaseSeeder.php performs:

Creates Admin user

Creates several normal users

Generates factories, dealers, cars

Creates sample reviews

Links dealers ↔ factories (pivot table)

Run:

php artisan migrate:fresh --seed

🎨 UI / Frontend

Built with:

Blade Templates

Bootstrap 5.3

Custom dark theme

Gradient Navbar

Responsive tables

Action buttons:

👁 View

✏ Edit

🗑 Delete

➕ Add Factory / Car / Dealer

🧭 Routes Overview
Public Routes:
GET /cars
GET /cars/{id}
GET /factories
GET /dealers
GET /reviews

Authenticated User Routes:
GET /reviews/create
POST /reviews
PUT /reviews/{id}
DELETE /reviews/{id}

Admin Routes:
GET /cars/create
GET /factories/create
GET /dealers/create
POST /factories/{id}/assign-dealers

🔧 Installation Guide

1. Clone the repository
   git clone <https://github.com/oleksiihubkin/autohub>
   cd autohub

2. Set up the database

php artisan migrate --seed

3. Run the app
   php artisan serve

🔑 Default Admin Login
email: admin@example.com
password: password
