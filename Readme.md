# E-commerce Website

This project is an e-commerce website developed using PHP and MySQL. It allows users to browse products, add items to a cart, and proceed to checkout. The website includes user login and signup functionalities.

## Features

- **Product Listing**: Display a catalog of products with images.
- **Add to Cart**: Users can add products to the shopping cart.
- **View Cart**: Review items added to the cart, and update or remove items as needed.
- **Checkout**: Complete the purchase by proceeding to checkout.
- **User Authentication**: Login and signup functionality for user accounts.

## Files Overview

- **add_to_cart.php**: Adds selected products to the shopping cart.
- **cart.php**: Displays the current cart items.
- **checkout.php**: Handles the checkout process for the cart.
- **db.php**: Contains the database connection details.
- **ecomm.sql**: SQL file to set up the database schema.
- **home.php**: Home page displaying the products.
- **login.php**: Handles user login.
- **signup.php**: Handles user registration.
- **remove_from_cart.php**: Removes products from the cart.
- **update_quantity.php**: Updates the quantity of items in the cart.

## Database Setup

1. Import the `ecomm.sql` file into your MySQL database to set up the required tables.
2. Configure the `db.php` file with your MySQL credentials.

## How to Run

1. Clone the repository or download the source code.
2. Set up the database by importing the `ecomm.sql` file.
3. Make sure you have PHP and MySQL installed on your server.
4. Update the `db.php` file with your database connection details.
5. Launch the application on your local or remote server.

## Requirements

- PHP 7.0+
- MySQL 5.6+
- Apache or Nginx Server
