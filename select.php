<?php
session_start();
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Fetch the user data based on the username
    $sql = "SELECT * FROM accountdb WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Store user_id and username in session
            $_SESSION["user_id"] = $row['id']; // Assuming 'id' is the column name for user ID
            $_SESSION["username"] = $username;

            // Redirect based on user type
            if ($row["Usertype"] == "user") {
                header("location: userpage.php");
            } elseif ($row["Usertype"] == "admin") {
                header("location: adminpage.php");
            } else {
                $_SESSION['status'] = "Incorrect username or password!!";
                header("location: login.php");
            }
        } else {
            $_SESSION['status'] = "Incorrect username or password!!";
            header("location: login.php");
        }
    } else {
        $_SESSION['status'] = "Incorrect username or password!!";
        header("location: login.php");
    }
}
?>
