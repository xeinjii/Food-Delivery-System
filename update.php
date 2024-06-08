<?php
session_start();
include("conn.php");
if(isset($_POST["cancel"])){
header("location: index.php");
}
if(isset($_POST["submit"])){
    $email = $_POST["email"];   
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $sql = "SELECT * FROM accountdb WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $count_email = mysqli_num_rows($result);

    if($count_email == 0){
        // Email does not exist
        $_SESSION['status'] = "Email does not exist!!";
        header("location: forgotpass.php");
    } else {

        if($password==$cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // Use placeholders and prepared statements to prevent SQL injection
            $sql= "UPDATE accountdb SET password = '$hash' WHERE email = '$email'";
            $stmt = mysqli_prepare($conn, $sql);
            $result = mysqli_stmt_execute($stmt);
            if($result){   
                $_SESSION['reminder'] = "Do you really want to delete these records? This process cannot be undone."; 
                header("Location: login.php"); 
                
                exit();
            } else {
                $_SESSION['status'] = "Password update failed!!";
              header("location: login.php");
            }
        } else {
            $_SESSION['status'] = "Password do not match!!";
            header("location: forgotpass.php");
        }
    }
}

?>