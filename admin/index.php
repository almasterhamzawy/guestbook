<?php

session_start();

require("../global.php");
require(INCLUDES.'/generalFunctions.php');

if (!checkLogin()) {
  header('LOCATION:login.php');
}


$pageTitle = 'index';

include(VIEW.'/back/header.html');
include(VIEW.'/back/menu.html');
include(VIEW.'/back/index.html');
include(VIEW.'/back/footer.html');
