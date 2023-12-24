<?php
session_start();
include("connect.php");

if (!isset($_SESSION['userdata'])) {
    header("location: ../loginv/loginv.html");
    exit();
}

$username = $_SESSION['userdata']['username'];
$candidateValue = $_POST['vote'];

if (empty($username)) {
    echo '
    <script>
    alert("Error: Username not found.");
    window.location = "../registration/regi.html";
    </script>
    ';
    exit();
}

if ($_SESSION['userdata']['status'] == 0) {
    $updateVoteQuery = mysqli_query($connect, "UPDATE users SET votes = $candidateValue, status = 1 WHERE username = '$username' AND votes = 0");
    $ins = mysqli_query($connect, "INSERT INTO vote(username,status, votes) VALUES ('$username', 1, '$candidateValue')");


    if ($updateVoteQuery) {
        echo '
        <script>
        alert("Voted successfully!!!");
        window.location = "../dashboard/dashboard.php";
        </script>
        ';
    } else {
        echo '
        <script>
        alert("Error occurred while updating database: ' . mysqli_error($connect) . '");
        window.location = "../dashboard/dashboard.php";
        </script>
        ';
    }
} else {
    echo '
    <script>
    alert("Error: User has already voted.");
    window.location = "../dashboard/dashboard.php";
    </script>
    ';
}
?>
