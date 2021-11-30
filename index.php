<!-- HEADER & SLIDER SECTION -->
<?php 
	include 'configuration/globalVariable.php';
	include 'views/client/section/header.php';
	include 'views/client/section/slider.php';
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		
	      <div class="section group">
		  	<?php
				$productList = $productModel->retrieveFeaturedProducts();
				if( $productList)
				{
					while( $element = $productList->fetch_assoc() )
					{
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?id=<?php echo $element['ID'] ?>"><img width="100px" src="<?= ASSET_URL ?>/admin/upload/<?php echo $element['image']; ?>" alt="" /></a>
					 <h2><?php echo $element['name']; ?> </h2>
					 <p><?php echo $formatModel->textShorten( $element['description'],50 );  ?></p>
					 <p><span class="price">$ <?php echo $element['price']; ?></span></p>
				     <div class="button"><span><a href="<?= APP_URL ?>views/client/preview.php?id=<?php echo $element['ID'] ?>" class="details">Details</a></span></div>
				</div>
			<?php
					}
				}
			?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
					$productList = $productModel->retrieveNewProducts();
					if( $productList)
					{
						while( $element = $productList->fetch_assoc() )
						{
				?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview.html?id=<?php echo $element['ID'] ?>"><img width="100px;" src="<?= ASSET_URL ?>/admin/upload/<?php echo $element['image']; ?>" alt="" /></a>
						<h2><?php echo $element['name'] ?></h2>
						<p><span class="price">$ <?php echo $element['price']; ?></span></p>
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
	include './views/client/section/footer.php';
?>