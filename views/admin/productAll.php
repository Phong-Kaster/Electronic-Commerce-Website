<?php include '../../configuration/globalVariable.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../../model/product.php' ;?>
<?php 
	if ( isset($_GET['delete-product-by-id']) )
	{
		$product = new Product();
		$id = $_GET['delete-product-by-id'];
		$status = $product->deleteByID($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
		<?php 
			if( isset( $status ))
			{
				echo $status;
			}
		?>
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Image</th>

					<th>Brand</th>
					<th>Category</th>

					
					<th>Price</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$product = new Product();
					$productList = $product->retrieveAllProduct();
					if( $productList )
					{
						while( $element = $productList->fetch_assoc())
						{
				?>
					<tr class="odd gradeX">
						<td><?php echo $element['ID']; ?></td>
						<td><?php echo $element['name']; ?></td>
						<td><img width="50px;" src="<?= ASSET_URL ?>/admin/upload/<?php echo $element['image']; ?>" /> </td>

						<td><?php echo $element['branchName']; ?></td>
						<td><?php echo $element['categoryName']; ?></td>

						
						<td> <?php echo $element['price']; ?></td>
						<td>
						<?php 
							if( $element['type'] == 1)
								echo 'Featured';
							else
								echo 'Non-featured';
						?></td>

						<td>
						<a href="productEdit.php?id=<?php echo $element['ID'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
								&nbsp;&nbsp;&nbsp;
						<a href="?delete-product-by-id=<?php echo $element['ID'] ?>" 
						onclick = "return confirm('Are you sure to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
						</td>
					</tr>
				<?php
						}
					}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
