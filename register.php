<?php 
    include('server.php') 
   
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="ajax.js"></script>
</head>
<body>
    <div class="header">
        <h2>Register</h2>
    </div>
        
    <form class="reglog" method="post" action="register.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label id="regLabel">Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label id="regLabel">Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
            <label id="regLabel">Password</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label id="regLabel">Confirm password</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Register</button>
        </div>
        <p id="regLabel">
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>
</body>
</html>