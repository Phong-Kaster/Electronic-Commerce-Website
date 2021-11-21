<?php include '../../configuration/globalVariable.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../../model/category.php';?>
<?php
    $category = new Category();
    $name = "";

    if( isset($_POST['name']) )
    {
        $name = $_POST['name'];
        $status = $category->insert($name);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock">
               <?php 
                    if( isset($status) )
                    {
                        echo $status;
                    }
                ?>  
                 <form action="categoryAdd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input class="btn btn-primary" type="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                
            </div>
        </div>
<?php include 'inc/footer.php';?>