<?php
	require_once "config.php";
	session_start();
	$role="";
		if (isset($_SESSION['Role'])) {
			
			$role=$_SESSION['Role'];
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ONLINE SHOPPING CENTER - CART</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
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
            <li <?php if($role=="Admin"){echo 'style="display: block;"';} else{echo 'style="display: none;"';} ?>>
            	<a href="dashboard.php"><b>Admin</b></a>
            </li>
            <li <?php if(isset($_SESSION['Username'])){echo 'style="display: none;"';} else{echo 'style="display: block;"';} ?>>
            	<a href="#" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-user"></span>Login</a>
            <?php include'Login.php' ?>
            </li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	      	<li class="active">
            <a href="view_cart.php">
            <span class="badge">
			<?php echo count($_SESSION['cart']); ?>
            </span> Cart <span class="glyphicon glyphicon-shopping-cart"></span>
            </a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<h1 class="page-header text-center">Cart Details</h1>
			<?php 
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
			//echo $_SESSION['cart'][0];
			?>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<form method="POST" action="save_cart.php">
			<table class="table table-bordered table-striped">
				<thead>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					<th></th>
				</thead>
				<tbody>
					<?php
						//initialize total
						$total = 0;
						if(!empty($_SESSION['cart'])){
						//connection
						//create array of initail qty which is 1
 						$index = 0;
 						if(!isset($_SESSION['qty_array'])){
 							$_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
 						}
						$sql = "SELECT * FROM products_tbl WHERE pro_id IN (".implode(',',$_SESSION['cart']).")";
						$query = $con->query($sql);
							while($row = $query->fetch_assoc()){
								?>
								<tr>
									<td><?php echo $row['pro_name']; ?></td>
									<td><?php echo number_format($row['pro_price']); ?></td>
									<input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
									<td><input type="number" max="<?php echo $row['pro_stock']; ?>" min="0"  value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_<?php echo $index; ?>"></td>
									<td><?php echo number_format($_SESSION['qty_array'][$index]*$row['pro_price']); ?></td>
									<?php $total += $_SESSION['qty_array'][$index]*$row['pro_price']; ?>
									<td>
										<a href="delete_item.php?id=<?php echo $row['pro_id']; ?>&index=<?php echo $index; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
									</td>
								</tr>
								<?php
								$index ++;
							}
						}
						else{
							?>
							<tr>
								<td colspan="4" class="text-center">No Item in Cart</td>
							</tr>
							<?php
						}

					?>
					<tr>
						<td colspan="3" align="right" ><b>Total</b></td>
						<td><b>Rs <?php echo number_format($total); ?></b></td>
					</tr>
				</tbody>
			</table>
			<br/>
			<div class="col-sm-offset-3">
				<a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
				<button href="checkout.php" type="submit" class="btn btn-success <?php if(empty($_SESSION['cart'])){echo "disabled";}?>" name="save">Save Changes</button>
				<a href="clear_cart.php" class="btn btn-danger <?php if(empty($_SESSION['cart'])){echo "disabled";}?>"><span class="glyphicon glyphicon-trash"></span> Clear Cart</a>
				<a href="checkout.php" class="btn btn-success <?php if(empty($_SESSION['cart'])){echo "disabled";}?>" ><span class="glyphicon glyphicon-check"></span> Checkout</a>
			</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>