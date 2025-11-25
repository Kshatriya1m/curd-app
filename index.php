<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Manager</title><?php 
// =============================
// 📂 Include Database Connection
// =============================
// Imports db.php which connects to MySQL 
// and ensures the database/table exist
include("db.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Manager</title>
    <!-- External stylesheet for UI styling -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

    <!-- =========================
         🛍️ Page Title
         ========================= -->
    <h2>🛍️ Product Manager</h2>

    <!-- =========================
         ➕ Add Product Form
         ========================= -->
    <div class="card">
        <h3>Add Product</h3>
        <!-- Form submits new product to add.php -->
        <form action="add.php" method="POST">
            <!-- Product Name: required, min length 2 -->
            <input type="text" name="product_name" placeholder="Product Name" required minlength="2">
            
            <!-- Product Price: required, min=1, step=1 (no decimals unless allowed) -->
            <input type="number" name="price" placeholder="Price" required min="1" step="1">
            
            <!-- Product Description: optional, limited to 200 chars -->
            <textarea name="description" placeholder="Description (optional, max 200 chars)" maxlength="200"></textarea>
            
            <!-- Submit Button -->
            <button type="submit" class="btn btn-add">Add Product</button>
        </form>
    </div>

    <!-- =========================
         📋 Product Listing
         ========================= -->
    <div class="card">
        <h3>Products</h3>
        <table>
            <!-- Table Headings -->
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <!-- Table Body -->
            <tbody>
                <?php
                // Fetch all products from DB, most recent first
                $sql = "SELECT * FROM products ORDER BY created_at DESC";
                $result = $conn->query($sql);
                $i = 1; // simple row counter for Id column

                // If there are products, loop through and display each row
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <!-- Auto-incrementing ID for table display -->
                            <td>". $i++ ."</td>

                            <!-- Product Name (escaped for security) -->
                            <td>". htmlspecialchars($row['product_name']) ."</td>

                            <!-- Price formatted as xx.xx -->
                            <td>Rs.". number_format($row['price'], 2) ."</td>

                            <!-- Description (escaped for security) -->
                            <td>". htmlspecialchars($row['description']) ."</td>

                            <!-- Edit/Delete Action Buttons -->
                            <td>
                                <!-- Passes product created_at as identifier -->
                                <a href='update.php?created_at=". $row['created_at'] ."' class='btn btn-edit'>Edit</a>
                                
                                <!-- Delete link with confirmation popup -->
                                <a href='delete.php?created_at=". $row['created_at'] ."' 
                                   class='btn btn-delete' 
                                   onclick=\"return confirm('Delete this product?')\">Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    // If no products exist, show friendly message
                    echo "<tr><td colspan='5'>No products found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

    <h2>🛍️ Product Manager</h2>

    <!-- Add Product Form -->
    <div class="card">
        <h3>Add Product</h3>
        <form action="add.php" method="POST">
            <input type="text" name="product_name" placeholder="Product Name" required minlength="2">
            <input type="number" name="price" placeholder="Price" required min="1" step="1">
            <textarea name="description" placeholder="Description (optional, max 200 chars)" maxlength="200"></textarea>
            <button type="submit" class="btn btn-add">Add Product</button>
        </form>
    </div>

    <!-- Products Table -->
    <div class="card">
        <h3>Products</h3>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM products ORDER BY created_at DESC";
                $result = $conn->query($sql);
                $i = 1; // numbering counter
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>". $i++ ."</td>
                            <td>". htmlspecialchars($row['product_name']) ."</td>
                            <td>$". number_format($row['price'], 2) ."</td>
                            <td>". htmlspecialchars($row['description']) ."</td>
                            <td>
                                <a href='update.php?created_at=". $row['created_at'] ."' class='btn btn-edit'>Edit</a>
                                <a href='delete.php?created_at=". $row['created_at'] ."' class='btn btn-delete' onclick=\"return confirm('Delete this product?')\">Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No products found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
