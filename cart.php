<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.html");
    exit();
}

require 'db.php';
$user_id = $_SESSION['user']['id']; // Assuming the user is logged in

// Fetch the cart items from the database
$query = "SELECT * FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Your Cart</h2>
    <div class="cart-container">
        <?php
        if ($result->num_rows > 0) {
            while ($item = $result->fetch_assoc()) {
                echo "<div class='cart-item'>";
                echo "<img src='" . $item['shoe_image'] . "' alt='" . $item['shoe_name'] . "' class='cart-image'>";
                echo "<p>" . $item['shoe_name'] . "</p>";
                echo "<p>Price: NPR " . number_format($item['shoe_price']) . "</p>";
                echo "<p>Quantity: " . $item['quantity'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </div>
</body>
</html>
