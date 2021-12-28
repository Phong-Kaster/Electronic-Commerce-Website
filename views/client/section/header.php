<?php
 	include dirname( __DIR__, 3) . '/lib/session.php';
    Session::init();

	include_once dirname( __DIR__ , 3).'/lib/database.php';
    include_once dirname( __DIR__ , 3).'/helpers/format.php';
	include_once dirname( __DIR__, 3).'/configuration/globalVariable.php';
	/* Automatically including all php files in MODEL directory */
	spl_autoload_register(function($className){
		include_once dirname( __DIR__ , 3)."/model/" . strtolower( $className ). ".php";
	});

	$databaseModel = new Database();
	$formatModel = new Format();

	$cartModel = new Cart();
	$userModel = new User();

	$categoryModel = new Category();
	$productModel = new Product();

	$brandModel = new Branch();
	$customerModel = new Customer();

	$APP_URL = APP_URL
?>
<?php
  
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>E-Commerce Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="<?= ASSET_URL ?>/client/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="<?= ASSET_URL ?>/client/css/menu.css" rel="stylesheet" type="text/css" media="all"/>

<script src="<?= ASSET_URL ?>/client/js/jquerymain.js"></script>
<script src="<?= ASSET_URL ?>/client/js/script.js" type="text/javascript"></script>

<script type="text/javascript" src="<?= ASSET_URL ?>/client/js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="<?= ASSET_URL ?>/client/js/nav.js"></script>

<script type="text/javascript" src="<?= ASSET_URL ?>/client/js/move-top.js"></script>
<script type="text/javascript" src="<?= ASSET_URL ?>/client/js/easing.js"></script> 

<script type="text/javascript" src="<?= ASSET_URL ?>/client/js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>

</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.html"><img src="../public/images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
  								<?php 
								  	/***************************************************************************
									 *	check if any cart exists or not. If yes, show session named "accruedExpenses" 
									 ***************************************************************************/
									$accruedExpenses = Session::get("accruedExpenses");
									$cart = $cartModel->findCurrentCart();
									if( $cart )
									{
										echo number_format( $accruedExpenses );
									}
									else
									{
										echo " ";
									}
								?>
								</span>
							</a>
						</div>
			      </div>
			<?php 
				if( isset( $_GET['customerID']))
				{
					Session::destroy();
					header('Location:index.php');
				}
			?>
			
			<div class="login">					
			<?php 
				if( !Session::get("customerID") )
				{
					echo "<a href='views/client/login.php'>Login</a>";
					
				}
				else
				{
					$id = Session::get("customerID");
					echo "<a href='?customerID=$id'>Logout</a>";
				}
			?>
		   
		</div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="<?= APP_URL ?>index.php">Home</a></li>
	  <li><a href="<?= APP_URL ?>views/client/products.php">Products</a> </li>
	  <li><a href="<?= APP_URL ?>views/client/topbrands.php">Top Brands</a></li>
	  <li><a href="<?= APP_URL ?>views/client/cart.php">Cart</a></li>
	  <li><a href="<?= APP_URL ?>views/client/contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>