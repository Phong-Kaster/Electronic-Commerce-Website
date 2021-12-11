<?php 
	include_once ( __DIR__ .  '/header.php' );
?>
<div class="header_bottom">
		<div class="header_bottom_left">
			
			<div class="section group">
			<?php
				$latestProduct = $productModel->retrieveLatestProducts();
				
				if( $latestProduct )
				{
					$index = 0;
					while( $element = $latestProduct->fetch_assoc() )
					{
						$index++;
						if( $index == 1 || $index == 2)
						{
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="<?= APP_URL ?>views/client/preview.php?id=<?php echo $element['ID'] ?>"> <img src="<?= ASSET_URL ?>/admin/upload/<?php echo $element['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $element['name']; ?></h2>
						<p><?php echo $element['description']; ?></p>
						<div class="button"><span><a href="<?= APP_URL ?>views/client/preview.php?id=<?php echo $element['ID'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php 
						}
					}
				}
			?>		
			</div>
			
			<div class="section group">
			<?php
				$latestProduct = $productModel->retrieveLatestProducts();
				
				if( $latestProduct )
				{
					$index = 0;
					while( $element = $latestProduct->fetch_assoc() )
					{
						$index++;
						if( $index == 3 || $index == 4)
						{
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="<?= APP_URL ?>views/client/preview.php?id=<?php echo $element['ID'] ?>"> <img src="<?= ASSET_URL ?>/admin/upload/<?php echo $element['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $element['name']; ?></h2>
						<p><?php echo $element['description']; ?></p>
						<div class="button"><span><a href="<?= APP_URL ?>views/client/preview.php?id=<?php echo $element['ID'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php 
						}
					}
				}
			?>		
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
				<!-- FlexSlider -->
				<section class="slider">
					<div class="flexslider">
						<ul class="slides">
							<li><img src="<?= ASSET_URL ?>/client/images/flag6.png" alt=""/></li>
							<li><img src="<?= ASSET_URL ?>/client/images/flag7.jpg" alt=""/></li>
							<li><img src="<?= ASSET_URL ?>/client/images/flag8.svg.png" alt=""/></li>
							<li><img src="<?= ASSET_URL ?>/client/images/flag5.jpg" alt=""/></li>
						</ul>
					</div>
				</section>
				<!-- FlexSlider -->
			</div>
	  <div class="clear"></div>
  </div>	