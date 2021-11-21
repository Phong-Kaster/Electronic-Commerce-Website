<?php include '../../configuration/globalVariable.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../../model/branch.php';
	$branch = new Branch();
	$id = "";

	if( isset($_GET['delete-branch-by-id']) )
	{
		$id = $_GET['delete-branch-by-id'];
		$status = $branch->deleteByID($id);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Branch List</h2>
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
							$listBranch = $branch->retrieveAllBranch();
							if( $listBranch )
							{
									$index = 0;
									while( $element = $listBranch->fetch_assoc())
									{ 
										$index++
										?>
							<tr class="odd gradeX">
								<td><?php echo $index; ?>  </td>
								<td><?php echo $element['name']; ?></td>
								<td>
									<a href="branchEdit.php?id=<?php echo $element['ID'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									&nbsp;&nbsp;&nbsp;
									<a href="?delete-branch-by-id=<?php echo $element['ID'] ?>" 
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

