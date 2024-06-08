<?php
session_start();
include("conn.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Food Delivery System</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link href=	"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  </head>
  <body>
    
  <nav class="navbar navbar-expand-lg bg-dark-subtle">
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



<div class="loginn-page">
    <div class="formm">
    <header>Login Form</header>
    <div class="login-form">

        <form action="select.php" method="post">

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
                <input class="in" type="text" placeholder="Username" name="username" id="username" required autocomplete="off"/><br><br>
            </div>
            <div>
                <input class="in" type="password" placeholder="Password" name="password" id="password" required autocomplete="off"/>
            </div>
            <div class="qw">
                <input type="checkbox" id="showpassword" onclick="myfunction()">
                <label for="">Display password</label><br><br>
            </div>
            <button class="qa" name="submit">Log in</button><br><br>
            <div>
           
            <div class="forgotp">
            <a class="nav-link" href="forgot.php">Forgot your password?</a>
            </div><br><br>
             
            <div class="text-align">
             Dont have an account? <a class="ms-1" href="signup.php">Signup</a>
            </div>

        </form>
    </div>
  </div>
  </div>

      <script src="script/function.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
