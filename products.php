<?php

require('global.php');
require(DATABASE.'/product.php');

$productsObject = new product();

$products = $productsObject-> getAllProducts ();

$selected = 'scripts';

$pageTitle = 'scripts';

include(VIEW.'/front/navbar.html');
include(VIEW.'/front/products.html');
include(VIEW.'/front/footer.html');
