<?php
//start_session
 @session_start();

if(isset($_GET['id'])){
    $product_id =  $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Shan</title>
    <!-- stylesheets and CDN links -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="products_page.css">
    <link rel="stylesheet" href="home_page.css">
    <link rel="stylesheet" href="user_pages.css">
    <link rel="icon" type="image/png" href="../../images/favicon-16x16.png">
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



<!-- nav bar -->
<?php  include_once 'nav.php';?> 

<!-- main-body-elements container -->
<section class="container" style="margin-top: 10em;">

    <!-- show product -->
    <div class="show-product row">

    <?php
        //database connection
        include_once '../../controls/conn.php';

            // Fetch product with the given ID
            $productSql = "SELECT * FROM products WHERE id = '$product_id'";
            $productResult = $conn->query($productSql);

            // Fetch product images
            $imageSql = "SELECT * FROM product_images WHERE product_id = $product_id";
            $imageResult = $conn->query($imageSql);

            if ($imageResult->num_rows > 0) {
                $image = $imageResult->fetch_assoc();
                $imageUrl = $image['file_path'];
            }
            while ($product = $productResult->fetch_assoc()) {
            ?>
        <!--  product details -->
        <div class="col-8 single-product-display" id="single-product-display"style= "background-color: white;  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);">
            <div class="row" style="height: 80%">
                <div class="col-6">
                <div class="product-images" style=" height: 80%">
                    <div class="focused-img" style=" height: 100%">
                        <img src="../../admin/product-upload/<?php echo $imageUrl; ?>" style="object-fit: contain;"/>
                    </div>
                    <?php
                        if($imageResult->num_rows > 1){
                    ?>
                    <div class="all-images row carousel slide" id="single-productCarousel" data-ride="carousel" data-interval="false">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <?php
                                while($image = $imageResult->fetch_assoc() ){
                            ?>
                                <img src="../../admin/product-upload/<?php echo $imageUrl; ?>"/>
                            <?php
                                }
                            ?>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#single-productCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#single-productCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <?php
                        }
                    ?>
                    </div>
                    <h6 style="padding-top: 1em; border-top: 1px solid-gray;">Share this product</h6>
                    <ul class="share-links list-group" style="border-radius: none; display: flex; flex-direction: row; ">
                        <li class="list-group-item" style="border:none"><a href="" style="text-decoration: none; color: black;"><i class="fa-brands fa-facebook"></i></a></li>
                        <li class="list-group-item" style="border:none"><a href="" style="text-decoration: none; color: black;"><i class="fa-brands fa-twitter"></i></a></li>
                    </ul>
            </div>
                <div class="product-details col-6" style=" height: 80%">
                    <div style="border-bottom: 1px solid lightgray; padding-bottom: 1em; margin-bottom: 1em;">
                        <p><?php echo $product['name'];?></p>
                        <p>Details: <?php echo $product['description']; ?></p>
                        <p ><?php echo $product['price']; ?></p>
                    </div>
                    <a href="add_to_cart.php?id=<?php echo $product_id; ?>" class="product-add btn"> <i class="fa-solid fa-cart-plus"></i> Add to cart</a>
                </div>
            </div>
        <!-- <div class="row">
                <h5>Product Details</h5>

            </div> -->
    </div>
        <?php
        }
        ?>

        <!-- call and help CTA -->
        <div class="col-4 delivery-CTA-Col3" id="delivery-CTA-Col3">
            <div class="card delivery-CTA "  style= " border: none; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);">
            <h5 style="border-bottom: 0.5px solid lightgray; font-weight: 500; padding: 0.5em ">Deliveries & Returns</h5>
            <p style="margin: 0.5em">Choose your location</p>
            <div class="input-group mb-3">
                <select class="custom-select" id="inputGroupSelectLocation" name="location" style="margin: 0.5em">
                    <option value="Nairobi">Nairobi</option>
                    <option value="Mombasa">Mombasa</option>
                    <option value="Kisumu">Kisumu</option>
                    <option value="Nyeri">Nyeri</option>
                    <option value="Kiambu">Kiambu</option>
                    <option value="Machakos">Machakos</option>
                    <option value="Nakuru">Nakuru</option>
                    <option value="Meru">Meru</option>
                    <option value="Bungoma">Bungoma</option>
                    <option value="Kakamega">Kakamega</option>
                    <option value="Kilifi">Kilifi</option>
                    <option value="Kericho">Kericho</option>
                    <option value="Bomet">Bomet</option>
                    <option value="Embu">Embu</option>
                    <option value="Kisii">Kisii</option>
                    <option value="Makueni">Makueni</option>
                    <option value="Garissa">Garissa</option>
                    <option value="Kitui">Kitui</option>
                    <option value="Homa Bay">Homa Bay</option>
                    <option value="Migori">Migori</option>
                    <option value="Baringo">Baringo</option>
                    <option value="Laikipia">Laikipia</option>
                    <option value="Tharaka-Nithi">Tharaka-Nithi</option>
                    <option value="Taita-Taveta">Taita-Taveta</option>
                    <option value="Siaya">Siaya</option>
                    <option value="Uasin Gishu">Uasin Gishu</option>
                    <option value="Nyandarua">Nyandarua</option>
                    <option value="Murang'a">Murang'a</option>
                    <option value="Busia">Busia</option>
                    <option value="Kajiado">Kajiado</option>
                    <option value="Trans-Nzoia">Trans-Nzoia</option>
                    <option value="Nyamira">Nyamira</option>
                    <option value="Vihiga">Vihiga</option>
                    <option value="Kwale">Kwale</option>
                    <option value="Kirinyaga">Kirinyaga</option>
                    <option value="West Pokot">West Pokot</option>
                    <option value="Samburu">Samburu</option>
                    <option value="Elgeyo-Marakwet">Elgeyo-Marakwet</option>
                    <option value="Turkana">Turkana</option>
                    <option value="Nandi">Nandi</option>
                    <option value="Narok">Narok</option>
                    <option value="Marsabit">Marsabit</option>
                    <option value="Wajir">Wajir</option>
                    <option value="Mandera">Mandera</option>
                    <option value="Tana River">Tana River</option>
                </select>
            </div>
            <!-- <div class="input-group mb-3" id="subLocationGroup" style="display:none;">
                <select class="custom-select" id="inputGroupSelectSubLocation" name="sub_location">
                </select>
            </div> -->

                <ul class="list-group">
                    <li class="list-group-item"><i class="fa-solid fa-boxes-packing"></i>&nbsp;&nbsp;<span>Pick Up Station <a href="" style="text-decoration: none; color: darkblue; font-size: 0.75em;">details</a><p>Delivery Fees Kes 70</p></span></li>
                    <li class="list-group-item"><i class="fa-solid fa-truck-fast"></i>&nbsp;&nbsp;<span>Door Delivery <a href="" style="text-decoration: none; color: darkblue; font-size: 0.75em;">details</a><p>Delivery Fees Kes 70</p></span></li>
                    <li class="list-group-item" style="border-top: 0.5px solid lightgray; padding-bottom: 0.5em; margin-bottom: 0.5em;"><i class="fa-solid fa-money-bill-trend-up"></i>
                    <span>Return Policy<p> Easy Return, Quick Refund. <a href="" style="text-decoration: none; color: darkblue; font-size: 0.75em;">details</a></p></span></li>
                </ul>   
            </div>
            <div class="card call-CTA" style= " border: none; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); height: 30%;">
                <p>Call or Whatsapp</p>
                <p>0745 527 698</p> 
                <p>TO ORDER</p>
            </div>
        </div>
    </div>

    <!-- <div class="row">
                <h5>Product Details</h5>

            </div> -->

    <!-- products row -->
        <?php

        // Fetch distinct categories from the products table
        $categorySql = "SELECT DISTINCT category FROM products"; 
        $categoryResult = $conn->query($categorySql);

        if ($categoryResult->num_rows > 0) {
            while ($category = $categoryResult->fetch_assoc()) {
                $currentCategory = $category['category'];

            // Fetch product with the given ID
            $productSql = "SELECT * FROM products WHERE category = '$currentCategory'";
            $productResult = $conn->query($productSql);
            ?>
            <div class="product-cards row carousel slide" id="productCarousel" data-ride="carousel" data-interval="false">
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
                        <img src="../../admin/product-upload/<?php echo $imageUrl;?>"   alt="product" />
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

<!-- footer -->
<?php include_once 'footer.php'; ?>
</body>
<!-- scripts -->
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
        $('.collapsed-items').removeClass('collapse');
        $('.categories-list').css('height', 'fit-content');
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var targetSmallCol = document.querySelector('.delivery-CTA-Col3');
    var targetLargeCol = document.querySelector('.single-product-display');

    function handleWindowResize() {
        if (window.innerWidth <= 720) {
            targetSmallCol.style.display = 'none';
            if (targetLargeCol.classList.contains('col-8')) {
                targetLargeCol.classList.remove('col-8');
                targetLargeCol.classList.add('col-12');
            }
        } else {
            targetSmallCol.style.display = 'flex';
            if (targetLargeCol.classList.contains('col-12')) {
                targetLargeCol.classList.remove('col-12');
                targetLargeCol.classList.add('col-8');
            }
        }
    }

    handleWindowResize(); // Call the function on page load

    window.addEventListener("resize", function() {
        handleWindowResize(); // Attach event listener for window resize
    });
});


// Define sub-locations for each location
const subLocations = {
    "Nairobi": ["Kibera", "Westlands", "Kasarani", "Lang'ata", "Embakasi"],
    "Mombasa": ["Nyali", "Mvita", "Kisauni", "Changamwe", "Likoni"],
    "Kisumu": ["Kisumu Central", "Kisumu East", "Kisumu West", "Nyakach"],
    "Nyeri": ["Nyeri Town", "Mathira", "Othaya", "Tetu", "Kieni"],
    "Kiambu": ["Thika", "Kiambu Town", "Ruiru", "Githunguri", "Kikuyu"],
    "Machakos": ["Machakos Town", "Kangundo", "Athi River", "Mwala", "Matungulu"],
    "Nakuru": ["Nakuru Town", "Nakuru East", "Nakuru West", "Naivasha", "Gilgil"],
    "Meru": ["Meru Central", "Meru South", "Meru North", "Igembe", "Tigania"],
    "Bungoma": ["Bungoma Town", "Webuye", "Kimilili", "Bumula", "Mt. Elgon"],
    "Kakamega": ["Kakamega Town", "Malava", "Lurambi", "Butere", "Khwisero"],
    "Kilifi": ["Kilifi Town", "Malindi", "Kilifi North", "Kilifi South", "Ganze"],
    "Kericho": ["Kericho Town", "Bureti", "Kipkelion", "Soin", "Ainamoi"],
    "Bomet": ["Bomet Town", "Sotik", "Chepalungu", "Bomet East", "Konoin"],
    "Embu": ["Embu Town", "Runyenjes", "Manyatta", "Mbeere North", "Mbeere South"],
    "Kisii": ["Kisii Town", "Ogembo", "Etago", "Nyangena", "Sameta"],
    "Makueni": ["Makueni Town", "Wote", "Kibwezi", "Makindu", "Mbooni"],
    "Garissa": ["Garissa Town", "Ijara", "Lagdera", "Dadaab", "Fafi"],
    "Kitui": ["Kitui Town", "Mwingi", "Mutomo", "Kitui West", "Kitui East"],
    "Homa Bay": ["Homa Bay Town", "Homa Bay West", "Homa Bay East", "Ndhiwa", "Rangwe"],
    "Migori": ["Migori Town", "Awendo", "Kuria", "Rongo", "Nyatike"],
    "Baringo": ["Kabarnet", "Mogotio", "Eldama Ravine", "Baringo Central", "Tiaty"],
    "Laikipia": ["Nanyuki", "Doldol", "Rumuruti", "Kinamba", "Ol-Moran"],
    "Tharaka-Nithi": ["Chuka", "Kathwana", "Marimanti", "Muthambi", "Gatunga"],
    "Taita-Taveta": ["Voi", "Wundanyi", "Taveta", "Mwatate", "Kasarani"],
    "Siaya": ["Siaya Town", "Ugunja", "Alego Usonga", "Bondo", "Gem"],
    "Uasin Gishu": ["Eldoret", "Ainabkoi", "Moiben", "Kesses", "Kapseret"],
    "Nyandarua": ["Ol Kalou", "Nyahururu", "Engineer", "Mirangine", "Kinangop"],
    "Murang'a": ["Murang'a Town", "Kandara", "Maragua", "Kangema", "Gatanga"],
    "Busia": ["Busia Town", "Malaba", "Nambale", "Butula", "Bunyala"],
    "Kajiado": ["Kajiado Town", "Namanga", "Loitokitok", "Isinya", "Kajiado Central"],
    "Trans-Nzoia": ["Kitale", "Kapenguria", "Kwanza", "Kiminini", "Saboti"],
    "Nyamira": ["Nyamira Town", "Nyamira South", "Borabu", "Masaba", "Kitutu Masaba"],
    "Vihiga": ["Vihiga Town", "Hamisi", "Luanda", "Emuhaya", "Sabatia"],
    "Kwale": ["Kwale Town", "Msambweni", "Lunga Lunga", "Matuga", "Kinango"],
    "Kirinyaga": ["Kerugoya", "Sagana", "Baricho", "Kutus", "Gichugu"],
    "West Pokot": ["Kapenguria", "Kacheliba", "Sigor", "Pokot South", "Chepareria"],
    "Samburu": ["Maralal", "Wamba", "Baragoi", "Suguta", "Samburu North"],
    "Elgeyo-Marakwet": ["Iten", "Marakwet", "Keiyo", "Sambirir", "Arror"],
    "Turkana": ["Lodwar", "Kakuma", "Lokichar", "Kibish", "Turkana Central"],
    "Nandi": ["Kapsabet", "Nandi Hills", "Mosop", "Emgwen", "Chesumei"],
    "Narok": ["Narok Town", "Kilgoris", "Narok South", "Narok North", "Narok East"],
    "Marsabit": ["Marsabit Town", "Moyale", "Laisamis", "North Horr", "Marsabit South"],
    "Wajir": ["Wajir Town", "Habaswein", "Tarbaj", "Eldas", "Wajir East"],
    "Mandera": ["Mandera Town", "Mandera East", "Mandera West", "Banisa", "Lafey"],
    "Tana River": ["Hola", "Garsen", "Madogo", "Bura", "Kipini"]
};


// Function to populate sub-locations based on the selected location
function populateSubLocations() {
    const selectedLocation = document.getElementById("inputGroupSelectLocation").value;
    const subLocationSelect = document.getElementById("inputGroupSelectSubLocation");
    const subLocs = subLocations[selectedLocation];

    // Clear previous options
    subLocationSelect.innerHTML = '';

    // Populate sub-locations
    subLocs.forEach((subLoc, index) => {
        const option = document.createElement('option');
        option.value = subLoc;
        option.text = subLoc;
        if (index === 1) { // Select the first option
            option.setAttribute("selected", "selected");
        }
        subLocationSelect.appendChild(option);
    });

    // Display sub-location group
    document.getElementById("subLocationGroup").style.display = "block";
}

// Initial population of sub-locations for Nairobi
populateSubLocations();

// Event listener to trigger sub-location population when a location is selected
document.getElementById("inputGroupSelectLocation").addEventListener("change", populateSubLocations);

function showDetails(product_id){
    window.location.href = 'product.php?id=' + product_id;
}
</script>
</html>
<?php
}else{
    echo'
    <script>
        window.location.href = "index.php";
    </script> 
    ';
}
?>
