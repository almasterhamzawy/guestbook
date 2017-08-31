<?php
//this page for add product

require("../global.php");
require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/product.php');

session_start();

if (!checkLogin()) {
    header('LOCATION:login.php');
}

$success = '';
$error   = '';

/* this is product information*/

if (count($_POST)>0) {

    $addProduct = new product();

    $title       = $_POST['title'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $available   = $_POST['available'];
    $userId      = $_SESSION['user']['id'];

    /* this section for upload image */

    $image = 'no-image.jpg';


    if(isset($_FILES['image'])){

        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $tmp = $_FILES['image']['tmp_name'];
        $errorUpload = $_FILES['image']['error'];
        $size = $_FILES['image']['size'];


        if(($type =='image/png' || $type =='image/jpg' || $type =='image/jpeg') && $errorUpload == 0 ){

            //change photo name

            $image = md5($name.date('U').rand(1000,100000).$name);

            //move image place

            move_uploaded_file($tmp,'../uploads/'.$image);

        }else{
            $error="no image";

        }

    }

    $addProducts = $addProduct->addProduct($title,$description,$image,$price,$available,$userId);

    if($addProducts){

        $success = 'product added';

        header('LOCATION:all-products.php');

    }else{

        $error = 'product not added';

    }

}

//adding design

$pageTitle = 'add product';

include(VIEW.'/back/header.html');
include(VIEW.'/back/menu.html');
include(VIEW.'/back/add-product.html');
include(VIEW.'/back/footer.html');
