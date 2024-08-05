<?php
    include('../lib/utils.php');
    $captcha = changeCaptcha();
echo "		
    <center>
			<div class='c' >
				<form action='' method='post'>
                    <div class='cc'>
                        <input class='ccc' name='username' placeholder='enter a Username' type='text' /><br />
                    </div>
                    <div class='cc'>  
                        <input class='ccc' id='captcha' name='captcha' placeholder='enter captcha' type='text'/><br />  
                        <input type='hidden' name='captcha-rand' value='{$captcha}'>
                    </div>  
                    <div id='capt1' class='captcha'>  
                    {$captcha}
                    </div>
                    <div>
                        <input type='submit' name='btn-update' value='Update' />
                    </div>
				</form>
			</div>	
		</center>	";
?>