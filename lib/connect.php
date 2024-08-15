<?php

class Sql {
	public $conn;
	function __construct() {
		$this->conn = mysqli_connect("localhost","root","", "university");
	}
	function runquery($query)
	{
	$result = mysqli_query($this->conn, $query);
	return $result;
	}
	function findquery($query)
	{
	$result = mysqli_query($this->conn, $query);
	if (mysqli_num_rows($result) == 0) {
		return true;
	} else {
		return false;
	}
	}
	function __destruct() {
		$this->conn->close();
	}
}

$sql = new Sql();

?>