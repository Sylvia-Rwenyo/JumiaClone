<?php
//start_session
 @session_start();
//  redirect user if not logged in
        if(!isset( $_SESSION["user"])){
            echo '
                <script>window.location.href = "../account/login/"</script>
            ';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My K-Shan Account</title>
    <!-- stylesheet files and CDN links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home_page.css"/>
    <link rel="stylesheet" href="user_pages.css"/>
    <link rel="stylesheet" href="user-account.css"/>
    <link rel="icon" type="image/png" href="../../images/favicon-16x16.png">
</head>
<body class="user-page-body">
<!-- nav bar -->
<?php include_once 'nav.php' ?>
>

<!-- main-body-elements container -->
<section class="container main-container" style="margin-top: 6em">   
    <div class="account-info CTA row" style="height: 40em; width: 100%">
        <!-- account links -->
        <div class="col-3  card" style="height: 100%; padding: 0;" >
            <ul class="list-group">
                <li class="list-group-item"><a href="">My Account</a></li>
                <li class="list-group-item"><a href="existing_orders.php">Orders</a></li>
                <li class="list-group-item"><a href="">Inbox</a></li>
                <li class="list-group-item"><a href="">Pending Reviews</a></li>
                <li class="list-group-item"><a href="">Vouchers</a></li>
                <li class="list-group-item"><a href="">Saved Items</a></li>
                <li class="list-group-item"><a href="">Followed Sellers</a></li>
                <li class="list-group-item"><a href="">Recently Viewed</a></li>
                <li class="list-group-item" style="border-top: 1px solid lightgray;"><a href="account_management.php" target="_blank">Account Management</a></li>
                <li class="list-group-item"><a href="address_book.php">Address Book</a></li>
                <li class="list-group-item"><a href="">Newsletter Preferences</a></li>
                <li class="list-group-item"><a href="">Close Account</a></li>
                <li class="list-group-item" style="border-top: 1px solid lightgray;"><a style="color:#f68b1e; align-items:center; width: 100%; height: 100%" href="../account/settings/logout.php">LOGOUT</a></li>
            </ul>
        </div>

        <!-- user info -->
        <div class="col-8 card" style="height: 100%; padding: 0;"> 
        <h5 style="border-bottom: 2px solid lightgray; padding: 0.5em">Account Overview</h5>
        <div class="account-info-cards" style="padding: 1em;">
            <div class="card">
                <h6 style="border-bottom: 1px solid lightgray; padding: 0.5em">Account Overview</h6>
                <?php
                   $user_access_value = $_SESSION['accInput'];
                   $client_id = $_SESSION['user_id'];

                   // Prepare the SQL statement with a parameterized query
                   $usersSql = "SELECT * FROM endusers WHERE emailAddress = ? || phoneNumber = ?";
                   $stmt = $conn->prepare($usersSql);
                   
                   // Bind the parameter and execute the statement
                   $stmt->bind_param("ss", $user_access_value,$user_access_value);
                   $stmt->execute();
                   
                   // Get the result
                   $usersResult = $stmt->get_result();
                   
                   if ($usersResult->num_rows > 0) {
                       // Fetch the row from the result set
                       $row = $usersResult->fetch_assoc();
                       $client_id = $row['id'];
                       if($row['emailAddress'] != ''){
                            echo "<p>" . $row['emailAddress'] . "</p>";
                       }else{
                            echo "<p>" . $row['phoneNumber'] . "</p>";
                       }
                   }
                   
                ?>
            </div>
            <!-- address card -->
            <div class="card">
                <h6 style="border-bottom: 1px solid lightgray; padding: 0.5em; display: flex; flex-direction: row; justify-content: space-between;">
                    Address Book 
                    <a href="address_book.php?edit=1" style="text-decoration: none; color:#f68b1e";><i class="fa-solid fa-pen"></i></a>
                </h6>
                <?php
                   $user_access_value = $_SESSION['accInput'];

                   $usersSql = "SELECT * FROM client_addresses WHERE client_id = ?";
                   $stmt = $conn->prepare($usersSql);
                   
                   $stmt->bind_param("i", $client_id);
                   $stmt->execute();
                   
                   $usersResult = $stmt->get_result();
                   
                   if ($usersResult->num_rows > 0) {
                       $row = $usersResult->fetch_assoc();
                       echo "<p><strong>Your default shipping address:</strong></p>
                            <p>" . $row['first_name'] ." " .  $row['last_name']."</p>";
                       echo "<p>Area: " . $row['area'] ."</p>";
                       echo "<p>City: " . $row['city'] ."</p>";
                       echo "<p>Address: " . $row['address'] ."</p>";
                       echo "<p>" . $row['phone_number'] . " / ". $row['additional_phone_number'] ."</p>";                       
                   }else{
                        echo '<a href="address_book.php?edit=1" style="text-decoration: none; color:#f68b1e";>Add an address</a>';
                   }
                   
                ?>
            </div>
            <!-- credit info card -->
            <div class="card">
                <h6 style="border-bottom: 1px solid lightgray; padding: 0.5em">Kshan Store Credit</h6>
                <p><strong>Balance:</strong> 0</p>
            </div>

            <!-- newsletter preferences card -->
            <div class="card">
                <h6 style="border-bottom: 1px solid lightgray; padding: 0.5em">Newsletter Preferences</h6>
                <p>You are currently not subscribed to any of our newsletters.</p>
                <a href="" style="text-decoration: none; color:#f68b1e; align-items:center; width: 100%; height: 100%">EDIT NEWSLETTER PREFERENCES</a>
            </div>
        </div>
        </div>
    </div>
    <!-- products row -->
    <div id="product-rows">
        <?php
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

<!-- Footer -->
<?php include_once 'footer.php'; ?>
</body>

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

    <?php
        if($category_count > 0){
            echo "
                $('#productCarousel".$category_count."').carousel();
        ";
        }
    ?>

    // Toggle collapse state of additional categories when "More categories" is clicked
    $('[data-toggle="collapse"]').on('click', function() {
        $('.collapsed-items').removeClass('collapse');
        $('.collapsed-items').addClass('show');
    });
});

function showDetails(product_id){
    window.location.href = 'product.php?id=' + product_id;
}
</script>
</html>
