<?php

    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    session_start();
    // include database file
    include_once 'mongodb_config.php';

    class SignIn{
        private $email;
        private $inputPassword;
        public $dbname = 'tender';
        public $collection = 'user';
        public $db;
        public $conn;

        public function __construct( $dbname, $collection, $email, $inputPassword){
            $this->dbname = $dbname;
            $this->collection = $collection;
            $this->email = $email;
            $this->db = new DbManager();
            $this->conn = ( $this->db)->getConnection();
            $this->inputPassword = $inputPassword;
        }

        public function getInfoArray(){
            $filter = ['email' => $this->email, 'password'=> $this->inputPassword];
            $option = [ 'projection' => ['name'=> 1, 'password'=> 1, 'mgr_id'=> 1, 'company_id'=> 1, 'active'=> 1]];
            $read = new MongoDB\Driver\Query($filter, $option);

            //fetch records
            $records = $this->conn->executeQuery("$this->dbname.$this->collection", $read);
            $array = iterator_to_array($records);
            return $array[0];
        }

        public function getPswdFromArray(){
            $infoArray = $this->getInfoArray();
            return $infoArray->password;
        }

        public function matchPassword(){
            $passwordFromDB = $this->getPswdFromArray();
            if( strcmp( $passwordFromDB, $this->inputPassword) == 0){
                return true;
            }
            else{
                return false;
            }
        }

        public function getDisplayInfo(){
            $signInData = $this->getInfoArray();
            // $response = json_decode($signInData);
                // echo json_encode( $signInData);
            return $signInData;
        }

        public function wihtoutSensitiveFields() {
            $signInData = $this->getDisplayInfo();
            unset($signInData->password);
            return $signInData;
        }
    }

    $email = $_POST["email"];
    $inputPassword = $_POST["password"];
    $signInObject = new SignIn("tender", "user", $email, $inputPassword);
    $passwordFromDB = $signInObject->getPswdFromArray();
    $signInData = $signInObject->wihtoutSensitiveFields();
    
    $response->success = $signInObject->matchPassword();
    if ($response->success) {
            $response->body = $signInData;
    }
    $_SESSION["oid"] = $response->body->oid;
    $_SESSION["email"] = $email;
    $_SESSION["mgr_id"] = $response->body->mgr_id;
    $_SESSION["name"] = $response->body->name;
    $_SESSION["password"] = $passwordFromDB;
    $_SESSION["company_id"] = $response->body->company_id;

    if(strcmp($response->body->active,'1') != 0){
        echo "{\"success\":false}";
    }
    else{
        echo json_encode($response);
    }
?>