<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <h2>Admin Settings</h2>
        <a href="../index.php">Shop</a>
        <a href='../manage-products/'>Products</a>
        <a href='../manage-orders/'>Orders</a>
        <a href='#'>Account Settings</a>
    </nav>
    <div class="container">
        <h3>Edit Admin Credentials</h3>
        <form action="edit_credentials.php" method="post">
            <label for="emailAddress">Email Address:</label>
            <input type="email" id="emailAddress" name="emailAddress" required>

            <label for="oldPassword">Old Password:</label>
            <input type="password" id="oldPassword" name="oldPassword" required>

            <label for="password">New Password:</label>
            <input type="password" id="new_password" name="password" required>

            <input type="submit" value="Save Changes">
        </form>

        <h3>Add New Admin</h3>
        <form action="add_admin.php" method="post">

            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="phoneNumber">phoneNumber:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" placeholder="e.g, +254111222333" required>

            <label for="emailAddress">Email:</label>
            <input type="email" id="emailAddress" name="emailAddress" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Add Admin">
        </form>

        <h3>Account Actions</h3>
        <a href="logout.php"><button>Logout</button></a>
        <a href="delete_account.php"><button>Delete Account</button></a>
    </div>
</body>
</html>
