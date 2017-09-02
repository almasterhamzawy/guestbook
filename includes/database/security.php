<?php

class sec{

    //Encrypt

    //this function is encrypting the user information

    public function encrypt($string){

        $string = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$string,KEY,MCRYPT_MODE_ECB)));

        return $string;

    }

    //Decrypt

    // this function will decrypt the user info

    public function decrypt($string){

        $string = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,KEY,base64_decode($string),MCRYPT_MODE_ECB));

        return $string;

    }


    // this function is for hashing passwords

    public function hashPassword($string){

        $string = crypt($string,'$3$'.SALT.'$');

        return $string;

    }




}