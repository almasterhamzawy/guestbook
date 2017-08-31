<?php

//this function is check login

function checkLogin(){
return (isset($_SESSION['user']))?true : false;

}
