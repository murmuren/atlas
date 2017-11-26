<?php
require_once './html_parts.php';
require_once './common_func.php';

//$Queries = Queries::getInstance();
//$q = $Queries->diamondsQ();
//$res = GetDbData::getResults($q, 'assoc');
//var_dump($res);
$func = new CommonFunc();
$parts = new html_parts();
$parts->html_header('index');

?><div class="cleaning_names_wrap"><?php
    $names = ['Jack', 'John', 'Mike'];
    for($i = 0; $i < count($names); $i++){
        ?><div id="cleaning_item_name_<?php echo $i; ?>" class="cleaning_item_name drag_item_src" draggable="true"><?php echo $names[$i]; ?></div><?php
    }
?></div><?php


?><div class="cleaning_table"><?php
    $cell_id = 1;
    for($row = 1; $row <= 7; $row++){
        for($cell = 1; $cell <= 7; $cell++){
            ?><div id="cell_cleaning_<?php echo $cell_id; ?>" class="cell_cleaning drag_dest"></div><?php
            $cell_id++;
        }
    }
?></div><?php


$parts->html_footer('index');

