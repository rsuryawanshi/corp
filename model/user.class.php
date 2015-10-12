<?php

/**
 * Enter description here...
 *
 */
class User {

    const USER_TABLE = 'user';

    public function __construct() {
        //  $this->conn = db::getInstance();
    }

    function isLoggedin() {
        if (isset($_COOKIE['userid']) and isset($_COOKIE['token'])) {
            $user_arr = unserialize($this->decrypt(($_COOKIE['token']), 'kiranrahul%$'));
            if ($_COOKIE['userid'] == $user_arr['userid'])
                return true;
        }
    }

    function decrypt($string, $key) {
        $result = '';
        $string = base64_decode($string);

        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result.=$char;
        }
        return $result;
    }


}

/* * * end of class ** */
?>
