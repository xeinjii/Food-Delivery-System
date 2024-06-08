<?php
session_start();
include("conn.php");

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['update_update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id' AND user_id = '$user_id'");
    if ($update_quantity_query) {
        header('location: vcart.php');
    }
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id' AND user_id = '$user_id'");
    header('location: vcart.php');
}

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'");
    header('location: vcart.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        <a class="navbar-brand" href="#">View cart</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">    
      <div class="navbar-nav">
        <li class="nav-item">
           <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ms-2" href="userpage.php">Shop</a>
        </li>
        <?php
            $select_rows = mysqli_query($conn, "SELECT * FROM `order` where user_id = '$user_id'") or die('query failed');
            $row_count = mysqli_num_rows($select_rows);
        ?>
        <li class="nav-item">
           <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ms-4" href="vorders.php">View order <span><?php echo $row_count; ?></a>
        </li>
        </div>
            </div>
        </div>
    </div>
</nav><br><br><br><br>

<table class="table table-hover text-center">
   <thead>
    <th class="bg-body-tertiary p-2 g-col-6">item</th>
    <th class="bg-body-tertiary p-2 g-col-6">name</th>
    <th class="bg-body-tertiary p-2 g-col-6">Price</th>
    <th class="bg-body-tertiary p-2 g-col-6">quantity</th>
    <th class="bg-body-tertiary p-2 g-col-6">total</th>
    <th class="bg-body-tertiary p-2 g-col-6">action</th>
    </thead>

<tbody>

<?php 
   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
   $grand_total = 0;
   if (mysqli_num_rows($select_cart) > 0) {
       while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
?>

<tr>
  <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="40" alt=""></td>
  <td><?php echo $fetch_cart['title']; ?></td>
  <td>₱<?php echo number_format($fetch_cart['price']); ?></td>
  <td>
    <form action="" method="post">
        <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
        <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
        <input type="submit" value="update" name="update_update_btn">
     </form>   
  </td>
  <td>₱<?php $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; echo number_format($sub_total); ?></td>
  <td><button type="button" class="btn btn-danger" data-bs-target="#remove" data-bs-toggle="modal" class="btn btn-danger"><i class='fw bx bxs-trash'></i>Remove</button></td>
</tr>

<!-- Remove row Modal -->
<div class="modal fade almodal" id="remove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Remove all</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to remove this row?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="vcart.php?remove=<?php echo $fetch_cart['id']; ?>" class="btn btn-danger">Remove</a>
      </div>
    </div>
  </div>
</div>

<?php
    $grand_total += $sub_total;  
     }
   } else {
       echo "<tr><td colspan='6'>Your cart is empty.</td></tr>";
   }
?>
<tr>
    <td></td>
    <td colspan="3">Grand total</td>
    <td>₱<?php echo number_format($grand_total); ?></td>
    <td><button data-bs-toggle="modal" data-bs-target="#deleteall" class="btn btn-danger"><i class='fw bx bxs-trash'></i>Remove all</button></td>        
</tr>

  </tbody>
</table>

<div class="checkout-btn">
    <a class="btn btn-secondary bck" href="userpage.php">Back</a>
    <a href="checkout.php" class="btn btn-primary proc <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to checkout</a>
</div>

<!-- Delete ALL Modal -->
<div class="modal fade almodal" id="deleteall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete all cart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to remove all items from your cart?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="vcart.php?delete_all" class="btn btn-danger">Remove all</a>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
