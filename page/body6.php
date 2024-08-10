<link rel='stylesheet' type='text/css' href='../css/style.css' />
<?php
echo "	
        <center>
			<div class='c' >
				<form method='post'>
                    <input type='hidden' name='flag-user' value='" . isset($_GET['Susername']) . "'/>
                    <div class='inputGroup'>  
                        <input id='newPass' name='newPass' type='password' required/>  
                        <label for='newPass'>New Password</label>  
                    </div>
                    <div class='inputGroup'>  
                        <input id='newPass2' name='newPass2' type='password' required/>  
                        <label for='newPass2'>Confirm new password</label>  
                    </div>
                    <div class='inputGroup'>  
                        <input id='read-username' name='username' value='" . $row['username'] . "' type='text' readnoly/>  
                        <label for='read-username'>Username</label>  
                    </div> 
                    <div>
                        <input type='submit' class='submit-btn' name='btn-change-pass-user' value='Change Password' />
                    </div>
				</form>
			</div>	
		</center>	";
?>