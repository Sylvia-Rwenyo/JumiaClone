<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    echo '
            <script>
            window.location.href = "../logIn/";
            </script>
            ';
    exit();
}

include_once '../../controls/conn.php';

// Retrieve product data from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" type="text/css" href="../../css/management-style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .carousel {
            width: 200px; 
            overflow: hidden;
        }

        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item {
            width: 100%;
            margin-right: 10px;
        }

        .carousel img {
            width: 100%;
            height: auto;
        }

        .carousel-control-prev, .carousel-control-next {
            width: auto;
        }
        td a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <h2>Manage Products</h2>
            <a href="../../user-pages/home/">Shop</a>
            <a href='../product-upload/'>Add Products</a>
            <a href='#'>Manage Products</a>
            <a href='../manage-orders/'>Orders</a>
            <a href='../account/settings/'>Account Settings</a>
        </nav>

        <h3>All Products</h3>

        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>";

            while ($row = $result->fetch_assoc()) {
                // Retrieve product images for the current product
                $productId = $row["id"];
                $imageSql = "SELECT file_path FROM product_images WHERE product_id = $productId";
                $imageResult = $conn->query($imageSql);

                echo "<tr>
                        <td>{$row["id"]}</td>
                        <td>{$row["name"]}</td>
                        <td>{$row["description"]}</td>
                        <td>{$row["price"]}</td>
                        <td class='product-images'>";

                // Check if there are images for the product
                if ($imageResult->num_rows > 0) {
                    echo "<div id='carousel{$row["id"]}' class='carousel'>";
                    echo "<div class='carousel-inner'>";

                    $firstImage = true;
                    while ($imageRow = $imageResult->fetch_assoc()) {
                        echo "<div class='carousel-item" . ($firstImage ? " active" : "") . "'>";
                        echo "<img src='../product-upload/{$imageRow["file_path"]}' alt='Product Image'>";
                        echo "</div>";

                        $firstImage = false;
                    }

                    echo "</div>";
                    echo "<a class='carousel-control-prev' href='#carousel{$row["id"]}' role='button' data-slide='prev'>
                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                            <span class='sr-only'>Previous</span>
                          </a>";
                    echo "<a class='carousel-control-next' href='#carousel{$row["id"]}' role='button' data-slide='next'>
                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                            <span class='sr-only'>Next</span>
                          </a>";
                    echo "</div>";
                } else {
                    echo "No images available.";
                }

                echo "</td>
                        <td class='action-buttons'>
                            <a href='edit_product.php?id={$row["id"]}'>Edit</a> |
                            <a href='delete_product.php?id={$row["id"]}'>Delete</a>
                        </td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "No products found.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
