<?php
session_start();
$_SESSION['login'] = true;
?>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="formstyles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow">
    <link href="robots.txt">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center">
            <img src="images/walnutridgebg.png" alt="Walnut Ridge Logo">
        </div>
    </div>
    <form action="admin.php" method="POST">
        <div class="row">
            <div class="col-6 mx-auto">
                <h1 class="login-header text-center">Admin Login</h1>
                <div class="form-group">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" class="form-control" placeholder="Enter Username" name="uname" id="uname" required>
                </div>
                <div class="form-group">
                    <label for="psw"><b>Password</b></label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="psw" id="psw"  required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" onclick="return checkLogin()">Login</button>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>