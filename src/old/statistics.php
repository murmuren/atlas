<?php
require_once './html_parts.php';
$html_parts = new html_parts();
$page = 'statistics';
$html_parts->html_header($page);
?>
<div id="charts">
    <!-- Google charts wrap -->
</div>
<?php
$html_parts->html_footer($page);