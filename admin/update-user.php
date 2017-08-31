<?php
//this page for delete user
require("../global.php");
require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/security.php');
require(DATABASE.'/user.php');

session_start();

if (!checkLogin()) {
  header('LOCATION:login.php');
}

$success = '';
$error   ='';

$id =(isset($_GET['id'])) ?(int)$_GET['id'] : 0;

$updateUser = new user();

$sceObject = new sec();

if (count($_POST)>0) {

  $username = $_POST['username'];
  $email    = $_POST['email'];
  $password = $_POST['password'];
  $id       = $_POST['id'];

  $update = $updateUser->updateUser($id,$sceObject->encrypt($username),$sceObject->hashPassword($password),$sceObject->encrypt($email));

if ($update) {
  $success = 'user updated successfully';
}else {
  $error = 'user not updated';
}

}else {

$user = $updateUser->getUserById($id);

}

$pageTitle = 'update user';

include(VIEW.'/back/header.html');
include(VIEW.'/back/menu.html');
include(VIEW.'/back/update-user.html');
include(VIEW.'/back/footer.html');
