<?php
echo "<table>
			<tr style=''>
				<td>Id</td>
				<td>Name</td>
				<td>Family</td>
				<td>Typeuser</td>
				<td>Username</td>
				<td>Type</td>
			</tr>";
		$query = "SELECT * FROM `student` where `type`='true'"; 	
		$result = runquery($conn,$query);
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
				echo "</td>
																
			</tr>";
		}	
		echo "</table>";
?>