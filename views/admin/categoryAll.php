<?php include '../../configuration/globalVariable.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../../model/category.php';
	$category = new Category();
	$id = "";

	if( isset($_GET['delete-category-by-id']) )
	{
		$id = $_GET['delete-category-by-id'];
		$status = $category->deleteByID($id);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">
					<?php 
						if( isset($status))
						{
							echo $status;
						}
					?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$listCategory = $category->retrieveAllCategory();
							if( $listCategory )
							{
									$index = 0;
									while( $element = $listCategory->fetch_assoc())
									{ 
										$index++
										?>
							<tr class="odd gradeX">
								<td><?php echo $index; ?>  </td>
								<td><?php echo $element['name']; ?></td>
								<td>
									<a href="categoryEdit.php?id=<?php echo $element['id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									&nbsp;&nbsp;&nbsp;
									<a href="?delete-category-by-id=<?php echo $element['id'] ?>" 
									onclick = "return confirm('Are you sure to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
								</td>
							</tr>
						<?php
									}
							}?>
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

