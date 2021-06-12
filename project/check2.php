<?php
session_start();

include_once('connection2.php'); 


if (isset($_POST['user']) && !isset($_SESSION['user'])) {
    $query1="select * from users where username ='".$_POST['user']."'"; 
    $result=mysqli_query($con,$query1);

    $wholedata1 = array();
    if (mysqli_num_rows($result) > 0){
	    while($row = mysqli_fetch_assoc($result)){
		    $wholedata1[] = $row;
	    }
    }
    $users = array();
    foreach($wholedata1 as $entry) {
        $users[$entry["username"]] = $entry["password"];
    }

    if (isset($users[$_POST['user']])) {
        if ($users[$_POST['user']] == $_POST['password']) {
            $query2 = "select id from users where username ='".$_POST['user']."'";
            $result2=mysqli_query($con,$query2);
            $wholedata2 = array();
        
            if (mysqli_num_rows($result2) > 0){
                while($row2 = mysqli_fetch_assoc($result2)){
                    $wholedata2[] = $row2;
                }
            }
            $_SESSION['user'] = $wholedata2[0]["id"];
        }
    }

    if (!isset($_SESSION['user'])) { 
        $error = true; 
    }
}

if (isset($_SESSION['user'])) {
    header("Location: roulette.php");
    exit();
}
?>