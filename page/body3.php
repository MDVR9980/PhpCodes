<?php
include('../lib/utils.php');
$captcha = changeCaptcha();
echo "		  
    <div class='c'>  
        <form method='post'>
            <div class='cc'>
                <label for='user-level'>select type user</label> 
            </div>
            <div class='inputGroup'>
                <select id='user-level' name='tuser'>  
                    <option value='Superuser'>Superuser</option>  
                    <option value='User'>User</option>  
                </select>
            </div> 
            <div class='inputGroup'>  
                <input id='username' name='Iusername' type='text' required/>  
                <label for='username'>Username</label>  
            </div> 
            <div class='inputGroup'>  
                <input id='password' name='userpass' type='password' required/>  
                <label for='password'>Password</label>  
            </div> 
            <div class='inputGroup'>  
                <input id='captcha' name='captcha' type='text' required/>  
                <label for='captcha'>Captcha</label>  
            </div>
                <input type='hidden' name='captcha-rand' value='{$captcha}'>
            <div class='captcha'>  
                {$captcha}
            </div>  
            <div class='checkbox-wrapper-33'>
                <label class='checkbox'>
                    <input class='checkbox__trigger visuallyhidden' name='subscribe' type='checkbox' />
                    <span class='checkbox__symbol'>
                    <svg
                        aria-hidden='true'
                        class='icon-checkbox'
                        width='28px'
                        height='28px'
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
                <input type='submit' class='submit-btn' name='btn-reg' value='Register' />
                <input type='submit' class='submit-btn' name='btn-login' value='Login' />  
            </div>
        </form>  
    </div>";
?>