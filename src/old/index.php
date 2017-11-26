<?php
require_once (dirname(__FILE__) . '/html_parts.php');

$parts = new html_parts();

$page = 'home';
$lang = 'eng';

$q = 'SELECT * FROM residents LIMIT 20';
$res = GetDbData::getResults($q, 'assoc');

$parts->html_header($page);
?>
<div class="tbl_wrap">
    <ul>
        <li  class="tbl_header">
            <span>id</span>
        </li>
    </ul>    
</div>
<?php
$parts->html_footer($page);