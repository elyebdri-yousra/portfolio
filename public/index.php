<?php
require '../vendor/autoload.php';
require '../config/define.php';


session_start();

require PATH_VIEWS . 'header.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'home';


require PATH_VIEWS . 'footer.php';