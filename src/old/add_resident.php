<?php
require_once (dirname(__FILE__) . '/html_parts.php');

$parts = new html_parts();
$add_new = new add_new();
$page = 'add_new';
$lang = 'eng';

$parts->html_header($page);
$add_new->set_content($lang);
$parts->html_footer($page);


class add_new{
    
    protected $arr_country = ['',
                            'Thailand|תאילנד', 
                            'Eritrea|אריתראה', 
                            'Ethiopia|אתיופיה', 
                            'Sri Lanca|סרי לנקה', 
                            'Philippines|פיליפינים', 
                            'Nepal|נפאל',
                            'Vietnam|וייטנאם',
                            'Ghana|גאנה',
                            'India|הודו',
                            'Sudan|סודן',
                            'China|סין',
                            'Ukraine|אוקראינה'];
    
    protected $arr_birth = [];


    protected $arr_mar_status = ['',
                                'Single|רווק', 
                                'Married|נשוי', 
                                'Divorced|גרוש', 
                                'Widower|אלמן'];
    
    protected $arr_kids = [0,1,2,3,4,5,6,7,8,9,10];
    
    protected $arr_education = ['1|1',
                                '2|2',
                                '3|3',
                                '4|4',
                                '5|5',
                                '6|6',
                                '7|7',
                                '8|8',
                                '9|9',
                                '10|10',
                                '11|11',
                                '12|12',
                                '13|13',
                                '14|14',
                                '15|15',
                                'Studied in University|למד באוניברסיטה',
                                'BA|תואר ראשון',
                                'No education|לא למד',
                                'Unknown|לא ידוע'];
    
    protected $arr_occupation = ['',
                                 'Farmer|חקלאי',
                                 'Teacher|מורה'];
    
    protected $arr_ref_reason = ['Witness|אדות',
                                 'Slavery|עבדות', 
                                 'Forced labor|עבודות כפייה',
                                 'Sexual services|שרותי מין'];
    
    protected $arr_leave_reason = ['',
                                   'employed|הושם אצל מעסיק', 
                                   'left shelter and hasn\'t come back|יצא מהמקלט ולא חזר'];
    
    protected $arr_case = ['',
                           'Kfar Maimon|כפר מימון', 
                           'Moshav Yesha|מושב ישע'];
    
    protected $arr_ref_authority = ['',
                                    'Lahav unit|יחידת להב'];
    
            
    function set_content($lang){
        
        $h1 = 'New resident reception form';
        ?>
        <div class="add_new_form">
            <h1 class="centered"><?php echo $h1; ?></h1>
            <div class="form_wrap">
                <div>
                    <span>ID:</span>
                    <input type="text" class="resident_id">
                </div>
                <div>
                    <span>First name in english:</span>
                    <input type="text" class="fname_eng">
                </div>
                <div>
                    <span>First name in hebrew:</span>
                    <input type="text" class="fname_heb">
                </div>
                <div>
                    <span>Last name in english:</span>
                    <input type="text" class="lname_eng">
                </div>
                <div>
                    <span>Last name in hebrew:</span>
                    <input type="text" class="lname_heb">
                </div>
                <div>
                    <span>Additional name in english:</span>
                    <input type="text" class="opt_name_eng">
                </div>
                <div>
                    <span>Additional name in hebrew:</span>
                    <input type="text" class="opt_name_heb">
                </div>
                <div>
                    <span>Year of birth:</span>
                    <?php $this->print_dropdown_single('birth', 'dropdown_year_birth'); ?>
<!--                    <input type="text" class="datepicker bdate" name="birthdate">-->
                </div>
                <div>
                    <span>Country:</span>
                    <?php $this->print_dropdown_double('country', $lang, 'dropdown_country'); ?>
                </div>
                <div>
                    <span>Marital status:</span>
                    <?php $this->print_dropdown_double('status', $lang, 'dropdown_status'); ?>
                </div>
                <div>
                    <span>Kids:</span>
                    <?php $this->print_dropdown_single('kids', 'dropdown_kids'); ?>
                </div>
                <div>
                    <span>Education:</span>
                    <?php $this->print_dropdown_double('education', $lang, 'dropdown_education'); ?>
                </div>
                <div>
                    <span>Occupation:</span>
                    <?php $this->print_dropdown_double('occupation', $lang, 'dropdown_occupation'); ?>
                </div>
                <div>
                    <span class="block span_ref_reason">Referral reason</span>
                    <?php $this->print_ref_reason($lang); ?>
                </div>
                <div>
                    <span>Case:</span>
                    <?php $this->print_dropdown_double('case', $lang, 'dropdown_case'); ?>
                </div>
                <div>
                    <span>Referral Authority:</span>
                    <?php $this->print_dropdown_double('ref_authority', $lang, 'dropdown_authority'); ?>
                </div>
                <div>
                    <span>Check in:</span>
                    <input type="text" class="checkin_date datepicker" name="checkin">
                </div>
                <div>
                    <span>Check out:</span>
                    <input type="text" class="checkout_date datepicker" name="checkout">
                </div>
                <div>
                    <span>Check out reason:</span>
                    <?php $this->print_dropdown_double('leave_reason', $lang, 'dropdown_leave_reason'); ?>
                </div>
                <div>
                    <span>Employment (english):</span>
                    <input type="text" class="input_employment_eng">
                </div>
                <div>
                    <span>Employment (hebrew):</span>
                    <input type="text" class="input_employment_heb">
                </div>
                <div class="return_method_wrap">
                    <span>Returned to origin country:</span>
                    <input type="radio" name="return_method" id="return1" value="by himself|עצמאית"><label for="return1">By himself</label>
                    <input type="radio" name="return_method" id="return2" value="voluntary|מרצון"><label  for="return2">Voluntary</label>
                    <input type="radio" name="return_method" id="return3" value="no|לא"><label for="return3">No</label>
                </div>
                <div>
                    <span>Left Israel to origin country in:</span>
                    <input type="text" class="homeland_return_date datepicker" name="homeland_return">
                </div>
                <div>
                    <span>Specialty obtained (english):</span>
                    <input type="text" class="input_specialty_obtained_eng">
                </div>
                <div>
                    <span>Specialty obtained (hebrew):</span>
                    <input type="text" class="input_specialty_obtained_heb">
                </div>
                <div class="btn_wrap">
                    <span class="btn btn_submit res_insert"><span>Insert resident</span></span>
                    <span class="btn btn_submit res_clear"><span>Clear</span></span>
                    <span class="btn btn_submit res_exit"><span>Exit</span></span>
                </div>
            </div>
        </div>
        <?php
    }
    
    
    function print_dropdown_double($type, $lang, $cl_list = ''){
        switch ($type){
            case 'country':
                $arr = $this->arr_country;
                break;
            case 'status':
                $arr = $this->arr_mar_status;
                break;
            case 'education':
                $arr = $this->arr_education;
                break;
            case 'occupation':
                $arr = $this->arr_occupation;
                break;
            case 'leave_reason':
                $arr = $this->arr_leave_reason;
                break;
            case 'case':
                $arr = $this->arr_case;
                break;
            case 'ref_authority':
                $arr = $this->arr_ref_authority;
                break;
            default:
                $arr = [];
        }
        
        ?>
        <select class="dropdown <?php echo $cl_list; ?>" type="select">
            <?php
            foreach ($arr as $arr_item){
                $temp = explode('|', $arr_item);
                $value = ($lang == 'heb')? $temp[1] : $temp[0];
                ?><option value="<?php echo $arr_item; ?>"><?php echo $value; ?></option><?php
            }
            ?>
        </select>  
        <?php
    }
    
    
    function print_dropdown_single($type, $cl_list = ''){
        
        if($type == 'kids'){
            $arr = $this->arr_kids;
        }elseif ($type == 'birth') {
            $arr[] = '';
            $this_year = (int)date('Y');
            for($i = 1960; $i < $this_year - 10; $i++){
                $arr[] = $i;
            }
        }
        else{
            $arr = [];
        }
        ?>
        <select class="dropdown <?php echo $cl_list; ?>" type="text">
            <?php
            foreach ($arr as $item){
                ?><option value="<?php echo $item; ?>"><?php echo $item; ?></option><?php
            }
            ?>
        </select>
        <?php
    }
    
    
    function print_ref_reason($lang){
        
        $arr = $this->arr_ref_reason;
        $arr_cl_input = ['chk_witness', 'chk_slave', 'chk_labor', 'chk_sexual'];
        $i = 0;
        foreach ($arr as $item){
            $reason = explode('|', $item);
            ?>
            <div>
                <input type="checkbox" class="form_input <?php echo $arr_cl_input[$i]; ?>" id="chk<?php echo $i; ?>" value="<?php echo $item; ?>">
                <label for="chk<?php echo $i; ?>"><?php echo ($lang == 'heb')? $reason[1] : $reason[0]; ?></label>
            </div>
            <?php
            $i++;
        }
    }
    
}