<?php

function removeHashtag($string)  
 {  
      $expression = "/#+([a-zA-Z0-9_]+)/";  
      $string = preg_replace($expression, '', $string);  
      return $string;  
 }

function removeDots($str)
 {
    $res = str_replace( array( '.', ',' ), '', $str);
    return $res;
 }
 
function clear_text($s)
 {
    $do = true;
    while ($do) {
        $start = stripos($s,'<script');
        $stop = stripos($s,'</script>');
        if ((is_numeric($start))&&(is_numeric($stop))) {
            $s = substr($s,0,$start).substr($s,($stop+strlen('</script>')));
        } else {
            $do = false;
        }
    }
    return trim($s);
 }
$xml = simplexml_load_file('http://www.tcmb.gov.tr/kurlar/today.xml');
foreach ($xml->Currency as $Currency)
 {
    if ($Currency['Kod'] == "USD")
     {
        $usd_ES = $Currency->ForexSelling;
        $usd_EA = $Currency->ForexBuying;
    }
}

function tl_hesapla($a)
 { 
    global $usd_ES;
    $a = strtr($a, ',', '.'); 
    $b = strtr($usd_ES, ',', '.'); 
    $ret = $a / $b; 
    return substr(strtr($ret, '.', ','),0, 3); 
   } 

function nice_number($n)
 {
    $n = (0+str_replace(",", "", $n));

    if (!is_numeric($n)) return false;
    if ($n > 1000000000) return round(($n/1000000000), 2).' M';
    elseif ($n > 1000000) return round(($n/1000000), 2).' K';
    elseif ($n > 1000) return round(($n/1000), 2).' $';

    return number_format($n);
}