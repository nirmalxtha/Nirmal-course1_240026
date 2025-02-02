<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.html");
    exit();
}
require 'db.php';

$query = "SELECT * FROM shoes WHERE price BETWEEN 50000 AND 300000";
$result = $conn->query($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $shoe_id = $_POST['shoe_id'];
    $shoe_name = $_POST['shoe_name'];
    $shoe_price = $_POST['shoe_price'];
    $shoe_image = $_POST['shoe_image'];

    
    $_SESSION['cart'][] = [
        'id' => $shoe_id,
        'name' => $shoe_name,
        'price' => $shoe_price,
        'image' => $shoe_image
    ];
    echo "<script>alert('Added to Cart!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="dashboard-header">
        <a href="aboutus.php" class="about-us-link" style="color:aqua">About Us</a>
        <h2 class="welcome-text">Welcome to Nirmal Luxury Shoes Shop</h2>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <h2 class="product-title">Shoe Collection</h2>
    <div class="shoe-container">
        <?php while ($shoe = $result->fetch_assoc()): ?>
            <div class="shoe">
                <form method="POST">
                    <a href="product_details.php?id=<?php echo $shoe['id']; ?>">
                        <img src="<?php echo $shoe['image_name']; ?>" alt="<?php echo $shoe['name']; ?>" class="shoe-image">
                    </a>
                    <h3><?php echo $shoe['name']; ?></h3>
                    <p>Brand: <?php echo $shoe['brand']; ?></p>
                    <p>Price: NPR <?php echo number_format($shoe['price']); ?></p>
                    <form action="cart.php" method="GET">
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

                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
