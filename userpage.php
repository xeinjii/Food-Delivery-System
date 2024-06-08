<?php
session_start();
include("conn.php");

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    // Check if the product is already in the cart for this user
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE product_id = '$product_id' AND user_id = '$user_id'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'Product already added to cart';
    } else {
        // Insert the product into the cart for this user
        $insert_product = mysqli_query($conn, "INSERT INTO `cart`(product_id, title, price, image, quantity, user_id) VALUES('$product_id', '$product_name', '$product_price', '$product_image', '$product_quantity', '$user_id')");
        $message[] = 'Product added to cart successfully';
    }
}

// Remove products with quantity 0
mysqli_query($conn, "DELETE FROM `productdb` WHERE Quantity = 0");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Food Delivery System</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark-subtle fixed-top">
  <div class="container-fluid">
    <img class="image" src="img/logo.png" alt="images">
    <a class="navbar-brand" href="#">Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup1" aria-controls="navbarNavAltMarkup1" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup1">
        <div class="navbar-nav">
        <?php
            $select_rows = mysqli_query($conn, "SELECT * FROM `cart` where user_id = '$user_id'") or die('query failed');
            $row_count = mysqli_num_rows($select_rows);
        ?>
            <li class="nav-item">
               <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ms-1" href="vcart.php">View cart <span><?php echo $row_count; ?></span></a>
            </li>
        <?php
            $select_rows = mysqli_query($conn, "SELECT * FROM `order` where user_id = '$user_id'") or die('query failed');
            $row_count = mysqli_num_rows($select_rows);
        ?>
            <li class="nav-item">
               <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ms-4" href="vorders.php">View order <span><?php echo $row_count; ?></a>
            </li>
        </div>
        <div class="Search">
            <input class="form-control me-2" type="search" id="search-bar" placeholder="Search" aria-label="Search">
        </div>
        <div class="navbar-nav ms-auto">     
           <button type="button" class="btn btn-outline-dark me-3" disabled> 
              <i class='bx-fw bx bxs-user-rectangle'></i>
              <?php if (isset($_SESSION['username'])) echo $_SESSION['username']; ?>
           </button>
           <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class='bx-fw bx bx-log-out'></i> Log out
           </button>
        </div>
    </div>
  </div>
</nav><br><br><br><br>

<div class="container">
  <div class="row" id="product-list">
    <?php
    $select_products = mysqli_query($conn, "SELECT * FROM `productdb`");
    if (mysqli_num_rows($select_products) > 0) {
       while ($fetch_product = mysqli_fetch_assoc($select_products)) {
    ?>
      <div class="col-md-3 product-item">
        <div class="card mb-4">
          <form method="POST" action="">
            <img src="uploaded_img/<?php echo $fetch_product['ProductPicture']; ?>" height="180" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $fetch_product['ProductTitle']; ?></h5>
              <p class="card-text">Price: ₱<?php echo $fetch_product['ProductPrice']; ?></p>
              <p class="card-text">Stock: <?php echo $fetch_product['Quantity']; ?></p>
              <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
              <input type="hidden" name="product_name" value="<?php echo $fetch_product['ProductTitle']; ?>">
              <input type="hidden" name="product_price" value="<?php echo $fetch_product['ProductPrice']; ?>">
              <input type="hidden" name="product_image" value="<?php echo $fetch_product['ProductPicture']; ?>">
              <input type="submit" class="btn btn-primary add-cart" value="Add to cart" name="add_to_cart">
            </div>
          </form>
        </div>
      </div>
    <?php
       }
    }
    ?>
  </div>
</div>

<div class="modal fade almodal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure, do you want to logout this admin account?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form action="logout.php" method="post">
          <button type="submit" class="btn btn-primary" name="logout">Log out</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script//function.js"></script>
</body>
</html>
