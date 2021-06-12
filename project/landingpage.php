<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheet.css">
    <style>
    .mySlides {display:none;}
    </style>
</head>
<body>
    <div class="mySlides">
        <img src="girl-car.jpg" class="animate-fading">
        <div class="display-middletop content-text animate-fading">
            Make Big Money Bucks
        </div>
        <a href="login2.php" class="buttonland display-middlebottom">Get Started NOW!</a>
    </div>
    <div class="mySlides">
        <img src="lamborghini-aventador.jpg" class="animate-fading">
        <div class="display-middletop content-text animate-fading">
            THIS CAR COULD BE YOURS!!
        </div>
        <a href="login2.php" class="buttonland display-middlebottom">Get Started NOW!</a>
    </div>
    <div class="mySlides">
        <img src="bigmoneystacks.jpg" class="animate-fading">
        <div class="display-middletop content-text animate-fading">
            BEFORE I WAS POOR, NOW LOOK AT ME!!!1!
        </div>
        <a href="login2.php" class="buttonland display-middlebottom">Get Started NOW!</a>
    </div>
    <div class="mySlides">
        <img src="thumbman.jpg" class="animate-fading">
        <div class="display-middletop content-text animate-fading">
            Cash Out Instantly 100% Safe
        </div>
        <a href="login2.php" class="buttonland display-middlebottom">Get Started NOW!</a>
    </div>
<script>
var myIndex = 0;
slides();

function slides() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(slides, 10000); 
}
</script>
<audio id="player" autoplay loop>
    <source src="Congratulations.mp3" type="audio/mp3"> <!–– kara za uzywanie dziwnego browsera, np internet explorer ––>
</audio>
</div>
</body>
</html>