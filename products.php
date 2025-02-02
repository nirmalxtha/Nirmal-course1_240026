<?php
session_start();
require 'db.php'; // Database connection

// Fetch products from the database
$query = "SELECT * FROM shoes WHERE price BETWEEN 200000 AND 300000";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Listings</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h2>Shoe Collection </h2>
    <div class="shoe-container">
        <?php while ($shoe = $result->fetch_assoc()): ?>
            <div class="shoe">
                <img src="<?php echo $shoe['image']; ?>" alt="<?php echo $shoe['name']; ?>">
                <h3><?php echo $shoe['name']; ?></h3>
                <p>Brand: <?php echo $shoe['brand']; ?></p>
                <p>Price: NPR <?php echo number_format($shoe['price']); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
