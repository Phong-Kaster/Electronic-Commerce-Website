<?php
	include '../../configuration/globalVariable.php';
	include ( __DIR__ .  '/section/header.php' );
?>
<?
	$totalPrice = 0;
	if( isset($_POST['submit']) )
	{

	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
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
								$cart = $cartModel->retrieveDetailCart();
								if( $cart )
								{
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
											<input type="number" name="" value="<?php echo $element['quantity'] ?>"/>
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
									<td><a href="">X</a></td>
								</tr>
							<?php 
									}
								}
							?>
						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php echo number_format($subTotal) ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td><?php 
										$VAT = $subTotal * 0.1;
										echo number_format($VAT);
									?></td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php 
										$grandTotal = $subTotal + $VAT;
										echo number_format($grandTotal) ;
									?> </td>
							</tr>
					   </table>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="../public/images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="../public/images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php 
	include (__DIR__ . '/section/footer.php' ) ;
 ?>