<?php include '../../configuration/globalVariable.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../../model/category.php';?>
<?php
    /*********************************************
     * @author Phong-Kaster
     * 
     * Step 1: declare local variable
     * Step 2: get id sent
     * Step 3: update with $id and $name
     *********************************************/

    /*Step 1 */
    $category = new Category();
    $id = "";
    $name = "";
    $status ="";



    /*Step 2*/
    if( isset($_GET['id']) || $_GET['id']) // if id is passed, set value for $id
    {
        $id = $_GET['id'];
    }
    else// if not, redirect to categoryAdd.php
    {
        echo "<script> window.location = 'categoryAll.php' </script>";
    }


    
    /*Step 3 */
    if(  isset($_POST['name']) )
    {
        $name = $_POST['name'];
        $status = $category->updateByID($id, $name);
    }
    else
    {
        $status = "Name can not be emptied !";
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock">
               <?php 
                    if( isset($status) )
                    {
                        echo $status;
                    }
                ?> 
                <?php 
                    $categoryEdit = $category->retrieveByID($id);
                    if( $categoryEdit )
                    {
                        while( $element = $categoryEdit->fetch_assoc() )
                        {
                ?>
                <!-- we have to let action empty, because PHP will return the remain URL which we are working -->
                <!-- in this situation, the URL is ../Electronic-Commerce-Website/categoryEdit.php?id=7 -->
                    <form action="categoryEdit.php?id=<?php echo $id ?>" method="POST">
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $element['name']; ?>" name="name" class="medium" />
                                </td>
                            </tr>
                            <tr> 
                                <td>
                                    <input class="btn btn-primary" type="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                    </form>
                  <?php
                        }
                    }
                  ?>
                </div>
                
            </div>
        </div>
<?php include 'inc/footer.php';?>