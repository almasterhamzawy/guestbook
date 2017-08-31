<?php
session_start();


require("../global.php");

require(INCLUDES.'/generalFunctions.php');
require(DATABASE.'/product.php');

if(!checkLogin())
    header('LOCATION:login.php');

$idFromUrl = (isset($_GET['id']))? (int)$_GET['id'] : 0;

$error = '';
$success = '';

$productsObject = new product();
$product = $productsObject->getProductById($idFromUrl);

include(VIEW.'/back/header.html');
include(VIEW.'/back/menu.html');

//product found

if(count($_POST)>0)
{
    //update product

    $idFromForm  = $_POST['id'];
    $title       = $_POST['title'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $available   = $_POST['available'];

    $productImage = $product['image'];

    if(isset($_FILES['image']))
    {
        //info
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $temp = $_FILES['image']['tmp_name'];
        $uploadError = $_FILES['image']['error'];
        $size = $_FILES['image']['size'];


        if(($type == 'image/png' || $type=='image/jpg' || $type=='image/jpeg') && $uploadError == 0 )
        {
            //rename :
            $newImageName = md5($name.date('U').rand(1000,100000)).$name;
            //move
            if(move_uploaded_file($temp,'../uploads/'.$newImageName))
            {
                if(file_exists('../uploads/'.$productImage))
                    @unlink('../uploads/'.$productImage);

                $productImage = $newImageName;
            }
        }

    }

    if($productsObject->updateProduct($idFromForm,$title,$description,$productImage,$price,$available))
    {

        $success = 'product Updated successfully';
        include(VIEW.'/back/resultMessage.html');
    }
    else
    {
        $error = 'Invalid data submitted';
        include(VIEW.'/back/resultMessage.html');
    }


}
else
{

    if(!$product || count($product)==0)
    {
        $error = 'Product Not Found';
        include(VIEW.'/back/resultMessage.html');
        include(VIEW.'/back/footer.html');
        exit;
    }

    //show product in form

    $pageTitle = 'update product';

    include(VIEW.'/back/update-product.html');
}
include(VIEW.'/back/footer.html');
