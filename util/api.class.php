<?php
/**
 * Enter description here...
 *
 */
class Api {
	private $_apId = '1295713138';
	private $_skey = 's4oRxUdrujF5hVKgVK1x';
	private $_test = true;
	private $_apiUrl = 'http://67.23.226.80/api/?';
	
    public function  __construct() {
    } 
    
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $userData
	 * @return unknown
	 */
    public function MakeCurlApi($userData = array()) {
	
		if(count($userData) > 0) {
		
			$default_vars = "aid=".$this->_apId."&skey=".$this->_skey."&test=".$this->_test."";
			$post_vars = $ch = $rec_data = $temp_output = '';
            
			//echo $this->_apiUrl; die;
			
			$ch = curl_init($this->_apiUrl);
			
			curl_setopt($ch, CURLOPT_POST, 1);
			
			$comma = '&';
			
			foreach ($userData as $key => $value){
				$post_vars .= $comma."".$key."=". $value;
				$comma = '&';
			}
			curl_setopt($ch, CURLOPT_POSTFIELDS, $default_vars.$post_vars);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION ,1);
			curl_setopt($ch, CURLOPT_HEADER ,0);  // DO NOT RETURN HTTP HEADERS
			curl_setopt($ch, CURLOPT_RETURNTRANSFER ,1);  // RETURN THE CONTENTS OF THE CALL
			
            // echo $default_vars.$post_vars; die;

            $rec_data = curl_exec($ch);
			$data = json_decode($rec_data);
			curl_close($ch);
			return $data;
		} else {
			return false;
		}
	}
    
    
   
} /*** end of class ***/

?>
