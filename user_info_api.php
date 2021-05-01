<?php

    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    session_start();
    // include database file
    include_once 'mongodb_config.php';

    class UserProfile{
        private $email;
        public $dbname = 'tender';
        public $collection = 'user';
        public $db;
        public $conn;

        public function __construct( $dbname, $collection, $email){
            $this->dbname = $dbname;
            $this->collection = $collection;
            $this->email = $email;
            $this->db = new DbManager();
            $this->conn = ( $this->db)->getConnection();
        }

        public function getInfoArray(){
            $filter = ['email' => $this->email];
            $option = [ 'projection' => ['name'=> 1, 'password'=> 1, 'mgr_id'=> 1, 'company_id'=> 1, 'user_id'=> 1, 'email'=> 1, 'DOB'=> 1, 'sex'=> 1, 'phone'=> 1, 'aadhar'=> 1]];
            $read = new MongoDB\Driver\Query($filter, $option);

            //fetch records
            $records = $this->conn->executeQuery("$this->dbname.$this->collection", $read);
            $array = iterator_to_array($records);
            return $array[0];
        }

        public function getDisplayInfo(){
            $signInData = $this->getInfoArray();
            // $response = json_decode($signInData);
                // echo json_encode( $signInData);
            return $signInData;
        }
    }

    $email = $_POST["email"];
    $userProfileObject = new UserProfile("tender", "user", $email);
    $_SESSION["oid"] = $response->body->oid;
    $_SESSION["email"] = $email;
    $_SESSION["mgr_id"] = $response->body->mgr_id;
    $_SESSION["name"] = $response->body->name;
    $_SESSION["password"] = $passwordFromDB;
    $_SESSION["company_id"] = $response->body->company_id;
    $response = $userProfileObject->getDisplayInfo();
    echo json_encode($response);
    
?>