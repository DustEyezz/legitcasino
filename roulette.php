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
    <div class="button"><a href="#">Roulette</a></div>
    <div class="button"><a href="#">Crash</a></div>
    <div class="button"><a href="coinflip.php">Coinflip</a></div>
    <div class="dropdown align-right">
      <button class="button dropbtn showname">▽<?php echo $name; ?>▽</button>
      <div class="dropdown-content">
	  	<a href="change.php">Change password</a>
        <a href="logout2.php">Log out</a>
      </div>
    </div>
    <div class="currenc align-right"><?php echo $balance; ?></div>
  </div>
<div id="main">
    <div id="sidebar">
        <div class="chatango">
            <script id="cid0020000283819925762" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 100%;height: 100%;">{"handle":"legitcasino","arch":"js","styles":{"a":"000000","b":100,"c":"FFFFFF","d":"FFFFFF","k":"000000","l":"000000","m":"000000","n":"FFFFFF","p":"10","q":"000000","r":100,"surl":0,"cnrs":"0.54","fwtickm":1}}</script>
        </div>
    </div>
    <div id="page-wrap">
		<div class="timer" id="Timer"></div>
		<canvas class="spinner" id="canvas" width="500" height="500"></canvas>
        <form id="bet" method="post" onsubmit="return false">
            <div class="betamm">
            <input type="number" id="betamm" name="bet" placeholder="Enter bet amount"/>
            </div>
            <div class="betconfirmblack">
            <input type="submit" name="subblack" onclick="getdataBlack()" class="button" value="Bet 2x"/>
            </div>
            <div class="betconfirmgreen">
            <input type="submit" name="subgreen" onclick="getdataGreen()" class="button" value="Bet 14x"/>
            </div>
            <div class="betconfirmred">
            <input type="submit" name="subred" onclick="getdataRed()" class="button" value="Bet 2x"/>
            </div>
        </form>
    </div>
</div>
</body>
			<script>
                var options = ["RED","BLACK","RED","BLACK","RED","BLACK","RED","BLACK","RED","BLACK","RED","BLACK","RED","BLACK","GREEN",];

                var startAngle = 0;
                var arc = Math.PI / (options.length / 2);
                var spinTimeout = null;
				var timeLeft = 19;

                var spinArcStart = 10;
                var spinTime = 0;
                var spinTimeTotal = 0;

				var betammount = 0;
				var betcolor = null;

                var ctx;

				var cash=<?php echo $balance; ?>;

				function getdataBlack(){ 
					betammount=document.getElementById('betamm').value;
					if (betammount > 0 && betammount <= cash){
						betcolor = "BLACK";
					}
					else {
						alert("invalid amount");
					}
				}
				function getdataGreen(){ 
					betammount=document.getElementById('betamm').value;
					if (betammount > 0 && betammount <= cash){
						betcolor = "GREEN";
					}
					else {
						alert("invalid amount");
					}
				}
				function getdataRed(){ 
					betammount=document.getElementById('betamm').value;
					if (betammount > 0 && betammount <= cash){
						betcolor = "RED";
					}
					else {
						alert("invalid amount");
					}
				}

                function getColor(item, maxitem) {
					var phase = 0;
					var center = 128;
					var width = 127;
					var frequency = Math.PI*2/maxitem;
				  	if (item%2 == 0 && item != 14){
						color = "red"
				  	}
					else if(item == 14){
						color = "green"
					}
					else{
						color = "black"
					}
                  
                  	return color;
                }

            function drawRouletteWheel() {
                var canvas = document.getElementById("canvas");
                if (canvas.getContext) {
                    var outsideRadius = 200;
                    var textRadius = 160;
                    var insideRadius = 125;

                    ctx = canvas.getContext("2d");
                    ctx.clearRect(0,0,500,500);

                    ctx.strokeStyle = "black";
                    ctx.lineWidth = 2;

                    ctx.font = 'bold 12px Helvetica, Arial';

                    for(var i = 0; i < options.length; i++) {
                      	var angle = startAngle + i * arc;
                      	ctx.fillStyle = getColor(i, options.length);

                    ctx.beginPath();
                    ctx.arc(250, 250, outsideRadius, angle, angle + arc, false);
                    ctx.arc(250, 250, insideRadius, angle + arc, angle, true);
                    ctx.stroke();
                    ctx.fill();

                    ctx.save();
                    ctx.shadowOffsetX = -1;
                    ctx.shadowOffsetY = -1;
                    ctx.shadowBlur    = 0;
                    ctx.shadowColor   = "rgb(220,220,220)";
                    ctx.fillStyle = "black";
                    ctx.translate(250 + Math.cos(angle + arc / 2) * textRadius, 
                                    250 + Math.sin(angle + arc / 2) * textRadius);
                    ctx.rotate(angle + arc / 2 + Math.PI / 2);
                    var text = options[i];
                    ctx.fillText(text, -ctx.measureText(text).width / 2, 0);
					
                    ctx.restore();
                    } 

                    //Arrow
                    ctx.fillStyle = "purple";
                    ctx.beginPath();
                    ctx.moveTo(250 - 4, 250 - (outsideRadius + 5));
                    ctx.lineTo(250 + 4, 250 - (outsideRadius + 5));
                    ctx.lineTo(250 + 4, 250 - (outsideRadius - 5));
                    ctx.lineTo(250 + 9, 250 - (outsideRadius - 5));
                    ctx.lineTo(250 + 0, 250 - (outsideRadius - 13));
                    ctx.lineTo(250 - 9, 250 - (outsideRadius - 5));
                    ctx.lineTo(250 - 4, 250 - (outsideRadius - 5));
                    ctx.lineTo(250 - 4, 250 - (outsideRadius + 5));
                    ctx.fill();
                  }
            }

                function spin() {
                  	spinAngleStart = Math.random() * 10 + 10;
                  	spinTime = 0;
                  	spinTimeTotal = Math.random() * 3 + 4 * 1000;
                  	rotateWheel();
				  	timeLeft = 20;
                }

                function rotateWheel() {
					spinTime += 30;
					if(spinTime >= spinTimeTotal) {
						stopRotateWheel();
						return;
					}
					var spinAngle = spinAngleStart - easeOut(spinTime, 0, spinAngleStart, spinTimeTotal);
					startAngle += (spinAngle * Math.PI / 180);
					drawRouletteWheel();
					spinTimeout = setTimeout('rotateWheel()', 30);
                }

                function stopRotateWheel() {
					clearTimeout(spinTimeout);
					var degrees = startAngle * 180 / Math.PI + 90;
					var arcd = arc * 180 / Math.PI;
					var index = Math.floor((360 - degrees % 360) / arcd);
					ctx.save();
					ctx.font = 'bold 30px Helvetica, Arial';
					var text = options[index]
					ctx.fillText(text, 250 - ctx.measureText(text).width / 2, 250 + 10);
					if (betcolor != null){
						if (betcolor == "BLACK" && text == "BLACK"){
							alert("You won!");
							var result = cash + betammount;
							betcolor = null;
						}
						else if (betcolor == "GREEN" && text == "GREEN"){
							alert("You won!");
							var result = cash + betammount;
							betcolor = null;
						}
						else if (betcolor == "RED" && text == "RED"){
							alert("You won!");
							var result = cash + betammount;
							betcolor = null;
						}		
						else{
							alert("You lost! Better luck next time!");
							var result = cash - betammount;
							betcolor = null;
						}	
					}
					ctx.restore();
                }

                function easeOut(t, b, c, d) {
					var ts = (t/=d)*t;
					var tc = ts*t;
					return b+c*(tc + -3*ts + 3*t);
                }
				var interval = setInterval(spin, 20000);

                drawRouletteWheel();

				var elem = document.getElementById('Timer');

				var timerId = setInterval(countdown, 1000);

				function countdown() {
				if (timeLeft != 0) {
					elem.innerHTML = 'Spin in: ' + timeLeft;
					timeLeft--;
				} 
				}
            </script>
</html>