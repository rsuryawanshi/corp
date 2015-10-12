<?php

/**
 * Enter description here...
 *
 */
class Functions {

	public $secret_key = 'd76f8cfd325e84be452beb9297bf1ce0';
    public $app_id = '158343900884888';

    public function __construct() {

    }

    /**
     * Enter description here...
     *
     * @param unknown_type $text
     * @return unknown
     */
    function clean_url($text) {
        //$text=strtolower($text);
        $code_entities_match = array(' ', '--', '&quot;', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '{', '}', '|', ':', '"', '<', '>', '?', '[', ']', '\\', ';', "'", ',', '.', '/', '*', '+', '~', '`', '=');
        $code_entities_replace = array('-', '-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
        $text = str_replace($code_entities_match, $code_entities_replace, $text);
        return $text;
    }

    function clean_url1($text) {
        //$text=strtolower($text);
        $code_entities_match = array(' ', '--', '&quot;', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '{', '}', '|', ':', '"', '<', '>', '?', '[', ']', '\\', ';', "'", ',', '.', '/', '*', '+', '~', '`', '=');
        $code_entities_replace = array(' ', ' ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
        $text = str_replace($code_entities_match, $code_entities_replace, $text);
        return $text;
    }

    /**
     * Enter description here...
     *
     * @param unknown_type $details
     * @param unknown_type $max
     * @return unknown
     */
    function truncate_string($details, $max) {
        if (strlen($details) > $max) {
            $details = substr($details, 0, $max);
            $i = strrpos($details, " ");
            $details = substr($details, 0, $i);
        }
        $details = trim($details);
        $RemoveChars = array("([\40])", "([^a-zA-Z0-9-])", "(-{2,})");
        $ReplaceWith = array("-", "", "-");
        $string = preg_replace($RemoveChars, $ReplaceWith, $details);
        return strtolower($string);
    }

    /* Works out the time since the entry post, takes a an argument in unix time (seconds) */

    function time_since($original) {
        // array of time period chunks
        $chunks = array(
            array(60 * 60 * 24 * 365, 'Year'),
            array(60 * 60 * 24 * 30, 'Month'),
            array(60 * 60 * 24 * 7, 'Week'),
            array(60 * 60 * 24, 'Day'),
            array(60 * 60, 'Hour'),
            array(60, 'Minute'),
        );

        $today = time(); /* Current unix time  */
        $since = $today - $original;

        // $j saves performing the count function each time around the loop
        $chunk_count = count($chunks);
        for ($i = 0, $j = $chunk_count; $i < $j; $i++) {

            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];

            // finding the biggest chunk (if the chunk fits, break)
            if (($count = floor($since / $seconds)) != 0) {
                // DEBUG print "<!-- It's $name -->\n";
                break;
            }
        }

        $print = ($count == 1) ? '1 ' . $name : "$count {$name}s";

        if ($i + 1 < $j) {
            // now getting the second item
            $seconds2 = $chunks[$i + 1][0];
            $name2 = $chunks[$i + 1][1];

            // add second item if it's greater than 0
            if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
                $print .= ( $count2 == 1) ? ', 1 ' . $name2 : ", $count2 {$name2}s";
            }
        }
        return $print . ' ago';
    }

    public function cleanString($string) {
        if ($string) {
            return stripslashes(trim(strip_tags($string)));
        }else
            return false;
    }

    function just_clean($string) {
// Replace other special chars
        $specialCharacters = array(
            '#' => '',
            '$' => '',
            '%' => '',
            '&' => '',
            '@' => '',
            '.' => '',
            '�' => '',
            '+' => '',
            '=' => '',
            '�' => '',
            '\\' => '',
            '/' => '',
        );

        while (list($character, $replacement) = each($specialCharacters)) {
            $string = str_replace($character, '-' . $replacement . '-', $string);
        }

        $string = strtr($string,
                        "������? ����������������������������������������������",
                        "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn"
        );

// Remove all remaining other unknown characters
        $string = preg_replace('/[^a-zA-Z0-9-]/', ' ', $string);
        $string = preg_replace('/^[-]+/', '', $string);
        $string = preg_replace('/[-]+$/', '', $string);
        $string = preg_replace('/[-]{2,}/', ' ', $string);

        return $string;
    }

    /**
     *
     * @param <type> $text
     * @param <type> $reverse
     * @return <type> 
     */
    function cleanSearchFilterUrl($text, $reverse = false) {
        if ($text) {
            $code_entities_match = array(' ', '/');
            $code_entities_replace = array('-', '_');
            if($reverse){
                $code_entities_match = array('-', '_');
                $code_entities_replace = array(' ', '/');
            }

            $text = str_replace($code_entities_match, $code_entities_replace, $text);
            return $text;
        }else return false;
    }


    /**
     *
     * @return string 
     */
    function createRandomPassword() {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double) microtime() * 1000000);
        $i = 0;
        $pass = '';
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }


    /**
     *
     * @param <type> $x
     * @return <type> 
     */
    function int_to_words($x) {
        if (($x > 100000) && ($x <= 10000000)) {    //   1 Lacs < No < 1 Crore
            $w = (($x / 100000));
            // $y = (($x%100000));
            $w = round($w, 2) . ' Lacs';
        } elseif (($x > 10000000) && ($x <= 1000000000)) {   // 1 Crore < No < 100 Crore
            $w = (($x / 10000000));
            // $y = (($x%10000000));
            $w = round($w, 2) . ' Cr';
        } else {

            $w = $x;
        }
        return $w;
    }


    function findTime($timestamp, $format) {
        $difference = $timestamp - time();
        if($difference < 0)
            return false;
        else{

            $min_only = intval(floor($difference / 60));
            $hour_only = intval(floor($difference / 3600));

            $days = intval(floor($difference / 86400));
            $difference = $difference % 86400;
            $hours = intval(floor($difference / 3600));
            $difference = $difference % 3600;
            $minutes = intval(floor($difference / 60));
            if($minutes == 60){
                $hours = $hours+1;
                $minutes = 0;
            }

            if($days == 0){
                $format = str_replace('Days', '?', $format);
                $format = str_replace('Ds', '?', $format);
                $format = str_replace('%d', '', $format);
            }
            if($hours == 0){
                $format = str_replace('Hours', '?', $format);
                $format = str_replace('Hs', '?', $format);
                $format = str_replace('%h', '', $format);
            }
            if($minutes == 0){
                $format = str_replace('Minutes', '?', $format);
                $format = str_replace('Mins', '?', $format);
                $format = str_replace('Ms', '?', $format);
                $format = str_replace('%m', '', $format);
            }

            $format = str_replace('?,', '', $format);
            $format = str_replace('?:', '', $format);
            $format = str_replace('?', '', $format);

            $timeLeft = str_replace('%d', number_format($days), $format);
            $timeLeft = str_replace('%ho', number_format($hour_only), $timeLeft);
            $timeLeft = str_replace('%mo', number_format($min_only), $timeLeft);
            $timeLeft = str_replace('%h', number_format($hours), $timeLeft);
            $timeLeft = str_replace('%m', number_format($minutes), $timeLeft);

            if($days == 1){
                $timeLeft = str_replace('Days', 'Day', $timeLeft);
                $timeLeft = str_replace('Ds', 'D', $timeLeft);
            }
            if($hours == 1 || $hour_only == 1){
                $timeLeft = str_replace('Hours', 'Hour', $timeLeft);
                $timeLeft = str_replace('Hs', 'H', $timeLeft);
            }
            if($minutes == 1 || $min_only == 1){
                $timeLeft = str_replace('Minutes', 'Minute', $timeLeft);
                $timeLeft = str_replace('Mins', 'Min', $timeLeft);
                $timeLeft = str_replace('Ms', 'M', $timeLeft);
            }

          return $timeLeft;
        }
    }


    function rel_time($from, $to = null) {
        $to = (($to === null) ? (time()) : ($to));
        $to = ((is_int($to)) ? ($to) : (strtotime($to)));
        $from = ((is_int($from)) ? ($from) : (strtotime($from)));

        $units = array
            (
            "year" => 29030400, // seconds in a year   (12 months)
            "month" => 2419200, // seconds in a month  (4 weeks)
            "week" => 604800, // seconds in a week   (7 days)
            "day" => 86400, // seconds in a day    (24 hours)
            "hour" => 3600, // seconds in an hour  (60 minutes)
            "minute" => 60, // seconds in a minute (60 seconds)
            "second" => 1         // 1 second
        );

        $diff = abs($from - $to);
//        $suffix = (($from > $to) ? ("from now") : ("ago"));
        $suffix =  "ago";
$output = '';
        foreach ($units as $unit => $mult)
            if ($diff >= $mult) {
                $and = (($mult !=0) ? ("") : ("and "));
                $output .= ", " . $and . intval($diff / $mult) . " " . $unit . ((intval($diff / $mult) == 1) ? ("") : ("s"));
                $diff -= intval($diff / $mult) * $mult;
            }
        $output .= " " . $suffix;
        $output = substr($output, strlen(", "));

        return $output;
    }

	public function getUrlHashForProperties($inputy_array){
		if(is_array($inputy_array)){
			return urlencode(str_replace("+","LQTRSV",preg_replace("/\//","TQRALLARQT",$this->encrypt(serialize(implode(',',$inputy_array)),'propertiesurls!@'))));
		}else return false;
	}

	public function getClean($str){
		if(!$str) return false;
		return strtolower(preg_replace('/[^a-zA-Z0-9-]/', '_', trim($str)));
	}

	public function getMD5($str){
		if(!$str) return false;
		return md5($str);		
	}

	function encrypt($string, $key) {
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result.=$char;
        }
        return base64_encode($result);
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

	function _ago($cur_time, $tm, $rcs = 0) {
		$cur_tm = $cur_time; $dif = $cur_tm-$tm;
		$pds = array('second','minute','hour','day','week','month','year','decade');
		$lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
		for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);
		
		$no = floor($no); if($no <> 1) $pds[$v] .='s'; $x=sprintf("%d %s ",$no,$pds[$v]);
		if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm);
		return $x;
	}


	function timeago($referencedate=0, $timepointer='', $measureby='', $autotext=true){    ## Measureby can be: s, m, h, d, or y
		if($timepointer == '') $timepointer = time();
		$Raw = $timepointer-$referencedate;    ## Raw time difference
		$Clean = abs($Raw);
		$calcNum = array(array('s', 60), array('m', 60*60), array('h', 60*60*60), array('d', 60*60*60*24), array('y', 60*60*60*24*365));    ## Used for calculating
		$calc = array('s' => array(1, 'second'), 'm' => array(60, 'minute'), 'h' => array(60*60, 'hour'), 'd' => array(60*60*24, 'day'), 'y' => array(60*60*24*365, 'year'));    ## Used for units and determining actual differences per unit (there probably is a more efficient way to do this)
		
		if($measureby == ''){    ## Only use if nothing is referenced in the function parameters
			$usemeasure = 's';    ## Default unit
		
			for($i=0; $i<count($calcNum); $i++){    ## Loop through calcNum until we find a low enough unit
				if($Clean <= $calcNum[$i][1]){        ## Checks to see if the Raw is less than the unit, uses calcNum b/c system is based on seconds being 60
					$usemeasure = $calcNum[$i][0];    ## The if statement okayed the proposed unit, we will use this friendly key to output the time left
					$i = count($calcNum);            ## Skip all other units by maxing out the current loop position
				}        
			}
		}else{
			$usemeasure = $measureby;                ## Used if a unit is provided
		}
		
		$datedifference = floor($Clean/$calc[$usemeasure][0]);    ## Rounded date difference
		
		if($autotext==true && ($timepointer==time())){
			if($Raw < 0){
				$prospect = ' from now';
			}else{
				$prospect = ' ago';
			}
		}
		
		if($referencedate != 0){        ## Check to make sure a date in the past was supplied
			if($datedifference == 1){    ## Checks for grammar (plural/singular)
				return $datedifference . ' ' . $calc[$usemeasure][1] . ' ' . $prospect;
			}else{
				return $datedifference . ' ' . $calc[$usemeasure][1] . 's ' . $prospect;
			}
		}else{
			return 'No input time referenced.';
		}
	}

	function sanitizeInput($str){
		if(!$str) return false;
		return htmlentities ( trim ( strip_tags( $str ) ) , ENT_NOQUOTES ) ;
	}

	public function getFBInstance(){
		$redirect_to = '';
        include_once 'facebook/src/facebook.php';
        // Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
                    'appId' => $this->app_id,
                    'secret' => $this->secret_key,
                    'cookie' => true
                ));
		return $facebook;
	}

	public function getFBLoggedinStatus(){
		$facebook = $this->getFBInstance();
/*		print '<pre>';
		print_R($facebook->getSession());
		print '</pre>';
		exit(0);*/
		//print_R($facebook->getSession());
		if ($facebook->getUser())
			return true;
		else return false;

	}


	function sendToFB($attachment){
		if(!$attachment) return false;
		$facebook = $this->getFBInstance();
		$user = $facebook->getUser();
		//print '****'.$user;
		//exit(0);
		$result = $facebook->api('/me/feed/','post',$attachment);

		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.
		$user_profile = array();
		if ($user) {
			try {
				// Proceed knowing you have a logged in user who's authenticated.
				$user_profile = $facebook->api('/me');
				$this->registry->template->user_profile = $user_profile;
			} catch (FacebookApiException $e) {
				print_R($e);
				error_log($e);
				$user = null;
			}
		}
		if(count($user_profile) > 0){			
			$return_arr = array('msg' => 'users_string', 'data' => '', 'isfb' =>$user_profile['id']);
            echo json_encode($return_arr);
		}
	}


	function genPagination($total_pages, $page, $targetpage, $nextPrev=true, $limit=10) {
		$adjacents = 2;
		/* Setup page vars for display. */
		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
		
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<div class=\"pagination\">";
			//previous button
			if ($page > 1) 
				$pagination.= "<a href='".$targetpage."page/".$prev."'>&#171;&nbsp;Previous</a>";
			else
				$pagination.= "<span class=\"disabled\">&#171;&nbsp;Previous</span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">".$counter."</span>";
					else
						$pagination.= "<a href='".$targetpage."page/".$counter."'>".$counter."</a>";
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href='".$targetpage."page/".$counter."'>".$counter."</a>";
					}
					$pagination.= "...";
					$pagination.= "<a href='".$targetpage."page/".$lpm1."'>".$lpm1."</a>";
					$pagination.= "<a href='".$targetpage."page/".$lastpage."'>".$lastpage."</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href='".$targetpage."page/1' >1</a>";
					$pagination.= "<a href='".$targetpage."page/2' >2</a>";
					$pagination.= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">".$counter."</span>";
						else
							$pagination.= "<a href='".$targetpage."page/".$counter."'>".$counter."</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href='".$targetpage."page/".$lpm1."'>".$lpm1."</a>";
					$pagination.= "<a href='".$targetpage."page/".$lastpage."'>".$lastpage."</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href='".$targetpage."page/1'>1</a>";
					$pagination.= "<a href='".$targetpage."page/2'>2</a>";
					$pagination.= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">".$counter."</span>";
						else
							$pagination.= "<a href='".$targetpage."page/".$counter."'>".$counter."</a>";
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href='".$targetpage."page/".$next."'>Next&nbsp;&#187;</a>";
			else
				$pagination.= "<span class=\"disabled\">Next&nbsp;&#187;</span>";
			$pagination.= "</div>\n";		
		}
		return $pagination;
	}



function distance_of_time_in_words($from_time, $to_time = null, $include_seconds = false){
	$to_time = $to_time? $to_time: time(); 
	$distance_in_minutes = floor(abs($to_time - $from_time) / 60);
	$distance_in_seconds = floor(abs($to_time - $from_time));
 
	  $string = '';
	  $parameters = array();
	 
	  if ($distance_in_minutes <= 1){
		if (!$include_seconds){
		  $string = $distance_in_minutes == 0 ? 'less than a minute' : '1 minute';
		}else{
		  if ($distance_in_seconds <= 5){
			$string = '5 seconds ago';
		  }else if ($distance_in_seconds >= 6 && $distance_in_seconds <= 10){
			$string = '10 seconds ago';
		  }else if ($distance_in_seconds >= 11 && $distance_in_seconds <= 20){
			$string = '20 seconds ago';
		  }else if ($distance_in_seconds >= 21 && $distance_in_seconds <= 40){
			$string = 'half a minute ago';
		  }else if ($distance_in_seconds >= 41 && $distance_in_seconds <= 59){
			$string = 'less than a minute ago';
		  }else{
			$string = '1 minute ago';
		  }
		}
	  }else if ($distance_in_minutes >= 2 && $distance_in_minutes <= 44){
		$string = '%minutes% minutes ago';
		$parameters['%minutes%'] = $distance_in_minutes;
	  }else if ($distance_in_minutes >= 45 && $distance_in_minutes <= 89){
		$string = 'about 1 hour ago';
	  }else if ($distance_in_minutes >= 90 && $distance_in_minutes <= 1439){
		$string = 'about %hours% hours ago' ;
		$parameters['%hours%'] = round($distance_in_minutes / 60);
	  }else if ($distance_in_minutes >= 1440 && $distance_in_minutes <= 2879){
		$string = '1 day ago';
	  }else if ($distance_in_minutes >= 2880 && $distance_in_minutes <= 43199){
		$string = '%days% days ago';
		$parameters['%days%'] = round($distance_in_minutes / 1440);
	  }else if ($distance_in_minutes >= 43200 && $distance_in_minutes <= 86399){
		$string = 'about 1 month ago';
	  }else if ($distance_in_minutes >= 86400 && $distance_in_minutes <= 525959){
		$string = '%months% months';
		$parameters['%months%'] = round($distance_in_minutes / 43200);
	  }else if ($distance_in_minutes >= 525960 && $distance_in_minutes <= 1051919){
		$string = 'about 1 year ago';
	  }else{
		$string = 'over %years% years ago';
		$parameters['%years%'] = floor($distance_in_minutes / 525960);
	  }	 
	  return strtr($string, $parameters);
}


function remove_accent($str) { 
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ'); 
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o'); 
  return str_replace($a, $b, $str); 
}

 function _splitLongString($string, $max="") {		
		$max = ($max) ? $max : $this->max_str_len;
		return preg_replace( '/([^\s]{'.$max.'})(?=[^\s])/', '$1<wbr>', ($string));		
	}//end _splitLongString()



	function genPagination1($total_pages, $page, $targetpage, $nextPrev=true, $limit=10) {
		$adjacents = 2;
		/* Setup page vars for display. */
		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
		
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<div class=\"pagination\">";
			//previous button
			if ($page > 1) 
				$pagination.= "<a href='".$targetpage."page/".$prev."'>&#171;&nbsp;Previous</a>";
			else
				$pagination.= "<span class=\"disabled\">&#171;&nbsp;Previous</span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">".$counter."</span>";
					else
						$pagination.= "<a href='".$targetpage."page/".$counter."'>".$counter."</a>";
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href='".$targetpage."page/".$counter."'>".$counter."</a>";
					}
					$pagination.= "...";
					$pagination.= "<a href='".$targetpage."page/".$lpm1."'>".$lpm1."</a>";
					$pagination.= "<a href='".$targetpage."page/".$lastpage."'>".$lastpage."</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href='".$targetpage."page/1' >1</a>";
					$pagination.= "<a href='".$targetpage."page/2' >2</a>";
					$pagination.= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">".$counter."</span>";
						else
							$pagination.= "<a href='".$targetpage."page/".$counter."'>".$counter."</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href='".$targetpage."page/".$lpm1."'>".$lpm1."</a>";
					$pagination.= "<a href='".$targetpage."page/".$lastpage."'>".$lastpage."</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href='".$targetpage."page/1'>1</a>";
					$pagination.= "<a href='".$targetpage."page/2'>2</a>";
					$pagination.= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">".$counter."</span>";
						else
							$pagination.= "<a href='".$targetpage."page/".$counter."'>".$counter."</a>";
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href='".$targetpage."page/".$next."'>Next&nbsp;&#187;</a>";
			else
				$pagination.= "<span class=\"disabled\">Next&nbsp;&#187;</span>";
			$pagination.= "</div>\n";		
		}
		return $pagination;
	}

	function neat_trim($str, $n, $delim='…') {
	   $len = strlen($str);
	   if ($len > $n) {
		   preg_match('/(.{' . $n . '}.*?)\b/', $str, $matches);
		   return rtrim($matches[1]) . $delim;
	   }
	   else {
		   return $str;
	   }
	}


	//return date time in IST format
	public function getTimeInLocalTimeZone($date_time, $server_time = ''){
		if(!$date_time) return false;
		$server_time = ($server_time) ? $server_time : time();
		$system_timezone = date_default_timezone_get();
		date_default_timezone_set("GMT");
		$gmt = date("Y-m-d h:i:s A");
		$local_timezone = 'Asia/Kolkata';
		date_default_timezone_set($local_timezone);
		$local_time = date("Y-m-d h:i:s A");
		date_default_timezone_set($system_timezone);
		$diff = (strtotime($local_time) - strtotime($gmt));
		$date = new DateTime($date_time);
		$date->modify("+$diff seconds");
		$timestamp = $date->format("d-m-Y H:i:s");
		return $this->distance_of_time_in_words(strtotime($timestamp), $server_time);
	}

}

/* * * end of class ** */
?>
