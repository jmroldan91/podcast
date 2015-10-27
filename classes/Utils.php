<?php

class Utils {
    
    static function redirect($dest = null, $end=TRUE){
        if($dest===null){
            $dest = '../index.php'; 
        }
        header('Location: '.$dest);
        if($end){
            exit();        
        }
    }
    
    static function queryToArray($query){
        $result = array();
        $campos = explode("&", $query);
        foreach ($campos as $item) {
            $campo = explode("=", $item);
            for($i=0;$i<count($campo);$i++){
                $result[$campo[$i]] = $campo[++$i];
            }
        }
        return $result;
    }
    
    static function ArrayToQuery($array){
        $result = "";
        foreach ($array as $key => $value) {
            $result .= $key . '=' . $value . '&';
        }
        return substr($result, 0,-1);
    }
        
    static function strNormailze($goodName){
	if (strlen($goodName) > 30) {
            $goodName =  substr($name, 0, 30);
        }        
        $goodName = str_replace("'", '', $goodName);
        $goodName = str_replace('"', '', $goodName);
        $goodName = str_replace('/', ' ', $goodName);
        $goodName = str_replace('á', 'a', $goodName);
        $goodName = str_replace('é', 'e', $goodName);
        $goodName = str_replace('í', 'i', $goodName);
        $goodName = str_replace('ó', 'o', $goodName);
        $goodName = str_replace('ú', 'u', $goodName);
        
        return $goodName;
    }
}
