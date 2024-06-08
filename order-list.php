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
        <a class="navbar-brand" href="#">Order list</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">    
       
            </div>
        </div>
    </div>
</nav><br><br><br><br>



            <table class="table table-hover">
        
            <thead>
                <th>date and time</th>
                <th>name</th>
                <th>item</th>
                <th>price</th>
                <th>phone</th>
                <th>city</th>
                <th>address1</th>
                <th>address2</th>
                <th>method</th>
            </thead>
                <tbody>
                <?php 
   $select_cart = mysqli_query($conn, "SELECT * FROM `order`");
   
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
                    </tr>
                    <?php 
     }
   } 
?>
                </tbody>
            </table>
  





</body>
</html>