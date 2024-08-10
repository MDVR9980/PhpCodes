<?php
echo "
	<div style='width: 13%;'>
		<form method='post''>
			<input type='submit' name='btn-to-dashboard' value='Back to Dashboard' />
		</form>
	</div>
	";
echo "<table>
			<tr style=''>
				<td>Id</td>
				<td>Name</td>
				<td>Family</td>
				<td>Typeuser</td>
				<td>Username</td>
				<td>Type</td>
				<td colspan=4>Operation</td>
			</tr>";
		$query = "SELECT * FROM `student`"; 	
		$result = runquery($conn, $query);
		while($row = mysqli_fetch_assoc($result)){
			echo "
            <tr>
				<td>".$row['id']."</td>
				<td>".$row['name-user']."</td>
				<td>".$row['family-user']."</td>
				<td>".$row['type-user']."</td>
				<td>".$row['username']."</td>
				<td>";
				if($row['type']=='true'){echo "Active";}else {echo "Inactive";}
				echo "</td>". 
				"<form method='post'>
					<input type='hidden' name='username' value='".$row['username']."'>
					<input type='hidden' name='typeU' value='".$row['type']."'>
					<td><input type='submit' name='del-btn' value='Delete' /></td>
					<td><input type='submit' name='chng-type' value='Inactive / Active User' /></td>
					<td><input type='submit' name='btn-updateuser' value='Update Information' /></td>
					<td><input type='submit' name='btn-to-chng-pass2' value='Change Password' /></td>
				</form>	"												
			."</tr>";
		}	
		echo "</table>";
?>