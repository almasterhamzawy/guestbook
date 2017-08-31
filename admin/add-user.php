<?php

//this page for add user

require("../global.php");
require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/security.php');
require(DATABASE.'/user.php');

session_start();

if (!checkLogin()) {
    header('LOCATION:login.php');
}

$success = '';

$userObject = new user();


$secObject = new sec();

if (count($_POST) >0){

    $username  = $_POST['username'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];

    if(!empty($addUser)){

        $addUser = $userObject->addUser($secObject->encrypt($username),$secObject->hashPassword($password),$secObject->encrypt($email));

        $success ="User added successfully";

    }else{
        //  add error validate start


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

        if(!filter_var($email,FILTER_VALIDATE_EMAIL) || empty($email) ){

            $emailError = $errorMessage[] = 'you must add email';

        }


    }



}


//adding design

$pageTitle = 'add user';


include(VIEW.'/back/header.html');
include(VIEW.'/back/menu.html');
include(VIEW.'/back/add-user.html');
include(VIEW.'/back/footer.html');
