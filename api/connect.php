<?php
	$connect = mysqli_connect('localhost','root','mintu12345','test') or die("Connection failed");
	if($connect){
	} else {
		echo "not connected";
	}
?>