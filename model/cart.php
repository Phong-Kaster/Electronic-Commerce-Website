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
       


    }
?>