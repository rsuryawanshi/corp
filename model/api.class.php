<?php

/**
 * Enter description here...
 *
 */
class Api {

    private $_apId = '1295713138';
    private $_skey = 's4oRxUdrujF5hVKgVK1x';
    private $_test = false;
    private $_apiUrl = 'http://50.56.70.10/api/?'; 
	protected $_apiIP = '50.56.70.10'; 
	public $news_url = '/';

    public function __construct() {

    }

    /**
     * Enter description here...
     *
     * @param unknown_type $userData
     * @return unknown
     */
    public function MakeCurlApi($userData = array()) {
        if (count($userData) > 0) {
            $default_vars = "aid=" . $this->_apId . "&skey=" . $this->_skey . "&test=" . $this->_test . "";
            $post_vars = $ch = $rec_data = $temp_output = '';
            $ch = curl_init($this->_apiUrl);
            curl_setopt($ch, CURLOPT_POST, 1);
            $comma = '&';
            foreach ($userData as $key => $value) {
                $post_vars .= $comma . "" . $key . "=" . $value;
                $comma = '&';
            }
            //print $this->_apiUrl.$default_vars.$post_vars.'<br />';
            curl_setopt($ch, CURLOPT_POSTFIELDS, $default_vars . $post_vars);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
            $rec_data = curl_exec($ch);
//			$data = json_decode($rec_data);
            $data = $rec_data;
            curl_close($ch);
            return $data;
        }else
            return false;
    }

    /**
     *
     * @param <type> $api_array
     */
    public function makeMultiCurlApi($api_array = array()) {
        $default_vars = "aid=" . $this->_apId . "&skey=" . $this->_skey . "&test=" . $this->_test . "";
        $post_vars = $rec_data = $temp_output = $mh = '';
//        print '<pre>';
//        print_r($api_array);
//        print '</pre>';
//        exit(0);
        if (count($api_array) > 0) {
            $count = 0;
            $ch = array();
            $mh = curl_multi_init();
            foreach ($api_array as $data_array) {
                $post_vars = $comma = '';
                $ch[$count] = curl_init($this->_apiUrl);

                curl_setopt($ch[$count], CURLOPT_POST, 1);
                $comma = '&';
                foreach ($data_array as $key => $value) {
                    $post_vars .= $comma . "" . $key . "=" . $value;
                    $comma = '&';
                }
//                print $this->_apiUrl.$default_vars . $post_vars . '<br />';
                curl_setopt($ch[$count], CURLOPT_POSTFIELDS, $default_vars . $post_vars);
                curl_setopt($ch[$count], CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch[$count], CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
                curl_setopt($ch[$count], CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
                curl_multi_add_handle($mh, $ch[$count]);
                $count++;
            }

            $still_running = 0;
            do{
                curl_multi_exec($mh, $still_running);
            } while ($still_running > 0);


            $count = 0;
            $results = array();
            foreach ($api_array as $data_array) {
                $results[$count] = json_decode(curl_multi_getcontent($ch[$count]), true);
                $count++;
            }
            return $results;
        }


    }


}

/* * * end of class ** */
?>
