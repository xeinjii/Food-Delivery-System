<?php
session_start();
include("conn.php");

$id = $_GET['edit'];

if(isset($_POST['submit'])){
$ProductTitle = $_POST['ProductTitle'];
$ProductPrice = $_POST['ProductPrice'];
$Quantity = $_POST['Quantity'];
$Category = $_POST['Category'];
$ProductPicture = $_FILES['ProductPicture']['name'];
$ProductPicture_tmp_name = $_FILES['ProductPicture']['tmp_name'];
$ProductPicture_folder = 'uploaded_img/'.$ProductPicture;

$edit = "UPDATE productdb SET ProductTitle='$ProductTitle', ProductPrice='$ProductPrice', Quantity='$Quantity', Category='Category', ProductPicture='$ProductPicture' WHERE id= '$id' ";
$upload = mysqli_query($conn, $edit);

if($upload){
   move_uploaded_file($ProductPicture_tmp_name, $ProductPicture_folder);
   header("location: search.php");
}
else{
   $_SESSION['status'] = "Product Id does not exist";
   header("location: search.php");
}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Food Delivery System</title>
   <link rel="icon" href="img/logo.png" type="image/x-icon">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="style/style.css">
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
</nav>


   <div class="edit-page">
      <header>Edit product</header>
      <div class="edit">
         <div class="edit-form">

 <?php
      
      $select = mysqli_query($conn, "SELECT * FROM productdb WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

 ?>

    <form action="" method="post" enctype="multipart/form-data">
         <div class="form-floating mb-3">
            <input type="text" class="form-control" id="ProductTitle" name="ProductTitle" value="<?php echo $row['ProductTitle']; ?>" placeholder="Product title" required>
            <label for="floatingPassword">Title</label>
         </div>

         <div class="form-floating mb-3">
            <input type="text" class="form-control" id="ProductPrice" name="ProductPrice" value="<?php echo $row['ProductPrice']; ?>" placeholder="Product price" required>
            <label for="floatingPassword">Price</label>
         </div>

         <div class="form-floating mb-3">
            <input type="number" class="form-control" id="Quantity" name="Quantity" value="<?php echo $row['Quantity']; ?>" placeholder="Product price" min="0" step="1" required>
            <label for="floatingPassword">Quantity</label>
         </div>

         <div class="form-floating mb-3">
      
         <select class="form-control"  name="Category" id="Category">
         <option value="Dessert" >Dessert</option>
         <option value="Drinks" >Drinks</option>
         <option value="Pizza" >Pizza</option>
         <option value="Combo meal">Combo meal</option>
         <option value="Fries"> French fries</option>
         <option value="Sandwich">Sandwich</option>  
         </select> 
        <label for="floatingPassword">Select category</label>
        </div>

         <div class="form-floating mb-3">
            <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="ProductPicture" name="ProductPicture" placeholder="Product Picture" required>
            <label for="floatingPassword">Picture</label></br>
         </div>

         <div class="modal-footer">
         <div>
         <a class="btn btn-secondary me-5" href="search.php">Cancel</a>
         </div>
            <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
        </div>
            </form>
            <?php }; ?>
         </div>
      </div>
   </div>

</body>
</html>
