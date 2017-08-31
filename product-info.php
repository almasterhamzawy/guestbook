<?php

require("global.php");

require(DATABASE.'/product.php');

$id = (isset($_GET['id']))?(int)$_GET['id'] : 0;

$productsObject = new product();

$products = $productsObject->getProductById($id);

$selected = 'home';

$pageTitle = 'product-info';


include(VIEW.'/front/navbar.html');

if ($products && count($products) > 0) {

  include(VIEW.'/front/product-info.html');

}
else {
  include(VIEW.'/front/404.html');
}



include(VIEW.'/front/footer.html');
