<?php 
session_start();
include("conn.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `order` WHERE id = '$remove_id' AND user_id = '$user_id'") or die('query failed');
    header('location: vorders.php');
 }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Food Delivery System</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark-subtle fixed-top">
    <div class="container-fluid">
        <img class="image" src="img/logo.png" alt="images">
        <a class="navbar-brand" href="#">View order</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">    
                <li class="nav-item">
                    <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ms-1" href="userpage.php">Shop</a>
                </li>
                <?php
                    $select_rows = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                    $row_count = mysqli_num_rows($select_rows);
                ?>
                <li class="nav-item">
                    <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ms-4" href="vcart.php">View cart<span><?php echo $row_count; ?></span></a>
                </li>
            </div>
        </div>
    </div>
</nav>
<br><br><br><br>

<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Date and Time</th>
                <th>Name</th>
                <th>Item</th>
                <th>Price</th>
                <th>Phone</th>
                <th>City</th>
                <th>Address1</th>
                <th>Address2</th>
                <th>Method</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $select_cart = mysqli_query($conn, "SELECT * FROM `order` WHERE user_id = '$user_id'");
            if (mysqli_num_rows($select_cart) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
        ?>
            <tr>
                <td><?php echo $fetch_cart['order_date']; ?></td>
                <td><?php echo $fetch_cart['fullname']; ?></td>
                <td><?php echo $fetch_cart['total_product']; ?></td>
                <td>₱<?php echo $fetch_cart['total_price']; ?></td>
                <td><?php echo $fetch_cart['phone']; ?></td>
                <td><?php echo $fetch_cart['city']; ?></td>
                <td><?php echo $fetch_cart['address1']; ?></td>
                <td><?php echo $fetch_cart['address2']; ?></td>
                <td><?php echo $fetch_cart['payment_method']; ?></td>
                <td>
                    <button data-bs-toggle="modal" data-bs-target="#removeorder<?php echo $fetch_cart['id']; ?>" class="btn btn-danger">
                        <i class='fw bx bxs-trash'></i> Remove
                    </button>
                </td>
            </tr>
            
            <!-- Remove row Modal -->
            <div class="modal fade" id="removeorder<?php echo $fetch_cart['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Remove Order</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to remove this order?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="vorders.php?remove=<?php echo $fetch_cart['id']; ?>" class="btn btn-danger">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
                }
            } else {
                echo '<tr><td colspan="10" class="text-center">No orders found</td></tr>';
            }
        ?>
        </tbody>
    </table>
</div>

<div class="foott">
    <a style="width:15%" class="btn btn-success" href="userpage.php">Back</a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script/function.js"></script>
</body>
</html>
