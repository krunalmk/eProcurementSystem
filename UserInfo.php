<?php
    class UserInfo{
        public $mgr_id;
        public $user_id;
        public $email;
        public $password;
        public $name;
        public $DOB;
        public $sex;
        public $phone;
        public $aadhar;
        public $company_id;

        
        public function formatDataToUpdatePassword(){
            return [ '$set' =>["password"=> $this->password]];
        }

        public function formatDataToUpdatePhone(){
            return [ '$set' =>[ "phone"=> $this->phone]];
        }

        public function formatDataToUpdateEmail(){
            return [ '$set' =>[ "email"=> $this->email]];
        }

        public function formatDataToDeleteProfile(){
            return [ '$set' =>[ "active"=> 0]];
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of phone
         */ 
        public function getPhone()
        {
                return $this->phone;
        }

        /**
         * Set the value of phone
         *
         * @return  self
         */ 
        public function setPhone($phone)
        {
                $this->phone = $phone;

                return $this;
        }
    }
?>