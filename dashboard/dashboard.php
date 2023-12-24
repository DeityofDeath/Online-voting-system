<?php
    session_start();
    if(isset($_SESSION['userdata'])){
        $userdata = $_SESSION['userdata'];
    } else {
        header("Location: ../loginv/loginv.html");
        exit();
    }
    if($userdata['status']==0){
        $status = '<b style="color:red">Not Voted</b>';
    }else{
        $status = '<b style="color:green">Voted</b>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dashboard.css">
    <title>User Dashboard</title>
</head>
<body>
    <header>
        <h1>ONLINE VOTING</h1>
        <h1>User Dashboard</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../home/home.html">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="../api/logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container containerline">
        <div class="user-profile">
            <img src="../uploads/<?php echo $userdata['photo']?>" alt="Profile Picture" class="profile-picture">
            <div class="user-details">
                <h2 class="name"><?php echo $userdata['name']?></h2>
                <p class="username"><?php echo $userdata['username']?></p>
                <p class="email"><?php echo $userdata['email']?></p>
                <p class="status"><?php echo $status?></p>
            </div>
        </div>

        <div class="elections">
            <h2>Elections</h2>
            <ul class="election-list"></ul>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2023 Online Voting System. All rights reserved.</p>
    </footer>

    <script src="./dashboard.js"></script>
</body>
</html>
