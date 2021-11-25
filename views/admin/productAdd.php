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
    if( isset($_POST['submit']) )// if submit is sent, go ahead
    {
        $product = new Product();
        $status = $product->insert($_POST, $_FILES);
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
         <form action="productAdd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="categoryID">
                            <option> ----Select Category---- </option>
                            <?php 
                                $category = new Category();
                                $categoryList = $category->retrieveAllCategory();
                                if( $categoryList )
                                {
                                    while($element = $categoryList->fetch_assoc())
                                    {
                            ?>
                                        <option value="<?php echo $element['id']; ?>"><?php echo $element['name']; ?></option>
                            <?php
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
                        <option> ----Select Brand---- </option>
                            <?php 
                                $brand = new Branch();
                                $brandList = $brand->retrieveAllBranch();
                                if( $brandList )
                                {
                                    while($element = $brandList->fetch_assoc())
                                    {
                            ?>
                                    <option value="<?php echo $element['ID']; ?>"><?php echo $element['name']; ?></option>
                            <?php 
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
                        <textarea name="description" class="tinymce"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input name="price" type="text" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <option value="0">Featured</option>
                            <option value="1">Non-Featured</option>
                        </select>
                    </td>
                </tr>

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


