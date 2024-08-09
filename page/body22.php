<link rel='stylesheet' type='text/css' href='../css/style.css'/>
<?php
echo "	
        <center>
			<div class='c' >
				<form method='post'>
                    <div class='cc'>
                        <input class='ccc' name='nameuser' placeholder='enter a name' type='text' value='".$row['name-user']."' /><br />
                    </div>
                    <div class='cc'>
                        <input class='ccc' name='familyuser' placeholder='enter a famil' type='text' value='".$row['family-user']."' /><br />
                    </div>
                    <div class='cc'>
                        <input class='ccc' name='username' placeholder='enter a Username' type='text' value='".$row['username']." ' disabled/><br />
                    </div>
                    <div class='cc'>
                        <input type='submit' name='btn-updateuser' value='Update user' />
                    </div>
				</form>
			</div>	
		</center>	";
?>