<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .call-help-CTA{
            height: 50%;
            margin-bottom: 1em;
        }
        .call-help-CTA ul{
            padding: 1em;
            height: 100%;
            width: 100%;
            display:grid;
            grid-template-rows: auto auto auto;
            font-size: 1.1em;
            font-weight: 700;
        }
        .call-help-CTA ul li{
            display: grid;
            grid-template-columns: 17.5% 80%;
            column-gap: 2.5%;
        }
        .call-help-CTA ul li i{
            font-size: 1.3em;
            margin-top: 0.25em;
            color: #f68b1e;
        }
        .call-help-CTA ul p{
            font-size: 0.8em;
            font-weight: initial;
        }
        .call-help-CTA ul  .list-group-item:hover{
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
            /* transition: transform 0.2s ease-in-out; */
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
<body class="product-page-body">

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
<nav class="nav navbar fixed-top">
    <div class="logo" style="margin-left: 2em; height: 2em; width: 2em;">
        <img src="../../images/logo.jpeg" alt="KShan Central Agency"/>
    </div>
    <div class="input-group">
        <input type="search" class="form-control rounded" placeholder="Search products, brands and categories" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn" data-mdb-ripple-init>search</button>
    </div>  
    <div class="dropdown show">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Account
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-item dp-btn"><a class="btn" href="../account/login/">SIGN IN</a></div>
            <a class="dropdown-item dp-link" href="../account/settings/"><i class="fa-regular fa-user"></i>My Account</a>
            <a class="dropdown-item dp-link" href=""><i class="ic-mrm fas fa-envelope"></i>Orders</a>
            <a class="dropdown-item dp-link" href=""><i class="fa-regular fa-heart"></i>Saved Items</a>
        </div>
    </div>
    <div class="dropdown show">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class='fa fa-question-circle-o'></i> Help
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item dp-link"  href="">Help Center</a>
            <a class="dropdown-item dp-link"  href="">Place an order</a>
            <a class="dropdown-item dp-link"  href="">Track your order</a>
            <a class="dropdown-item dp-link"  href="">Order Cancellation</a>
            <a class="dropdown-item dp-link"  href="">Returns and Refunds</a>
            <a class="dropdown-item dp-link"  href="">Payment and Jumia Account</a>
            <div class="dropdown-item dp-btn" style="border-bottom: none; border-top: 4px solid lightgray; padding-bottom: 1em;">
                <a class="btn" href=""><i class="fa-regular fa-message"></i> Live Chat</a>
            </div>
        </div>
    </div>
    <a href="" style="padding-right: 2em;" class="cart"><i class="fa-solid fa-cart-shopping"></i> Cart</a>
</nav>

<!-- main-body-elements container -->
<section class="container" style="margin-top: 6em;">

    <!-- CTA -->
    <div class="CTA row">
        <!-- categories list -->
        <div class="col-2  card categories-list" >
            <ul class="list-group">
                <li class="list-group-item show">Official Stores</li>
                <li class="list-group-item show">Phone & Tablets</li>
                <li class="list-group-item show">TVs & Audio</li>
                <li class="list-group-item show">Phone Accessories</li>
                <li class="list-group-item show">Appliances</li>
                <li class="list-group-item show">Health & Beauty</li>
                <li class="list-group-item show">Home & Office</li>
                <li class="list-group-item show">Fashion</li>
                <li class="list-group-item show">Computing</li>
                <li class="list-group-item show">Supermarket</li>
                <li class="list-group-item show">Baby Products</li>
                <li class="list-group-item show">Sporting Goods</li>
                <li class="list-group-item collapse collapsed-items">Automobile</li>
                <li class="list-group-item collapse collapsed-items">Garden and Outdoors</li>
                <li class="list-group-item collapse collapsed-items">Books, Music and Movies</li>
                <li class="list-group-item collapse collapsed-items">Industrial and Scientific</li>
                <li class="list-group-item collapse collapsed-items">Livestock</li>
                <li class="list-group-item collapse collapsed-items">Pet Supplies</li>
                <li class="list-group-item collapse collapsed-items">Musical Instruments</li>
                <li class="list-group-item collapse collapsed-items">Services</li>
                <li class="list-group-item collapse collapsed-items">Toys and Games</li>
                <li class="list-group-item collapse collapsed-items">Miscellaneous</li>
                <li class="list-group-item" data-toggle="collapse" data-target=".collapsed-items">More categories</li>
            </ul>
        </div>

        <!-- promo carousel -->
        <div class="col-8">
            <div id="shop-now-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#shop-now-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#shop-now-carousel" data-slide-to="1"></li>
                    <li data-target="#shop-now-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="../../admin/product-upload/uploads/65c0c97ea9cac.jpg" alt="">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="../../admin/product-upload/uploads/65c0c97ece69d.jpg" alt="">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="../../admin/product-upload/uploads/65c550b4c6c94.jpg" alt="">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#shop-now-carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#shop-now-carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <!-- call and help CTA -->
        <div class="col-2" >
            <div class="card call-help-CTA">
                <ul class="list-group">
                    <li class="list-group-item"><i class='fa fa-question-circle-o'></i> <span>HELP CENTER<p> Guide To Customer Care</p></span></li>
                    <li class="list-group-item"><i class="fa-solid fa-boxes-packing"></i> <span>EASY RETURN <p> Quick Refund</p></span></li>
                    <li class="list-group-item"><i class="fa-solid fa-money-bill-trend-up"></i> <span>SELL ON JUMIA <p> Millions Of Visitors</p></span></li>
                </ul>   
            </div>
            <div class="card call-CTA">
                <p>Call or Whatsapp</p>
                <p>0711 222 333</p> 
                <p>TO ORDER</p>
            </div>
        </div>
    </div>

    <!-- products row -->
        <?php
            include_once '../../controls/conn.php';

            // Fetch distinct categories from the products table
            $categorySql = "SELECT DISTINCT category FROM products"; // Assuming 'category' is the column containing category names
            $categoryResult = $conn->query($categorySql);

            if ($categoryResult->num_rows > 0) {
                while ($category = $categoryResult->fetch_assoc()) {
                    $currentCategory = $category['category'];

                    // Fetch products in the current category
                    $productSql = "SELECT * FROM products WHERE category = '$currentCategory'";
                    $productResult = $conn->query($productSql);
            ?>
            <div class="product-cards row carousel slide" id="productCarousel" data-ride="carousel" data-interval="false">
                <div class="header-band">
                    <h4><?php echo $currentCategory; ?></h4>
                    <span>See all <i class="fa fa-angle-right"></i></span>
                </div>
                <div class="carousel-inner">
                    <?php
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
<!-- Footer -->
<?php include_once 'footer.php'; ?>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function(){
    $('#productCarousel').carousel();
    $('#shop-now-carousel').carousel();

    // Toggle collapse state of additional categories when "More categories" is clicked
    $('[data-toggle="collapse"]').on('click', function() {
        $('.collapsed-items').removeClass('collapse');
        $('.categories-list').css('height', 'fit-content');
    });
});

function showDetails(product_id){
    window.location.href = 'product.php?id=' + product_id;
}
</script>
</body>
</html>
