<?php
//start_session
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user_pages.css">
    <link rel="stylesheet" href="products_page.css">
    <link rel="stylesheet" href="home_page.css">
    <title>K-Shan</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
        #shop-now-carousel img{
            width: 100%; 
            height: auto; 
        }
        .logo{
            height: 100%;
            width: 4em;
            align-self: center;
        }
        .logo img{
            height: 100%;
            width: 100%;
        }
        .dropdown-menu{
           left: -20px;
        }
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
        .list-group-item {
            border: none;
            padding: 0.2em;
            font-size: 0.85em;
        }
        .list-group-item:hover, .header-band span:hover{
            color: #f68b1e;
        }
        .total-card{
            height: 70%;
            margin-bottom: 1em;
        }
        .total-card ul{
            padding: 1em;
            height: 100%;
            width: 100%;
            display:grid;
            grid-template-rows: auto auto auto;
            font-size: 1.1em;
            font-weight: 700;
        }
        .total-card ul li{
            display: grid;
            grid-template-columns: 17.5% 80%;
            column-gap: 2.5%;
        }
        .total-card ul li i{
            font-size: 1.3em;
            margin-top: 0.25em;
            color: #f68b1e;
        }
        .total-card ul p{
            font-size: 0.8em;
            font-weight: initial;
        }
        .total-card ul  .list-group-item:hover{
            color: black;
        }
        .call-CTA{
            height: 45%;
            width: 100%;
            padding: 1em;
            padding-top: 3em;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 1.1em;
            font-weight: 400;
            
        }
        .call-CTA p:nth-child(2){
            font-weight: 700;
        }
        .product-cards{
            padding: 1em;
        }
        .product-cards .header-band{
            padding: 0.5em;
            padding-left: 2.5%;
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .header-band span{
            width: 7%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-size: 1em;
        }
        .header-band span:hover{
            color: #f68b1e;
        }
        .header-band i{
            margin-top: 0.25em;
        }
        .product-cards .carousel-inner{
            width: 100%;
            height:16em ;
        }
        .product-cards .carousel-item, .product-cards .carousel-item .row{
            width: 100%;
            height: 95%;
        }
        .carousel-item {
            transition: transform 0.3s cubic-bezier(0.25, 0.1, 0.25, 1);
        }
        .product-cards .card{
            border: none;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .product-cards .card img{
            width: 90%;
            height: 80%;
        }
        .product-cards .card p:nth-child(1){
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }
        .product-cards .card p:nth-child(2){
            margin-top: 0rem;
            margin-bottom: 0.5rem;
        }
        .product-cards .carousel-control-next-icon, .product-cards .carousel-control-prev-icon{
            margin-bottom: 2em;
            background-color: lightgray;
            border-radius: 50%;

        }
        .product-cards .carousel-control-prev-icon{
            padding-left: 0;
        }
        .product-cards .carousel-control-prev, .product-cards .carousel-control-next{
            height:fit-content;
            top: 130px;
        }
        .carousel-indicators li {
            border-radius: 50%; 
            width: 10px; 
            height: 10px;
            margin: 0 4px;
            cursor: pointer;
        }
        footer{
            margin-top: 2.5em;
            padding: 2em;
            color: white;
            background-color: #000;
            padding-left: 0;
            padding-right: 0;

        }
        footer .container:nth-child(1) .row{
            height: 10em;
        }
        .download-prompt h5{
            font-size: 0.8em;
        }
        .download-prompt{
            display: grid;
            grid-template-columns: 20% 75%;
            column-gap: 5%;
            margin-bottom: 1.5em;
            color: white;
        }
        .download-prompt-btns{
            display: grid;
            grid-template-columns: auto auto;
            column-gap: 5%;
        }
        .download-prompt-btns .btn{
            display: grid;
            grid-template-columns: 30% 70%;
            font-size: 0.8em;
            border: 1px solid white;
            text-align: left;
            color: white;
        }
        .download-prompt-btns .btn i{
            font-size:2.25em;
        }
        .newsletter-prompt .btn{
            border: 1px solid white;
            text-align: left;
            color: white;
            width: 100%;
        }
        .newsletter-prompt .input-group{
            width: 90%;
            height: 3em;
            display: grid;
            grid-template-columns: 55% 17.5% 17.5%;
            column-gap: 3%;
        }
        .newsletter-prompt .input-group .form-control{
            height: 100%;
            width: 100%;
        }
        .input-group .form-control,
        .input-group .btn, .card {
            border-radius: 2px;
        }

    </style>
<body class="home-page-body">

<!-- nav bar -->
<?php include_once 'nav.php'; ?>

<section class="container" style="margin-top: 12em;">

    <!-- Display products in the cart -->
    <div class="show-product row" style="margin-right: 12.5px; margin-left: 12.5px;">
        <div class="col-8" style="background-color: white; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); background-color: white; height: 100%;">
        <h5 style="border-bottom: 0.5px solid lightgray; font-weight: 500;">
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
                        <div class="row " style="height: 15em;  padding-bottom: 2.5em;">
                            <div class="col-3">
                                <div class="focused-img" style="width: 100%; height: 80%; padding: 1em;">
                                    <img style="width: 100%; height: 100%;" src="../../admin/product-upload/<?php echo $imageUrl; ?>" style="object-fit: contain;"/>
                                </div>
                                <a href="remove_from_cart.php?id=<?php echo $product['id']; ?>" style="text-decoration: none; color: #f68b1e"><i class="fa-solid fa-trash"></i></a>
                            </div>
                            <div class="product-details col-5" style="padding: 1em;">
                                <div style=" padding: 1em; margin-bottom: 1em; ">
                                    <p><?php echo $product['name']; ?></p>
                                </div>
                            </div>
                            <div class="product-details col-4" style="padding: 1em;">
                                <div style="padding: 1em; margin-bottom: 1em;">
                                    <p><?php echo $product['price']; ?></p>
                                    <div style="display: flex; flex-direction: row; justify-content: space-between; font-size: 1.15em; width: 50%; margin-right: 20%; align-items: flex-start">
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
        <div class="col-3"  style="height: 100% ;border: none; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); background-color: white; ">
            <div class="card total-card" style="border: none; padding: 1em"  >
                <h5 style="border-bottom: 0.5px solid lightgray; font-weight: 500;">Cart Summary</h5>
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

<!-- scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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

// redirect user to view a single product's details
function showDetails(product_id){
    window.location.href = 'product.php?id=' + product_id;
}
</script>
</body>
</html>
