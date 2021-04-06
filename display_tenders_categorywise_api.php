<?php

    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    session_start();
    // include database file
    include_once 'mongodb_config.php';

    class SignIn{
        private $inputCategory;
        public $dbname = 'tender';
        public $collection = 'tender_form';
        public $db;
        public $conn;

        public function __construct( $dbname, $collection, $inputCategory){
            $this->dbname = $dbname;
            $this->collection = $collection;
            $this->db = new DbManager();
            $this->conn = ( $this->db)->getConnection();
            $this->inputCategory = $inputCategory;
        }

        public function getInfoArray(){
            $filter = ['category' => $this->inputCategory];
            $option = [ 'projection' => [ 'tender_id'=> 1, 'comp_id'=> 1, 'category'=> 1, 'description'=> 1, 'contract_title'=> 1, 'reference'=> 1, 'estimated_time'=> 1, 'agreement_value'=> 1, 'date_invited'=> 1, 'date_due'=> 1, 'conditions'=> 1, 'open_close'=> 1]];
            $read = new MongoDB\Driver\Query($filter, $option);

            //fetch records
            $records = $this->conn->executeQuery("$this->dbname.$this->collection", $read);
            $array = iterator_to_array($records);
            return $array;
        }

        public function getDisplayInfo(){
            $tenderData = $this->getInfoArray();
            // $response = json_decode($tenderData);
                // echo json_encode( $tenderData);
            return json_encode( $tenderData);
        }
    }

    $inputCategory = $_POST["chosencategory"];
    $signInObject = new SignIn("tender", "tender_form", $inputCategory);

    $response = $signInObject->getDisplayInfo();
    echo $response;
?>