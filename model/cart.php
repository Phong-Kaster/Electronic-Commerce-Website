<?php
    /**
     * CART.PHP handles do shopping
     */
    include_once dirname( __FILE__ , 2).'/lib/database.php';
    include_once dirname( __FILE__ , 2).'/helpers/format.php';

    class Cart
    {
        private $database;
        private $format;



        public function __construct()
        {
            $this->database = new Database();
            $this->format = new Format();
        }
       


        /**************************************
        * HANDLE WITH CART
        * $id is the id of product
        * $quantity is the number of product
        * Step 1: check input data
        * Step 2: get current session ID
        * Step 3: query to get product's detail
        * Step 4: insert a new product to Cart table
        **************************************/
        public function addProductToCart($productID , $quantity)
        {
            if( empty($productID) || empty($quantity) )
            {
                $message = "<span class='error'>There is error happening !</span>";
                return $message;
            }



            /*Step 1 */
            $productID = $this->format->validation($productID);
            $quantity = $this->format->validation($quantity);

            $productID = mysqli_real_escape_string($this->database->link, $productID);
            $quantity = mysqli_real_escape_string($this->database->link, $quantity);



            /*Step 2 */
            $sessionID = session_id();

            $query = "SELECT * FROM Cart WHERE productID = $productID AND sessionID = '$sessionID' ";
            $status = $this->database->select($query);
            if( $status )
            {
                return "<span style='color:red'>Product Added Successfully</span>";
            }


            /*Step 3 */
            $query = "SELECT * FROM Product WHERE ID = $productID";
            $product = $this->database->select($query)->fetch_assoc();
            $price = $product['price'];



            /*Step 4 */
            $query = "INSERT INTO Cart(sessionID, productID, quantity, price) 
                     VALUES('$sessionID', '$productID', '$quantity','$price' )";
            $result = $this->database->insert($query);
            if( $result)
            {
                header('Location:cart.php');
            }
            else
            {
                $message = "<span class='error'>Action Unsuccessfully !</span>";
                return $message;
            }
        }



        /**************************************
         * retrieve detain product quantity, name, ID... from a cart
         **************************************/
        public function retrieveDetailCart()
        {
            $sessionID = session_id();
            $query = "SELECT Product.name as ProductName, 
                    Product.image as ProductImage , 
                    Product.price as ProductPrice,
                    Product.ID as ProductID,
                    Cart.*  
            FROM Product, Cart
            WHERE Cart.productID = Product.ID
            AND Cart.sessionID = '$sessionID' ";

            $result = $this->database->select($query);
            return $result;
        }



        /***************************************
         * Delete product in cart
         ***************************************/
        public function deleteProductInCart($cartID, $productID)
        {
            /*Step 1*/
            if( empty($cartID) || empty($productID) )
            {
                return;
            }


            /*Step 2*/
            $cartID = mysqli_real_escape_string($this->database->link, $cartID);
            $productID = mysqli_real_escape_string( $this->database->link, $productID);
            

            /*Step 3*/
            $query = "DELETE FROM Cart WHERE ID = $cartID AND productID = $productID";
            $status = $this->database->delete($query);
            if( $status )
            {
                $message = "<span style='color:green'>Action Successfully !</span>";
                return $message;
            }
            else
            {
                $message = "<span style='color:red'>Action Unsuccessfully !</span>";
                return $message;
            }
        }



        /***************************************
         * update Product Quantity
         ***************************************/
        public function updateProductQuantity($cartID, $productID, $quantity)
        {
            /*Step 1*/
            if( empty($cartID) || empty($productID) || empty($quantity) )
            {
                return;
            }

            /*Step 2*/
            $cartID = mysqli_real_escape_string($this->database->link, $cartID);
            $productID = mysqli_real_escape_string( $this->database->link, $productID);
            $quantity = mysqli_real_escape_string( $this->database->link, $quantity);


            /*Step 3 */
            $query = "UPDATE Cart SET quantity = $quantity WHERE ID = $cartID AND productID = $productID";
            $status = $this->database->update($query);
            if( $status )
            {
                $message = "<span style='color:green'>Action Successfully !</span>";
                return $message;
            }
            else
            {
                $message = "<span style='color:red'>Action Unsuccessfully !</span>";
                return $message;
            }
        }



        public function findCurrentCart()
        {
            /*Step 1*/
            $sessionID = session_id();

            $query = "SELECT * FROM Cart WHERE sessionID = '$sessionID' ";
            $result = $this->database->select($query);

            return $result;
        }
    }
?>