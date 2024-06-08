<?php

session_start();
include("conn.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery System</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
      <header>Add admin</header>
      <div class="edit">
         <div class="edit-form"></div>
         <form action="adminin.php" method="post">

        <?php
        if(isset($_SESSION['ss'])){
        ?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong></strong> 
        <?php echo $_SESSION['ss'];?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
        <?php
          unset($_SESSION['ss']);
        }
        ?>



        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="Fullname" name="Fullname"  required>
            <label for="floatingPassword">Fullname</label>
      </div>
      <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" required>
            <label for="floatingPassword">Email</label>
      </div>
      <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" required>
            <label for="floatingPassword">Username</label>
      </div>
      <div class="form-floating mb-3">
            <input type="password" class="form-control" id="pasword" name="password"  required>
            <label for="floatingPassword">Password</label>
      </div>
      <div class="form-floating mb-3">
            <input type="password" class="form-control" id="cpassword" name="cpassword" required>
            <label for="floatingPassword">Confirm your password</label>
      </div>

      <div class="modal-footer">
        <div class="cancel">
          <a class="btn btn-secondary" href="adminpage.php">Cancel</a>
        </div>
        <button type="submit" name="submit" class="btn btn-primary ms-4">Save</button> 
      </div>
        </form>



      </div>
   </div>
</div>






       
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>