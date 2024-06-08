<?php
session_start();
include("conn.php");
if(isset($_POST['submit'])){

$ProductTitle = $_POST['ProductTitle'];
$ProductPrice = $_POST['ProductPrice'];
$Quantity = $_POST['Quantity'];
$Category = $_POST['Category'];
$ProductPicture = $_FILES['ProductPicture']['name'];

$ProductPicture_tmp_name = $_FILES['ProductPicture']['tmp_name'];
$ProductPicture_folder = 'uploaded_img/'.$ProductPicture;

$insert = "INSERT INTO productdb(ProductTitle, ProductPrice,  Quantity, Category, ProductPicture) VALUES ('$ProductTitle','$ProductPrice','$Quantity', '$Category' ,'$ProductPicture')";
$upload = mysqli_query($conn,$insert);
if($upload){
   move_uploaded_file($ProductPicture_tmp_name, $ProductPicture_folder);
   header("location: adminpage.php");
   }
   else{
    $message[] = 'could not add the product';
   }
}

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM productdb WHERE id = $id");
   header('location:adminpage.php');
}
else if(isset($_GET['remove'])){
   $id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM productdb WHERE id = $id");
   header('location: search.php');
};
?>

