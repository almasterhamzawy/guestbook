<?php
//this page for delete product

session_start();

require("../global.php");
require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/product.php');

if(!checkLogin())
header('LOCATION:login.php');

$id = (isset($_GET['id']))? (int)$_GET['id'] : 0;


$error = '';
$success = '';

$productsObject = new product();
$product = $productsObject->getProductById($id);

include(VIEW.'/back/header.html');
include(VIEW.'/back/menu.html');

if($productsObject->deleteProduct($id))
{
    if(file_exists('../uploads/'.$product['image']))
        unlink('../uploads/'.$product['image']);
    $success = 'Product deleted';
    header('LOCATION:all-products.php');
}else
{
    $error = 'Product Not Deleted';
}

include(VIEW.'/back/resultMessage.html');
include(VIEW.'/back/footer.html');
