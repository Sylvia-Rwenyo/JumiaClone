<?php
include_once '../../controls/conn.php';

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $stockQuantity = $_POST["stockQuantity"];
    $price = $_POST["price"];

    // Insert data into the products table using prepared statement
    $stmt = $conn->prepare("INSERT INTO products (name, category, description, price, stockQuantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdd", $name, $category, $description, $price, $stockQuantity);

    if ($stmt->execute()) {
        $productId = $conn->insert_id;

        // Handle file uploads
        $targetDirectory = "uploads/";

        // Check if the directory exists, create it if not
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        $uploadedFiles = array();

        foreach ($_FILES['images']['name'] as $key => $value) {
            // Generate a unique identifier
            $uniqueIdentifier = uniqid();

            // Append the unique identifier and original file extension to create a new file name
            $newFileName = $uniqueIdentifier . '.' . pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION);

            $targetFile = $targetDirectory . $newFileName;

            // Validate file type (you may need to enhance this)
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Error: Only JPG, JPEG, and PNG files are allowed.";
                continue; // Skip to the next iteration
            }

            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFile)) {
                $uploadedFiles[] = $targetFile;

                // Insert file information into a separate table (you may need to create this table)
                $fileSql = "INSERT INTO product_images (product_id, file_path) VALUES ($productId, '$targetFile')";
                $conn->query($fileSql);
            } else {
                echo "Error uploading file.";
            }
        }

        echo "
        <script>
        window.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
