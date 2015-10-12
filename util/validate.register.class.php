<?php

class Register {
    
     public $email = '';
     public $password = '';
     public $name = '';

     public function validate() {

       require_once 'validator.class.php';

       $data = $_POST;
//     $data = array(
//					"emailId"=>"rbsuryawanshiindia@gmail.com",
//					"password" => "",
//        			"fullName" => "",
//      );
       
       // define the rules
       $rules = array(
					"emailId"=>"email",
					"password" => "require",
					"fullName" => "require",
		);

       $message = array(
					"email"=>array(
						"require"=>"Email Id is Required", // empty field is not allowed
						"email"=>'Valid EmailId Only'
					),
					"password" => "Password is Required",
					"fullName" => "Full Name is Required",
        );

        $objValidator = new Validator($rules,$message);

        if(!$objValidator->isValid($data))
        {
            return false;
        } else {
           return true;
        }
    }

    public function getRegisterError() {
        return  $this->ErrorFields();
    }

    public function isEmailAlreadyRegister($emailId) {

        $userObj = new User();
        
        if($userObj->findEmail($emailId) == 0) {
           return false;
        } else {
            return true;
        }
        
    }
    
}

//$vv = new Validator();
//$vv->check("email","rbsuryawanshiindia@gmail.com");
  

?>