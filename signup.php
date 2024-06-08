<?php
session_start();
include ("conn.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Delivery System</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css">
    <link href=	"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
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
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        <a class="nav-link" href="login.php">Login</a>

      </div>
    </div>
  </div>
</nav>

<div class="login-page">
  <div class="form">
  <header>SIGN UP FORM</header>
    <form class="register-form" action="insert.php" method="post">
      
      <?php
        if(isset($_SESSION['status'])){
        ?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong></strong> 
        <?php echo $_SESSION['status'];?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
        <?php
          unset($_SESSION['status']);
        }
        ?>

        <div>
            <input class="in" type="text" placeholder="Fullname" id="Fullname" name="Fullname" required autocomplete="off"/><br><br>
        </div>
        <div>
            <input class="in" type="text" placeholder="Email address" name="email" id="email" required autocomplete="off"/><br><br>
        </div>
        <div>
            <input class="in" type="text" placeholder="Username" name="username" id="username" required autocomplete="off"/><br><br>
        </div>
        <div>
            <input class="in" type="password" placeholder="Password" name="password" id="password" required autocomplete="off"/><br><br>
        </div>
        <div>
            <input class="inn" type="password" placeholder="Confirm password" name="cpassword" id="cpassword" required autocomplete="off"/>
        </div>
        <div class="qw">
            <input type="checkbox" id="showpassword" onclick="myfunction()">
            <label for="">Display password</label><br><br>
        </div>

        <button class="qa" name="submit">Sign up</button><br><br>
       
             <div>
              Already have an account? <a class="ms-1" href="login.php">Log in</a>
             </div>   
            </form>
          <div>
        <div>

     <script src="script/function.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
