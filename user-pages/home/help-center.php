<?php
    @session_start();
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
    <link rel="stylesheet" href="user_pages.css">
    <link rel="stylesheet" href="products_page.css">
    <title>K-Shan</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
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
      
      
        .carousel-item {
            /* transition: transform 0.2s ease-in-out; */
            transition: transform 0.3s cubic-bezier(0.25, 0.1, 0.25, 1);
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
        .input-group .btn{
            border-radius: 5px;
        }
        .container .row{
            padding: 2em;
            height: fit-content;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            margin-bottom: 20px;
        }
         /* Add custom styles here */
         .icon-container {
            position: relative; /* Make the container position relative */
            display: inline-block; /* Ensure inline display */
        }
        
        .badge {
            position: absolute; /* Position the badge absolutely */
            top: 0; /* Adjust top position */
            right: 0; /* Adjust right position */
            background-color: white; /* Set badge background color */
            color: black; /* Set badge text color */
            width: 15px; /* Set badge width */
            height: 15px; /* Set badge height */
            border-radius: 50%; /* Make the badge circular */
            display: flex; /* Use flexbox for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            font-size: 10px; /* Set badge font size */
            padding: 0.25em
        }
        
        .icon {
            font-size: 60px; /* Set icon size */
        }
        
        .col-2 i{
            font-size: 2em;
        }
        .order-info{
            top: -2.5em;
        }
        .order-info-container {
    height: 200px;
    margin-bottom: 2.5em;
}

.order-info {
    display: flex;
    flex-direction: row;
    justify-content: space-around; /* Adjust as needed */
    position: relative;
    top: 15px;
}

.col-2 {
    display: flex;
    flex-direction: row;
    align-items: center;
    border-radius: 5px;
    background: white;
    height: 5em;
    font-size: 1.5em;
    width: 7em;
    padding: 0.5em;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add shadow for better visibility */
}


    </style>
<body class="home-page-body">

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

<!-- main-body-elements container -->
<section class="container" style="margin-top: 6em;">

<div class="order-info-container" style="background-color: #f68b1e; opacity: 0.75; padding: 1em">
    <div class="help-center-top">
        <H5>Help Center</H5>
        <p>Hi, how can we help you?</p>
    </div>
    <div class="row order-info" style="display: flex; flex-direction: row;">
        <div class="col-2">
            <span>Place an Order</span>
            <span class="icon-container">
                <i class="fa-solid fa-bag-shopping icon"></i>
            </span>
        </div>
        <div class="col-2">
            <span>Pay for your Order</span>
            <span class="icon-container">
                <i class="fa-regular fa-credit-card icon"></i>
            </span>
        </div>
        <div class="col-2">
            <span>Track your Order</span>
            <span class="icon-container">
                <i class="fa-solid fa-bag-shopping icon"></i>
                <span class="badge"><i class="fa-solid fa-magnifying-glass"></i></span>
            </span>
        </div>
        <div class="col-2">
            <span>Cancel an Order</span>
            <span class="icon-container">
                <i class="fa-solid fa-bag-shopping icon"></i>
                <span class="badge"><i class="fa-regular fa-circle-xmark "></i></span>
            </span>
        </div>
        <div class="col-2">
            <span>Create a return</span>
            <span class="icon-container">
                <i class="fa-solid fa-bag-shopping icon"></i>
                <span class="badge"><i class="fa-solid fa-repeat "></i></span>
            </span>
        </div>
    </div>
</div>

</section>

<!-- footer -->
<?php include_once 'footer.php'; ?>
 

<!-- Scripts -->
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
        $('.collapsed-items').removeClass('collapse');
        $('.categories-list').css('height', 'fit-content');
    });

    function showDetails(product_id){
        window.location.href = 'product.php?id=' + product_id;
    }
});
    
</script>
</body>
</html>
