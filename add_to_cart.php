<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
    if (!isset($_SESSION["user"])) {
        echo "<script>alert('Please log in to add items to cart.'); window.location.href='index.html';</script>";
        exit();
    }

    $user_id = $_SESSION["user"]["id"];  // Assuming user session has an 'id' field
    $shoe_id = $_POST["shoe_id"];
    $shoe_name = $_POST["shoe_name"];
    $shoe_price = $_POST["shoe_price"];
    $shoe_image = $_POST["shoe_image"];
    $quantity = 1;

    // Check if item already exists in cart for the user
    $check_query = "SELECT * FROM cart WHERE user_id = ? AND shoe_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $user_id, $shoe_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update quantity if already exists
        $update_query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND shoe_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ii", $user_id, $shoe_id);
        $stmt->execute();
    } else {
        // Insert new item into cart
        $insert_query = "INSERT INTO cart (user_id, shoe_id, shoe_name, shoe_price, shoe_image, quantity) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("iisdsi", $user_id, $shoe_id, $shoe_name, $shoe_price, $shoe_image, $quantity);
        $stmt->execute();
    }

    echo "<script>alert('Item added to cart!'); window.location.href='dashboard.php';</script>";
}
?>
