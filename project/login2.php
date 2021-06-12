<?php
 require "check2.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="loginstylesheet.css">
</head>
<body class="loginbody">
    
    <div class="login">
    <form id="login" method="post" action="login2.php">
        <div class="wrong">
        <?php if (isset($error)) { 
        echo "Wrong username or password!";
        }
        ?>
        </div>
        <input type="text" name="user" placeholder="Username" required/>
        <input type="password" name="password" placeholder="Password" required/>
        <input type="submit" class="button" value="Log in"/>
    </form>
        <div class="register">
            Need an account? <a style="color: darkgray" href="register2.php">Register</a>
        </div>
    </div>
</body>
</html>