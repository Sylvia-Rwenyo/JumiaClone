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
            <a class="dropdown-item dp-link" href="existing_orders.php"><i class="ic-mrm fas fa-envelope"></i>Orders</a>
            <a class="dropdown-item dp-link" href=""><i class="fa-regular fa-heart"></i>Saved Items</a>
        </div>
    </div>
    <div class="dropdown show">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class='fa fa-question-circle-o'></i> Help
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a href="help-center.php" class="dropdown-item dp-link">Help Center</a>
            <a href="checkout.php" class="dropdown-item dp-link">Place an order</a>
            <a href="existing_orders.php" class="dropdown-item dp-link">Track your order</a>
            <a href="existing_orders.php?cancel=1" class="dropdown-item dp-link">Order Cancellation</a>
            <a href="" class="dropdown-item dp-link">Returns and Refunds</a>
            <a href="" class="dropdown-item dp-link">Payment and KShan Account</a>
            <div class="dropdown-item dp-btn" style="border-bottom: none; border-top: 4px solid lightgray; padding-bottom: 1em;">
                <a class="btn" href="" ><i class="fa-regular fa-message"></i> Live Chat</a>
            </div>
        </div>
    </div>
    <a href="cart.php" style="padding-right: 2em;" class="cart"><i class="fa-solid fa-cart-shopping"></i> Cart</a>
</nav>