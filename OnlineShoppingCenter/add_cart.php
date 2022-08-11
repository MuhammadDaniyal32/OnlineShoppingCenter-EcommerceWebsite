<?php
	session_start();

if (isset($_SESSION['Username'])) {

	//check if product is already in the cart

	if(!in_array($_GET['id'], $_SESSION['cart'])){
		array_push($_SESSION['cart'], $_GET['id']);
		$_SESSION['message'] = 'Product added to cart';
	}
	else{
		$_SESSION['message'] = 'Product already in cart';
	}

	header('location: index.php');
	}
	else
	{
		$_SESSION['message'] = 'Please Login First!';
		header('location: index.php');
	}
?>