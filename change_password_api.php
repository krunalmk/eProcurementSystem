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

    class ChangePassword extends UserInfo{
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

        public function setAndGetFormValue($password){
            $this->setPassword($password);
            $updateInfoInProperFormat = $this->formatDataToUpdatePassword();
            return $updateInfoInProperFormat;
        }

        public function updatePasswordInDB($password){
            $bulk = new MongoDB\Driver\BulkWrite();
            $temp = $this->setAndGetFormValue($password);
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

    $passwordObj = new ChangePassword();
    $passwordObj->updatePasswordInDB( $_POST["password"]);
?>