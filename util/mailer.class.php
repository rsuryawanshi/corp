<?php

/**
 * Enter description here...
 *
 */
class Mailer {

	/**
	 * Enter description here...
	 *
	 * @return unknown
	 */
 

    public function  __construct() {
        $this->db = db::getInstance();
    }

    public function registerMail($user) {

        $template = " Hi ".$user['name'].", <br/> Thank you to register with Healthwishers.com <br/>
                      Regards, Healthwishers.com Team";
        $header = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n";
        if(@mail($user['emailId'],"Registered Successfully",$template,$header)) {
           // @ to do logging to database with link
            return true;
        } else {
           echo " unable to send mail "; die;
           return false;
        }
        
    }

    public function forgotPassword($data) {

        $template = " This is to confirm that we have received a Forgot Password request for your Account {$data['emailId']} .<br/>
                      Please click <a href={$data['ulr']}> reset password </a> or copy paset this link in your browser address {$data['ulr']}
                      Regards, Healthwishers.com Team";
        $header = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n";
        
        if(@mail($data['emailId'],"Reset new password ",$template,$header)) {
           // @ to do logging to database with link
            return true;
        } else {
           echo " unable to send mail "; die;
           return false;
        }
    }

} /*** end of class ***/

?>
