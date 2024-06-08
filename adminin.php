<?php
    session_start();
    include("conn.php");
    if(isset($_POST['submit'])){
        $Fullname = mysqli_real_escape_string($conn, $_POST['Fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
      
        
        $sql="select * from accountdb where username='$username'";
        $result = mysqli_query($conn, $sql);
        $count_username = mysqli_num_rows($result);

        $sql="select * from accountdb where email='$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        if($count_username == 0 & $count_email==0){
            if($password==$cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO accountdb(Fullname, username, email, password, Usertype) VALUES('$Fullname','$username', '$email', '$hash', 'admin')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: adminpage.php");
                }
            }
            else{       
              $_SESSION['ss'] = "Password do not match!!";
              header("location: insertadmin.php");
            }
        }
        else{
            if($count_username>0){
                $_SESSION['ss'] = "Username already exist!!";
                header("location: insertadmin.php");
            }
            if($count_email>0){
                $_SESSION['ss'] = "Email already exist";
                header("location: insertadmin.php");
            }
        }
        
    }
?>