<?php
function changeCaptcha() {  
    $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";   

    $string_length = 5;    
    $changeCaptcha = '';  
    
    for ($i = 0; $i < $string_length; $i++) {  
        $rnum = rand(0, strlen($chars) - 1); 
        $changeCaptcha .= $chars[$rnum]; 
    }  

    $_SESSION['captcha'] = $changeCaptcha;
    return $changeCaptcha;   
}  
?>