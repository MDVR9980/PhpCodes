<link rel='stylesheet' type='text/css' href='../css/style.css'/>
<?php
echo "	
        <center>
			<div class='c' >
				<form method='post'>
                    <div class='cc'>
                        <input class='ccc' name='newPass' placeholder='enter new password' type='password' /><br />
                    </div>
                    <div class='cc'>
                        <input class='ccc' name='newPass2' placeholder='confirm your new password' type='password' /><br />
                    </div>
                    <div class='cc'>
                        <input class='ccc' name='username' type='text' value='".$row['username']."' readonly/><br />
                    </div>
                    <div class='cc'>
                        <input type='submit' name='btn-change-pass-user' value='Change Password' />
                    </div>
				</form>
			</div>	
		</center>	";
?>