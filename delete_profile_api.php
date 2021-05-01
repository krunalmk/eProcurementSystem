<?php
    session_start();

    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // include database file
    include_once 'mongodb_config.php';
    include 'UserInfo.php';

    class DeleteProfile extends UserInfo{
        public $dbname = 'tender';
        public $collection;
        public $db;
        public $conn;

        public function __construct(){
            $this->dbname = "tender";
            $this->collection = "user";
            $this->db = new DbManager();
            $this->conn = ( $this->db)->getConnection();
        }

        public function setAndGetFormValue(){
            $updateInfoInProperFormat = $this->formatDataToDeleteProfile();
            return $updateInfoInProperFormat;
        }

        public function deleteProfileInDB(){
            $bulk = new MongoDB\Driver\BulkWrite();
            $temp = $this->setAndGetFormValue();
            $bulk->update( ['email'=> $_SESSION["email"], $_SESSION["oid"]],$temp);

            $result = $this->conn->executeBulkWrite("$this->dbname.$this->collection", $bulk);
            if( $result == TRUE){
                echo [ 'success'=>1];
            }
            else{
                echo [ 'success'=>0];
            }
        }
    }

    $deleteProfileObj = new DeleteProfile();
    $deleteProfileObj->deleteProfileInDB( $_POST["email"]);
    session_destroy();
?>