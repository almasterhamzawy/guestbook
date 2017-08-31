<?php
//this page for delete user

require("../global.php");
require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/user.php');

session_start();

if (!checkLogin()) {
  exit("go and login");
}

$id =(isset($_GET['id'])) ?(int)$_GET['id'] : 0;

$deleteUser = new user();

$user = $deleteUser->deleteUser($id);

if ($user) {
  header('LOCATION:all-users.php');
}else {
  echo "error";
}
