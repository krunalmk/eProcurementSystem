<?php
    class GeneralTenderForm {
        public $tenderid;
        public $compid;
        public $compid_owner;
        public $category;
        public $description;
        public $contracttitle;
        public $reference;
        public $estimatedtime;
        public $agreementvalue;
        public $dateinvited;
        public $datedue;
        public $conditions;
        public $openclose;
        public $whyiamspecial;
        public $tendersetter;
        public $comp_estimate;

        public function setGeneralValues($tenderid, $compid, $category, $contracttitle, $description, $reference, $estimatedtime, $agreementvalue, $dateinvited, $datedue, $conditions, $openclose){
            $this->tenderid = $tenderid;
            $this->compid = $compid;
            $this->category = $category;
            $this->description = $description;
            $this->contracttitle = $contracttitle;
            $this->reference = $reference;
            $this->estimatedtime = $estimatedtime;
            $this->agreementvalue = $agreementvalue;
            $this->dateinvited = $dateinvited;
            $this->datedue = $datedue;
            $this->conditions = $conditions;
            $this->openclose = $openclose;
        }

        public function setGeneralValuesToUploadNewTender($tenderid, $compid, $category, $contracttitle, $description, $reference, $estimatedtime, $agreementvalue, $dateinvited, $datedue, $conditions, $openclose){
                $this->tenderid = $tenderid;
                $this->compid = $compid;
                $this->category = $category;
                $this->description = $description;
                $this->contracttitle = $contracttitle;
                $this->reference = $reference;
                $this->estimatedtime = $estimatedtime;
                $this->agreementvalue = $agreementvalue;
                $this->dateinvited = $dateinvited;
                $this->datedue = $datedue;
                $this->conditions = $conditions;
                $this->openclose = $openclose;
            }

        public function setGeneralValuesForTenderApply($tenderid, $compid, $compid_owner, $category, $contracttitle, $description, $reference, $estimatedtime, $agreementvalue, $dateinvited, $datedue, $conditions, $openclose, $whyiamspecial, $comp_estimate){
                $this->tenderid = $tenderid;
                $this->compid = $compid;
                $this->compid_owner = $compid_owner;
                $this->category = $category;
                $this->description = $description;
                $this->contracttitle = $contracttitle;
                $this->reference = $reference;
                $this->estimatedtime = $estimatedtime;
                $this->agreementvalue = $agreementvalue;
                $this->dateinvited = $dateinvited;
                $this->datedue = $datedue;
                $this->conditions = $conditions;
                $this->openclose = $openclose;
                $this->whyiamspecial = $whyiamspecial;
                $this->comp_estimate = $comp_estimate;
        }

        public function formatDataForInsertionInDB(){
                return [ "tender_id"=> $this->tenderid, "comp_id"=> $this->compid, "category"=> $this->category, "contracttitle"=> $this->contracttitle, "description"=> $this->description, "reference"=> $this->reference, "estimated_time"=> $this->estimatedtime, "agreement_value"=> $this->agreementvalue, "date_invited"=> $this->dateinvited, "date_due"=>$this->datedue, "conditions"=>$this->conditions, "open_close"=> $this->openclose ];
        }

        public function formatDataForTenderFormUploadInsertionInDB(){
                return [ "tender_id"=> $this->tenderid, "comp_id_owner"=> $this->compid, "category"=> $this->category, "contracttitle"=> $this->contracttitle, "description"=> $this->description, "reference"=> $this->reference, "estimated_time"=> $this->estimatedtime, "agreement_value"=> $this->agreementvalue, "date_invited"=> $this->dateinvited, "date_due"=>$this->datedue, "conditions"=>$this->conditions, "open_close"=> $this->openclose ];
        }

        public function formatTenderApplyDataForInsertionInDB(){
                return [ "tender_id"=> $this->tenderid, "comp_id_bidder"=> $this->compid, "comp_id_owner"=> $this->compid_owner, "category"=> $this->category, "contracttitle"=> $this->contracttitle, "description"=> $this->description, "reference"=> $this->reference, "estimated_time"=> $this->estimatedtime, "agreement_value"=> $this->agreementvalue, "date_invited"=> $this->dateinvited, "date_due"=>$this->datedue, "conditions"=>$this->conditions, "open_close"=> $this->openclose, "whyiamspecial"=>$this->whyiamspecial, "comp_estimate" =>$this->comp_estimate ];
        }


        /**
         * Get the value of tenderid
         */ 
        public function getTenderid()
        {
                return $this->tenderid;
        }

        /**
         * Set the value of tenderid
         *
         * @return  self
         */ 
        public function setTenderid($tenderid)
        {
                $this->tenderid = $tenderid;

                return $this;
        }

        /**
         * Get the value of compid
         */ 
        public function getCompid()
        {
                return $this->compid;
        }

        /**
         * Set the value of compid
         *
         * @return  self
         */ 
        public function setCompid($compid)
        {
                $this->compid = $compid;

                return $this;
        }

        /**
         * Get the value of category
         */ 
        public function getCategory()
        {
                return $this->category;
        }

        /**
         * Set the value of category
         *
         * @return  self
         */ 
        public function setCategory($category)
        {
                $this->category = $category;

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of contracttitle
         */ 
        public function getContracttitle()
        {
                return $this->contracttitle;
        }

        /**
         * Set the value of contracttitle
         *
         * @return  self
         */ 
        public function setContracttitle($contracttitle)
        {
                $this->contracttitle = $contracttitle;

                return $this;
        }

        /**
         * Get the value of reference
         */ 
        public function getReference()
        {
                return $this->reference;
        }

        /**
         * Set the value of reference
         *
         * @return  self
         */ 
        public function setReference($reference)
        {
                $this->reference = $reference;

                return $this;
        }

        /**
         * Get the value of estimatedtime
         */ 
        public function getEstimatedtime()
        {
                return $this->estimatedtime;
        }

        /**
         * Set the value of estimatedtime
         *
         * @return  self
         */ 
        public function setEstimatedtime($estimatedtime)
        {
                $this->estimatedtime = $estimatedtime;

                return $this;
        }

        /**
         * Get the value of agreementvalue
         */ 
        public function getAgreementvalue()
        {
                return $this->agreementvalue;
        }

        /**
         * Set the value of agreementvalue
         *
         * @return  self
         */ 
        public function setAgreementvalue($agreementvalue)
        {
                $this->agreementvalue = $agreementvalue;

                return $this;
        }

        /**
         * Get the value of dateinvited
         */ 
        public function getDateinvited()
        {
                return $this->dateinvited;
        }

        /**
         * Set the value of dateinvited
         *
         * @return  self
         */ 
        public function setDateinvited($dateinvited)
        {
                $this->dateinvited = $dateinvited;

                return $this;
        }

        /**
         * Get the value of datedue
         */ 
        public function getDatedue()
        {
                return $this->datedue;
        }

        /**
         * Set the value of datedue
         *
         * @return  self
         */ 
        public function setDatedue($datedue)
        {
                $this->datedue = $datedue;

                return $this;
        }

        /**
         * Get the value of conditions
         */ 
        public function getConditions()
        {
                return $this->conditions;
        }

        /**
         * Set the value of conditions
         *
         * @return  self
         */ 
        public function setConditions($conditions)
        {
                $this->conditions = $conditions;

                return $this;
        }

        /**
         * Get the value of openclose
         */ 
        public function getOpenclose()
        {
                return $this->openclose;
        }

        /**
         * Set the value of openclose
         *
         * @return  self
         */ 
        public function setOpenclose($openclose)
        {
                $this->openclose = $openclose;

                return $this;
        }
    }
?>
