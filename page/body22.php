<link rel='stylesheet' type='text/css' href='../css/style.css' />
<?php
echo "	
        <center>
			<div class='c' >
				<form method='post'>
                    <div class='inputGroup'>  
                        <input id='nameuser' name='nameuser' type='text' value='" . $row['name-user'] . "' />  
                        <label for='nameuser'>Name</label>  
                    </div>
                    <div class='inputGroup'>  
                        <input id='familyuser' name='familyuser' value='" . $row['family-user'] . "' />  
                        <label for='familyuser'>Family</label>  
                    </div> 
                    <div class='inputGroup'>  
                        <input id='username' name='username' value='" . $row['username'] . "' type='text' readnoly />  
                        <label for='username'>Username</label>  
                    </div> 
                    <div>
                        <input type='submit' class='submit-btn' name='btn-Update-user' value='Update user' />
                    </div>
				</form>
			</div>	
		</center>	";
?>