<?php 
    include dirname( __FILE__ , 2).'/lib/session.php';
    include dirname( __FILE__ , 2).'/lib/database.php';
    include dirname( __FILE__ , 2).'/helpers/format.php';

    Session::checkLogin();

    class AdminLogin
    {
        private $database;
        private $format;



        public function __construct()
        {
            $this->database = new Database();
            $this->format = new Format();
        }
       


        /*********************************************
         * @author Phong-Kaster
         * Step 1: check $username and $password format is correct ?
         * Step 2: mysqli_real_escape_string: Escape special characters, if any
         *********************************************/
        public function login($username ,$password)
        {
            $message =  "";
            $query = "";


            /*Step 1 */
            $username = $this->format->validation($username);
            $password = $this->format->validation($password);
            

            /*Step 2*/
            $username = mysqli_real_escape_string($this->database->link, $username);
            $password = mysqli_real_escape_string($this->database->link, $password);


            /*Step 3*/
            if( empty($username) || empty($password))
            {
                $message = "Username and password must be fullfil";
                return $message;
            }
            else
            {
                $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' LIMIT 1 ";
                $result = $this->database->select($query);
                
                if( $result != false)
                {
                    $value = $result->fetch_assoc();//fetch_assoc: convert a row into an array
                    Session::set("login", true);
                    Session::set("ID", $value['ID']);

                    
                    Session::set("name", $value['name']);
                    Session::set("username", $value['username']);

                    header('Location: index.php');// if true, return admin dashboard - redirect
                }
                else
                {
                    $message = "Username and password are not correct";
                    return $message;
                }
            }
        }
    }
?>