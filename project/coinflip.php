<?php
include_once('connection2.php'); 

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: logout2.php");
    exit();
}

$user = $_SESSION['user'];
$query1 = "SELECT * FROM users where id = '" . $user . "'";
$result=mysqli_query($con,$query1);
$row = mysqli_fetch_assoc($result);
$name = $row['username'];
$balance = $row['points'];
$total = 0;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
  <div class="box">
    <img src="casfin.png" class="smolbox">
    <div class="button"><a href="roulette.php">Roulette</a></div>
    <div class="button"><a href="#">Crash</a></div>
    <div class="button"><a href="coinflip.php">Coinflip</a></div>
    <div class="dropdown align-right">
      <button class="button dropbtn showname">▽<?php echo $name; ?>▽</button>
      <div class="dropdown-content">
        <a href="change.php">Change password</a>
        <a href="logout2.php">Log out</a>
      </div>
    </div>
    <div class="currenc align-right"><?php echo $balance;?></div>
  </div>
<div id="main">
    <div id="sidebar">
        <div class="chatango">
            <script id="cid0020000283819925762" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 100%;height: 100%;">{"handle":"legitcasino","arch":"js","styles":{"a":"000000","b":100,"c":"FFFFFF","d":"FFFFFF","k":"000000","l":"000000","m":"000000","n":"FFFFFF","p":"10","q":"000000","r":100,"surl":0,"cnrs":"0.54","fwtickm":1}}</script>
        </div>
    </div>
    <div id="page-wrap">
        <form id="bet" method="post" action="coinflip.php">
        <div class="wrap">
            <?php 
            if (isset($_POST['betsubmit']) && isset($_POST['select'])){
                if ($_POST['betamm'] <= $balance && $_POST['betamm'] > 0.1){
                    $thebet = $_POST['betamm'];
                    $number = rand (1 , 2);
                    if($number == 1){
                        echo "<img src=\"head.png\" class=\"alligncoin\" />";
                    }
                    else{
                        echo "<img src=\"tail.png\" class=\"alligncoin\" />";
                    }
                    if ($number == $_POST['select']){
                        $total = $balance + $thebet;
                        echo "<div class = \"betmsg\">You won: $thebet </div>";
                    }
                    else{
                        $total = $balance - $thebet;
                        echo "<div class = \"betmsg\">You lost: $thebet </div>";
                    }
                    $query5 = "UPDATE users set points = $total where id = '" . $user . "'";
                    mysqli_query($con,$query5);
                    header('Refresh: 3; URL=coinflip.php');
                }
                else{
                    echo "<script> alert('invalid amount'); </script>";
                }
            }
            
            ?>
            <input type="radio" name="select" id="option-1" value="1" checked>
            <input type="radio" name="select" id="option-2" value="2">
            <label for="option-1" class="option option-1">
                <div class="dot"></div>
                <span>Heads</span>
                </label>
            <label for="option-2" class="option option-2">
                <div class="dot"></div>
                <span>Tails</span>
            </label>
        </div>
            <div class="betammcoin">
            <input type="number" id="betamm" name="betamm" required placeholder="Enter bet amount"/>
            </div>
            <div class="betconfirmcoin">
            <input type="submit" name="betsubmit" class="button" value="Confirm"/>
            </div>
        </form>
    </div>
</body>
</html>