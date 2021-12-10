<?php
	include '../../configuration/globalVariable.php';
	include ( __DIR__ .  '/section/header.php' );
?>
<?php
	$totalPrice = 0;

	/******************************************
	 * update product quantity in a cart
	 * Step 1: declare variable
	 * Step 2: if quantity less than 1, it is deleted 
	 ******************************************/
	if( $_POST )
	{
		/*Step 1 */
		$cartID = $_POST['cartID'];
		$productID = $_POST['productID'];	
		$quantity = $_POST['quantity'];
		

		/*Step 2 */
		if( $quantity < 1 )
		{
			$cartModel->deleteProductInCart($cartID, $productID);
		}
		else
		{
			$editStatus = $cartModel->updateProductQuantity($cartID, $productID, $quantity);
			echo $editStatus;
		}
	}



	/******************************************
	 * delete a product from cart
	 ******************************************/
	if( isset($_GET['delete-product-by-id']) )
	{
		
		$productID = $_GET['delete-product-by-id'];
		$cartID = $_GET['in-cart'];
		
		$deleteStatus = $cartModel->deleteProductInCart($cartID, $productID);
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
					<?php 
						$cart = $cartModel->retrieveDetailCart();
						if( !$cart )
						{
					?>
						<h1>Nothing in your cart</h1>	
					<?php 
						}
						else
						{
					?>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>

							<?php
									$subTotal = 0;
									while( $element = $cart->fetch_assoc() )
									{
							?>
								<tr>
									<td><?php echo $element['ProductName']; ?></td>
									<td><img src="<?= ASSET_URL ?>/admin/upload/<?php echo $element['ProductImage'] ?>" alt=""/></td>
									<td><?php echo $element['ProductPrice']; ?></td>
									<td>
										<form action="" method="post">
											<input type="hidden" name="productID" value="<?php echo $element['ProductID']; ?>" />
											<input type="hidden" name="cartID" value="<?php echo $element['ID']; ?>" />
											<input type="number" name="quantity" value="<?php echo $element['quantity']; ?>"/>
											<input type="submit" name="submit" value="Update"/>
										</form>
									</td>
									<td>
										<?php 
											$totalPrice = (float)$element['ProductPrice'] * $element['quantity'];
											$subTotal += $totalPrice;
											echo number_format($totalPrice);
										?>
									</td>
									<td><a href="?delete-product-by-id=<?php echo $element['ProductID'] ?>&in-cart=<?php echo $element['ID'] ?>" 
									onclick = "return confirm('Are you sure to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
								</tr>
							<?php 
									}
								}
							?>
						</table>
						<?php 
							if( $cart)
							{
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th> Pre-Expenses : </th>
								<td><?php echo number_format($subTotal) ?></td>
							</tr>
							<tr>
								<th> Value Added Tax(VAT) 35% : </th>
								<td><?php 
										$VAT = $subTotal * 0.35;
										echo number_format($VAT);
									?></td>
							</tr>
							<tr>
								<th>Accrued Expenses :</th>
								<td><?php 
										$accruedExpenses = $subTotal + $VAT;
										Session::set("accruedExpenses", $accruedExpenses);
										echo number_format($accruedExpenses) ;
									?> </td>
							</tr>
					   </table>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="<?= APP_URL ?>index.php"> <img src="<?= ASSET_URL ?>/client/images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="<?= ASSET_URL ?>/client/images/check.png" alt="" /></a>
						</div>
					</div>
					<?php 
							}
					?>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php 
	include (__DIR__ . '/section/footer.php' ) ;
 ?>