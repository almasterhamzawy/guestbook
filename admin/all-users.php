<?php

//this page for get all user

require("../global.php");
require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/user.php');

session_start();

if (!checkLogin()) {
    header('LOCATION:login.php');
}

$allUser = new user();

$all = $allUser->getAllUser();


$pageTitle = 'all users';

include(VIEW.'/back/header.html');
include(VIEW.'/back/menu.html');
include(VIEW.'/back/all-users.html');
include(VIEW.'/back/footer.html');
