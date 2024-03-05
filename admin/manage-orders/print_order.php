<?php
//start_session
 @session_start();

//database connection
include_once '../../controls/conn.php';

// Check if an order ID is provided in the URL
if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Retrieve order data with product details and client details from the database
    $sql = "SELECT orders.order_id, 
                   orders.mpesa_phone_number, 
                   orders.total_price, 
                   orders.total_items, 
                   orders.created_at, 
                   orders.status, 
                   products.name as product_name,
                   products.price as product_price,
                   products.category,
                   order_items.quantity
            FROM orders
            INNER JOIN order_items ON orders.order_id = order_items.order_id
            INNER JOIN products ON order_items.product_id = products.id
            WHERE orders.order_id = '$orderId'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status = $row["status"] ? "Processed" : "Pending";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f7f7f7;
        }

        h2 {
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }

        p {
            margin: 10px 0;
        }

        strong {
            font-weight: bold;
        }

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

        .print-button {
            margin-top: 20px;
            text-align: center;
        }

        .print-button button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .print-button button:hover {
            background-color: #45a049;
        }
    </style>
    <link rel="icon" type="image/png" href="../../../images/favicon-16x16.png">
</head>
<body>
    <h2>Order Details</h2>
    <!-- show order details form the database -->
    <?php
    if ($result->num_rows > 0) {
        ?>
        <p><strong>Order ID:</strong> <?php echo $row["order_id"]; ?></p>
        <p><strong>M-Pesa Phone Number:</strong> <?php echo $row["mpesa_phone_number"]; ?></p>
        <p><strong>Total Price:</strong> <?php echo $row["total_price"]; ?></p>
        <p><strong>Total Items:</strong> <?php echo $row["total_items"]; ?></p>
        <p><strong>Created At:</strong> <?php echo $row["created_at"]; ?></p>
        <p><strong>Status:</strong> <?php echo $status; ?></p>
        <h3>Products Ordered</h3>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php
            // Output each ordered product
            do {
                ?>
                <tr>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["category"]; ?></td>
                    <td><?php echo $row["product_price"]; ?></td>
                    <td><?php echo $row["quantity"]; ?></td>
                </tr>
                <?php
            } while ($row = $result->fetch_assoc());
            ?>
        </table>

        <!-- print order when button is clicked -->
        <div class="print-button">
            <button onclick="window.print()" style="background-color: #f68b1e; color: white">Print Order</button>
        </div>
        <?php
    } else {
        echo "No order found.";
    }
    ?>
</body>
</html>


<?php
    } else {
        echo "No order found.";
    }

    //close database connection 
    $conn->close();
} else {
    echo "Order ID not provided.";
}
?>
