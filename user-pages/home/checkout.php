<?php
//start_session
@session_start();
    if(!isset( $_SESSION["user"])){
        // Store the referring page URL in a session variable
    $_SESSION["referer"] = $_SERVER['HTTP_REFERER'];
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
    <title>K-Shan</title>
    <!-- stylesheet files, favicon and cdn links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="user_pages.css">
    <link rel="stylesheet" href="products_page.css">
    <link rel="stylesheet" href="home_pages_forms_styling.css">
    <link rel="icon" type="image/png" href="../../images/favicon-16x16.png">
</head>
<style>
        
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
        .input-group .form-control, .input-group .btn{
            border-radius: 5px;
        }
        .container .row{
            padding: 2em;
            background-color: white;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
            height: fit-content;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            margin-bottom: 20px;
        }
        .floating-label{
            font-size: 14px;
        } 
    </style>
<body class="home-page-body">

<!-- nav bar -->
<?php include_once 'nav.php';
?>

<!-- main-body-elements container -->
<section class="container" style="margin-top: 6em;">
<div id="messageContainer"></div>

    <!-- get client info -->
    <div class="col-10" style="height: fit-content">
            <?php
                    $client_id = $_SESSION['user_id'];

                    // Prepare the SQL statement with a parameterized query
                    $usersSql = "SELECT * FROM client_addresses WHERE client_id = ?";
                    $stmt = $conn->prepare($usersSql);
                    $row = [];
                    
                    // Bind the parameter and execute the statement
                    $stmt->bind_param("i", $client_id);
                    $stmt->execute();
                    
                    // Get the result
                    $usersResult = $stmt->get_result();
                    
                    if ($usersResult->num_rows > 0) {
                        // Fetch the row from the result set
                        $row = $usersResult->fetch_assoc();   
                    }   
                    // auto fill with client info   
                ?>  
        <form class="row" method="POST" action="save-client-info.php" style="padding: 1em;">
            <h6 style="border-bottom: 1px solid lightgray; margin-bottom: 2em; padding-bottom: 1em;">1. &nbsp;&nbsp;Customer Address</h6>
            <div class="form-group mb-3" style="position: relative; display: flex;">
                <div class="input-group">
                    <input type="text" class="form-control"  placeholder="<?php echo isset($row['first_name']) ? $row['first_name'] : 'First name'; ?>" 
                    value="<?php echo isset($row['first_name']) ? $row['first_name'] : ''; ?>" aria-label="First name" aria-describedby="user-first-name" 
                    name="first_name">
                    <label class="floating-label">First name*</label>                          
                </div>
                <div class="input-group" style="margin-left: 10px">  
                    <input type="text" class="form-control" style="margin-left: 10px;"  placeholder="<?php echo isset($row['last_name']) ? $row['last_name'] : 'Last name'; ?>" 
                        value="<?php echo isset($row['last_name']) ? $row['last_name'] : ''; ?>"  aria-label="Last Name" name="last_name" aria-describedby="user-last-name">
                    <label class="floating-label" style="margin-left: 10px">Last name*</label> 
                </div>
            </div>
            <div class="form-group mb-3" style="position: relative; display: flex;">
                <div class="input-group">
                    <div class="input-group-append" style="background: transparent; border-left-radius: 5px;">
                        <span class="input-group-text" id="basic-addon2"> +254</span>
                    </div>
                    <input type="number" class="form-control" placeholder="<?php echo isset($row['phone_number']) ? $row['phone_number'] : 'Phone number'; ?>" 
                        value="<?php echo isset($row['phone_number']) ? $row['phone_number'] : ''; ?>"  aria-label="phone number" aria-describedby="phone number" name="phone_number">
                    <label class="floating-label" style="margin-left: 10px">Phone number*</label>
                </div>
                <div class="input-group" style="margin-left: 10px">
                    <div class="input-group-append" style="background: transparent; margin-left: 20px;border-left-radius: 5px;">
                    <span class="input-group-text" id="basic-addon2"> +254</span>
                    </div>
                    <input type="number" class="form-control" placeholder="<?php echo isset($row['additional_phone_number']) ? $row['additional_phone_number'] : 'Additional phone number'; ?>" 
                        value="<?php echo isset($row['additional_phone_number']) ? $row['additional_phone_number'] : ''; ?>"  aria-label="Additional phone number" name="additional_phone_number" aria-describedby="additional phone number">
                        <label class="floating-label" style="margin-left: 20px">Additional phone number*</label>
                </div>
            </div>
            <div class="form-group mb-3" style="position: relative; display: flex;">
                <div class="input-group">
                    <input type="text" class="form-control"  placeholder="<?php echo isset($row['address']) ? $row['address'] : 'Address'; ?>" 
                        value="<?php echo isset($row['address']) ? $row['address'] : ''; ?>" aria-label="address" aria-describedby="user-address" name="address">
                </div>
                <label class="floating-label" style="margin-left: 20px">Address*</label>
            </div>
             <div class="form-group mb-3" style="position: relative; display: flex;">
                <div class="input-group" >
                    <input type="text" class="form-control"  placeholder="<?php echo isset($row['additional_information']) ? $row['additional_information'] : 'Additional information'; ?>" 
                        value="<?php echo isset($row['additional_information']) ? $row['additional_information'] : ''; ?>"  aria-label="additional information" name="additional_info" aria-describedby="user-additional-information">
                </div>
                <label class="floating-label" style="margin-left: 20px">Additional information*</label>
             </div>
            <div class="form-group mb-3" style="position: relative; display: flex;">
                <div class="input-group" >
                    <input type="text" class="form-control" placeholder="<?php echo isset($row['city']) ? $row['city'] : 'City'; ?>" 
                        value="<?php echo isset($row['city']) ? $row['city'] : ''; ?>"  aria-label="city" aria-describedby="user-city" name="city">
                    <label class="floating-label" style="margin-left: 10px">City*</label>
                </div>
                <div class="input-group" >  
                    <input type="text" class="form-control" style="margin-left: 20px;"  placeholder="<?php echo isset($row['area']) ? $row['area'] : 'Area'; ?>" 
                        value="<?php echo isset($row['area']) ? $row['area'] : ''; ?>"  aria-label="area" aria-describedby="user-area" name="area">
                    <label class="floating-label" style="margin-left: 20px">Area*</label>
                </div>
            </div>
            <div class="form-group mb-3">
                <button type="submit" id="submit-client-info" class="btn" style="background-color: #f68b1e; color: white;">Save Info</button>
            </div>
        </form>

        <!-- delivery details -->
    <div class="row" id="delivery-info">
        <h6 style="border-bottom: 1px solid lightgray; margin-bottom: 2em; padding-bottom: 1em; display: flex; flex-direction: row; justify-content: space-between">
        2. &nbsp;&nbsp;Delivery Details <a>Change <i class="fa fa-angle-right"></i></a></h6>

        <div style="margin-bottom: 1em;">
            <p style="margin-block-start: 0.25em;margin-block-end: 0.25em;">Door Delivery</p>
            <p style="margin-block-start: 0.25em;margin-block-end: 0.25em; font-size: 0.9em; font-weight: 400;">Delivery scheduled on <strong>19 February</strong></p>
        </div>
        <div style="padding: 1em; border: 0.5px solid lightgray; border-radius: 5px; margin-bottom: 1em;">
            <div>
                <p style="margin-block-start: 0.25em;margin-block-end: 0.25em; font-size: 0.8em; font-weight: bolder; display: flex; flex-direction: row; justify-content: space-between">
                    Switch to a pickup station starting from KSh 100 <a id="changeDelivery">Change <i class="fa fa-angle-right"></i></a></p>
                <p style="margin-block-start: 0.25em;margin-block-end: 0.25em; font-size: 0.8em; font-weight: 400;">
                    Delivery scheduled on <strong>19 February</strong></p>
            </div>
        </div>
        <div style="display: flex; flex-direction: row;" class="shipping-options">
            <input type="radio" name="shippingOption" style="size: 1em;" <?php
            // Check if $_SESSION['pickup_station'] is set and has more than 0 entries
            if(isset($_SESSION['pickup_station']) && count($_SESSION['pickup_station']) > 0) {
                echo "checked";
            }
            ?>
            />
            <div style="margin-top: 1.5em; padding-left: 1em">
                <p style="margin-block-start:1em; margin-block-end:1em;  font-size: 0.8em; font-weight: bolder;">
                    <strong>Pick-up Station</strong>(Ksh 100)</p>
                <p style="margin-block-start: 0.25em;margin-block-end: 0.25em; font-size: 0.8em; font-weight: 400;">
                Delivery scheduled on <strong>19 February</strong></p>
            </div>
        </div>
        <div style="padding: 1em; border: 0.5px solid lightgray; border-radius: 5px; margin-bottom: 1em;" class="shipping-options">
            <p style="border-bottom: 1px solid lightgray; margin-bottom: 2em; padding-bottom: 1em; display: flex; flex-direction: row; justify-content: space-between">
            Pick-up station <a data-toggle="modal" data-target="#pickupModal">Select pickup station <i class="fa fa-angle-right"></i></a></p>
            <div style="display: flex; flex-direction: row;">
                <i class="fa-solid fa-truck-ramp-box" style="color: #f68b1e"></i>
                <div style="margin-top: 0; padding-left: 1em">
                    <p style="margin-block-start:0; margin-block-end:0.25em;  font-size: 0.8em; font-weight: bolder;">
                    No Pickup Station Selected
                    <p style="margin-block-start: 0.25em;margin-block-end: 0.25em; font-size: 0.8em; font-weight: 400;">
                    To use this option, you will need to add a pickup station near your location.</p>
                </div>
            </div>
        </div>

        <div style="display: flex; flex-direction: row;" class="shipping-options">
            <input type="radio" name="shippingOption" style="size: 1em; background-color: #f68b1e;" 
            <?php // Check if $_SESSION['pickup_station'] is set and has more than 0 entries
            if(!isset($_SESSION['pickup_station']) || count($_SESSION['pickup_station']) < 1) {
                echo "checked";
            }
            ?>
            />
            <div style="margin-top: 1.5em; padding-left: 1em">
                <p style="margin-block-start:1em; margin-block-end:1em;  font-size: 0.8em; font-weight: bolder;">
                    <strong>Door Delivery</strong></p>
                <p style="margin-block-start: 0.25em;margin-block-end: 0.25em; font-size: 0.8em; font-weight: 400;">
                Delivery scheduled on <strong>19 February</strong></p>
            </div>
        </div>

        <p>Shipment
        <?php
            if(isset($_SESSION['cart'])) {
                $cartCount = count($_SESSION['cart']);
                echo " $cartCount/$cartCount";
            }
        ?></p>
        <div style="padding: 1em; border: 0.5px solid lightgray; border-radius: 5px; margin-bottom: 1em;" >
            <p style="margin-bottom: 0; display: flex; flex-direction: row; justify-content: space-between">
           <strong>Door Delivery</strong></p>
            <p style="margin-block-start: 0.25em;margin-block-end: 0.25em; font-size: 0.8em; font-weight: 400;">Delivery scheduled on 19 February</p>
            <div>
            <?php
            //database connection
            include_once '../../controls/conn.php';
            $totalPrice = 0;  
            // Check if the cart session variable exists and is not empty
            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                // Fetch all products from the cart session variable
                foreach ($_SESSION['cart'] as $productId => $quantity) {
                    // Fetch product details from the database
                    $productSql = "SELECT * FROM products WHERE id = '$productId'";
                $productResult = $conn->query($productSql);

                // Loop through each product in the cart and display its details
                while ($product = $productResult->fetch_assoc()) {
                    // Fetch product images
                    $imageSql = "SELECT * FROM product_images WHERE product_id = {$product['id']}";
                    $imageResult = $conn->query($imageSql);
                    $imageUrl = ''; // Default image URL
                    if ($imageResult->num_rows > 0) {
                        $image = $imageResult->fetch_assoc();
                        $imageUrl = $image['file_path'];
                    }
                    $product_id = $product['id'];

                    $totalPrice += $product['price'] * intval($quantity);

                    $_SESSION['total_amount'] = $totalPrice;
            ?>
        <!-- Product details -->
            <div class="row" style=" padding-top: 2em;height: 8em; box-shadow: none; border-top: 0.25px solid lightgray">
                <div class="col-2">
                    <div class="focused-img" style="width: 100%; height:100%;">
                        <img style="width: 100%; height: 100%;" src="../../admin/product-upload/<?php echo $imageUrl; ?>" style="object-fit: contain;"/>
                    </div>
                </div>
                <div class="product-details col-6" style="padding: 1em; font-size: 0.75em;">
                    <div style="padding: 1em; padding-top:2em; margin-bottom: 1em; ">
                        <p><?php echo $product['name']; ?></p>
                        <p><strong>QTY </strong><?php echo $quantity .' @Kes'. $product['price']. '/='; ?></p>
                        <p><strong>Total price:</strong> Kes <?php echo $totalPrice; ?></p>
                    </div>
                </div>
            </div>
            <?php
                }}}
            ?>
            </div>
        </div>
        <a href="cart.php" style="width: 100%; color:  #f68b1e; text-align: center; font-weight: 700; text-decoration: none;">MODIFY CART</a>

    </div>

    <!-- payment method -->
    <div class="row">
        <h6 style="border-bottom: 1px solid lightgray; margin-bottom: 2em; padding-bottom: 1em; display: flex; flex-direction: row; justify-content: space-between">
        3. &nbsp;&nbsp;PAYMENT METHOD 
    </h6>

        <div style="margin-bottom: 1em;">
            <p style="margin-block-start: 0.25em;margin-block-end: 0.25em;">KSHAN Pay Now (Mpesa)</p>
            <p style="margin-block-start: 0.25em;margin-block-end: 0.25em; font-size: 0.9em; font-weight: 400;">Pay now fast and securely with JumiaPay, Mastercard or Visa</p>
        </div>

        <!-- <div style="display: flex; flex-direction: row;" class="shipping-options">
            <input type="radio" name="shippingOption" style="size: 1em;"/>
            <div style="margin-top: 1.5em; padding-left: 1em">
                <p style="margin-block-start:1em; margin-block-end:1em;  font-size: 0.8em; font-weight: bolder;">
                    <strong>Pick-up Station</strong>(Ksh 100)</p>
                <p style="margin-block-start: 0.25em;margin-block-end: 0.25em; font-size: 0.8em; font-weight: 400;">
                Delivery scheduled on <strong>19 February</strong></p>
            </div>
        </div> -->
        <a  data-toggle="modal" data-target="#confirm-payment" class="btn" style="background-color:  #f68b1e; width: 30%; align-self: flex-end; color: white;">CONFIRM PAYMENT METHOD</a>
    </div>
    </div>
    <div class="modal fade" id="pickupModal" tabindex="-1" aria-labelledby="pickupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pickupModalLabel">Select Pickup Station</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--  pickup station selection form -->
                <form method="POST" action="save_pickup_station.php">
                    <p>Select your pickup station:</p>
                        <div class="input-group mb-3">
                            <div>
                            <select class="custom-select" id="inputGroupSelectLocation" name="location">
                            </select>
                        </div>
                        <div>
                            <select class="custom-select" id="inputGroupSelectSubLocation" name="sub_location" style="margin-left: 20px;">
                            </select>
                        </div>
                        </div>
            </div>
            <div class="modal-footer" style="width: 100%; display: flex; flex-direction: row; justify-content: space-between; margin-left: 0;">
                <button type="button" class="btn btn-secondary" style="width: 48%; color: #f68b1e; border: 1px solid #f68b1e; background: transparent" data-dismiss="modal">CANCEL</button>
                <button type="submit" class="btn select-pickup-station" style="width: 48%; color: white; background-color: #f68b1e;">SELECT PICKUP STATION</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div id="confirm-payment" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Input your M-Pesa number</p>
                <form id="order-form" method="POST" action="create_order.php">
                    <div class="input-group mb-3">
                        <div class="input-group-append" style="background: transparent; margin-left: 20px;border-left-radius: 5px;">
                            <span class="input-group-text" id="basic-addon2"> +254</span>
                        </div>
                        <input type="number" class="custom-select" name="mpesa_phoneNumber">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="width: 48%; color: #f68b1e; border: 1px solid #f68b1e; background: transparent" data-dismiss="modal">Cancel</button>
                <button type="button" id="confirm-payment-form" class="btn" style="width: 48%; color: white; background-color: #f68b1e;">Confirm</button>
            </div>
        </div>
    </div>
</div>
</section>
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
    $('#single-productCarousel').carousel();

    // Toggle collapse state of additional categories when "More categories" is clicked
    $('[data-toggle="collapse"]').on('click', function() {
        $('.collapsed-items').removeClass('collapse');
        $('.categories-list').css('height', 'fit-content');
    });

    // Hide shipping-options initially
    $(".shipping-options").hide();

    // Toggle shipping-options when #changeDelivery is clicked
    $("#changeDelivery").click(function(){
        $(".shipping-options").toggle();
    });
    document.querySelector('.select-pickup-station').addEventListener('click', function() {
    var location = document.querySelector('#inputGroupSelectLocation').value;
    var subLocation = document.querySelector('#inputGroupSelectSubLocation').value;

    // Send data to server to save in session variable
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_pickup_station.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Check the response from save_pickup_station.php
            var response = xhr.responseText;
            showMessage(response, false); // Display success message
        } else {
            showMessage('An error occurred while processing your request.', true); // Display error message
        }
    };
    xhr.send('location=' + encodeURIComponent(location) + '&sub_location=' + encodeURIComponent(subLocation));
});

function showMessage(message, isError) {
    var messageContainer = document.getElementById("messageContainer");
    messageContainer.innerHTML = message;
    messageContainer.style.display = "block";
    messageContainer.classList.toggle("error", isError);

    if (!isError) {
        setTimeout(function() {
            hideMessage();
        }, 5000);
    }
}

function hideMessage() {
    var messageContainer = document.getElementById("messageContainer");
    messageContainer.style.display = "none";
}

document.getElementById("messageContainer").addEventListener("click", function() {
    hideMessage();
});


        // Add event listener to the button
    document.getElementById('confirm-payment-form').addEventListener('click', function(event) {
        // Prevent the default button behavior
        event.preventDefault();

        // Get the form by its ID
        var form = document.getElementById('order-form');

        // Submit the form
        form.submit();
    });



    
    // Define locations
    const locations = ["Nairobi", "Mombasa", "Kisumu", "Nyeri", "Kiambu", "Machakos", "Nakuru", "Meru", "Bungoma", "Kakamega", "Kilifi", "Kericho", "Bomet", "Embu", "Kisii", "Makueni", "Garissa", "Kitui", "Homa Bay", "Migori", "Baringo", "Laikipia", "Tharaka-Nithi", "Taita-Taveta", "Siaya", "Uasin Gishu", "Nyandarua", "Murang'a", "Busia", "Kajiado", "Trans-Nzoia", "Nyamira", "Vihiga", "Kwale", "Kirinyaga", "West Pokot", "Samburu", "Elgeyo-Marakwet", "Turkana", "Nandi", "Narok", "Marsabit", "Wajir", "Mandera", "Tana River"];

    // Get the location select element
    const locationSelect = document.getElementById("inputGroupSelectLocation");

    // Populate locations
    locations.forEach((location) => {
        const option = document.createElement("option");
        option.text = location;
        locationSelect.add(option);
    });

    // Trigger change event to populate sub-locations based on the initial selected location
    const initialSelectedLocation = locationSelect.value;
    populateSubLocations(initialSelectedLocation);
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
    function populateSubLocations(selectedLocation) {
        const subLocationSelect = document.getElementById("inputGroupSelectSubLocation");
        const subLocs = subLocations[selectedLocation];

        // Clear previous options
        subLocationSelect.innerHTML = '';

        // Populate sub-locations
        subLocs.forEach((subLoc) => {
            const option = document.createElement('option');
            option.value = subLoc;
            option.text = subLoc;
            subLocationSelect.appendChild(option);
        });
    }

    // Event listener to trigger sub-location population when a location is selected
    document.getElementById("inputGroupSelectLocation").addEventListener("change", function() {
        const selectedLocation = this.value;
        populateSubLocations(selectedLocation);
    });

    // Trigger change event to populate sub-locations based on the initial selected location
    const initialSelectedLocation = document.getElementById("inputGroupSelectLocation").value;
    populateSubLocations(initialSelectedLocation);


    function showDetails(product_id){
        window.location.href = 'product.php?id=' + product_id;
    }
    
</script>
</html>
