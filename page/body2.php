<?php
    include('../lib/utils.php');
    $captcha = changeCaptcha();
    echo "		
    <center>
        <div class='c' >
            <form action='' method='post'>
                <div class='cc'>
                    <input class='ccc' name='nameuser' placeholder='enter name' type='text'/><br />
                </div>
                <div class='cc'>
                    <input class='ccc' name='familyuser' placeholder='enter family' type='text'/><br />
                </div>
                <div class='cc'>
                    <input class='ccc' name='username' placeholder='enter username' type='text'/><br />
                </div>
                <div class='cc'>
                    <input class='ccc' name='userpass' placeholder='enter password' type='password'/><br />
                </div>
                <div class='cc'>  
                <input class='ccc' id='captcha' name='captcha' placeholder='enter captcha' type='text'/><br />  
                <input type='hidden' name='captcha-rand' value='{$captcha}'>
                </div>  
                <div id='capt1' class='captcha'>  
                    {$captcha}
                </div>
                <div>
                    <input type='checkbox' id='subscribe' name='subscribe' value='I am not a robot'>
                    <label for='subscribe'>I am not a robot!</label>
                </div>
                <br/>
                <div class='btn'>
                    <input type='submit' class='ccc' class='submit-btn' name='btn-register' value='Save' />
                    <input type='submit' class='ccc' class='submit-btn' name='btn-login3' value='Login'/>  
                </div>
            </form>
        </div>	
    </center>	";
?>