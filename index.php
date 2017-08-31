<?php

require('global.php');

require(DATABASE.'/product.php');

$productsObject = new product();

$products = $productsObject-> getAllProducts ("ORDER BY `id` DESC LIMIT 3");

$pageTitle = 'Home';

$selected = 'home';

include(VIEW.'/front/navbar.html');
include(VIEW.'/front/index.html');
include(VIEW.'/front/footer.html');
