<?php
//start_session
 @session_start();

// Check if the user is logged in as admin, if not redirect them to login
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    echo '
        <script>
        window.location.href = "../logIn/";
        </script>
        ';
}

//database connection
include_once '../../controls/conn.php';

// Check if product ID is provided
if (isset($_GET["id"])) {
    $productId = $_GET["id"];

    // Retrieve the file paths of associated images
    $imageSql = "SELECT file_path FROM product_images WHERE product_id = $productId";
    $imageResult = $conn->query($imageSql);

    // Delete the product from the database
    $deleteProductSql = "DELETE FROM products WHERE id = $productId";

    if ($conn->query($deleteProductSql) === TRUE) {
        // Delete associated images from the database
        $deleteImagesSql = "DELETE FROM product_images WHERE product_id = $productId";
        $conn->query($deleteImagesSql);

        // Delete the actual image files from the server
        while ($imageRow = $imageResult->fetch_assoc()) {
            $filePath = "../product-upload/uploads/" . $imageRow["file_path"];
            unlink($filePath);
        }

        // redirect admin to products display page
        echo '
        <script>
        window.location.href = "index.php";
        </script>
        ';
    } else {
        // show error if it occurred
        echo "Error deleting product: " . $conn->error;
    }
} else {
    echo "Product ID not provided.";
    exit();
}

//close database connection 
    $conn->close();

?>
