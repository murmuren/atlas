<?php
/**
 * Creates maintenance page in case of mysql connection error
 * Type: sideffect
 */

require_once './conf/constants.php';

$title = 'The site is under maintenance';
$h1 = 'Maintenance';
$desc = 'The site is under maintenance';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo str_replace('-', ' ', $arr_meta['desc']); ?>">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo $abs_url; ?>img/favicon-32x32.png"/>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div>Site is under maintenance</div>
    <script src="<?php echo ABS_URL; ?>js/jquery.main.js"></script>
</body>
</html>