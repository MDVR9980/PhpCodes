<?php
include('../lib/utils.php');
$captcha = changeCaptcha();
echo "		
    <center>
        <div class='c'>
            <form method='post'>
                <div class='inputGroup'>  
                    <input id='nameuser' name='nameuser' type='text' required/>  
                    <label for='nameuser'>Name</label>  
                </div> 
                <div class='inputGroup'>  
                    <input id='familyuser' name='familyuser' type='text' required/>  
                    <label for='familyuser'>Family</label>  
                </div> 
                <div class='inputGroup'>  
                    <input id='username' name='username' type='text' required/>  
                    <label for='username'>Username</label>  
                </div> 
                <div class='inputGroup'>  
                    <input id='password' name='userpass' type='password' required/>  
                    <label for='password'>Password</label>  
                </div> 
                <div>  
                <div class='inputGroup'>  
                    <input id='captcha' name='captcha' type='text' required/>  
                    <label for='captcha'>Captcha</label>  
                </div>   
                <input type='hidden' name='captcha-rand' value='{$captcha}'/>
                </div>  
                <div id='capt1' class='captcha'>  
                    {$captcha}
                </div>
                <div class='checkbox-wrapper-33'>
                <label class='checkbox'>
                    <input class='checkbox__trigger visuallyhidden' name='subscribe' type='checkbox' />
                    <span class='checkbox__symbol'>
                    <svg
                        aria-hidden='true'
                        class='icon-checkbox'
                        width='20px'
                        height='20px'
                        viewBox='0 0 28 28'
                        version='1'
                        xmlns='http://www.w3.org/2000/svg' >
                        <path d='M4 14l8 7L24 7'></path>
                    </svg>
                    </span>
                    <p class='checkbox__textwrapper'>Not a robot!</p>
                </label>
                </div>
                <br/>
                <div>
                    <input type='submit' class='submit-btn' name='btn-register' value='Save' />
                    <input type='submit' class='submit-btn' name='btn-to-login' value='Login' onclick='goToLogin()'/>  
                </div>
            </form>
        </div>	
    </center>
    <script>
    function goToLogin() {  
        window.location.href = 'login.php'; 
    } 
    </script>";
