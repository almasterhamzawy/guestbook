<?php


/*
 * this is directories for the project
 */

define('ROOT',dirname(__FILE__));
define('INCLUDES',ROOT.'/includes');
define('PLUGINS',INCLUDES.'/plugins');
define('DATABASE',INCLUDES.'/database');
define('CONTROLLER',INCLUDES.'/controllers');
define('VIEW',ROOT.'/template');
define('ASSETS',ROOT.'/assets');


require(INCLUDES.'/config.php');
