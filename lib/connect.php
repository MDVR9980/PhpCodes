<?php
    $conn = mysqli_connect("localhost", "root", "", "University");
    function runquery($conn, $query){
        $result = mysqli_query($conn, $query);
		return $result;
    }
    function findquery($conn,$query){
		$result = mysqli_query($conn,$query);
		if (mysqli_num_rows($result)==0){

			return true;
		}else {
			return false;
		}
	}
?>