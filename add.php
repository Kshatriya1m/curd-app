<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['product_name']);
    $price = $_POST['price'];
    $desc = trim($_POST['description']);
<?php
// =============================
// 📂 Include Database Connection
// =============================
// Brings in db.php which handles DB connection and setup
include("db.php");

// =============================
// 📥 Handle Form Submission
// =============================
// Only run this block if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and sanitize inputs
    $name = trim($_POST['product_name']);   // Remove extra spaces
    $price = $_POST['price'];               // Product price (numeric)
    $desc = trim($_POST['description']);    // Optional description

    // =============================
    // ✅ Input Validation
    // =============================
    // Ensure product name is at least 2 chars and price is > 0
    if (strlen($name) >= 2 && $price > 0) {

        // =============================
        // 📝 Insert Product into Database
        // =============================
        // Use a prepared statement to prevent SQL injection
        $stmt = $conn->prepare(
            "INSERT INTO products (product_name, price, description) VALUES (?, ?, ?)"
        );

        // Bind parameters:
        // "sds" → string (name), double (price), string (desc)
        $stmt->bind_param("sds", $name, $price, $desc);

        // Execute the prepared statement
        $stmt->execute();
    }
}

// =============================
// 🔄 Redirect Back to Index
// =============================
// After adding the product, go back to the main page
header("Location: index.php");
exit;
?>

    if (strlen($name) >= 2 && $price > 0) {
        $stmt = $conn->prepare("INSERT INTO products (product_name, price, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $name, $price, $desc);
        $stmt->execute();
    }
}
header("Location: index.php");
exit;
?>
