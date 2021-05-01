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

    class ChangeEmail extends UserInfo{
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

        public function setAndGetFormValue($email){
            $this->setEmail($email);
            $updateInfoInProperFormat = $this->formatDataToUpdateEmail();
            return $updateInfoInProperFormat;
        }

        public function updateEmailInDB($email){
            $bulk = new MongoDB\Driver\BulkWrite();
            $temp = $this->setAndGetFormValue($email);
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

    $emailObj = new ChangeEmail();
    $emailObj->updateEmailInDB( $_POST["email"]);
?>