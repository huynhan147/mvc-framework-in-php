<?php
/**
 * Created by PhpStorm.
 * User: huyptit
 * Date: 29/12/2018
 * Time: 00:13
 */
define('PUBLIC', str_replace("Public/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Public/index.php", "", $_SERVER["SCRIPT_FILENAME"]));


require(ROOT . 'Config/core.php');
require(ROOT . 'Route.php');

require(ROOT . 'Request.php');

require(ROOT . 'dispatcher.php');

$dispatch = new Dispatcher();


$dispatch->dispatch();
