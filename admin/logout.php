<?php

//this page make user logout

session_start();
header('LOCATION:login.php');
session_destroy();
