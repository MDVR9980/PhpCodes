<?php
echo "
	<div style='width: 13%;'>
		<form method='post''>
			<input id='i1' type='submit' class='submit-btn' name='btn-to-dashboard' value='Back to Dashboard' />
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
$result = $sql->runquery($query);
while ($row = mysqli_fetch_assoc($result)) {
	echo "
            <tr>
				<td>" . $row['id'] . "</td>
				<td>" . $row['name-user'] . "</td>
				<td>" . $row['family-user'] . "</td>
				<td>" . $row['type-user'] . "</td>
				<td>" . $row['username'] . "</td>
				<td>";
	if ($row['type'] == 'true') {
		echo "Active";
	} else {
		echo "Inactive";
	}
	echo "</td>" .
		"<form method='post'>
					<input type='hidden' name='username' value='" . $row['username'] . "'>
					<input type='hidden' name='typeU' value='" . $row['type'] . "'>
					<div class='inputGroup' > 
					<td><input type='submit' class='submit-btn' name='del-btn' data-username='" . $row['username'] . "' value='Delete' style='font-size: 16px; padding: 8px 18px; width: 100px; height: 50px;'/></td>
					</div> 
					<div class='inputGroup'> 
					<td><input type='submit' class='submit-btn' name='chng-type' value='Inactive / Active User' style='font-size: 16px; padding: 8px 18px; width: 190px; height: 50px;'/></td>
					</div> 
					<div class='inputGroup'> 
					<td><input type='submit' class='submit-btn' name='btn-updateuser' value='Update Information' style='font-size: 16px; padding: 8px 18px; width: 180px; height: 50px;'/></td>
					</div> 
					<div class='inputGroup'> 
					<td><input type='submit' class='submit-btn' name='btn-to-chng-pass2' value='Change Password' style='font-size: 16px; padding: 8px 18px; width: 160px; height: 50px;'/></td>
					</div> 
				</form>	"
		. "</tr>";
}
echo "</table>";
?>