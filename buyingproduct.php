
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="style/style.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="icon" href="img/logo.png" type="image/x-icon">
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
	</nav>

	<?php
		
		$select = mysqli_query($conn, "SELECT * FROM productdb WHERE id = '$id'");
		while($row = mysqli_fetch_assoc($select)){

	?>
	<div div="productpic">
	<img class="dis" src="uploaded_img/<?php echo $row["ProductPicture"];  ?>"  class="card-img-top" alt="..."><br><br>
	</div>

 <div class="buy-page">
    <div class="buy">
   <form action="" method="post">
	<div class="form-floating mb-3">
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['ProductTitle'];?>"disabled>
            <label for="floatingPassword">Title</label>
      </div>
	  <div class="form-floating mb-3">
            <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['ProductPrice'];?>"disabled>
            <label for="floatingPassword">Price</label>
      </div>
	  <div class="form-floating mb-3">
            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="0" step="1">
            <label for="floatingPassword">Quantity</label>
      </div>
	  <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" required>
            <label for="floatingPassword">Name</label>
      </div>
	  <div class="form-floating mb-3">
           <select class="form-control" name="" id="" required>
			<option value=""></option>
			<option value="CCS" class="">CCS</option>
			<option value="COTED" class="">COTED</option>
			<option value="CAS" class="">CAS</option>
			<option value="COE" class="">COE</option>
			<option value="CBM" class="">CBM</option>
			<option value="CAF" class="">CAF</option>
			<option value="CCJE" class="">CCJE</option>
		   </select>
            <label for="floatingPassword">Select address to deliver</label>
      </div>
	  <div class="form-floating mb-3">
            <input type="tel" class="form-control" id="contact_number" name="contact_number" required >
            <label for="floatingPassword">Contact number</label>
      </div>
	 <div class="buy-product">
		<a class="btn btn-secondary can" href="userpage.php">Cancel</a>
     <button type="submit" name="submit" class="btn btn-primary buying">Buy</button>
	 </div>
</form>
</div>
</div>
	<?php }; ?>

				<script src="script/function.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
	</body>
	</html>