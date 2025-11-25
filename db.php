<?php
$servername = "localhost:3307"; 
$username = "root"; 
$password = ""; 
$dbname = "crud_php";

// Create connection
$conn = new mysqli($servername, $username, $password);
<?php
// =============================
// 🗄️ Database Configuration
// =============================

// Server details (adjust port if MySQL runs on custom port, e.g. 3307)
$servername = "localhost:3307"; 
$username   = "root"; 
$password   = ""; 
$dbname     = "crud_php";

// =============================
// 🔌 Create Connection
// =============================
$conn = new mysqli($servername, $username, $password);

// Check connection success/failure
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// =============================
// 🏗️ Create Database if Missing
// =============================
// Will only create it if it doesn't already exist
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");

// Switch active database to the one we just ensured exists
$conn->select_db($dbname);

// =============================
// 📦 Create Products Table
// =============================
// Defines table with 4 columns:
// - product_name: name of the product
// - price: decimal field for product price
// - description: optional product description
// - created_at: timestamp, auto-generated
$table = "CREATE TABLE IF NOT EXISTS products (
    product_name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Execute the table creation query
$conn->query($table);
?>

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

// Create products table if not exists (no id column)
$table = "CREATE TABLE IF NOT EXISTS products (
    product_name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($table);
?>
