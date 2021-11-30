<?php
   include '../../configuration/globalVariable.php';
   include ( __DIR__ .  '/section/header.php' );
   ?>
<?php 
   $APP_URL = APP_URL;
   if( $_GET['id'] )
   {
   	$id = $_GET['id'];
   	$product = $productModel->retrieveDetailProductByID($id);
   }
   else// if does have id , return index.php automatically
   {
   	echo "<script> window.location = '$APP_URL/index.php' </script>";
   }
   ?>
<div class="main">
<div class="content">
   <div class="section group">
	   <?php 
			if( $product )
			{
				while( $element = $product->fetch_assoc())
				{
	   ?>
      <div class="cont-desc span_1_of_2">
			<div class="grid images_3_of_2">
				<img height="50px;" src="<?= ASSET_URL ?>/admin/upload/<?php echo $element['image']; ?>" alt="" />
			</div>
			<div class="desc span_3_of_2">
				<h2><?php echo $element['name'] ?> </h2>
				<p><?php $formatModel->textShorten( $element['description'],50 ); ?></p>
				<div class="price">
				<p>Price: <span>$ <?php echo $element['price']; ?></span></p>
				<p>Category: <span> <?php echo $element['categoryName']; ?> </span></p>
				<p>Brand:<span><?php echo $element['branchName']; ?></span></p>
				</div>
				<div class="add-cart">
				<form action="cart.php" method="post">
					<input type="number" class="buyfield" name="" value="1"/>
					<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
				</form>
				</div>
			</div>
			<div class="product-desc">
				<h2>Product Details</h2>
				<p><?php echo $element['description']; ?></p>
				
			</div>
      </div>
	 <?php 
				}
			}
	 ?>

      <div class="rightsidebar span_3_of_1">
         <h2>CATEGORIES</h2>
         <ul>
			 <?php 
				$categoryList = $categoryModel->retrieveAllCategory();
				while( $element = $categoryList->fetch_assoc())
				{
			 ?>
            		<li><a href="<?= APP_URL ?>views/client/productbycat.php?id=<?php echo $element['id']; ?>"><?php echo $element['name']; ?></a></li>
            <?php
				}
			?>
         </ul>
      </div>


   </div>
</div>
<?php 
   include (__DIR__ . '/section/footer.php' ) ;
   ?>