<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "efm"; // ⬅️ Make sure this is your DB name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
// Using product_name, prix_de_vente, image. Adjust if your column names differ.
// Added ORDER BY id_Produit for consistent ordering, optional.
$sql = "SELECT product_name, prix_de_vente, image FROM produit ORDER BY id_Produit ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Categories</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="css/categories.css">
</head>
<body>

    <div class="categories-container">
        <div class="categories-header">
            <h2>Categories</h2>
            <p>Find your saved items and prepare to place your order.</p>
        </div>

        <div class="filters">
            <div class="filter-item dropdown">
                <span>All Categories</span> <!-- Placeholder text -->
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-item">
                <input type="text" placeholder="Search products..."> <!-- Placeholder -->
                <i class="fas fa-search"></i>
            </div>
        </div>

        <div class="product-grid">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="product-card">
                        <?php 
                            // Set a default image if the image field is empty or file doesn't exist
                            $image_path = "images/" . htmlspecialchars($row["image"]);
                            if (empty($row["image"]) || !file_exists($image_path)) {
                                $image_path = "https://via.placeholder.com/200x150.png?text=No+Image"; // Default placeholder
                            }
                        ?>
                        <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($row["product_name"]) ?>">
                        <h3><?= htmlspecialchars($row["product_name"]) ?></h3>
                        <p class="price"><?= htmlspecialchars(number_format((float)$row["prix_de_vente"], 2, ',', '')) ?> DH</p>
                        <div class="rating">
                            <?php 
                            // Assuming a 5-star rating for now, as it's not in the DB schema provided.
                            // If you add a rating column to your DB (e.g., 'rating' from 1 to 5),
                            // you can make this dynamic. For example:
                            // $rating = isset($row['rating']) ? (int)$row['rating'] : 5; // Default to 5 if no rating
                            // for ($i = 0; $i < 5; $i++) {
                            //     if ($i < $rating) {
                            //         echo '<i class="fas fa-star"></i>';
                            //     } else {
                            //         echo '<i class="far fa-star"></i>'; // 'far' for empty star (FontAwesome Pro) or use fa-star-o
                            //     }
                            // }
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <button class="buy-button">Buy</button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-products">No products found.</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>

<?php
// Close the connection
if ($conn) {
    $conn->close();
}
?>