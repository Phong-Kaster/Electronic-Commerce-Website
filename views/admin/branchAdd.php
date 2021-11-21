<?php include '../../configuration/globalVariable.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../../model/branch.php';?>
<?php
    $branch = new Branch();
    $name = "";

    if( isset($_POST['name']) )
    {
        $name = $_POST['name'];
        $status = $branch->insert($name);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Branch</h2>
               <div class="block copyblock">
               <?php 
                    if( isset($status) )
                    {
                        echo $status;
                    }
                ?>  
                 <form action="branchAdd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" placeholder="Enter Branch Name..." class="medium" />
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