<?php

#this class communicates with the db
    class Account {

        private $con;
        private $errorArray = array(); #assign the variable to an empty array

        #constructor
        public function __construct($con){
            $this->con = $con;
        }

        public function updateDetails($fn, $ln, $em, $un) {
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateNewEmail($em, $un);
    
            if(empty($this->errorArray)) {
                $query = $this->con->prepare("UPDATE webflix_users SET first_name=:fn, last_name=:ln, email=:em
                                                WHERE username=:un");
                $query->bindValue(":fn", $fn);
                $query->bindValue(":ln", $ln);
                $query->bindValue(":em", $em);
                $query->bindValue(":un", $un);
    
                return $query->execute();
            }
    
            return false;
        }

      
        #this function will be calling the validation functions below
        #by using this public function we can change the validation functions
        #to PRIVATE making the code more secure since the validation functions will
        #no longer be able to be called from the register.php
        #avoiding any accidental mistakes 
        public function register($fn, $ln, $un, $em, $em2, $pw, $pw2){
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateUsername($un);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw,$pw2);
     
            #if there are no errors
            if(empty($this->errorArray)){
                #call the function to insert the user to the db
                return $this->insertUserDetails($fn, $ln,$un,$em,$pw);
            }

            return false;
        }

        public function login($un, $pw){
            #comparing the hash passwords when the user logins to make sure they used correct password
            $pw = hash("sha512",$pw); 

            $query = $this->con->prepare("SELECT * FROM webflix_users WHERE username=:un AND pass=:pw");
                        
            $query->bindValue(":un",$un);
            $query->bindValue(":pw",$pw);

            $query->execute();

            if($query->rowCount()==1){
                return true;
            }

            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }

          #function that registers the user in the table
        private function insertUserDetails($fn, $ln,$un,$em,$pw){
            $pw = hash("sha512",$pw); #hashing the password - conerting the pass in the table to cover it for security reasons
            
            $query = $this->con->prepare("INSERT INTO webflix_users(first_name,last_name,username,email,pass)
                                          VALUES(:fn, :ln, :un, :em, :pw)");
            $query->bindValue(":fn",$fn);
            $query->bindValue(":ln",$ln);
            $query->bindValue(":un",$un);
            $query->bindValue(":em",$em);
            $query->bindValue(":pw",$pw);

            return $query->execute();
        }

        private function validateFirstName($fn){
            if(strlen($fn) < 2 || strlen($fn) >25){
                array_push($this->errorArray, Constants::$firstNameCharacters);
            }
        }

        private function validateLastName($ln){
            if(strlen($ln) < 2 || strlen($ln) >25){
                array_push($this->errorArray, Constants::$lastNameCharacters);
            }
        }

        #return stops the function from proceeding since if 
        #there is already an error there is no need to check if the 
        #username exists.
        #prepare statement -> more secure way to make queries against SQL injection
        #making a query to access the username database and check if username already exists
        #execute query
        private function validateUsername($un){
            if(strlen($un) < 2 || strlen($un) >25){
                array_push($this->errorArray, Constants::$usernameCharacters);
                return; 
            }
           
           $query = $this->con->prepare("SELECT * FROM webflix_users WHERE username=:un");
           $query->bindValue(":un",$un);
            $query->execute();

            #if username exists (a row has been found with the username)
             if($query->rowCount() !=0){
              array_push($this->errorArray, Constants::$usernameTaken);
            }
        }

        #checks if emails match
        private function validateEmails($em,$em2){
            if($em != $em2){
                array_push($this->errorArray, Constants::$emailsDontMatch);
                return;
            }

            #check email has .com extension
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            $query = $this->con->prepare("SELECT * FROM webflix_users WHERE email=:un");
            $query->bindValue(":em",$em);
             $query->execute();
    
             #if username exists (a row has been found with the username)
              if($query->rowCount() !=0){
               array_push($this->errorArray, Constants::$emailTaken);
             }
        }

        private function validateNewEmail($em, $un) {

            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }
    
            $query = $this->con->prepare("SELECT * FROM webflix_users WHERE email=:em AND username != :un");
            $query->bindValue(":em", $em);
            $query->bindValue(":un", $un);
    
            $query->execute();
            
            if($query->rowCount() != 0) {
                array_push($this->errorArray, Constants::$emailTaken);
            }
        }

        #validating passwords
        public function validatePasswords($pw,$pw2){
            if($pw != $pw2){
                array_push($this->errorArray, Constants::$passwordsDontMatch);
                return;
            }

            if(strlen($pw) < 6 || strlen($pw) >20){
                array_push($this->errorArray, Constants::$passwordLength);
                
            }
        }

       public function getError($error){
        if(in_array($error, $this->errorArray)){
            return "<span class='errorMessage'>$error</span>";
        }

       
       }

       public function getFirstError(){
           if(!empty($this->errorArray)){
               return $this->errorArray[0];
           }
       }

       public function updatePassword($oldPw, $pw, $pw2, $un){
            $this->validateOldPassword($oldPw,$un);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray)) {
                $query = $this->con->prepare("UPDATE webflix_users SET pass=:pw
                                                WHERE username=:un");
                $pw = hash("sha512",$pw); 
                $query->bindValue(":pw", $pw);
                $query->bindValue(":un", $un);
    
                return $query->execute();
            }
    
            return false;
       }

       public function validateOldPassword($oldPw, $un){

        $pw = hash("sha512",$oldPw); 

        $query = $this->con->prepare("SELECT * FROM webflix_users WHERE username=:un AND pass=:pw");
                    
        $query->bindValue(":un",$un);
        $query->bindValue(":pw",$pw);

        $query->execute();

        if($query->rowCount()==0){
            array_push($this->errorArray, Constants::$passwordIncorrect );
        }
    }


    }

?>