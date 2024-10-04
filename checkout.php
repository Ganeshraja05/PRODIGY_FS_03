<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user_id_query = "SELECT id FROM users WHERE username='" . $_SESSION['user'] . "'";
$user_id_result = mysqli_query($conn, $user_id_query);
$user_id_row = mysqli_fetch_assoc($user_id_result);
$user_id = $user_id_row['id'];

$query = "SELECT products.*, cart.quantity FROM cart 
JOIN products ON cart.product_id = products.id 
WHERE cart.user_id = '$user_id'";
$result = mysqli_query($conn, $query);

$total = 0;

$message = ''; // Initialize message variable
if (isset($_POST['place_order'])) {
    $message = "Order confirmed! Thank you for shopping with us!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://pictarts.com/10/material/10-download/0903-large-image-m.png'); /* Add a background image */
    background-size: cover;
    background-position: center;
            color: #fff; /* White text */
            margin: 0;
            padding: 20px;
        }

        .checkout-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f3f3f3; /* Light gray background */
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .checkout-header {
            background-color: #E50914; /* Netflix red background */
            color: #fff; /* White text */
            padding: 15px;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .checkout-header h2 {
            margin: 0;
            font-size: 28px;
        }

        .checkout-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .checkout-table th, .checkout-table td {
            padding: 15px;
            text-align: left;
            border: none;
        }

        .checkout-table th {
            background-color: #E50914; /* Netflix red background */
            color: #fff; /* White text */
        }

        .checkout-table td {
            background-color: #fff; /* White background for table rows */
            color: #333; /* Dark text for readability */
        }

        .checkout-table img {
            width: 60px; /* Standard image size */
            height: 60px; /* Standard image size */
            border-radius: 8px; /* Rounded corners for images */
        }

        .checkout-total {
            font-size: 24px;
            font-weight: bold;
            color: #E50914; /* Netflix red text */
            text-align: right; /* Right-align total */
        }

        .checkout-button {
            width: 100%;
            height: 50px;
            background-color: #E50914; /* Netflix red background */
            color: #fff; /* White text */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .checkout-button:hover {
            background-color: #d40712; /* Darker red on hover */
        }

        .confirmation-message {
            margin-top: 20px;
            font-size: 20px;
            color: black; /* Netflix red */
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <div class="checkout-header">
            <h2>Checkout</h2>
        </div>
        <table class="checkout-table">
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><img src="<?= htmlspecialchars($row['image']) ?>" alt="Product Image"></td>
                    <td><?= $row['quantity'] ?></td>
                    <td>$<?= number_format($row['price'], 2) ?></td>
                    <td>$<?= number_format($row['price'] * $row['quantity'], 2) ?></td>
                </tr>
                <?php $total += $row['price'] * $row['quantity']; ?>
            <?php } ?>
            <tr>
                <td colspan="4">Total:</td>
                <td class="checkout-total">$<?= number_format($total, 2) ?></td>
            </tr>
        </table>
        <form method="post">
            <button type="submit" name="place_order" class="checkout-button">Place Order</button>
        </form>
    </div>
    <?php if ($message): ?>
        <div class="confirmation-message">
            <?= $message ?>
        </div>
    <?php endif; ?>
</body>
</html>
