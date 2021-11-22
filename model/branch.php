<?php 
    include_once dirname( __FILE__ , 2).'/lib/database.php';
    include_once dirname( __FILE__ , 2).'/helpers/format.php';

    class Branch
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
         * retrieve every single category in table Category
         *********************************************/
        public function retrieveAllBranch()
        {
            $query = "SELECT * FROM Branch ORDER BY ID DESC";
            $result = $this->database->select($query);
            return $result;
        }



        /*********************************************
         * @author Phong-Kaster
         * Step 1: declare local variables
         * Step 2: escapes special characters, if any
         * Step 3: handle and execute query with database
         *********************************************/
        public function insert($name)
        {
            $message =  "";
            $query = "";


            /*Step 1 */
            $name = $this->format->validation($name);
            

            /*Step 2*/
            $name = mysqli_real_escape_string($this->database->link, $name);


            /*Step 3*/
            if( empty($name))
            {
                $message = "<span class='error'>You have to enter a name !</span>";
                return $message;
            }
            else
            {
                $query = "INSERT INTO Branch(name) VALUES('$name')";
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
        }


        /*********************************************
         * @author Phong-Kaster
         * get a specific category by ID
         *********************************************/
        public function retrieveByID($id)
        {
            $query = "SELECT * FROM Branch WHERE ID = '$id' ";
            $result = $this->database->select($query);
            return $result;
        }


        /*********************************************
         * @author Phong-Kaster
         *********************************************/
        public function updateByID($id, $name)
        {
            $message =  "";
            $query = "";


            /*Step 1 */
            $id = $this->format->validation($id);
            $name = $this->format->validation($name);
            

            /*Step 2*/
            $id = mysqli_real_escape_string($this->database->link, $id);
            $name = mysqli_real_escape_string($this->database->link, $name);


            /*Step 3*/
            if( empty($name))
            {
                $message = "<span class='error'>You have to enter a name !</span>";
                return $message;
            }
            else
            {
                $query = "UPDATE Branch SET name = '$name' WHERE id = '$id' ";
                $result = $this->database->update($query);
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




        /*********************************************
         * @author Phong-Kaster
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
            
            $query = " DELETE FROM Branch WHERE id = '$id' ";
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