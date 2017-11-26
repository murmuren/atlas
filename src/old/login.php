<?php
require_once (dirname(__FILE__) . '/html_parts.php');
$html_parts = new html_parts();
$page = 'login';
$html_parts->html_header($page);
loginForm();
$html_parts->html_footer($page);

function loginForm(){
    ?>
    <div class="login_form">
        <span class="login_title">Administrator Login</span>
        <input class="login_username" type="text" autofocus="true" placeholder="Username">
        <input class="login_password" type="password" placeholder="Password">
        <span class="login_submit">Login</span>
    </div>
    <?php
}