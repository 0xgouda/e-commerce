# E-Commerce Website

This is a PHP-based e-commerce website project that allows users to browse products, add items to their cart, and complete purchases. It also includes an admin panel for managing products, categories, and brands.

## Features

- User registration and login
- Product browsing with category and brand filters
- Shopping cart functionality
- Checkout process
- Admin panel for product, category, and brand management
- Responsive design using Bootstrap

## Technologies Used

- PHP
- MySQL
- HTML/CSS
- Bootstrap 5
- JavaScript

## Installation

1. Clone the repository:
   ```
   git clone https://github.com/0xgouda/e-commerce.git
   ```

2. Import the database schema (located in `database/db.sql`) to your MySQL server.

3. Configure the database connection:
   - Open `includes/connect.php`
   - Update the database credentials to match your local environment

4. Place the project files in your web server's document root.

5. Access the website through your web browser.

## Usage

### Customer

- Register for an account or log in
- Browse products by category or brand
- Add products to the cart
- View and update the cart
- Complete the checkout process

### Admin

- Access the admin panel by logging in with admin credentials
- Manage products: add, edit, or remove products
- Manage categories and brands
- View registered users

## File Structure
```
e-commerce_php/
│
├── admin_panel/
│ ├── insert_product.php
│ ├── view_products.php
│ └── ...
│
├── functions/
│ └── common_functions.php
│
├── includes/
│ └── connect.php
│
├── style.css
│
├── index.php
├── login.php
├── register.php
├── cart.php
├── checkout.php
└── README.md
```
