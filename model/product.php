<?php 
    include_once dirname( __FILE__ , 2).'/lib/database.php';
    include_once dirname( __FILE__ , 2).'/helpers/format.php';
    include_once dirname( __FILE__ , 2).'/configuration/globalVariable.php';

    class Product
    {
        private $database;
        private $format;



        public function __construct()
        {
            $this->database = new Database();
            $this->format = new Format();
        }
       
        public function retrieveProductByBrandID($id)
        {
            $query = "SELECT Product.* , 
                            Category.name as categoryName
            FROM Product 
            INNER JOIN Category ON Product.categoryID = Category.id
            WHERE Product.categoryID = $id";
            $result = $this->database->select($query);
            return $result;
        }

        public function retrieveDetailProductByID($id)
        {
            $query = "SELECT Product.* , 
                            Category.name as categoryName,
                            Branch.name as branchName
            FROM Product 
            INNER JOIN Category ON Product.categoryID = Category.id
            INNER JOIN Branch ON Product.brandID = Branch.ID
            WHERE Product.ID = $id";
            $result = $this->database->select($query);
            return $result;
        }



        /*********************************************
         * @author Phong-Kaster
         * get a specific category by $ID
         *********************************************/
        public function retrieveByID($id)
        {
            $query = "SELECT * FROM Product WHERE ID = '$id' ";
            $result = $this->database->select($query);
            return $result;
        }


        /*********************************************
         * @author Phong-Kaster
         * retrieve every single category in table Category
         *********************************************/
        public function retrieveAllProduct()
        {
            $query = "SELECT Product.* , 
                            Category.name as categoryName,
                            Branch.name as branchName
            FROM Product 
            INNER JOIN Category ON Product.categoryID = Category.id
            INNER JOIN Branch ON Product.brandID = Branch.ID
            ORDER BY Product.ID DESC";
            $result = $this->database->select($query);
            return $result;
        }



        /*********************************************
         * @author Phong-Kaster
         * retrieve every single category in table Category
         *********************************************/
        public function retrieveFeaturedProducts()
        {
            $query = "SELECT Product.* , 
                            Category.name as categoryName,
                            Branch.name as branchName
            FROM Product 
            INNER JOIN Category ON Product.categoryID = Category.id
            INNER JOIN Branch ON Product.brandID = Branch.ID
            WHERE Product.type = '0'
            ORDER BY Product.ID DESC
            LIMIT 4";
            $result = $this->database->select($query);
            return $result;
        }



        /*********************************************
         * @author Phong-Kaster
         * retrieve every single category in table Category
         *********************************************/
        public function retrieveNewProducts()
        {
            $query = "SELECT Product.* , 
                            Category.name as categoryName,
                            Branch.name as branchName
            FROM Product 
            INNER JOIN Category ON Product.categoryID = Category.id
            INNER JOIN Branch ON Product.brandID = Branch.ID
            ORDER BY Product.ID DESC
            LIMIT 4";
            $result = $this->database->select($query);
            return $result;
        }

        /*********************************************
         * @author Phong-Kaster
         * Step 1: escapes special characters, if any
         * Step 2: handle upload image
         * Step 3: execute query
         *********************************************/
        public function insert($data, $files)
        {
            /*Step 1 */
            $name = mysqli_real_escape_string($this->database->link, $data['name']);
            $categoryID = mysqli_real_escape_string($this->database->link, $data['categoryID']);

            $brandID = mysqli_real_escape_string($this->database->link, $data['brandID']);
            $description = mysqli_real_escape_string($this->database->link, $data['description']);

            $price = mysqli_real_escape_string($this->database->link, $data['price']);
            $type = mysqli_real_escape_string($this->database->link, $data['type']);



            /*Step 2*/
            $permitted = array('jpg', 'jpeg', 'png', 'gif');
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];
            $fileTemp = $_FILES['image']['tmp_name'];

            $div = explode('.', $fileName);// get raw file's extension
            $fileExtension = strtolower( end($div) );// convert file's extension to lower case 
            $uniqueImage = substr(md5(time()), 0, 10).'-'.$fileName;// create a unique name for uploaded file
            // create path to store the file
            $uploadImage = $_SERVER['DOCUMENT_ROOT']."/Electronic-Commerce-Website/public/admin/upload/" . $uniqueImage;

                

            /*Step 3*/
            if( empty($name) || empty($categoryID) || empty($brandID) || empty($description) || empty($price) )
            {
                $message = "<span class='error'>Every field can't be empty !</span>";
                return $message;
            }
            else
            {
                $query = "INSERT INTO Product(name, brandID, categoryID, description, price, image, type) 
                VALUES('$name', '$brandID', '$categoryID', '$description', '$price', '$uniqueImage', '$type')";


                $result = $this->database->insert($query);
                if( $result)
                {
                    move_uploaded_file($fileTemp, $uploadImage);
                    $message = "<span class='success'>Action Successfully !</span>";
                    return $message;
                }
                else
                {
                    $message = "<span class='error'>Action Unsuccessfully !</span>";
                    return $message;
                }
            }
        }



        


        
        /*********************************************
         * @author Phong-Kaster
         * Step 1: handle raw data
         * Step 2: handle for uploading image | photo. Only accept for jpg - jpeg - png - gif
         * Step 3: check input data
         * Step 4: execute query
         *********************************************/
        public function updateByID($data, $files, $id)
        {
            $message = "";


            /*Step 1 */
            $name = mysqli_real_escape_string($this->database->link, $data['name']);
            $categoryID = mysqli_real_escape_string($this->database->link, $data['categoryID']);

            $brandID = mysqli_real_escape_string($this->database->link, $data['brandID']);
            $description = mysqli_real_escape_string($this->database->link, $data['description']);

            $price = mysqli_real_escape_string($this->database->link, $data['price']);
            $type = mysqli_real_escape_string($this->database->link, $data['type']);
            


            /*Step 2*/
            $permitted = array('jpg', 'jpeg', 'png', 'gif');
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];
            $fileTemp = $_FILES['image']['tmp_name'];

            $div = explode('.', $fileName);// get raw file's extension
            $fileExtension = strtolower( end($div) );// convert file's extension to lower case 
            $uniqueImage = substr(md5(time()), 0, 10).'-'.$fileName;// create a unique name for uploaded file
            // create path to store the file
            $uploadImage = $_SERVER['DOCUMENT_ROOT']."/Electronic-Commerce-Website/public/admin/upload/" . $uniqueImage;



            /*Step 3*/
            if( empty($name) || empty($categoryID) || empty($brandID) || empty($description) 
            || empty($price) )
            {
                $message = "<span class='error'>Every field can't be empty !</span>";
                return $message;
            }


            if( !empty($fileName) )
            {
                if( $fileSize > 200000 )
                {
                    $message = "<span class='error'>Image size can not greater than 20 MB !</span>";
                    return $message;
                }

                if( in_array($fileExtension, $permitted ) == false)
                {
                    $message = "<span class='error'>Only accept jpg - jpeg - png - gif !</span>";
                    return $message;
                }

                $query = "UPDATE Product 
                SET name = '$name',
                    brandID = '$brandID',
                    categoryID = '$categoryID',
                    description = '$description',
                    price = '$price',
                    image = '$uniqueImage',
                    type = '$type'
                WHERE ID = '$id' ";
            }            
            else// remove only image = '$uniqueImage'
            {
                $query = "UPDATE Product 
                SET name = '$name',
                    brandID = '$brandID',
                    categoryID = '$categoryID',
                    description = '$description',
                    price = '$price',
                    type = '$type'
                WHERE ID = '$id' ";
            }

            
            $result = $this->database->update($query);
            if( $result )
            {
                move_uploaded_file($fileTemp, $uploadImage);
                $message = "<span class='success'>Action Successfully !</span>";
                return $message;
            }
            else
            {
                $message = "<span class='error'>Action Unsuccessfully !</span>";
                return $message;
            }
        }




        /*********************************************
         * @author Phong-Kaster
         * removing a product bases on $id
         *********************************************/
        public function deleteByID($id)
        {
            $message =  "";
            $query = "";

            /*Step 3*/
            if( empty($id))
            {
                $message = "<span class='error'>You have to enter a id !</span>";
                return $message;
            }
            
            $query = " DELETE FROM Product WHERE id = '$id' ";
            $result = $this->database->delete($query);
            if( $result)
            {
                $message = "<span class='success'>Action Successfully !</span>";
                return $message;
            }
            else
            {
                $message = "<span class='error'>Action Unsuccessfully !</span>";
                return $message;
            }
        }
    }
?>