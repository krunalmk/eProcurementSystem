<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    session_start();

    // include database file
    include_once 'mongodb_config.php';
    include 'GeneralTenderForm.php';

    class TenderFormSet extends GeneralTenderForm{
        public $dbname = 'tender';
        public $collection;
        public $db;
        public $conn;

        public function __construct(){
            $this->dbname = "tender";
            $this->collection = "company_set_tender";
            $this->db = new DbManager();
            $this->conn = ( $this->db)->getConnection();
        }

        public function incrementTenderIDInDB(){
            // insert record
            $bulk = new MongoDB\Driver\BulkWrite();
            $bulk->update( [], ['$inc'=> [ 'num'=> 1]]);

            $sequenceCollectionName = "tender_id_sequence";
            $result = $this->conn->executeBulkWrite("$this->dbname.$sequenceCollectionName", $bulk);
        }

        public function generateTenderID(){
            $filter = [];
            $option = [ 'projection' => [ 'num'=> 1]];
            $read = new MongoDB\Driver\Query($filter, $option);

            //fetch records
            $sequenceCollectionName = "tender_id_sequence";
            $records = $this->conn->executeQuery("$this->dbname.$sequenceCollectionName", $read);
            $array = iterator_to_array($records);

            $this->incrementTenderIDInDB();

            return $array[0]->num;
        }

        public function setFormValue( $compid, $category, $contracttitle, $description, $reference, $estimatedtime, $agreementvalue, $dateinvited, $datedue, $conditions, $openclose){
            $this->setGeneralValues($this->generateTenderID(), $compid, $category, $contracttitle, $description, $reference, $estimatedtime, $agreementvalue, $dateinvited, $datedue, $conditions, 1);
            $updateInfoInProperFormat = $this->formatDataForInsertionInDB();
            
            $bulk = new MongoDB\Driver\BulkWrite();
            $bulk->insert( $updateInfoInProperFormat);

            $result = $this->conn->executeBulkWrite("$this->dbname.$this->collection", $bulk);
            if( $result == TRUE){
                echo [ 'success'=>1];
            }
            else{
                echo [ 'success'=>0];
            }
        }
    }

    $tenderFormSetObject = new TenderFormSet();
    $tenderFormSetObject->incrementTenderIDInDB();
    $tenderFormSetObject->setFormValue( $_SESSION["company_id"], $_POST["chosencategory"], $_POST["contracttitle"], $_POST["description"], $_POST["reference"], $_POST["estimatedtime"], $_POST["agreementvalue"], $_POST["dateinvited"], $_POST["datedue"], $_POST["conditions"], 1 );
?>
