<?php
require_once './common_func.php';
$func = new CommonFunc();
// Check if current request is ajax call
$func->isAjax();

if(isset($_GET['type']) && isset($_GET['data'])){
    $type = $_GET['type'];
    $data = $_GET['data'];
    
    switch ($type){
        case 'insert_resident':
            $resident_db_handler = new ResidentDbHandler();
            $resident_db_handler->insertResident($data);
            break;
        case 'chart':
            $chart_data = new ChartData($data['chart_id']);
            $chart_data->init();
            break;
        case 'login':
            $username = $data['username'];
            $password = $data['password'];
            $login = new Login();
            $login->verifyClient($username, $password);
    }
}

class ResidentDbHandler{
    
    function insertResident($arr){
//        var_dump($arr);
        $resident_id = ($arr['resident_id'] != '')? $arr['resident_id'] : 0;
        $birth_year = ($arr['birth_year'] != '')? $arr['birth_year'] : 0;
        if($arr['country'] != ''){
            $arr_country = explode('|', $arr['country']);
            $country_eng = $arr_country[0];
            $country_heb = $arr_country[1];
        }
        else{
            $country_eng = $country_heb = '';
        }
        if($arr['status'] != ''){
            $arr_status = explode('|', $arr['status']);
            $status_eng = $arr_status[0];
            $status_heb = $arr_status[1];
        }
        else{
            $status_eng = $status_heb = '';
        }
        $arr_education = explode('|', $arr['education']);
        $education_eng = $arr_education[0];
        $education_heb = $arr_education[1];
        if($arr['occupation'] != ''){
            $arr_occupation = explode('|', $arr['occupation']);
            $occupation_eng = $arr_occupation[0];
            $occupation_heb = $arr_occupation[1];
        }
        else{
            $occupation_eng = $occupation_heb = '';
        }
        $arr_ref_reason = ['eng'=>[], 'heb'=>[]];
        if($arr['is_witness'] != ''){
            $arr_is_witness = explode('|', $arr['is_witness']);
            array_push($arr_ref_reason['eng'], $arr_is_witness[0]);
            array_push($arr_ref_reason['heb'], $arr_is_witness[1]);
        }
        if($arr['is_slave'] != ''){
            $arr_is_slave = explode('|', $arr['is_slave']);
            array_push($arr_ref_reason['eng'], $arr_is_slave[0]);
            array_push($arr_ref_reason['heb'], $arr_is_slave[1]);
        }
        if($arr['is_labor'] != ''){
            $arr_is_labor = explode('|', $arr['is_labor']);
            array_push($arr_ref_reason['eng'], $arr_is_labor[0]);
            array_push($arr_ref_reason['heb'], $arr_is_labor[1]);
        }
        if($arr['is_sexual'] != ''){
            $arr_is_sexual = explode('|', $arr['is_sexual']);
            array_push($arr_ref_reason['eng'], $arr_is_sexual[0]);
            array_push($arr_ref_reason['heb'], $arr_is_sexual[1]);
        }
        $ref_reason_eng = implode(',', $arr_ref_reason['eng']);
        $ref_reason_heb = implode(',', $arr_ref_reason['heb']);
        if($arr['ref_case'] != ''){
            $arr_ref_case = explode('|', $arr['ref_case']);
            $ref_case_eng = $arr_ref_case[0];
            $ref_case_heb = $arr_ref_case[1];
        }
        else{
            $ref_case_eng = $ref_case_heb = '';
        }
        if($arr['ref_authority'] != ''){
            $arr_ref_authority = explode('|', $arr['ref_authority']);
            $ref_authority_eng = $arr_ref_authority[0];
            $ref_authority_heb = $arr_ref_authority[1];
        }
        else{
            $ref_authority_eng = $ref_authority_heb = '';
        }
        if($arr['check_out_reason'] != ''){
            $arr_leave_reason = explode('|', $arr['check_out_reason']);
            $leave_reason_eng = $arr_leave_reason[0];
            $leave_reason_heb = $arr_leave_reason[1];
        }
        else{
            $leave_reason_eng = $leave_reason_heb = '';
        }
        if($arr['return_method'] != ''){
            $arr_return_method = explode('|', $arr['return_method']);
            $return_method_eng = $arr_return_method[0];
            $return_method_heb = $arr_return_method[1];
        }
        else{
            $return_method_eng = $return_method_heb = '';
        }
        $check_in_date = $this->convertDateForDb($arr['check_in_date']);
        $check_out_date = $this->convertDateForDb($arr['check_out_date']);
        $return_date = $this->convertDateForDb($arr['return_date']);
        
        $q = 'INSERT INTO residents('
                . 'resident_id,'
                . 'first_name_eng,'
                . 'last_name_eng,'
                . 'opt_name_eng,'
                . 'first_name_heb,'
                . 'last_name_heb,'
                . 'opt_name_heb,'
                . 'country_eng,'
                . 'country_heb,'
                . 'year_of_birth,'
                . 'marital_status_eng,'
                . 'marital_status_heb,'
                . 'children,'
                . 'education_eng,'
                . 'education_heb,'
                . 'occupation_eng,'
                . 'occupation_heb,'
                . 'ref_reason_eng,'
                . 'ref_reason_heb,'
                . 'case_eng,'
                . 'case_heb,'
                . 'referral_authority_eng,'
                . 'referral_authority_heb,'
                . 'in_date,'
                . 'out_date,'
                . 'leave_reason_eng,'
                . 'leave_reason_heb,'
                . 'employed_eng,'
                . 'employed_heb,'
                . 'homeland_return_method_eng,'
                . 'homeland_return_method_heb,'
                . 'homeland_return_date,'
                . 'prof_gain_eng,'
                . 'prof_gain_heb) '
                . 'VALUES'
                . '('.$resident_id.', '
                . '"'.$arr['fname_eng'].'", '
                . '"'.$arr['lname_eng'].'", '
                . '"'.$arr['opt_name_eng'].'", '
                . '"'.$arr['fname_heb'].'", '
                . '"'.$arr['lname_heb'].'", '
                . '"'.$arr['opt_name_heb'].'", '
                . '"'.$country_eng.'", '
                . '"'.$country_heb.'", '
                . $birth_year.', '
                . '"'.$status_eng.'", '
                . '"'.$status_heb.'", '
                . $arr['kids'].', '
                . '"'.$education_eng.'", '
                . '"'.$education_heb.'", '
                . '"'.$occupation_eng.'", '
                . '"'.$occupation_heb.'", '
                . '"'.$ref_reason_eng.'", '
                . '"'.$ref_reason_heb.'", '
                . '"'.$ref_case_eng.'", '
                . '"'.$ref_case_heb.'", '
                . '"'.$ref_authority_eng.'", '
                . '"'.$ref_authority_heb.'", '
                . '"'.$check_in_date.'", '
                . '"'.$check_out_date.'", '
                . '"'.$leave_reason_eng.'", '
                . '"'.$leave_reason_heb.'", '
                . '"'.$arr['employment_eng'].'", '
                . '"'.$arr['employment_heb'].'", '
                . '"'.$return_method_eng.'", '
                . '"'.$return_method_heb.'", '
                . '"'.$return_date.'", '
                . '"'.$arr['spec_obt_eng'].'", '
                . '"'.$arr['spec_obt_heb'].'") ';
//        echo $q;
        GetDbData::execute($q);
        echo 'Inserted';
    }
    
    
    function convertDateForDb($date){
        return implode('-', array_reverse(explode('/', $date)));
    }
}


class ChartData{
    
    private $chart_name;
    
    public function __construct($chart_name) {
        $this->chart_name = $chart_name;
    }
    
    function init(){
        $arr = [];
        switch ($this->chart_name){
            case 'country':
                $q = 'SELECT COUNT(*) AS `nr`, country '
                    . 'FROM residents '
                    . 'GROUP BY country ORDER BY `nr` DESC';
                $arr['cols'] = [
                                    ['id'=>'1', 'label'=>'Country', 'pattern'=>'', 'type'=>'string'], 
                                    ['id'=>'2', 'label'=>'Quantity', 'pattern'=>'', 'type'=>'number']
                                ];
                $col = 'country';
                break;
            case 'status':
                $q = 'SELECT COUNT(*) AS `nr`, status '
                    . 'FROM residents AS t1 '
                    . 'INNER JOIN statuses AS t2 ON t1.marital_status = t2.id '
                    . 'GROUP BY status ORDER BY `nr` DESC';
                $arr['cols'] = [
                                    ['id'=>'1', 'label'=>'Marital Status', 'pattern'=>'', 'type'=>'string'], 
                                    ['id'=>'2', 'label'=>'Quantity', 'pattern'=>'', 'type'=>'number']
                                ];
                $col = 'status';
                break;
            case 'birth':
                $q = 'SELECT COUNT(*) AS `nr`, birth_year '
                    . 'FROM residents '
                    . 'GROUP BY birth_year ORDER BY `nr` DESC';
                $arr['cols'] = [
                                    ['id'=>'1', 'label'=>'Year of Birth', 'pattern'=>'', 'type'=>'string'], 
                                    ['id'=>'2', 'label'=>'Quantity', 'pattern'=>'', 'type'=>'number']
                                ];
                $col = 'birth_year';
                break;
        }
        if(empty($arr)) return;
//        echo $q;
        $res = GetDbData::getResults($q, 'assoc');
        foreach ($res as $row){
            $arr['rows'][] = ['c'=>[['v'=>$row[$col], 'f'=>null],['v'=>$row['nr'], 'f'=>null]]];
        }
        
//        $arr = ['cols'=>[
//                                ['id'=>'1', 'label'=>'Country', 'pattern'=>'', 'type'=>'string'], 
//                                ['id'=>'2', 'label'=>'Quantity', 'pattern'=>'', 'type'=>'number']
//                            ],
//
//                    'rows'=>[
//                                ['c'=>[['v'=>'Eritrea', 'f'=>null],['v'=>83, 'f'=>null]]],
//                                ['c'=>[['v'=>'Thailand', 'f'=>null],['v'=>145, 'f'=>null]]],
//                                ['c'=>[['v'=>'Nepal', 'f'=>null],['v'=>13, 'f'=>null]]],
//                                ['c'=>[['v'=>'Sri Lanka', 'f'=>null],['v'=>9, 'f'=>null]]],
//                                ['c'=>[['v'=>'India', 'f'=>null],['v'=>6, 'f'=>null]]]
//                            ]
//                   ];
        echo json_encode($arr);
    }
}


class Login{
    
    function verifyClient($username, $password){
        $stored_hash_res = GetDbData::getResults('SELECT password FROM client_accounts WHERE username = "'.$username.'" LIMIT 1', 'assoc');
        if(empty($stored_hash_res)){
            echo '0';
            return false;
        }
        $stored_hash = $stored_hash_res[0]['password'];
//        $hash = $func->getPasswordHash($password);
        if(password_verify($password, $stored_hash)){
            echo '1';
        }
        else{
            echo '0';
        }
    }
}