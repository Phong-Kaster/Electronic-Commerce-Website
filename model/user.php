<?php
    /**
     * CART.PHP handles sign in - sign up for customers
     */
    include_once dirname( __FILE__ , 2).'/lib/database.php';
    include_once dirname( __FILE__ , 2).'/helpers/format.php';

    class User
    {
        private $database;
        private $format;



        public function __construct()
        {
            $this->database = new Database();
            $this->format = new Format();
        }
       


    }
?>