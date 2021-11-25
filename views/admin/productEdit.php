<?php include '../../configuration/globalVariable.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../../model/category.php'; ?>
<?php include '../../model/branch.php'; ?>
<?php include '../../model/product.php'; ?>

<?php
    /********************************************************
     * $_POST gets all input and transfer to 'insert'
     * $_FILES work with 'image' field
     ********************************************************/
    if( isset($_GET['id']) )// if submit is sent, go ahead
    {
        $product = new Product();
        $id = $_GET['id'];
    }
    else
    {
        echo "<script> window.location = 'productAll.php' </script>";
    }

    if( $_POST )
    {
        $status = $product->updateByID($_POST,$_FILES, $id);
        echo $_POST['type'];
        echo "</br>";
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <?php
            if( isset($status))
            {
                echo $status;
            }
        ?>
        <h2>Add New Product</h2>
        <div class="block">
        <?php
                    $productEdit = $product->retrieveByID($id);
                    if( $productEdit )
                    {
                        while( $productElement = $productEdit->fetch_assoc())
                        {
        ?>             
         <form action="productEdit.php?id=<?php echo $productElement['ID']; ?>" method="post" enctype="multipart/form-data">
            <table class="form">
               
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $productElement['name'] ?>" placeholder="Enter Product Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="categoryID">
                                <option disabled> ----Select Category---- </option>
                                <?php 
                                    $category = new Category();
                                    $categoryList = $category->retrieveAllCategory();
                                    if( $categoryList )
                                    {
                                        while($element = $categoryList->fetch_assoc())
                                        {
                                            if( $productElement['categoryID'] == $element['id'])
                                            {
                                ?>
                                            <option selected value="<?php echo $element['id']; ?>"><?php echo $element['name']; ?></option>
                                <?php
                                            }
                                            else
                                            {
                                ?>
                                                <option value="<?php echo $element['id']; ?>"><?php echo $element['name']; ?></option>
                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brandID">
                            <option disabled> ----Select Brand---- </option>
                                <?php 
                                    $brand = new Branch();
                                    $brandList = $brand->retrieveAllBranch();
                                    if( $brandList )
                                    {
                                        while($element = $brandList->fetch_assoc())
                                        {
                                            if( $productElement['branchID'] == $element['id'])
                                            {
                                ?>
                                                <option selected value="<?php echo $element['ID']; ?>"><?php echo $element['name']; ?></option>
                                <?php 
                                            }
                                            else
                                            {
                                ?>
                                                <option selected value="<?php echo $element['ID']; ?>"><?php echo $element['name']; ?></option>
                                <?php            
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea name="description" class="tinymce"> <?php echo $productElement['description']; ?> </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input name="price" value="<?php echo $productElement['price']; ?>" type="text" class="medium" />
                        </td>
                    </tr>
                
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img width="50px;" src="<?= ASSET_URL ?>/admin/upload/<?php echo $productElement['image']; ?>" />
                                </br>
                            <input value="<?php echo $productElement['image']; ?>" type="file" name="image" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option disabled>Select Type</option>
                                <?php 
                                    if( $productElement['type'] == 1)
                                    {
                                ?>
                                        <option selected value="0">Featured</option>
                                        <option value="1">Non-Featured</option>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                        <option value="0">Featured</option>
                                        <option selected value="1">Non-Featured</option>
                                <?php
                                    }
                                ?>
                                
                            </select>
                        </td>
                    </tr>
                <?php
                        }
                    }
                ?>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="./admin/js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


