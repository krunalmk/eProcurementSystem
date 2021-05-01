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
    include 'GeneralTenderForm.php';

    class ApplyTender extends GeneralTenderForm{
        public $dbname = 'tender';
        public $collection;
        public $db;
        public $conn;

        public function __construct(){
            $this->dbname = "tender";
            $this->collection = "tender_form";
            $this->db = new DbManager();
            $this->conn = ( $this->db)->getConnection();
        }

        public function checkIfAlreadyApplied(){
            $filter = ['comp_id' => $_SESSION['company_id'], 'tender_id' => $_POST['tender_id'], 'category' => $_POST['chosencategory']];
            $option = [ 'projection' => [ 'description'=> 1]];
            $read = new MongoDB\Driver\Query($filter, $option);

            //fetch records
            $records = $this->conn->executeQuery("$this->dbname.$this->collection", $read);
            $array = iterator_to_array($records);
            if( count($array) != 1)
                return false;
            else
                return true;
        }

        public function setFormValue( $tender_id, $compid, $compid_owner, $category, $contracttitle, $description, $reference, $estimatedtime, $agreementvalue, $dateinvited, $datedue, $conditions, $openclose, $whyiamspecial, $comp_estimate){
            $this->setGeneralValuesForTenderApply( $tender_id, $compid, $compid_owner, $category, $contracttitle, $description, $reference, $estimatedtime, $agreementvalue, $dateinvited, $datedue, $conditions, $openclose, $whyiamspecial, $comp_estimate);
            $updateInfoInProperFormat = $this->formatTenderApplyDataForInsertionInDB();
            
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

    $applyTenderObject = new ApplyTender();
    if($applyTenderObject->checkIfAlreadyApplied()){
        header('location:tenderViewPage.php?applied=2');
    }
    else{
    $applyTenderObject->setFormValue( $_POST['tender_id'], $_SESSION["company_id"], $_POST['comp_id_owner'], $_POST["chosencategory"], $_POST["contracttitle"], $_POST["description"], $_POST["reference"], $_POST["estimated_time"], $_POST["agreement_value"], $_POST["date_invited"], $_POST["date_due"], $_POST["conditions"], 1, $_POST["whyiamspecial"], $_POST["comp_estimate"] );
    header('location:tenderViewPage.php?applied=1');
    }

    //applied = 2 means already applied by the company
    //applied = 1 means applied successfully ( not used till now)
    //applied = 0 means unsuccessful ( not used till now)
?>
