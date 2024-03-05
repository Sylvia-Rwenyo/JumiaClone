<?php
//start_session
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Shan</title>
    <!-- stylesheet files and CDN links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="products_page.css">
    <link rel="stylesheet" href="home_page.css">
    <link rel="stylesheet" href="user_pages.css">
    <link rel="icon" type="image/png" href="../../images/favicon-16x16.png">
</head>
<body class="home-page-body">

<!-- nav bar -->
<?php include_once 'nav.php'; ?>

<section class="container" style="margin-top: 12em;">
<div class="row">
    <div class="col-3">

    </div>
   <div class="col-7">

    <!-- Display product categories and products -->
    <?php
        // Get the query from the URL
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $query = urldecode($query); // Decode URL-encoded query string
        $query = str_replace('%20', ' ', $query); // Replace %20 with spaces
        $query = '%' . $query . '%'; // Add wildcard characters for partial match
        
        $stmt = $conn->prepare("SELECT * FROM products WHERE category = ? OR name LIKE ?");
        $stmt->bind_param("ss", $query, $query);
        $stmt->execute();
        $productResult = $stmt->get_result();
        // Get the number of matches found
        $numMatches = $productResult->num_rows;
    ?>    
            <div class="product-cards row" style="row-gap: 2em;">
                <!-- Display query header -->
                <div class="header-band" style="background:transparent;">
                    <p style="width: 100%"><?php echo $numMatches ?> products found</p>
                </div>
                    <?php
                    // Display products for the current query
                    while ($product = $productResult->fetch_assoc()) {
                    
                        // Fetch product images
                        $productId = $product['id'];
                        $imageSql = "SELECT * FROM product_images WHERE product_id = $productId";
                        $imageResult = $conn->query($imageSql);

                        if ($imageResult->num_rows > 0) {
                            $image = $imageResult->fetch_assoc();
                            $imageUrl = $image['file_path'];
                        }
                        ?>
                        <!-- Display product card -->
                        <div class="single-product-card card col-3" onclick="showDetails(<?php echo $productId; ?>)">
                            <img src="../../admin/product-upload/<?php echo $imageUrl; ?>" alt="product"  tsyle="height: 60%"/>
                            <div class="">
                                <p><?php echo $product['name']; ?></p>
                                <p style="font-size: 0.8em">Ksh <?php echo $product['price']; ?></p>
                                <p style="font-size: 0.8em"><?php $description = $product['description'];
                                    $words = explode(' ', $description); // Split the description into an array of words
                                    $first_three_words = implode(' ', array_slice($words, 0, 3)); // Concatenate the first three words 
                                    echo $first_three_words ?>
                            </p>
                             <a href="add_to_cart.php?id=<?php echo $productId; ?>" class="btn cart-btn"> <i class="fa-solid fa-cart-plus"></i> Add to cart</a>
                            </div>
                        </div>
                        <?php
                    }
                        ?>
            </div>
   </div>
   </div>
</section>

<!-- footer -->
<?php include_once 'footer.php'; ?>
</body>
<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="nav_script.js"></script>
</html>
