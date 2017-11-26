<?php
/** path to global components */
define("LIBRARIES_PATH", "libraries");

/** starts MVC api */
require_once(LIBRARIES_PATH."/php-servlets-api/loader.php");

/** FrontController */
try {
    new FrontController();
} catch(PathNotFoundException $e) {
	// send 404 header
	header("HTTP/1.0 404 Not Found");
	header('Content-Type: text/html; charset=UTF-8');
	require_once("application/views/404.html");
}