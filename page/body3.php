<?php  
$code = rand(10000,100000);
echo "		  
    <div class='c'>  
        <form action='' method='post'>  
            <div class='cc'>  
                <input class='ccc' id='username' name='username' placeholder='enter username' type='text'/><br />  
            </div>  
            <div class='cc'>  
                <input class='ccc' id='password' name='userpass' placeholder='enter password' type='password'/><br />  
            </div>  
            <div class='cc'>  
                <input class='ccc' id='captcha' name='captcha' placeholder='enter captcha' type='text'/><br />  
                <input type='hidden' name='captcha-rand' value='{$code}'>
            </div>  
            <div class='captcha'>  
                {$code}
            </div>  
            <div class='btn'>  
                <input class='ccc' type='submit' name='btn-reg' value='Register' class='submit-btn'>
                <input class='ccc' type='submit' name='btn-login' value='Login' class='submit-btn' />  
            </div>  
        </form>  
    </div>";	  
?>