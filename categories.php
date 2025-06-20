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

// Fetch Categories for the dropdown
$categories_sql = "SELECT id_categorie, nom_categorie FROM categorie ORDER BY nom_categorie ASC";
$categories_result = $conn->query($categories_sql);
$categories = [];
if ($categories_result && $categories_result->num_rows > 0) {
    while ($cat_row = $categories_result->fetch_assoc()) {
        $categories[] = $cat_row;
    }
}

// --- Product Fetching ---
// Get selected category ID from URL, default to 'all'
$selected_category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 'all';

// Base SQL query
$sql = "SELECT p.product_name, p.prix_de_vente, p.image 
        FROM produit p "; // Alias 'p' for produit table

// Add JOIN and WHERE clause if a specific category is selected
if ($selected_category_id !== 'all' && is_numeric($selected_category_id)) {
    // It's good practice to join with categorie table if you might need category name later,
    // but for now, just filtering by id_categorie in produit table is enough.
    // Assuming 'id_categorie' is the foreign key column in 'produit' table
    $sql .= " WHERE p.id_categorie = ?";
}

$sql .= " ORDER BY p.id_Produit ASC";

// Prepare statement
$stmt = $conn->prepare($sql);

if ($selected_category_id !== 'all' && is_numeric($selected_category_id)) {
    $stmt->bind_param("i", $selected_category_id); // "i" for integer
}

$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Categories</title>
    <!-- Font Awesome for icons (ensure you have this or use CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                <select id="categoryFilter" name="category_id" onchange="filterByCategory()">
                    <option value="all" <?= ($selected_category_id === 'all') ? 'selected' : '' ?>>All Categories</option>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['id_categorie']) ?>" 
                                    <?= ($selected_category_id == $category['id_categorie']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['nom_categorie']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <!-- You might want to style the select to look like your original div or remove the i tag -->
                <!-- <i class="fas fa-chevron-down"></i> -->
            </div>
            <div class="filter-item">
                <input type="text" id="searchProduct" placeholder="Search products..."> <!-- Placeholder -->
                <i class="fas fa-search"></i>
            </div>
        </div>

        <div class="product-grid">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="product-card">
                        <?php
                            $image_path = "images/" . htmlspecialchars($row["image"]);
                            if (empty($row["image"]) || !file_exists($image_path)) {
                                $image_path = "https://via.placeholder.com/200x150.png?text=No+Image";
                            }
                        ?>
                        <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($row["product_name"]) ?>">
                        <h3><?= htmlspecialchars($row["product_name"]) ?></h3>
                        <p class="price"><?= htmlspecialchars(number_format((float)$row["prix_de_vente"], 2, ',', '')) ?> DH</p>
                        <div class="rating">
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
                <p class="no-products">No products found for the selected category.</p>
            <?php endif; ?>
        </div>
    </div>

<script>
    function filterByCategory() {
        const categoryId = document.getElementById('categoryFilter').value;
        // Reload the page with the new category ID
        window.location.href = `categories.php?category_id=${categoryId}`;
        // If search is also active, you might want to include it:
        // const searchQuery = document.getElementById('searchProduct').value;
        // window.location.href = `categories.php?category_id=${categoryId}&search=${encodeURIComponent(searchQuery)}`;
    }

    // Basic search functionality (client-side, filters currently displayed items)
    // For server-side search, you'd modify the PHP query and reload like with categories.
    document.getElementById('searchProduct').addEventListener('keyup', function() {
        let searchTerm = this.value.toLowerCase();
        let productCards = document.querySelectorAll('.product-card');
        let noProductsMessage = document.querySelector('.no-products');
        let foundProducts = false;

        productCards.forEach(function(card) {
            let productName = card.querySelector('h3').textContent.toLowerCase();
            if (productName.includes(searchTerm)) {
                card.style.display = ''; // or 'flex' if your card uses flex display
                foundProducts = true;
            } else {
                card.style.display = 'none';
            }
        });

        if (noProductsMessage) { // Handle the "No products found" message
            if (foundProducts) {
                if (document.querySelectorAll('.product-card[style*="display: none"]').length === productCards.length) {
                    // All cards are hidden by search, but there were cards initially
                    noProductsMessage.textContent = "No products match your search.";
                    noProductsMessage.style.display = 'block';
                } else {
                     noProductsMessage.style.display = 'none';
                }
            } else {
                // This case happens if the initial PHP query returned no products for the category
                // and the search bar is empty or doesn't find anything from an empty set.
                // Or if it was already "No products found" and search is also empty
                if (searchTerm === '' && productCards.length > 0) { // search cleared, show original message if it was there
                     noProductsMessage.style.display = 'none'; // if there are cards, hide this
                } else if (productCards.length === 0) { // initial load had no products
                    noProductsMessage.textContent = "No products found for the selected category.";
                    noProductsMessage.style.display = 'block';
                } else { // search term results in no visible products
                    noProductsMessage.textContent = "No products match your search.";
                    noProductsMessage.style.display = 'block';
                }
            }
        }
    });
</script>
</body>
</html>

<?php
// Close the statement and connection
if (isset($stmt)) {
    $stmt->close();
}
if ($conn) {
    $conn->close();
}
?>