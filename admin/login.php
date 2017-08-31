<?php

//this page for make user login
require("../global.php");
require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/security.php');
require(DATABASE.'/user.php');

session_start();

//this var is showning error

$error = '';
$success = '';

if (checkLogin()) {
    header('LOCATION:index.php');
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new user();
    $sec = new sec();

    $userdate = $user->login($username,$password);
    if ($userdate && count($userdate) > 0) {

      //store in session

     $_SESSION['user'] = $userdate;
     header('LOCATION:index.php');
    }else {
      $error = 'error check your username or password';
    }
}


$pageTitle = 'login';

include(VIEW.'/back/login.html');
