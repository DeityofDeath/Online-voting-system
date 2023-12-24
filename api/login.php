<?php
    include("connect.php");

    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($connect, "SELECT * FROM users WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($check) > 0) {
        $userdata = mysqli_fetch_array($check);
        $_SESSION['userdata'] = $userdata;

        echo "Session Data after Login:";
        var_dump($_SESSION);

        echo "<script>
            alert('Login Successful! Redirecting to Dashboard.');
            window.location='../dashboard/dashboard.php';
        </script>";
        
    } else {
        echo "Session Data before Redirection (Login Failed):";
        var_dump($_SESSION);

        echo '<script>
            alert("Username or Password is incorrect!");
            window.location = "../loginv/loginv.html";
        </script>';
    }
?>
