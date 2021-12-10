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
         * 
         **************************************/
        public function retrieveDetailCart()
        {
            $sessionID = session_id();
            $query = "SELECT Product.name as ProductName, 
                    Product.image as ProductImage , 
                    Product.price as ProductPrice,
                    Cart.*  
            FROM Product, Cart
            WHERE Cart.productID = Product.ID
            AND Cart.sessionID = '$sessionID' ";

            $result = $this->database->select($query);
            return $result;
        }
    }
?>