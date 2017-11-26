<?php
/**
 * Gets client's IP and country name
 * Type: logic
 */

class Ip{
    
    /**
     * Gets user's IP
     * @return string $my_ip
     */
    public static function getIp(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $real_ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $real_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        elseif(!empty($_SERVER['REMOTE_ADDR'])) {
            $real_ip = $_SERVER['REMOTE_ADDR'];
        }
        else{
            $real_ip = null;
        }
        $my_ip = ($real_ip == '::1')? 'localhost' : $real_ip;
        return $my_ip;
    } 
    
    /**
     * Gets user's country
     * @param string $ip
     * @return string $country
     */
    public static function getCountry($ip){
        $country = 'United States';
        if($ip == 'localhost' || $ip == '' || $ip == null){
            return $country;
        }
        $ip_range=ip2long($ip);
        if($ip_range == -1 || $ip_range === false){
            return $country;
        }
        if($ip_range < 0){
            $ip_range+= 4294967296;
        }
        $query = 'SELECT `col_6` FROM geo_ips WHERE ' . $ip_range . ' BETWEEN `col_3` AND `col_4` LIMIT 1;';
        $result = GetDbData::getResults($query, 'assoc');
        if(!empty($result)){
            $country = $result[0]['col_6'];
        }
        else{
            $country = 'United States';
        }
        return $country;
    }
}


