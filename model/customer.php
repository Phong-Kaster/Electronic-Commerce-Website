<?php
    /**
     * CART.PHP handles sign in - sign up for customers
     */
    include_once dirname( __FILE__ , 2).'/lib/database.php';
    include_once dirname( __FILE__ , 2).'/helpers/format.php';
    include_once dirname( __FILE__ , 2).'/lib/session.php';

    class Customer
    {
        private $database;
        private $format;



        public function __construct()
        {
            $this->database = new Database();
            $this->format = new Format();
        }
       

        /************************************************************************
         * this function checks an account which have $username exists or not?
         * return 1 if $username exists
         * return null if $username doesn't exist
         ************************************************************************/
        public function isUsernameExisted($username)
        {
            $query = "SELECT 1 FROM Customer WHERE username = '$username'";
            $result = $this->database->select($query);
            return $result;
        }


        /************************************************************************
         * this function checks an account which have $username exists or not?
         * return 1 if $username exists
         * return null if $username doesn't exist
         ************************************************************************/
        public function isEmailExisted($email)
        {
            $query = "SELECT 1 FROM Customer WHERE email = '$email'";
            $result = $this->database->select($query);
            return $result;
        }


        /************************************************************************
         * STEP 1: retrieve data sent from client
         * Step 2: check input data
         * Step 3: check both username and email are used or not
         * Step 4: if every thing passes, query to create a new account
         *************************************************************************/
        public function createAccount($data)
        {
            /**Step 1*/
            $email = mysqli_real_escape_string($this->database->link, $data['email']);
            $address = mysqli_real_escape_string($this->database->link, $data['address']);
            $username = mysqli_real_escape_string($this->database->link, $data['username']);
            $password = mysqli_real_escape_string($this->database->link, $data['password']);
            $confirmPassword = mysqli_real_escape_string($this->database->link, $data['confirmpassword']);



            /**Step 2 */
            if( empty($email) || empty($address) || empty($username) || empty($password) || empty($confirmPassword) )
            {
                $message = "<span class='error'>Every field can't be empty !</span>";
                return $message;
            }

            if( strcmp( $password,$confirmPassword) )
            {
                $message = "<span class='error'>Password isn't equal with confirm password !</span>";
                return $message;
            }



            /**Step 3 */
            $usernameStatus = $this->isUsernameExisted($username);
            if( $usernameStatus )
            {
                $message = "<span class='error'>This username is used ! Please, try another username</span>";
                return $message;
            }


            $emailStatus = $this->isEmailExisted($email);
            if( $emailStatus )
            {
                $message = "<span class='error'>This email is used ! Please, try another email</span>";
                return $message;
            }


            /**Step 4 */
            $email = $this->format->validation($email);
            $address = $this->format->validation($address);
            $username = $this->format->validation($username);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            


            /**Step 5 */
            $query = "INSERT INTO Customer (email, address, username, password )
                    VALUES('$email', '$address', '$username', '$hashedPassword')";

            $result = $this->database->insert($query);
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



        /************************************************************************
         * Step 1: retrieve data sent from client
         * Step 2: check data if they are empty
         * Step 3: check username if it exists
         * Step 4: retrieve hashed password and compare with $password
         ************************************************************************/
        public function login($data)
        {
            /**Step 1*/
            $username = mysqli_real_escape_string($this->database->link, $data['username']);
            $password = mysqli_real_escape_string($this->database->link, $data['password']);


            /**Step 2 */
            if( empty($username) || empty($password) )
            {
                $message = "<span class='error'>You have to fullfil both username and password !</span>";
                return $message;
            }


            /**Step 3 */
            $usernameStatus = $this->isUsernameExisted($username);
            if( !$usernameStatus )
            {
                $message = "<span class='error'>This username doesn't exist ! Please, try again</span>";
                return $message;
            }


            /**Step 4 */
            $query = "SELECT password FROM Customer WHERE username = '$username' ";
            $result = $this->database->select($query);
            $hashedPassword = "";
            while( $element = $result->fetch_assoc())
            {
                $hashedPassword = $element['password'];
            }
            

            /**Step 5 */
            if( !password_verify( $password, $hashedPassword ))
            {
                return "Your username or password is incorrect ! Please, try again";
            }
           

            /**Step 6 */
            $query = "SELECT * FROM Customer WHERE username = '$username' and password = '$hashedPassword' ";
            $result = $this->database->select($query);
            $customerID = "";
            $customerName = "";
            while( $element = $result->fetch_assoc())
            {
                $customerID = $element['ID'];
                $customerName = $element['username'];
            }
            
            Session::set("customerLogin", true);
            Session::set("customerID", $customerID);
            Session::set("customerName", $customerName);
            header('Location:payment.php');
        }
    }
?>