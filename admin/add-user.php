<?php

//this page for add user

require("../global.php");
require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/user.php');
require(DATABASE.'/security.php');

session_start();

if (!checkLogin()) {
    header('LOCATION:login.php');
}

$success = '';

$userObject = new user();

$secObject = new sec();


if (count($_POST) >0){

    $username  = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
    $email     = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $password  = $_POST['password'];

    $errorMessage = array();

        if(strlen($username) < 3){

            $userError = $errorMessage[] = 'username name must be 3 character or more';

        }elseif(empty($username)){

            $userError = $errorMessage[] = 'you must add username';
        }

        if(strlen($password) < 6){

            $passwordError = $errorMessage[] = 'password must six character or number';

        }elseif(empty($password)){

            $passwordError = $errorMessage[] = 'you must add password';
        }

        if(!(filter_var($email,FILTER_VALIDATE_EMAIL)) || empty($email) ){

            $emailError = $errorMessage[] = 'you must add email';

        }

    if(count($errorMessage)>0){

        $error = "user not add";

    }else{

        $userObject = new user();

        $userObject->addUser($username,$secObject->hashPassword($password,SALT),$email);

        $success = 'User added successfully...';

    }


}

//adding design

$pageTitle = 'add user';


include(VIEW.'/back/header.html');
include(VIEW.'/back/menu.html');
include(VIEW.'/back/add-user.html');
include(VIEW.'/back/footer.html');
