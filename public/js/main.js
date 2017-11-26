addDotimeout();

var abs_url = $('.controller').attr('data-abs-url');
var page = $('.controller').attr('data-page');
var google;
var drag_item_src = null;


$(document).ready(function (){
    
//    $( ".dropdown" ).selectmenu();
    $(".datepicker").datepicker({
        dateFormat: 'dd/mm/yy'
    });
    
    if(page === 'statistics'){
        var charts = {0:['country','pie','Residents\' origin country'], 
                      1:['status','pie','Marital Status'],
                      2:['birth','col','Year of Birth']};
        // Load the Visualization API and the chart package.
        google.charts.load('current', {'packages':['corechart']});
        $.each(charts, function(key, arr){
            $('#charts').append('<div id="chart_'+arr[0]+'"></div>');
            $('#chart_'+arr[0]).prepend('<span class="green_spinner"></span>');
            loadChart(arr);
        });
        
    }
    
    
    $('.login_submit').click(function(){
        login();
    });
    $('.login_password').keyup(function(event){
        if(event.keyCode === 13){
            login();
        }
    });
    $('.login_username').keyup(function(event){
        if(event.keyCode === 13){
            login();
        }
    });
    
    
    // Resident insert
//    $('.fname_eng').keyup(function(){
//        if(validateInput('alpha_eng', $(this).val())){
//            console.dir('good');
//        }
//        else{
//            console.dir('bad');
//        }
//    });
    
    $('.res_insert').click(function(){
        var resident_id = $('.resident_id').val();
        var fname_eng = $('.fname_eng').val();
        var fname_heb = $('.fname_heb').val();
        var lname_eng = $('.lname_eng').val();
        var lname_heb = $('.lname_heb').val();
        var opt_name_eng = $('.opt_name_eng').val();
        var opt_name_heb = $('.opt_name_heb').val();
        var birth_year = $('.dropdown_year_birth').val();
        var country = $('.dropdown_country').val();
        var marital_status = $('.dropdown_status').val();
        var kids = $('.dropdown_kids').val();
        var education = $('.dropdown_education').val();
        var occupation = $('.dropdown_occupation').val();
        // Referral reason:
        var is_witness = ($('.chk_witness').is(':checked') !== false)? $('.chk_witness').attr('value') : null;
        var is_slave = ($('.chk_slave').is(':checked') !== false)? $('.chk_slave').attr('value') : null;
        var is_labor = ($('.chk_labor').is(':checked') !== false)? $('.chk_labor').attr('value') : null;
        var is_sexual = ($('.chk_sexual').is(':checked') !== false)? $('.chk_sexual').attr('value') : null;
        var ref_case = $('.dropdown_case').val();
        var ref_authority = $('.dropdown_authority').val();
        var check_in_date = $('.checkin_date').val();
        var check_out_date = $('.checkout_date').val();
        var check_out_reason = $('.dropdown_leave_reason').val();
        var employment_eng = $('.input_employment_eng').val();
        var employment_heb = $('.input_employment_heb').val();
        var return_method = ($('.return_method_wrap input[type="radio"]:checked').length !== 0)? $('.return_method_wrap input[type="radio"]:checked').attr('value') : null;
        var return_date = $('.homeland_return_date').val();
        var specialty_obtained_eng = $('.input_specialty_obtained_eng').val();
        var specialty_obtained_heb = $('.input_specialty_obtained_heb').val();

        var arr_resident = {'resident_id':resident_id,
                            'fname_eng':fname_eng,
                            'fname_heb':fname_heb,
                            'lname_eng':lname_eng,
                            'lname_heb':lname_heb,
                            'opt_name_eng':opt_name_eng,
                            'opt_name_heb':opt_name_heb,
                            'birth_year':birth_year,
                            'country':country,
                            'status':marital_status,
                            'kids':kids,
                            'education':education,
                            'occupation':occupation,
                            'is_witness':is_witness,
                            'is_slave':is_slave,
                            'is_labor':is_labor,
                            'is_sexual':is_sexual,
                            'ref_case':ref_case,
                            'ref_authority':ref_authority,
                            'check_in_date':check_in_date,
                            'check_out_date':check_out_date,
                            'check_out_reason':check_out_reason,
                            'employment_eng':employment_eng,
                            'employment_heb':employment_heb,
                            'return_method':return_method,
                            'return_date':return_date,
                            'spec_obt_eng':specialty_obtained_eng,
                            'spec_obt_heb':specialty_obtained_heb};
        
//        if(!checkInput()){
//            return false;
//        }
        
        addResident(arr_resident);
        
//        console.dir(fname_eng);
//        console.dir(fname_heb);
//        console.dir(lname_eng);
//        console.dir(lname_heb);
//        console.dir(opt_name_eng);
//        console.dir(opt_name_heb);
//        console.dir(resident_id);
//        console.dir(birth_year);
//        console.dir(country);
//        console.dir(marital_status);
//        console.dir(kids);
//        console.dir(education);
//        console.dir(occupation);
//        console.dir(is_slave);
//        console.dir(is_labor);
//        console.dir(is_sexual);
//        console.dir(check_in_date);
//        console.dir(check_out_date);
//        console.dir(check_out_reason);
//        console.dir(employment_eng);
//        console.dir(employment_heb);
//        console.dir(return_method);
//        console.dir(specialty_obtained_eng);
//        console.dir(specialty_obtained_heb);
    });
    
    
    var dragged_items = $('.drag_item_src');
    [].forEach.call(dragged_items, function(item) {
        item.addEventListener('dragstart', handleDragStart, false); // start moving element
        item.addEventListener('drag', handleDrag, false); // dragged element being moved
        item.addEventListener('dragend', handleDragEnd, false); // dragged element is released
    });
    
    var drop_targets = $('.drag_dest');
    [].forEach.call(drop_targets, function(target) {
        target.addEventListener('dragenter', handleDragEnter, false); // draggable item enters a droppable area
        target.addEventListener('dragover', handleDragOver, false); // dragged item event
        target.addEventListener('dragleave', handleDragLeave, false); // draggable item leaves droppable area
        target.addEventListener('drop', handleDrop, false); // dragged item event
    });
    
//    $('.drag_item_src').each(function(item){

//        $(this).addEventListener('dragenter', handleDragEnter, false); // drop target event
//        $(this).addEventListener('dragover', handleDragOver, false); // drop target event
//        $(this).addEventListener('dragleave', handleDragLeave, false); // drop target event
//        $(this).addEventListener('drop', handleDrop, false); // drop target event
//    });

});


function checkInput(){
    var error_msg = 'Incorrect input, see below:<br>';
    if(!validateInput('alpha_eng', fname_eng)){
        error_msg += 'First name in english must be in latin letters only!<br>';
    }
    if(!validateInput('alpha_heb', fname_heb)){
        error_msg += 'First name in hebrew must be in hebrew letters only!<br>';
    }
    if(!validateInput('alpha_eng', lname_eng)){
        error_msg += 'Last name in english must be in latin letters only!<br>';
    }
    if(!validateInput('alpha_heb', lname_heb)){
        error_msg += 'Last name in hebrew must be in hebrew letters only!<br>';
    }
    if(!validateInput('alpha_eng', opt_name_eng)){
        error_msg += 'Additional name in english must be in hebrew letters only!<br>';
    }
    if(!validateInput('alpha_heb', opt_name_heb)){
        error_msg += 'Additional name in hebrew must be in hebrew letters only!<br>';
    }
}



function validateInput(type, string) {
    var pattern;
    switch (type){
        case 'alpha_eng':
            pattern = /^[a-zA-Z\s]+$/;
            break;
        case 'alpha_heb':
            pattern = /^[א-ת\s]+$/;
            break;
        case 'num':
            pattern = /^[0-9]+$/;
            break;
    }
    return pattern.test(string);
}


function addResident(arr_resident){
//    console.dir(arr_resident);
    $.ajax({
        url: abs_url+"ajax_func.php",
        type: "get",
        cache: false,
        data: {'type':'insert_resident',  'data':arr_resident},
        success: function (response) {
            if(response !== ''){
                console.dir(response);
            }
        }
    });
}


function loadChart(row){
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var arr = {'chart_id':row[0]};
        
        $.ajax({
            url: abs_url+"ajax_func.php",
            type: "get",
            async: false,
            data: {'type':'chart', 'data':arr},
            success: function (response) {
                if(response !== ''){
                    var chart;
                    // Create data table out of JSON data loaded from server.
                    var chart_data = new google.visualization.DataTable(response);
                    // Instantiate and draw chart, passing in some options.
                    if(row[1] === 'pie'){
                        chart = new google.visualization.PieChart(document.getElementById('chart_'+row[0]));
                    }
                    else if(row[1] === 'col'){
                        chart = new google.visualization.ColumnChart(document.getElementById('chart_'+row[0]));
                    }
                    chart.draw(chart_data, {title: row[2],
                                            width: 1000, 
                                            height: 640,
                                            legend:{position:'right'},
                                            'is3D' : true});
                }
            }
        });
    }
}


function login(){
    $.doTimeout('login', 250, function(){
        if($('.login_username').val() !== '' && $('.login_password').val() !== ''){
            var username = $('.login_username').val();
            var password = $('.login_password').val();
            
            var input_data = {'username':username, 'password':password};

            $.ajax({
                url: abs_url+"ajax_func.php",
                type: "get",
                cache: false,
                data: {'type':'login',  'data':input_data},
                success: function (response) {
                    if(response === '1'){
                        $('.login_form').removeClass('access_denied').addClass('access_granted');
                        $.doTimeout('redirect', 1000, function(){
                            document.location.href = abs_url + 'add-resident';
                        });
                    }
                    else if(response === '0'){
                        console.dir('access denied');
                        $('.login_form').removeClass('access_granted').addClass('access_denied');
                    }
                }
            });
        }
        else{
            console.dir('fill all fields!');
        }
    });
    
}

/*###############################################################
 * DRAG and DROP functions 
 *############################################################### 
 */
function handleDragStart(e){
    drag_item_src = e.target;
    $(drag_item_src).addClass('drag_item_dragged');
    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/html', this.innerHTML);
}


function handleDrag(e){
    
}


// Fired when dragged item is released
function handleDragEnd(e){
    var drag_item_src = e.target;
    $(drag_item_src).removeClass('drag_item_dragged');
}


// Drop area entered
function handleDragEnter(e){
    e.preventDefault();
    e.stopPropagation();
    var drop_target_area = e.target;
    $(drop_target_area).addClass('drop_area_hover');
}


function handleDragOver(e){
    e.preventDefault();
}


function handleDragLeave(e){
    var drop_target_area = e.target;
    $(drop_target_area).removeClass('drop_area_hover');
}


function handleDrop(e) {
    // Don't do anything if dropping the same column we're dragging.
    if (drag_item_src !== e.target) {
        drop = e.target;
        $(drop).removeClass('drop_area_hover');
        var dataList, dataHTML, dataText;
        // collect our data (based on what browser support we have)
        try {
          dataList = e.dataTransfer.getData('text/uri-list');
          dataHTML = e.dataTransfer.getData('text/html');
        } catch (e) {
          dataText = e.dataTransfer.getData('text');
        }
        // we have access to the HTML
        if (dataHTML) {
          $(drop).empty();
          $(drop).prepend(drag_item_src);
        }
        // only have access to text (old browsers + IE)
        else {
          $(drop).empty();
          $(drop).prepend(drag_item_src.clone());
        }
    }
    e.preventDefault();
    e.stopPropagation();
}


//function allowDrop(ev) {
//    ev.preventDefault();
//}
//
//function drag(ev) {
//    ev.dataTransfer.setData("text", ev.target.id);
//}
//




//
//function handleDragOver(e) {
//    if (e.preventDefault) {
//      e.preventDefault(); // Necessary. Allows us to drop.
//    }
//    e.dataTransfer.dropEffect = 'move';
//}
//
//function handleDragEnter(e) {
//    e.target.classList.add('hovered');
//}
//
//function handleDragLeave(e) {
//    e.target.classList.remove('hovered');  // this / e.target is previous target element.
//}
//

//
//function handleDragEnd(e) {
//  // e.target is source node.
//    [].forEach.call(e.target, function (drag_item) {
//      drag_item.classList.remove('hovered');
//    });
//}



function addDotimeout(){
    
    (function($){var a={},c="doTimeout",d=Array.prototype.slice;$[c]=function(){return b.apply(window,[0].concat(d.call(arguments)))};$.fn[c]=function(){var f=d.call(arguments),e=b.apply(this,[c+f[0]].concat(f));return typeof f[0]==="number"||typeof f[1]==="number"?this:e};function b(l){var m=this,h,k={},g=l?$.fn:$,n=arguments,i=4,f=n[1],j=n[2],p=n[3];if(typeof f!=="string"){i--;f=l=0;j=n[1];p=n[2]}if(l){h=m.eq(0);h.data(l,k=h.data(l)||{})}else{if(f){k=a[f]||(a[f]={})}}k.id&&clearTimeout(k.id);delete k.id;function e(){if(l){h.removeData(l)}else{if(f){delete a[f]}}}function o(){k.id=setTimeout(function(){k.fn()},j)}if(p){k.fn=function(q){if(typeof p==="string"){p=g[p]}p.apply(m,d.call(n,i))===true&&!q?o():e()};o()}else{if(k.fn){j===undefined?e():k.fn(j===false);return true}else{e()}}}})(jQuery);
}