<?php
session_start();
if (isset($_SESSION['Role'])) {
	$role = $_SESSION['Role'];
	if ($role=="User") {
		
		header("location:index.php");
	}

}
else
{
	header("location:index.php");
}
?>