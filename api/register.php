<?php
    include("connect.php");

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $image = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];

    if($password == $cpassword){
        move_uploaded_file($tmp_name, "../uploads/$image");
        $insert = mysqli_query($connect, "INSERT INTO users(name, mobile, email, username, password, photo, status, votes) VALUES ('$name', '$mobile', '$email', '$username', '$password', '$image', 0, 0)");
        if($insert){
            echo '
            <script>
            alert("Registered successfully!!!");
            window.location = "../loginv/loginv.html";
            </script>
            ';
        }else {
            echo '
            <script>
            alert("Error occurred while registering: ' . mysqli_error($connect) . '");
            window.location = "../registration/regi.html";
            </script>
            ';
        }
    }else{
        echo '
        <script>
        alert("Password does not match");
        window.location = "../registration/regi.html";
        </script>
        ';
    }
?>
