    <?php
//start_session
 @session_start();
 //database connection
include_once '../../controls/conn.php';

    $items_count = 0;

    if(isset($_SESSION['cart'])){
        if(count($_SESSION['cart']) > 0){
        $items_count =  count($_SESSION['cart']);
        }else{
            echo '<style> .cart .badge {display: none;}</style>';
        }
    }else{
        echo '<style> .cart .badge {display: none;}</style>';
    }
    ?>
    <!-- preloader -->
    <!-- <div id="preloader">
        <div id="loader"></div>
    </div> -->
    <div class="fixed-top">
    <!-- delivery banner -->
    <div class="delivery-banner">
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
            <p>Call or Whatsapp to Order</p>
            <a href="https://wa.me/+254745527698" target="_blank"><i class="fab fa-whatsapp"></i>0745 527 698</a>
        </div>
    </div>
    <!-- main nav content -->
    <nav class="nav navbar">
    <!-- logo -->
        <div class="logo" >
            <img src="../../images/logo.jpeg" alt="KShan Central Agency"/>
        </div>
    <!-- search bar -->
    <form action="search_results.php" method="get">
        <div class="input-group" style="width: 100%">
            <input type="search" name="query" class="form-control rounded" placeholder="Search products, brands and categories" aria-label="Search" aria-describedby="search-addon" />
            <button type="submit" class="btn" data-mdb-ripple-init>Search</button>
        </div>
    </form>

        <!-- dropdown for account links -->
        <div class="dropdown show">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php
                $username = '';
                if(isset($_SESSION['user'])){
                    $access_value = $_SESSION['accInput'];
                    $sql_a=mysqli_query($conn,"SELECT * FROM endusers where emailAddress || phoneNumber = '$access_value'");
                    if(mysqli_num_rows($sql_a)>0)
                    {
                        $row  = mysqli_fetch_array($sql_a);
                        if(is_array($row)){
                          $username = $row['firstName'];
                          $_SESSION["user_id"] = $row['id'] ;
                            }}}
                            if($username != ''){
                                echo '<i class="fa-solid fa-user-check"></i> Hi, '. $username;
                            }else{
            ?>    
            Account
            <?php } ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <?php
                if(!isset($_SESSION['user'])){
                ?>
                <div class="dropdown-item dp-btn"><a class="btn" href="../account/login/">SIGN IN</a></div>
                <?php
                }?>
                <a class="dropdown-item dp-link" href="user-account.php"><i class="fa-regular fa-user"></i>My Account</a>
                <a class="dropdown-item dp-link" href="existing_orders.php"><i class="ic-mrm fas fa-envelope"></i>Orders</a>
                <!-- <a class="dropdown-item dp-link" href=""><i class="fa-regular fa-heart"></i>Saved Items</a> -->
                <?php
                if(isset($_SESSION['user'])){
                ?>
                <!-- <a class="dropdown-item dp-link" href=""><i class="fa-solid fa-ticket"></i>Vouchers</a> -->
                <a class="dropdown-item dp-link" style="color: #f68b1e; border-bottom: none; border-top: 4px solid lightgray; padding: 1em; padding-bottom: 2em; text-align: center;" href="../account/settings/logout.php">Log Out</a>
                <?php
                }
                ?>
            </div>
        </div>

        <!-- dropdown for orders info, help, chat, payment and refunds -->
        <div class="dropdown show">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class='fa fa-question-circle-o'></i> Help
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a href="" class="dropdown-item dp-link">Help Center</a>
                <a href="checkout.php" class="dropdown-item dp-link">Place an order</a>
                <a href="existing_orders.php" class="dropdown-item dp-link">Track your order</a>
                <a href="existing_orders.php?cancel=1" class="dropdown-item dp-link">Order Cancellation</a>
                <a href="?create-return=1" class="dropdown-item dp-link">Returns and Refunds</a>
                <a href="?pay-for-order=1" class="dropdown-item dp-link">Payment and KShan Account</a>
                <div class="dropdown-item dp-btn" style="border-bottom: none; border-top: 4px solid lightgray; padding-bottom: 1em;">
                    <a class="btn" href="" ><i class="fa-regular fa-message"></i> Live Chat</a>
                </div>
            </div>
        </div>

        <!-- cart link -->
        <div class="cart-div">
            <a href="cart.php" class="cart" id="cart">
                <span>
                    <i class="fa-solid fa-cart-shopping"></i><span class="badge"><?php echo $items_count ?>
                </span>
            </span> 
            Cart</a>
        </div>
    </nav>
    </div>
