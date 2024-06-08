<?php
    session_start();
    include("conn.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css">
    <link href=	"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<title>Food Delivery System</title>
</head>
<body>

        
<nav class="navbar navbar-expand-lg bg-dark-subtle fixed-top">
    <div class="container-fluid">
    <img class="image" src="img/logo.png" alt="images">
        <a class="navbar-brand" href="#">Order details</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">    
     
            </div>
        </div>
    </div>
</nav><br><br><br><br>

<div class="checkout-page">
    <div class="check-out">
        <div class="checkout-form">
            <form action="process-checkout.php" method="post">
               <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="fullname" id="floatingInput">
                  <label for="floatingInput">Name</label>
               </div>
               
               <div class="form-floating mb-3">
                  <input type="tel" class="form-control" name="phone" id="floatingInput">
                  <label for="floatingInput">Phone number</label>
               </div>
               
               <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="city" id="floatingInput">
                  <label for="floatingInput">City</label>
               </div>

               <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="address1" id="floatingInput" >
                  <label for="floatingInput">Address 1</label>
               </div>

               <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="address2" id="floatingInput" >
                  <label for="floatingInput">Address 2</label>
               </div>
                <div>
                    <select class="sel" name="payment_method" id="payment_method">
                        <option value="Cod">Cash on delivery</option>
                    </select>
                </div><br>
                <div>
                   <a class="btn btn-secondary me-4 ca" href="vcart.php">Cancel</a>
                   <button class="btn btn-primary ms-3 ckk" type="submit" name="order_btn">Checkout</button>
                </div>

            </form>
        </div>
    </div>
</div>






        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>