<?php
if (isset($_POST["regsub"])){
    if($_POST["password"] == $_POST["confirmpassword"]){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $username1 = $_POST['username'];
        $password =  $_POST['password'];
        $query1 = "SELECT * FROM users where username = '" . $username1 . "'";
        $result = $conn->query($query1);
        if ($result->num_rows == true){
            $error2 = true;
        }
        else{
            $sql = "INSERT INTO users (username, password, points)
            VALUES ('$username1', '$password', 1000)";
            if ($conn->query($sql) === TRUE){
            } 
            else{
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            echo '<style>#alert{visibility: visible !important;}</style>';
            header('Refresh: 5; URL=login2.php');
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
    <form id="login" method="post" action="register2.php">
        <div class="wrong">
        <?php 
        if (isset($error)) { 
            echo "Passwords do not match!";
        }
        if (isset($error2)) { 
            echo "User already exists!";
        }      
        ?>
        </div>
        <input type="text" pattern="[a-zA-Z][a-zA-Z0-9-_]{5,12}" title="Must be between 5 and 12 characters, no special characters apart from dash(-) and underscore(_)" name="username" placeholder="Username" required/>
        <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" placeholder="Password" required/>
        <input type="password" name="confirmpassword" placeholder="Confirm Password" required/>
        <div class="registercheck">
        <input type="checkbox" name="check1" required/>
        <label class="margin-left" for="check1">I confirm that I am over 18</label>
        <input type="submit" class="button" name="regsub" value="Register"/>
        </div>
    </form>
        <div class="register">
            Have an account? <a style="color: darkgray" href="login2.php">Log in</a>
        </div>
    </div>
</body>
</html>