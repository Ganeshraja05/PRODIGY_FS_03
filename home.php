<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

$search = $_POST['search'] ?? '';

$query = "SELECT * FROM products WHERE name LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - My E-Commerce</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Header Styles */
        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        header a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        header a:hover {
            color: #ff3333;
        }

        /* Forms (Search Bar) */
        form {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        form input[type="text"] {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-right: 10px;
        }

        form button {
            background-color: #ff3333;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #000;
        }

        /* Product List Styles */
        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s;
        }

        .product-item:hover {
            transform: scale(1.05);
            border-color: #ff3333;
        }

        .product-item img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
            border-bottom: 2px solid #333;
        }

        .product-item h3 {
            color: #ff3333;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .product-item p {
            font-size: 14px;
            margin-bottom: 10px;
            color: #555;
        }

        .product-item p.price {
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .product-item button {
            background-color: #333;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .product-item button:hover {
            background-color: #000;
        }

        /* Footer Links */
        .cart-link {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 30px;
            text-decoration: none;
            background-color: #000;
            color: #fff;
            padding: 10px;
            border-radius: 3px;
        }

        .cart-link:hover {
            background-color: #ff3333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .product-list {
                grid-template-columns: 1fr;
            }
        }
        .product-item img {
    width: 300px;
    height: 300px;
    object-fit: cover; /* Ensures the image fills the area while maintaining aspect ratio */
    border-radius: 10px; /* Optional: Adds rounded corners for a stylish look */
}
/* Footer CSS */
footer {
  background-color: #f9f9f9;
  padding: 20px 0;
  color: #333;
}

footer .container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

footer .row {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

footer .col-md-4 {
  flex-basis: 33.33%;
  margin: 20px;
}

footer h5 {
  font-weight: bold;
  margin-top: 0;
}

footer ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

footer li {
  margin-bottom: 10px;
}

footer a {
  color: #337ab7;
  text-decoration: none;
}

footer a:hover {
  color: #23527c;
}

footer .copyright {
  font-size: 14px;
  color: #666;
  text-align: center;
  margin-top: 20px;
}

/* Responsive design */
@media (max-width: 768px) {
  footer .col-md-4 {
    flex-basis: 50%;
  }
}

@media (max-width: 480px) {
  footer .col-md-4 {
    flex-basis: 100%;
  }
}
    </style>
</head>
<body>

<header>
    <h1>My E-Commerce Store</h1>
    <a href="home.php">Home</a>
    <a href="cart.php">Cart</a>
    <a href="logout.php">Logout</a>
</header>

<div class="container">
    <h2>Welcome to Our Store</h2>

    <form method="POST" action="home.php">
        <input type="text" name="search" placeholder="Search for products...">
        <button type="submit">Search</button>
    </form>

    <div class="product-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-item">
                <img src="<?php echo $row['image']; ?>" alt="Product Image">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <p class="price">$<?php echo $row['price']; ?></p>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php } ?>
    </div>

    <a href="cart.php" class="cart-link">Go to Cart</a>
</div>
<!-- Footer HTML -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>About Us</h5>
        <p>Developed as a e-commerce website for online shopping by a beginner .</p>
      </div>
      <div class="col-md-4">
        <h5>Quick Links</h5>
        <ul>
          <li><a href="#">Terms of Use</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Follow Us</h5>
        <ul>
          <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
        </ul>
      </div>
    </div>
    <p class="copyright">Copyright 2023 Your Website Name. All rights reserved.</p>
  </div>
</footer>
</body>
</html>
