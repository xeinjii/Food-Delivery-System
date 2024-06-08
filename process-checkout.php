<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css">
    <title>Food Delivery System</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark-subtle fixed-top">
    <div class="container-fluid">
    <img class="image" src="img/logo.png" alt="images">
        <a class="navbar-brand" href="#">Food Delivery System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">    
       
            </div>
        </div>
    </div>
</nav><br><br><br><br>
    
</body>
</html>
<?php 
session_start();
include("conn.php");

if(isset($_POST['order_btn'])){
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address1 = mysqli_real_escape_string($conn, $_POST['address1']);
    $address2 = mysqli_real_escape_string($conn, $_POST['address2']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $user_id = $_SESSION['user_id'];

    $order_date = date("Y-m-d H:i:s");

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE  user_id = '$user_id'");
    $total_price = 0;
    $product_name = [];

    if(mysqli_num_rows($cart_query) > 0){
        while($product_item = mysqli_fetch_assoc($cart_query)){
            $product_name[] = $product_item['title'] .' ('. $product_item['quantity'] .') ';
            $product_price = number_format($product_item['price'] * $product_item['quantity'], 2, '.', '');
            $total_price += $product_price;

            // Update the quantity in the productdb
            $product_id = $product_item['product_id']; // Assuming product_id is stored in the cart table
            $quantity_ordered = $product_item['quantity'];
            mysqli_query($conn, "UPDATE productdb SET Quantity = Quantity - $quantity_ordered WHERE id = '$product_id'") or die('query failed');
        }
    }

    $total_product = implode(', ', $product_name);

    // Generate a unique order ID
    $order_id = uniqid();

    $detail_query = mysqli_query($conn, "INSERT INTO `order` (order_id, fullname, phone, city, address1, address2, payment_method, total_product, total_price, order_date, user_id) VALUES ('$order_id', '$fullname','$phone','$city','$address1','$address2','$payment_method','$total_product','$total_price','$order_date','$user_id')") or die('query failed');

    if($detail_query){
        echo "
        <div class='message-page'>
           <div class='message'>
                <h3>Thank you for shopping!</h3>
                <div class='order-detail'>
                    <span>".$total_product."</span>
                    <span class='total'> Total:₱".$total_price." </span>
                    <span class='order-id'> Order ID: ".$order_id." </span>
                </div>
                <div class='customer-details'>
                    <p>Your name: <span>".$fullname."</span></p>
                    <p>Your number: <span>".$phone."</span></p>
                    <p>Your city: <span>".$city."</span></p>
                    <p>Your address: <span>".$address1.", ".$address2."</span></p>
                    <p>Your payment mode: <span>".$payment_method."</span></p>
                    <p>(*Pay when the product arrives*)</p>
                </div>
                <a class='orer' href='vorders.php' class='btn'>View order</a>
            </div>
        </div>
        ";
        
        // Clear the cart after placing the order
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

        // Retrieve the product quantity after placing the order
       
    }
}
?>
