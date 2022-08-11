<?php
    require_once "config.php";
	session_start();
	//user needs to login to checkout
	if(isset($_SESSION['Userid'])){
        if(empty($_SESSION['cart'])){
            $_SESSION['message'] = 'Please Add Products To Cart Before Checkout';
            header('location: index.php');
        }
        $userid = $_SESSION['Userid'];
        if(isset($_POST['Checkout'])){
            $uname=$_POST['username'];
            $email=$_POST['email'];
            $address=$_POST['address'];
            $country=$_POST['country'];
            $city=$_POST['city'];
            $zip=$_POST['zip'];
            $paymentMethod=$_POST['paymentMethod'];
            $ccnumber=$_POST['cc-number'];
            $ccname=$_POST['cc-name'];
            $ccexpiration=$_POST['cc-expiration'];
            $cccvv=$_POST['cc-cvv'];
            $index=0;

            $sql = "SELECT * FROM products_tbl WHERE pro_id IN (".implode(',',$_SESSION['cart']).")";
					$query = $con->query($sql);
						while($row = $query->fetch_assoc()){
                            $productid=$row['pro_id'];
                            $productname=$row['pro_name'];
                            $productqty=$_SESSION['qty_array'][$index];
                            $productprice=$row['pro_price'];
                            $productstock=$row['pro_stock'];
                            $total= $productprice*$productqty;
                            $insertorder_query="INSERT INTO `orders_tbl`(`order_userid`, `order_username`, `order_address`, `order_country`, `order_city`, `order_zip`, `order_paymentmethod`, `order_ccnum`, `order_ccname`, `order_ccexpdate`, `order_cccv`, `order_product`, `order_qty`, `order_price`, `order_total`, `order_product_id`) VALUES ('$userid','$uname','$address','$country','$city','$zip','$paymentMethod','$ccnumber','$ccname','$ccexpiration','$cccvv','$productname','$productqty','$productprice','$total','$productid')";
                            $RUN=mysqli_query($con,$insertorder_query);
    
                            if($RUN)
                            {
                                $productcurrentstock=$productstock-$productqty;
                                $updatestock_query="UPDATE `products_tbl` SET `pro_stock`='$productcurrentstock' WHERE pro_id=$productid";
                                $RUN2=mysqli_query($con,$updatestock_query);
                                if($RUN2)
                                {
                                    $_SESSION['message'] = 'Your Order Is Confirmed';
                                     unset($_SESSION['qty_array'][$index]);
                                     unset($_SESSION['cart'][$index]);
                                    header('location: index.php');
                                }
                            }
                            else{
                                $_SESSION['message'] = 'Your Order Is Not Confirmed!!!';
                                header('location: index.php');
                            }
                            $index++;
                        }
            
        }
    }
	else{
		$_SESSION['message'] = 'You need to login to checkout';
		header('location: index.php');
	}

	$role="";

	if (isset($_SESSION['Role'])) {
		
		$role=$_SESSION['Role'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ONLINE SHOPPING CENTER - CHECKOUT</title>
	<link href="css/bootstrap_admin.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/font-awesome.min.css" />
</head>
<body>
<div class="loader"></div>
		<main id="main" role="main">
        <section id="checkout-container">
            <div class="container">
                <div class="py-5 text-center">
                    <i class="fa fa-credit-card fa-3x text-primary"></i>
                    <h2 class="my-3">CheckOut</h2>
                    <p class="lead">Please Provide Your Necessary Information To Complete Your Order.</p>
                </div>
				
                <div class="row py-5">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Your cart</span>
                            <span class="badge badge-secondary badge-pill"><?php echo count($_SESSION['cart']); ?></span>
                        </h4>
						<?php
                            $index=0;
                            $total=0;
							$sql = "SELECT * FROM products_tbl WHERE pro_id IN (".implode(',',$_SESSION['cart']).")";
							$query = $con->query($sql);
								while($row = $query->fetch_assoc()){
						?>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?php echo $row['pro_name']; ?></h6>
                                    <small class="text-muted"><?php echo $row['pro_descrip']; ?></small>
                                </div>
								<span class="text-muted"> x<?php echo $_SESSION['qty_array'][$index] ?></span>
                                <span class="text-muted">&nbsp;<?php echo number_format($row['pro_price']*$_SESSION['qty_array'][$index]); ?></span>
                                <?php $total += $_SESSION['qty_array'][$index]*$row['pro_price']; ?>
                            </li>
							<?php $index++; };?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (Rs)</span>
                                <strong><?php echo number_format($total); ?></strong>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Billing Details</h4>
                        <form action="checkout.php" method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input type="text" class="form-control" id="username" name="username" value=<?php echo $_SESSION['Username'];?> required>
                                    <div class="invalid-feedback" style="width: 100%;">
                                        Your username is required.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email">Email
                                    <span class="text-muted">(Optional)</span>
                                </label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['Email'];?>">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Country</label>
                                    <select class="custom-select d-block w-100" id="country" name="country" required>
                                        <option value="">Choose Your Country</option>
                                        <option>Pakistan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid country.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="city">City</label>
                                    <select class="custom-select d-block w-100" id="city" name="city" required>
                                        <option>Choose Your City</option>
                                        <option>Karachi</option>
                                        <option>Multan</option>
                                        <option>Hydrabad</option>
                                        <option>Lahore</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid city.
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip</label>
                                    <input type="number" min=0 class="form-control" id="zip" name="zip" required>
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div>
                            </div>
                            <!-- <hr class="mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="same-address">
                                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="save-info">
                                <label class="custom-control-label" for="save-info">Save this information for next time</label>
                            </div> -->
                            <hr class="mb-4">

                            <h4 class="mb-3">Payment</h4>

                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="paymentMethod" value="Credit card" type="radio" class="custom-control-input" checked required>
                                    <label class="custom-control-label" for="credit">Credit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="debit" name="paymentMethod" value="Debit card" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="debit">Debit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="paymentMethod" value="Paypal" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cc-name">Name on card</label>
                                    <input type="text" class="form-control" id="cc-name" name="cc-name" required>
                                    <small class="text-muted">Full name as displayed on card</small>
                                    <div class="invalid-feedback">
                                        Name on card is required
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cc-number">Credit card number</label>
                                    <input type="number" min=0 class="form-control" id="cc-number" name="cc-number" required>
                                    <div class="invalid-feedback">
                                        Credit card number is required
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" required>
                                    <div class="invalid-feedback">
                                        Expiration date required
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cc-cvv">CVV</label>
                                    <input type="number" min=0 class="form-control" id="cc-cvv" name="cc-cvv" required>
                                    <div class="invalid-feedback">
                                        Security code required
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">

                            <div class="col-md-6">
                            <a href="view_cart.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
                            <button class="btn btn-success btn-lg " name="Checkout" type="submit">Confirm Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </section>
    </main>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="popper/popper.min.js" integrity=""></script>
<script src="js/bootstrap_admin.min.js"></script>
<script src="js/main.min.js"></script>
</body>
</html>