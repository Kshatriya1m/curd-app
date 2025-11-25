<?php
include("db.php");

if (isset($_GET['created_at'])) {
    $created_at = $_GET['created_at'];
    $stmt<?php
// =============================
// 📂 Include Database Connection
// =============================
// Connects to MySQL and selects the CRUD database
include("db.php");

// =============================
// ❌ Delete Product (if requested)
// =============================
// Check if "created_at" is passed in the URL query string
if (isset($_GET['created_at'])) {

    // Get the timestamp identifier from query string
    $created_at = $_GET['created_at'];

    // Prepare SQL statement to delete a product by created_at
    $stmt = $conn->prepare("DELETE FROM products WHERE created_at=?");

    // Bind parameter: "s" means string (created_at timestamp is a string)
    $stmt->bind_param("s", $created_at);

    // Execute the deletion query
    $stmt->execute();
}

// =============================
// 🔄 Redirect Back to Index
// =============================
// After deletion, send user back to main page
header("Location: index.php");
exit;
?>
 = $conn->prepare("DELETE FROM products WHERE created_at=?");
    $stmt->bind_param("s", $created_at);
    $stmt->execute();
}
header("Location: index.php");
exit;
?>
