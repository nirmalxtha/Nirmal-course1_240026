<?php
require 'db.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "SELECT * FROM shoes WHERE id = $product_id";
    $result = $conn->query($query);
    $shoe = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="product-details">
        <img src="<?php echo $shoe['image_name']; ?>" alt="<?php echo $shoe['name']; ?>" class="product-image">
        <h2><?php echo $shoe['name']; ?></h2>
        <p>Brand: <?php echo $shoe['brand']; ?></p>
        <p>Price: NPR <?php echo number_format($shoe['price']); ?></p>
        <form method="POST" action="dashboard.php">
        <input type="hidden" name="shoe_id" value="<?php echo $shoe['id']; ?>">
                    <input type="hidden" name="shoe_name" value="<?php echo $shoe['name']; ?>">
                    <input type="hidden" name="shoe_brand" value="<?php echo $shoe['brand']; ?>">
                    <input type="hidden" name="shoe_size" value="<?php echo $shoe['size']; ?>">
                    <input type="hidden" name="shoe_price" value="<?php echo $shoe['price']; ?>">
                    <input type="hidden" name="shoe_stock" value="<?php echo $shoe['stock']; ?>">
                    <input type="hidden" name="shoe_description" value="<?php echo $shoe['description']; ?>">
                    <input type="hidden" name="shoe_image" value="<?php echo $shoe['image_name']; ?>"> 
                    <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </div>
</body>
</html>
