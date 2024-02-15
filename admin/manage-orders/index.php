<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    echo '
        <script>
        window.location.href = "../logIn/";
        </script>
        ';
    exit();
}

include_once '../../controls/conn.php';

// Retrieve order data with product name, quantity, and total price from the database
$sql = "SELECT orders.order_id, orders.status,
               COUNT(order_items.product_id) as total_items,
               SUM(products.price * order_items.quantity) as total_price
        FROM orders
        INNER JOIN order_items ON orders.order_id = order_items.order_id
        INNER JOIN products ON order_items.product_id = products.id
        GROUP BY orders.order_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" type="text/css" href="../../css/management-style.css">

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <h2>Manage Orders</h2>
            <a href="../../user-pages/home/">Shop</a>
            <a href='../manage-products/'>Products</a>
            <a href='#'>Orders</a>
            <a href='../account/settings/'>Account Settings</a>
        </nav>

        <h3>All Orders</h3>

        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                    <th>ID</th>
                    <th>Total Items</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>";

            while ($row = $result->fetch_assoc()) {
                
                echo "<tr>
                        <td>{$row["order_id"]}</td>
                        <td>{$row["total_items"]}</td>
                        <td>{$row["total_price"]}</td>
                        <td>{$row["status"]}</td>
                        <td class='action-buttons'>
                            <a href='print_order.php?id={$row["order_id"]}'>Details</a>
                            <a href='process_order.php?id={$row["order_id"]}'>Process Order</a>
                            <a href='cancel_order.php?id={$row["order_id"]}'>Cancel Order</a>
                        </td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "No orders found.";
        }

        $conn->close();
        ?>

    </div>
</body>
</html>
