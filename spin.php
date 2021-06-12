<?php
function spin(){
    $number = rand (1 , 38);
    if($number < 18){
        return "red";
    }
    else if($number >= 20){
        return "black";
    }
    else if($number == 18 or $number == 19){
        return "green";
    }
    
}
?>