<?php
//start_session
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Jumia Clone</title>
    <!-- stylesheets and cdn links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="user_pages.css">
    <link rel="stylesheet" href="products_page.css">
    <link rel="stylesheet" href="home_page.css">
    <link rel="icon" type="image/png" href="../../images/favicon-16x16.png">
</head>
<body class="home-page-body">

<!-- nav bar -->
<?php include_once 'nav.php'; ?>

<section class="container main-container" style="margin-top: 10em; row-gap: 1%;">

    <!-- Display products in the cart -->
    <div class="show-product show-cart-products row">
        <div class="col-7 all-cart-products" style="background-color: white; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); background-color: white; height: 100%;">
        <h5 style="border-bottom: 0.5px solid lightgray; font-weight: 500; padding: 1em">
            Cart <?php echo isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 ? '(' . count($_SESSION['cart']) . ')' : ''; ?>
        </h5>
            <?php
            //database connection
            include_once '../../controls/conn.php';

            $totalPrice = 0;

            // Check if the cart session variable exists and is not empty
            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                // Fetch all products from the cart session variable
                foreach ($_SESSION['cart'] as $productId => $quantity){
                    // Fetch product details from the database
                    $productSql = "SELECT * FROM products WHERE id = '$productId'";
                    $productResult = $conn->query($productSql);

                    if ($productResult->num_rows > 0) {
                        $product = $productResult->fetch_assoc();
                        $imageUrl = ''; // Default image URL

                        // Fetch product images
                        $imageSql = "SELECT * FROM product_images WHERE product_id = '$productId'";
                        $imageResult = $conn->query($imageSql);

                        if ($imageResult->num_rows > 0) {
                            $image = $imageResult->fetch_assoc();
                            $imageUrl = $image['file_path'];
                        }
                        

                        // Calculate total price
                        $totalPrice += $product['price'] * intval($quantity);

                        $_SESSION['total_amount'] = $totalPrice;

                        // style row appropraitely
                        echo "<style>
                                .show-product.row{
                                    height: fit-content;
                                </style>
                        ";

                        // Display product details
                        ?>
                        <div class="row " style="height: 15em;  padding-bottom: 2.5em; border-bottom: 2px solid lightgray">
                            <div class="col-3">
                                <div class="focused-img" style="width: 100%; height: 80%;">
                                    <img style="width: 100%; height: 100%; object-fit: contain;" src="../../admin/product-upload/<?php echo $imageUrl; ?>"/>
                                </div>
                                <a href="remove_from_cart.php?id=<?php echo $product['id']; ?>" style="text-decoration: none; color: #f68b1e"><i class="fa-solid fa-trash"></i></a>
                            </div>
                            <div class="product-details col-5" style="padding: 1em;">
                                <div style=" padding: 1em; margin-bottom: 1em; padding-left: 0; padding-right: 0;">
                                    <p><?php echo $product['name']; ?></p>
                                </div>
                            </div>
                            <div class="product-details col-4" style="padding: 1em;">
                                <div style="padding: 1em; margin-bottom: 1em; padding-left: 0.5em; padding-right: 0.5em;">
                                    <p><?php echo $product['price']; ?></p>
                                    <div style="display: flex; flex-direction: row; justify-content: space-between; font-size: 1.15em; width: 100%; margin-right: 20%; align-items: flex-start">
                                        <i class="fa-solid fa-square-minus minus-quantity" data-productid="<?php echo $product['id']; ?>" style="color: #f68b1e; border-radius: 10px; font-size: 1.25em"></i>
                                        <span id="quantity-text"><?php echo $quantity; ?></span>
                                        <i class="fa-solid fa-square-plus add-quantity" data-productid="<?php echo $product['id']; ?>" style="color: #f68b1e; font-size: 1.25em"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
            }}}else {
                // If the cart is empty, display a message
                echo "<p>Your cart is empty.</p>
                        <style>
                        .show-product.row{
                            height: 10em;
                        </style>
                ";
            }
            ?>
        </div>

        <!-- Display cart summary -->
        <?php
            if($totalPrice > 0){
        ?>
        <div class="col-4 cart-summary"  style="height: 100% ;border: none; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); background-color: white; ">
            <h5 style="border-bottom: 0.5px solid lightgray; font-weight: 500; padding: 1em">Cart Summary</h5>
            <div class="card total-card" style="border: none; padding: 1em"  >
                <p>Sub Total: <span><?php echo $totalPrice; ?></span></p>
                <a href="checkout.php" class="btn"> Check Out (Ksh <?php echo $totalPrice; ?>)</a>
            </div>
        </div>
        <?php
            }
        ?>
    </div>

    <!-- Display product categories and products -->
    <?php
    // Fetch distinct categories from the products table
    $categorySql = "SELECT DISTINCT category FROM products"; 
    $categoryResult = $conn->query($categorySql);

    if ($categoryResult->num_rows > 0) {
        while ($category = $categoryResult->fetch_assoc()) {
            $currentCategory = $category['category'];

            // Fetch products for the current category
            $productSql = "SELECT * FROM products WHERE category = '$currentCategory'";
            $productResult = $conn->query($productSql);
            ?>
            <div class="product-cards row carousel slide" id="productCarousel" data-ride="carousel" data-interval="false">
                <!-- Display category header -->
                <div class="header-band">
                    <h4><?php echo $currentCategory; ?></h4>
                     <a href="products_by_category.php?category=<?php echo urlencode($currentCategory); ?>" class="categories-link">See all <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="carousel-inner">
                    <?php
                    // Display products for the current category
                    $count = 0; // Counter for tracking products displayed
                    while ($product = $productResult->fetch_assoc()) {
                        if ($count % 4 == 0) { // Start a new carousel item every 4 products
                            if ($count == 0) {
                                echo '<div class="carousel-item active">';
                            } else {
                                echo '<div class="carousel-item">';
                            }
                            echo '<div class="row">';
                        }
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
                            <img src="../../admin/product-upload/<?php echo $imageUrl; ?>" alt="product" />
                            <div class="single-product-details">
                                <p><?php echo $product['name']; ?></p>
                                <p>Ksh <?php echo $product['price']; ?></p>
                            </div>
                        </div>
                        <?php
                        $count++;
                        if ($count % 4 == 0) { // Close the row and carousel item every 4 products
                            echo '</div>'; // Close the row
                            echo '</div>'; // Close the carousel item
                        }
                    }
                    // If the number of products is not a multiple of 4, close the last carousel item and row
                    if ($count % 4 != 0) {
                        echo '</div>'; // Close the row
                        echo '</div>'; // Close the carousel item
                    }
                    ?>
                </div>
                <!-- Carousel navigation controls -->
                <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <?php
        }
    }
    ?>
</section>

<?php include_once 'footer.php'; ?>

<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="nav_script.js"></script>

<script>
$(document).ready(function(){
    $('#productCarousel').carousel();
    $('#single-productCarousel').carousel();

    // Toggle collapse state of additional categories when "More categories" is clicked
    $('[data-toggle="collapse"]').on('click', function() {
        if($('.collapsed-items').classList.contains('collapse')){
            $('.collapsed-items').classList.remove('collapse');
            $('.collapsed-items').classList.add('show');
            $('.categories-list').css('height', 'fit-content');
        }else{
            $('.collapsed-items').classList.remove('show');
            $('.collapsed-items').classList.add('collapse');
        }
    });
   
    // Handle click event for adding quantity
    $('.add-quantity').on('click', function() {
        var productId = $(this).data('productid');
        var quantitySpan = document.getElementById('quantity-text');
        var quantityText = quantitySpan.textContent.trim(); 
        var quantity = parseInt(quantityText); 
        quantity++;
        quantitySpan.textContent = quantity; // Update the text content

        // Update cart session variable with new quantity
        updateCart(productId, quantity);
    });

    // Handle click event for reducing quantity
    $('.minus-quantity').on('click', function() {
        var productId = $(this).data('productid');
        var quantitySpan = document.getElementById('quantity-text');
        var quantityText = quantitySpan.textContent.trim(); 
        var quantity = parseInt(quantityText); 

        if (quantity > 1) {
            quantity--;
            quantitySpan.textContent = quantity; // Update the text content

            // Update cart session variable with new quantity
            updateCart(productId, quantity);
        }
    });

    function updateCart(productId, quantity) {
        // Send AJAX request to update cart session variable
        $.ajax({
            type: 'POST',
            url: 'update_cart.php',
            data: { productId: productId, quantity: quantity },
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    var parentRow = document.querySelector('.show-cart-products');
    var targetSmallCol = document.querySelector('.cart-summary');
    var targetLargeCol = document.querySelector('.all-cart-products');

    parentRow.marginBottom = 0;

    function handleWindowResize() {
        if (window.innerWidth <= 720) {
            if (targetSmallCol.classList.contains('col-4')) {
                targetSmallCol.classList.remove('col-4');
                targetSmallCol.classList.add('col-12');
            }
            if (targetLargeCol.classList.contains('col-7')) {
                targetLargeCol.classList.remove('col-7');
                targetLargeCol.classList.add('col-12');
            }
        } else {
            if (targetSmallCol.classList.contains('col-12')) {
                targetSmallCol.classList.remove('col-12');
                targetSmallCol.classList.add('col-4');
            }
            if (targetLargeCol.classList.contains('col-12')) {
                targetLargeCol.classList.remove('col-12');
                targetLargeCol.classList.add('col-7');
            }
        }
    }

    handleWindowResize(); // Call the function on page load

    window.addEventListener("resize", function() {
        handleWindowResize(); // Attach event listener for window resize
    });
});

// redirect user to view a single product's details
function showDetails(product_id){
    window.location.href = 'product.php?id=' + product_id;
}
</script>
</body>
</html>
