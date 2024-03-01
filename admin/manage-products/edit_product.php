<?php
//start_session
@session_start();

// Check if the user is logged in as admin
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

    // Fetch product details from the database
    $productSql = "SELECT * FROM products WHERE id = $productId";
    $productResult = $conn->query($productSql);

    if ($productResult->num_rows > 0) {
        $product = $productResult->fetch_assoc();

        // Fetch product images
        $imageSql = "SELECT * FROM product_images WHERE product_id = $productId";
        $imageResult = $conn->query($imageSql);

        if ($imageResult->num_rows > 0) {
            $images = $imageResult->fetch_all(MYSQLI_ASSOC);
        }
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "Product ID not provided.";
    exit();
}

// Check if the form is submitted for updating the product
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newName = $_POST["name"];
    $newPrice = $_POST["price"];
    $newDescription = $_POST["description"];

    // Update the product details in the database
    $updateProductSql = "UPDATE products SET name='$newName', price=$newPrice, description='$newDescription' WHERE id=$productId";

    if ($conn->query($updateProductSql) === TRUE) {
        // Fetch updated product images
        $imageSql = "SELECT * FROM product_images WHERE product_id = $productId";
        $imageResult = $conn->query($imageSql);

        if ($imageResult->num_rows > 0) {
            $images = $imageResult->fetch_all(MYSQLI_ASSOC);
        }

        // Handle image deletion
        if (isset($_POST['delete_images'])) {
            $deletedImages = $_POST['delete_images'];

            foreach ($deletedImages as $deletedImage) {
                // Delete from the database
                $deleteImageSql = "DELETE FROM product_images WHERE id = $deletedImage";
                $conn->query($deleteImageSql);

                // Delete from the uploads folder
                $deletedImagePath = "../product-upload/uploads/" . $deletedImage;
                if (file_exists($deletedImagePath)) {
                    unlink($deletedImagePath);
                }
            }
        }

        // Handle image upload
        if (!empty($_FILES['new_images']['name'][0])) {
            // Upload new images
            $uploadsFolder = "../product-upload/uploads/";

            foreach ($_FILES['new_images']['tmp_name'] as $key => $tmpName) {
                $newImageName = uniqid() . "_" . $_FILES['new_images']['name'][$key];
                $targetPath = $uploadsFolder . $newImageName;

                if (move_uploaded_file($tmpName, $targetPath)) {
                    // Insert into the database
                    $insertImageSql = "INSERT INTO product_images (product_id, file_path) VALUES ($productId, '$newImageName')";
                    $conn->query($insertImageSql);

                    // Add the new image to the images array
                    $images[] = array('file_path' => $newImageName);
                } else {
                    echo "Failed to upload image.";
                }
            }
        }

        // Redirect user after processing
        echo '<script>window.location.href = "index.php";</script>';
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

//close database connection 
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" type="text/css" href="../product-upload/style.css">
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
     <!-- navigation bar -->
        <nav>        
            <h2>Manage Products</h2>
            <a href='index.php'>Products</a>
            <a href='../manage-orders/'>Orders</a>
            <a href='../account/settings/'> Settings</a>
        </nav>

        <h3 >Edit Product Details</h3>

        <!-- show edit product form with values of product to be edited being autofilled -->
        <form action="edit_product.php?id=<?php echo $productId; ?>" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>

            <label for="price">Price:</label>
            <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required><br>

            <label for="description">Description:</label>
            <textarea name="description" required><?php echo $product['description']; ?></textarea><br>

            <h4>Existing Images</h4>
            <?php if (isset($images) && is_array($images) && count($images) > 0) : ?>
                <div class="existing-images">
                    <?php foreach ($images as $image) : ?>
                        <div class="image-container">
                            <img src="../product-upload/<?php echo $image['file_path']; ?>" alt="Product Image">
                            <input type="checkbox" name="delete_images[]" value="<?php echo $image['id']; ?>">
                            <span>Delete</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <h4>New Images</h4>
            <div class="file-container">
            <input type="file" name="new_images[]" id="file-input" multiple accept="image/*" class="file-input" onchange="previewFiles()">
            <span id="file-text">Choose files</span>
            <div id="file-preview-container"></div>
        </div>

            <input type="submit" value="Update Product">
        </form>
    </div>

        <!-- external js scripts -->
    <script src="../product-upload/script.js"></script>

</body>
</html>
