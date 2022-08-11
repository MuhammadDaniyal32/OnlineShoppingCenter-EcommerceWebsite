<?php
	require_once "config.php";
		session_start();
		//initialize cart if not set or is unset
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
		}

		//unset qunatity
		unset($_SESSION['qty_array']);

		$role="";

		if (isset($_SESSION['Role'])) {
			
			$role=$_SESSION['Role'];
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ONLINE SHOPPING CENTER - PRODUCTS</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container">
	<nav class="navbar navbar-default" style="background-color:#000;">
	  <div class="container-fluid">
	    <div class="navbar-header">
	 
	      <a class="navbar-brand" href="index.php">Online Shopping Centre</a>
	    </div>

	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      	<!-- left nav here -->
            <li><a  href="index.php">Products</a></li>
	      </ul>
		<ul class="nav navbar-nav pull-right" <?php if(isset($_SESSION['Username'])){echo 'style="display: block;"';} else{echo 'style="display: none;"';} ?>>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Welcome,<?php echo $_SESSION['Username'];?></b><b class="caret"></b></a>
				<ul class="dropdown-menu">
					
					<li><a href="Logout.php"><i class="icon-off"></i> Logout</a></li>
				</ul>
			</li>
		</ul>

	      <ul class="nav navbar-nav navbar-right">
			<li>
				<a href="view_cart.php"><span class="badge">
				<?php echo count($_SESSION['cart']); ?></span><span class="glyphicon glyphicon-shopping-cart"></span>
                </a>
            </li>
            <li <?php if($role=="Admin"){echo 'style="display: block;"';} else{echo 'style="display: none;"';} ?>>
            	<a href="dashboard.php"><b>Admin</b></a>
            </li>
            <li <?php if(isset($_SESSION['Username'])){echo 'style="display: none;"';} else{echo 'style="display: block;"';} ?>>
            	<a href="#" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-user"></span>Login</a>
            <?php include'Login.php' ?>
            </li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<?php
		//info message
		if(isset($_SESSION['message'])){
			?>
			<div class="row">
				<div class="col-sm-3 col-lg-3 col-lg-offset-4 col-lg-offset-4">
					<div class="alert alert-info text-center">
						<?php echo $_SESSION['message']; ?>
					</div>
				</div>
			</div>
			<?php
			unset($_SESSION['message']);
		}
		$sql = "SELECT * FROM products_tbl";
		$query = mysqli_query($con,$sql);
		while($row =mysqli_fetch_assoc($query)){
			
			?>
			<div class="col-sm-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row product_image">
							<img src="<?php echo $row['pro_img'] ?>" class="img-responsive" width="80%" height="80%">
						</div>
						<div class="row product_name">
							<h4><?php echo $row['pro_name']; ?></h4>
							<p><?php echo $row['pro_descrip']; ?></p>
						</div>
						<br/>
						<div class="row product_footer">
							<p class="pull-left"><b>Rs <?php echo number_format($row['pro_price']); ?></b></p>
							<span class="pull-right" <?php if($row['pro_stock']==0){echo "hidden";} ?>><a href="add_cart.php?id=<?php echo $row['pro_id']; ?>" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-shopping-cart">
                            </span> Cart</a></span>

							<span class="pull-right" <?php if($row['pro_stock']>0){echo "hidden";} ?>><a href="#" class="btn btn-danger btn-sm disabled"> Product Out Of Stock</a></span>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	
		
		//end product row 
	?>
</div>
</body>
</html>