<?php
session_start();
include("conn.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Delivery System</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
   
  
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <img class="image" src="img/logo.png" alt="images">
    <a class="navbar-brand" href="#">Food Delivery System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="login.php">Login</a>
        <a class="nav-link" href="Signup.php">Sign up</a>
      </div>
    </div>
  </div>
</nav>

<div class="forgot-page">
  <header>Forgot password</header>
   <div class="forgot-form">
      <div class="formmmm">
    
      <form action="delete.php" method="post">

  
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
              <input class="innnn" type="email" id="email" name="email" placeholder="Enter your email" required autocomplete="off"/>
            </div>
            <div>
              <input class="innnn" type="password" name="password" id="password" placeholder="Create new password" required autocomplete="off"/> 
            </div>
            <div>
              <input class="innnn" type="password" name="cpassword" id="cpassword" placeholder="Confirm your password" required autocomplete="off"/>             </div>
            </div>
            <div class="qw">
            <input type="checkbox" id="showpassword" onclick="myfunction()">
            <label for="">Display password</label><br><br>
            </div>
            
            <button class="pa" name="submit">Changes password</button>
      </form>
    </div>
  </div>
</div>

        <script src="script/function.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  </body>
</html>