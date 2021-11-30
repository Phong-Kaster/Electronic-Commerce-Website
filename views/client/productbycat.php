<?php
	include '../../configuration/globalVariable.php';
	include ( __DIR__ .  '/section/header.php' );
?>
<?php
	$APP_URL = APP_URL;
	if( $_GET['id'] )
	{
		$id = $_GET['id'];
		$productList = $productModel->retrieveProductByBrandID($id);
		$category = $categoryModel->retrieveByID($id);
	}
	else// if does have id , return index.php automatically
	{
		echo "<script> window.location = '$APP_URL/index.php' </script>";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
			<?php
				if( $category )
				{
					while( $element = $category->fetch_assoc())
					{
			?>
    					<h3>Latest from <?php echo $element['name']; ?> </h3>
			<?php 
					}
				}
			?>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  	<?php 
					if( $productList )
					{
						while( $element = $productList->fetch_assoc())
						{
			  	?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview-3.php"><img src="<?= ASSET_URL ?>/admin/upload/<?php echo $element['image']; ?>" alt="" /></a>
						<h2><?php echo $element['name']; ?> </h2>
						<p><?php echo $element['description']; ?></p>
						<p><span class="price">$ <?php echo $element['price'] ?></span></p>
						<div class="button"><span><a href="<?= APP_URL ?>views/client/preview.php?id=<?php echo $element['ID'] ?>" class="details">Details</a></span></div>
					</div>
				<?php 
						}
					}
				?>
			</div>

	
	
    </div>
 </div>

 <?php 
	include (__DIR__ . '/section/footer.php' ) ;
 ?>