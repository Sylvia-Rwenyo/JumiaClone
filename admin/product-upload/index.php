<?php
//start_session
 @session_start();

// Check if the user is logged in as admin. if not redirect them to log in page
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    echo '
            <script>
            window.location.href = "../account/login/";
            </script>
            ';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Upload</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="../../../images/favicon-16x16.png">
</head>
<body>
    
     <!-- navigation bar -->
    <nav>
        <h2>Upload Product</h2>
        <a href="../../user-pages/home/">Shop</a>
        <a href='../manage-products/'>Products</a>
        <a href='../manage-orders/'>Orders</a>
        <a href='../account/settings/'>Account Settings</a>
    </nav>

    <!-- product upload form -->
    <form action="processing.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required><br>
        
        <label>Category</label>
        <select name="category">
            <option value="Official Stores"> Official Stores</option>
            <option value="Phone & Tablets">Phone & Tablets</option>
            <option value="TVs & Audio">TVs & Audio</option>
            <option value="Phone Accessories">Phone Accessories</option>
            <option value="Appliances">Appliances</option>
            <option value="Health & Beauty">Health & Beauty</option>
            <option value="Home & Office">Home & Office</option>
            <option value="Fashion">Fashion</option>
            <option value="Computing">Computing</option>
            <option value="Supermarket">Supermarket</option>
            <option value="Baby Products">Baby Products</option>
            <option value="Sporting Goods">Sporting Goods</option>
            <option value="Automobile">Automobile</option>
            <option value="Garden and Outdoors">Garden and Outdoors</option>
            <option value="Books, Music and Movies">Books, Music and Movies</option>
            <option value="Industrial and Scientific">Industrial and Scientific</option>
            <option value="Livestock">Livestock</option>
            <option value="Pet Supplies">Pet Supplies</option>
            <option value="Musical Instruments">Musical Instruments</option>
            <option value="Services">Services</option>
            <option value="Toys and Games">Toys and Games</option>
            <option value="Miscellaneous">Miscellaneous</option>
        </select>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="stockQuantity">Quantity in stock:</label>
        <input type="number" name="stockQuantity" required><br>
        
        <label for="images" class="file-label">Images:</label>
        <div class="file-container">
            <input type="file" name="images[]" id="file-input" multiple accept="image/*" class="file-input" onchange="previewFiles()">
            <span id="file-text">Choose files</span>
            <div id="file-preview-container"></div>
        </div>

        <input type="submit" value="Upload Product">
    </form>

    <!-- external js scripts -->
    <script src="script.js"></script>
</body>
</html>
