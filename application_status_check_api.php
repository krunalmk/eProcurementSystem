<?php

    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    session_start();
    // include database file
    include_once 'mongodb_config.php';

    class ApplicationStatus{
        public $dbname = 'tender';
        public $collection = 'tender_form';
        public $company_id;
        public $db;
        public $conn;

        public function __construct( $dbname, $collection, $company_id){
            $this->dbname = $dbname;
            $this->collection = $collection;
            $this->db = new DbManager();
            $this->company_id = $company_id;
            $this->conn = ( $this->db)->getConnection();
        }

        public function getInfoArray(){
            $filter = ['comp_id' => $this->company_id];
            $option = [ 'projection' => [ 'tender_id'=> 1, 'comp_id'=> 1, 'category'=> 1, 'description'=> 1, 'contract_title'=> 1, 'reference'=> 1, 'estimated_time'=> 1, 'agreement_value'=> 1, 'date_invited'=> 1, 'date_due'=> 1, 'conditions'=> 1, 'open_close'=> 1, 'whyiamspecial'=> 1]];
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

    $company_id = $_SESSION["company_id"];
    $ApplicationStatusObject = new ApplicationStatus("tender", "tender_form", $company_id);

    $response = $ApplicationStatusObject->getDisplayInfo();
    echo $response;
?>
