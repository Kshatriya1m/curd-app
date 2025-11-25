<?php
// =============================
// 📂 Include Database Connection
// =============================
// Brings in db.php to connect to MySQL
include("db.php");

// =============================
// ✏️ Edit / Update Product
// =============================
if (isset($_GET['created_at'])) {  
    // Get identifier from query string
    $created_at = $_GET['created_at'];

    // -----------------------------
    // 🔄 Handle Form Submission (Update)
    // -----------------------------
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize user input
        $name = trim($_POST['product_name']);   // Product name
        $price = $_POST['price'];               // Product price
        $desc = trim($_POST['description']);    // Optional description

        // Basic validation: name length & price > 0
        if (strlen($name) >= 2 && $price > 0) {
            // Prepare SQL statement to update product
            $stmt = $conn->prepare(
                "UPDATE products 
                 SET product_name=?, price=?, description=? 
                 WHERE created_at=?"
            );

            // Bind params: string, double, string, string
            $stmt->bind_param("sdss", $name, $price, $desc, $created_at);

            // Execute update query
            $stmt->execute();

            // Redirect back to main list
            header("Location: index.php");
            exit;
        }

    // -----------------------------
    // 📥 Load Existing Product (for edit form)
    // -----------------------------
    } else {
        // Fetch product details for the given created_at
        $stmt = $conn->prepare("SELECT * FROM products WHERE created_at=?");
        $stmt->bind_param("s", $created_at);
        $stmt->execute();

        // Get result as associative array
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <!-- External CSS for consistent styling -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h3>Edit Product</h3>

        <!-- =============================
             📝 Edit Product Form
             ============================= -->
        <form method="POST">
            <!-- Pre-fill product values using PHP -->
            <input type="text" name="product_name" 
                   value="<?php echo htmlspecialchars($product['product_name']); ?>" 
                   required minlength="2">

            <input type="number" name="price" 
                   value="<?php echo $product['price']; ?>" 
                   required min="1" step="1">

            <textarea name="description" maxlength="200"><?= htmlspecialchars($product['description']) ?></textarea>


            <!-- Update + Cancel buttons -->
            <button type="submit" class="btn btn-edit">Update Product</button>
            <a href="index.php" class="btn btn-delete">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>
