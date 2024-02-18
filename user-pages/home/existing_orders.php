<?php
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="products_page.css">
    <link rel="stylesheet" href="home_page.css">
    <link rel="stylesheet" href="user_pages.css">
    <title>K-Shan</title>
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="home-page-body">

<style>
         .dropdown .btn-secondary.dropdown-toggle{
            background:  transparent;
            color: black;
            border: none;
        }
        .dropdown .btn-secondary.dropdown-toggle:focus{
            outline: none;
            box-shadow: none;
            color: #f68b1e;
        }
        </style>

<!-- delivery banner -->
<!-- <div class="delivery-banner">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <p>FREE DELIVERY</p>
            </div>
            <div class="carousel-item">
                <p>On orders above Ksh 1,999</p>
            </div>
            <div class="carousel-item">
                <p>Terms and Conditions apply</p>
            </div>
        </div>
    </div>
    <div class="delivery-call-prompt">
        <p>Call Whatsapp to Order</p>
        <p><i class="fab fa-whatsapp"></i>0711 222 333</p>
    </div>
</div> -->

<!-- nav bar -->
<?php include_once 'nav.php'; ?>

<section class="container" style="margin-top: 12em;">

    <!-- Display products in the orders table -->
    <div class="show-product row" style="height: 20em;">
    <div class="col-12" style="background-color: white; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); height: 100%; overflow-y: scroll;">
        <h5 style="border-bottom: 0.5px solid lightgray; font-weight: 500; padding: 1em;">Your Orders</h5>
        <?php
        include_once '../../controls/conn.php';

        $totalPrice = 0;

        $order_id = 0;

        $ordersSql = "SELECT * FROM orders WHERE status = 'pending'";
        $orderResult = $conn->query($ordersSql);

        if ($orderResult->num_rows > 0) {
            while ($order = $orderResult->fetch_assoc()) {
                $order_id = $order['order_id'];

                // Fetch product details from the database
                $order_itemsSql = "SELECT * FROM order_items WHERE order_id = '$order_id'";
                $order_itemsResult = $conn->query($order_itemsSql);

                if ($order_itemsResult->num_rows > 0) {
                    while ($item = $order_itemsResult->fetch_assoc()) {
                        $item_id = $item['product_id'];

                        // Fetch product details from the database
                        $productSql = "SELECT * FROM products WHERE id = '$item_id'";
                        $productResult = $conn->query($productSql);

                        if ($productResult->num_rows > 0) {
                            $product = $productResult->fetch_assoc();
                            $imageUrl = ''; // Default image URL

                            // Fetch product images
                            $imageSql = "SELECT * FROM product_images WHERE product_id = '$item_id'";
                            $imageResult = $conn->query($imageSql);

                            if ($imageResult->num_rows > 0) {
                                $image = $imageResult->fetch_assoc();
                                $imageUrl = $image['file_path'];
                            }

                            // Calculate total price
                            // $totalPrice += $product['price'] * intval($quantity);

                            // Display product details
                            ?>
                            <div class="row" style="height: 8em; margin-bottom: 3em">
                                <div class="col-2">
                                    <div class="focused-img" style="width: 100%; height: 80%; padding: 1em;">
                                        <img style="width: 100%; height: 100%;" src="../../admin/product-upload/<?php echo $imageUrl; ?>" style="object-fit: contain;"/>
                                    </div>
                                    <a data-toggle="modal" data-target="#delete-order"  style="text-decoration: none; color: darkblue;">Cancel order</a>
                                </div>
                                <div class="product-details col-2" style="padding: 1em;">
                                    <div style=" padding: 1em; margin-bottom: 1em; ">
                                        <p><?php echo $product['name']; ?></p>
                                    </div>
                                </div>
                                <div class="product-details col-3" style="padding: 1em;">
                                    <div style="padding: 1em; margin-bottom: 1em;">
                                        <p><?php echo $product['price']; ?></p>

                                    </div>
                                </div>
                                <div class="product-details col-5" style="padding: 1em;">
                                    <div style="padding: 1em; margin-bottom: 1em;">
                                        <p><strong>Processing status: </strong><?php echo $order['status']; ?></p>

                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
            }
        } else {
            // If the cart is empty, display a message
            echo "<p>No pending orders.</p>";
        }
        ?>
    </div>
    <!-- Modal for deleting order -->
    <div id="delete-order" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure you want to cancel your order?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="width: 48%; color: #f68b1e; border: 1px solid #f68b1e; background: transparent" data-dismiss="modal">Cancel</button>
                    <a href="cancel_order.php?id=<?php echo $order_id; ?>" type="button"  class="btn" style="width: 48%; color: white; background-color: #f68b1e;">Confirm</a>
                </div>
            </div>
        </div>
    </div>

        <!-- Display cart summary -->
        <!-- <div class="col-3"  style="height: 100% ;border: none; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); ">
            <div class="card total-card" style="border: none; padding: 1em"  >
                <h5 style="border-bottom: 0.5px solid lightgray; font-weight: 500;">Cart Summary</h5>
                <p>Sub Total: <span><?php
                //  echo $totalPrice; 
                ?></span></p>
                <a href="checkout.php" class="btn"> Check Out (Ksh <?php 
                // echo $totalPrice; 
                ?>)</a>
            </div>
        </div> -->
    </div>

    <!-- Display product categories and products -->
    <?php
    // Fetch distinct categories from the products table
    $categorySql = "SELECT DISTINCT category FROM products"; // Assuming 'category' is the column containing category names
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
                    <span>See all <i class="fa fa-angle-right"></i></span>
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
                            <div class="">
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

<!-- Scripts -->
<script src="../../js/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="../../js/fontawesome.js" crossorigin="anonymous"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function(){
    $('#productCarousel').carousel();
    $('#single-productCarousel').carousel();

    // Toggle collapse state of additional categories when "More categories" is clicked
    $('[data-toggle="collapse"]').on('click', function() {
        $('.collapsed-items').removeClass('collapse');
        $('.categories-list').css('height', 'fit-content');
    });
   
    // Handle click event for adding quantity
    $('.add-quantity').on('click', function() {
        var productId = $(this).data('productid');
        var quantitySpan = $(this).next('span');
        var quantityText = quantitySpan.text().trim(); // Trim whitespace
        var quantity = quantityText; // Check if text contains only digits, if not, default to 0
        quantity++;
        quantitySpan.text(quantity);

        // Update cart session variable with new quantity
        updateCart(productId, quantity);
    });

    // Handle click event for reducing quantity
    $('.minus-quantity').on('click', function() {
        var productId = $(this).data('productid');
        var quantitySpan = $(this).prev('span');
        var quantityText = quantitySpan.text().trim(); // Trim whitespace
        var quantity = quantityText; // Check if text contains only digits, if not, default to 0

        if (quantity > 1) {
            quantity--;
            quantitySpan.text(quantity);

            // Update cart session variable with new quantity
            updateCart(productId, quantity);
        }
    });

    function updateCart(productId, quantity) {
        // Send AJAX request to update cart session variable
        $.ajax({
            type: 'POST',
            url: 'update_cart.php', // Replace 'update_cart.php' with the actual file handling cart updates
            data: { productId: productId, quantity: quantity },
            success: function(response) {
                // Handle success response
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    }
});



function showDetails(product_id){
    window.location.href = 'product.php?id=' + product_id;
}
</script>
</body>
</html>
