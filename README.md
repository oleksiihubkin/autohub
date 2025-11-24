# 🚗 AutoHub — Car Factory Management System

**Author:** Oleksii Hubkin  
**Course:** Advanced Web Development
**Date:** October 2025

---

## 📘 Overview

AutoHub is a Laravel-based web application to manage factories, cars, and dealers.  
It demonstrates authentication, CRUD functionality, and many-to-many database relationships using modern Laravel features.

---

## ⚙️ Features

-   User authentication (login, register, logout)
-   CRUD for **Factories**, **Cars**, and **Dealers**
-   Dashboard showing total counts
-   FormRequest validation and flash messages
-   Many-to-Many: Factories ↔ Dealers (assign dealers to factories)
-   Clean Bootstrap/Tailwind UI

---

## 🧱 Database Structure

| Table          | Description                                  |
| -------------- | -------------------------------------------- |
| factories      | Stores all car factories                     |
| cars           | Cars linked to factories                     |
| dealers        | Dealer information                           |
| dealer_factory | Pivot table connecting factories and dealers |
| users          | Authenticated system users                   |

**Relationships:**

-   Factory → Car = One-to-Many
-   Factory ↔ Dealer = Many-to-Many
-   User = system administrator

---

## 🧩 Tech Stack

-   **Backend:** Laravel 10 (PHP 8+)
-   **Frontend:** Blade, Bootstrap 5, Tailwind CSS
-   **Database:** MySQL
-   **Authentication:** Laravel Breeze
-   **Server:** php artisan serve / XAMPP

---

## 🚀 Installation & Setup

### 1️⃣ Clone or download the project

```bash
git clone https://github.com/yourusername/autohub.git
cd autohub

2️⃣ Install dependencies
bash
Copy code
composer install
npm install
npm run dev

3️⃣ Set up environment
bash
Copy code
cp .env.example .env
php artisan key:generate
Then update your database credentials in .env.

4️⃣ Run migrations
bash
Copy code
php artisan migrate

5️⃣ Start local server
bash
Copy code
php artisan serve
Then open in your browser:
http://127.0.0.1:8000

🧮 Dashboard
After login, the dashboard displays:

Number of factories 🏭

Number of cars 🚗

Number of dealers 🤝

🧠 MVC Structure
Model: Factory, Car, Dealer (with relationships)

View: Blade templates with shared layout (Navbar + Footer)

Controller: CRUD operations with validation

🧾 Notes
All test data is entered manually (no Faker).

Factories can assign multiple dealers via a pivot table.

Flash messages confirm success or validation errors.

📊 ER Diagram
<p align="center">
  <img src="https://raw.githubusercontent.com/oleksiihubkin/autohub/main/resources/images/er_diagram.png" alt="AutoHub ER Diagram" width="600">
</p>

### **Diagram Description**
- **Factory (1) → Car (∞)**
  Each factory produces many cars.
- **Factory (∞) ↔ Dealer (∞)**
  A factory can work with many dealers, and each dealer can represent multiple factories.
- **Pivot Table:** `dealer_factory` connects both entities via foreign keys.
```
