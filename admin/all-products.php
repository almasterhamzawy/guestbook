<?php
//this page for get all user
require("../global.php");
require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/product.php');

session_start();

if (!checkLogin()) {

  header('LOCATION:login.php');
}

$Allproducts = new product();

$products = $Allproducts->getAllProducts();

//adding design

$pageTitle = 'all products';

include(VIEW.'/back/header.html');
include(VIEW.'/back/menu.html');
include(VIEW.'/back/all-products.html');
include(VIEW.'/back/footer.html');
