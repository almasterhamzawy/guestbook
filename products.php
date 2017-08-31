<?php

require('global.php');
require(DATABASE.'/product.php');

$productsObject = new product();

$products = $productsObject-> getAllProducts ();

$selected = 'products';

$pageTitle = 'products';

include(VIEW.'/front/navbar.html');
include(VIEW.'/front/products.html');
include(VIEW.'/front/footer.html');
