<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Shan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home_page.css">
    <link rel="stylesheet" href="user_pages.css">
    <link rel="icon" type="image/png" href="../../images/favicon-16x16.png">
</head>
<body class="product-page-body">
<!-- nav bar -->
<?php include_once 'nav.php' ?>

<!-- main-body-elements container -->
<section class="container main-container">

    <!-- CTA -->
    <div class="CTA row">
        <!-- categories list -->
        <div class="col-2  card categories-list" id="categories-list">
            <ul class="list-group">
                <li class="list-group-item show"><i class="fa-solid fa-bag-shopping"></i>Official Stores</li>
                <li class="list-group-item show"><i class="fa-solid fa-mobile-screen"></i>Phone & Tablets</li>
                <li class="list-group-item show"><i class="fa-solid fa-tv"></i>TVs & Audio</li>
                <li class="list-group-item show"><i class="fa-solid fa-blender"></i>Appliances</li>
                <li class="list-group-item show"><i class="fa-solid fa-bottle-droplet"></i>Health & Beauty</li>
                <li class="list-group-item show"><i class="fa-solid fa-blender"></i>Home & Office</li>
                <li class="list-group-item show"><i class="fa-solid fa-shirt"></i>Fashion</li>
                <li class="list-group-item show"><i class="fa-solid fa-computer"></i>Computing</li>
                <li class="list-group-item show"><i class="fa-solid fa-apple-whole"></i>Supermarket</li>
                <li class="list-group-item show"><i class="fa-solid fa-baby-carriage"></i>Baby Products</li>
                <li class="list-group-item show"><i class="fa-solid fa-dumbbell"></i>Sporting Goods</li>
                <li class="list-group-item collapsed-items collapse">Automobile</li>
                <li class="list-group-item collapsed-items collapse">Garden and Outdoors</li>
                <li class="list-group-item collapsed-items collapse">Books, Music and Movies</li>
                <li class="list-group-item collapsed-items collapse">Industrial and Scientific</li>
                <li class="list-group-item collapsed-items collapse">Livestock</li>
                <li class="list-group-item collapsed-items collapse">Pet Supplies</li>
                <li class="list-group-item collapsed-items collapse">Musical Instruments</li>
                <li class="list-group-item collapsed-items collapse">Services</li>
                <li class="list-group-item collapsed-items collapse">Toys and Games</li>
                <li class="list-group-item collapsed-items collapse">Miscellaneous</li>
                <li class="list-group-item" data-toggle="collapse" data-target=".collapsed-items">
                    <i class="fa-solid fa-ellipsis" style="padding: 0.15em; border: 1px solid black; border-radius: 30%"></i>More categories
                </li>
            </ul>
        </div>

        <!-- promo carousel -->
        <div class="col-8 shop-now-carousel-div" id="shop-now-carousel-div">
            <div id="shop-now-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#shop-now-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#shop-now-carousel" data-slide-to="1"></li>
                    <li data-target="#shop-now-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img  src="../../admin/product-upload/uploads/65c0c97ea9cac.jpg" alt="">
                    </div>
                    <div class="carousel-item">
                        <img  src="../../admin/product-upload/uploads/65c0c97ece69d.jpg" alt="">
                    </div>
                    <div class="carousel-item">
                        <img  src="../../admin/product-upload/uploads/65c55188b6d35.jpg" alt="">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#shop-now-carousel" role="button" data-slide="prev" style="height: 3em; top: 40%">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#shop-now-carousel" role="button" data-slide="next" style="height: 3em; top: 40%">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <a href="index.php#product-rows" class="shop-now-CTA">Shop now  <i class="fa fa-angle-right"></i></a>
        </div>

        <!-- call and help CTA -->
        <div class="col-2" id="home-CTA-Col2" >
            <div class="card call-help-CTA">
                <ul class="list-group">
                    <li class="list-group-item"><i class='fa fa-question-circle-o'></i> <span style="font-size: 0.85em">HELP CENTER<p> Guide To Customer Care</p></span></li>
                    <li class="list-group-item"><i class="fa-solid fa-boxes-packing"></i> <span style="font-size: 0.85em">EASY RETURN<p> Quick Refund</p></span></li>
                    <li class="list-group-item"><i class="fa-solid fa-money-bill-trend-up"></i><span style="font-size: 0.85em">SELL ON KSHAN<p>Millions Of Visitors</p></span></li>
                </ul>   
            </div>
            <div class="card call-CTA">
                <p>Call or Whatsapp</p>
                <a href="tel: +254745527698" style=" font-size: 0.9em; text-decoration: none; color: black;">0745 527 698</a> 
                <p>TO ORDER</p>
            </div>
        </div>
    </div>

    <!-- products row -->
    <div id="product-rows">
        <?php
            //database connection
            include_once '../../controls/conn.php';

            // Fetch distinct categories from the products table
            $categorySql = "SELECT DISTINCT category FROM products"; 
            $categoryResult = $conn->query($categorySql);
            $category_count= 0;

            if ($categoryResult->num_rows > 0) {
                while ($category = $categoryResult->fetch_assoc()) {
                    $currentCategory = $category['category'];
                    $category_count += 1;

                    // Fetch products in the current category
                    $productSql = "SELECT * FROM products WHERE category = '$currentCategory'";
                    $productResult = $conn->query($productSql);
            ?>
            <div class="product-cards row carousel slide" id="productCarousel<?php echo $category_count; ?>" data-ride="carousel" data-interval="false">
                <div class="header-band">
                    <h4><?php echo $currentCategory; ?></h4>
                     <a href="products_by_category.php?category=<?php echo urlencode($currentCategory); ?>" class="categories-link">See all <i class="fa fa-angle-right"></i></a>
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
                        <div class="single-product-details">
                            <?php
                            $description = $product['description'];
                            $words = explode(' ', $description); // Split the description into an array of words
                            $first_three_words = implode(' ', array_slice($words, 0, 3)); // Concatenate the first three words

                            echo '<p>' . $product['name'] . ' | ' . $first_three_words . '</p>'; // Display only the first three words
                            ?>
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
                <a class="carousel-control-prev" href="#productCarousel<?php echo $category_count; ?>" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#productCarousel<?php echo $category_count; ?>" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <?php
                }
            }
        ?>
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
<script src="user_pages.js"></script>
<script>
$(document).ready(function(){
    $('#productCarousel').carousel();
    $('#shop-now-carousel').carousel();
    <?php
        if($category_count > 0){
            echo " $('#productCarousel".$category_count."').carousel();";
        }
    ?>

    // Toggle collapse state of additional categories when "More categories" is clicked
    let categoriesList = document.getElementById("categories-list");
    let shopCarousel = document.getElementById("shop-now-carousel-div");
    var helpCTA = document.getElementById("home-CTA-Col2");
    $('[data-toggle="collapse"]').on('click', function() {
        let collapsedItems = document.querySelector('.collapsed-items');
        if (collapsedItems && !collapsedItems.classList.contains('show')) {
            collapsedItems.classList.remove('collapse');
            categoriesList.style.height = 'fit-content';
            shopCarousel.style.height = '100%'
            helpCTA.style.height = '100%'
        } else{
            helpCTA.style.height = '25em';
            shopCarousel.style.height = '25em';
            collapsedItems.classList.add('collapse');
            categoriesList.style.height = '25em';
        }
    });

    var targetSmallCol = $('.categories-list');
    var targetLargeCol = $('.shop-now-carousel-div');

    if (window.innerWidth <= 1200) {
        helpCTA.style.display = 'none';
        if (!targetSmallCol.hasClass('col-3')) {
            targetSmallCol.removeClass('col-2').addClass('col-3');
        }
        if (!targetLargeCol.hasClass('col-9')) {
            targetLargeCol.removeClass('col-8').addClass('col-9');
        }
    } else {
        helpCTA.style.display = 'block';
        if (!targetSmallCol.hasClass('col-2')) {
            targetSmallCol.removeClass('col-3').addClass('col-2');
        }
        if (!targetLargeCol.hasClass('col-8')) {
            targetLargeCol.removeClass('col-9').addClass('col-8');
        }
    }

    function adjustColumns() {
        var targetSmallCol = $('.categories-list');
        var targetLargeCol = $('.shop-now-carousel-div');

        if (window.innerWidth <= 1200) {
            helpCTA.style.display = 'none';
            if (!targetSmallCol.hasClass('col-3')) {
                targetSmallCol.removeClass('col-2').addClass('col-3');
            }
            if (!targetLargeCol.hasClass('col-9')) {
                targetLargeCol.removeClass('col-8').addClass('col-9');
            }
        } else {
            helpCTA.style.display = 'block';
            if (!targetSmallCol.hasClass('col-2')) {
                targetSmallCol.removeClass('col-3').addClass('col-2');
            }
            if (!targetLargeCol.hasClass('col-8')) {
                targetLargeCol.removeClass('col-9').addClass('col-8');
            }
        }
    }

    // Call the function once when the page loads
    $(window).on('load', adjustColumns);

    // Attach event listener to the window resize event
    $(window).resize(adjustColumns);

});

function showDetails(product_id){
    window.location.href = 'product.php?id=' + product_id;
}
</script>
</html>
