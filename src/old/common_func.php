<?php
require_once './conf/ini.php';
require_once './db/db_get_data.php';
require_once './queries.php';
require_once './ip.php';
require_once './conf/constants.php';
require_once './conf/client.php';

class CommonFunc{
    
    
    public function isAjax(){
        $is_ajax = false;
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
           if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
                $is_ajax = true;
            }
            else{
                $is_ajax = false;
            }
        }
        else{
            $is_ajax = false;
        }
        if($is_ajax == false){
            require_once './check_url.php';
            $check_url = new CheckUrl();
            $check_url->stopPageLoad();
        }
    }
    
    
    function getPasswordHash($password_entered, $rounds = 10){
        $crypt_options = ['cost'=>$rounds];
        return password_hash($password_entered, PASSWORD_BCRYPT, $crypt_options);
    }
    
    
    
}