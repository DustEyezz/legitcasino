<?php
 include_once('connection2.php'); 
 
 session_start();
 if (!isset($_SESSION['user'])) {
     header("Location: logout2.php");
     exit();
}
if (isset($_POST["chgsub"])){
    if($_POST["password"] == $_POST["confirmpassword"]){
        $password1 =  $_POST['password'];
        $user = $_SESSION['user'];

        $query3 = "SELECT * FROM users where id = '" . $user . "'";
        $result=mysqli_query($con,$query3);
        $row = mysqli_fetch_assoc($result);
        $currpassword= $row['password'];

        if($currpassword == $_POST['currpassword']){

            $sql = "UPDATE users SET password = '$password1' where id = '" . $user . "'";
            if (mysqli_query($con,$sql) === TRUE){
            } 
            else{
            echo "Error: " . $sql . "<br>" . mysqli_error ($con);
            }
            echo '<style>#alert{visibility: visible !important;}</style>';
            header('Refresh: 5; URL=logout2.php');

        }
        else{
            $error2 = true;
        }
        
    }
    else{
        $error = true;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="loginstylesheet.css">
</head>
<body class="loginbody">
    <div class="alert animate-left" style="visibility:hidden" id="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    Success! You will be redirected in 5 seconds.
    </div>
    <div class="registerpage">
    <form id="login" method="post" action="change.php">
        <div class="wrong">
        <?php 
        if (isset($error)) { 
            echo "Passwords do not match!";
        }
        if (isset($error2)) { 
            echo "Wrong password";
        }      
        ?>
        </div>
        <input type="password" name="currpassword" placeholder="Current Password" required/>
        <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" placeholder="New Password" required/>
        <input type="password" name="confirmpassword" placeholder="Confirm Password" required/>
        <div class="registercheck">
        <input type="submit" class="button" name="chgsub" value="Change"/>
        </div>
    </form>
        <div class="register">
            Back to <a style="color: darkgray" href="roulette.php">site</a>
        </div>
    </div>
</body>
</html>