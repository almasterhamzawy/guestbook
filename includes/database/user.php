<?php
/**
 * this class for user
 */

class user
{

//connecting to database

    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli(HOST,USER,PASSWORD,DBNAME);
    }

//this function is adding user

    public function addUser($username,$password,$email){

        $this->connection->query("INSERT INTO `user` (`username`,`password`,`email`) VALUES ('$username','$password','$email')");

        if ($this->connection->affected_rows > 0)
            return true;

        return false;


    }

//this function is update user

    public function updateUser($id,$username,$password,$email){

        $sql = "UPDATE `user` SET";

        if (strlen($username)>0) {
            $sql .= "`username` = '$username',";
        }

        if (strlen($password)>0) {
            $sql .= "`password` = '$password',";
        }

        if (strlen($email)>0) {
            $sql .= "`email` = '$email'";
        }

        $sql.= "WHERE `id` = $id";

        $this->connection->query($sql);


        if ($this->connection->affected_rows > 0)
            return true;

        return false;

    }

//this function is delete user

    public function deleteUser($id){

        $this->connection->query("DELETE FROM `user` WHERE `id` = $id");

        if ($this->connection->affected_rows > 0)
            return true;

        return false;

    }

//this function is get all user

    public function getAllUser($extra = ''){

        $result = $this->connection->query(" SELECT * FROM `user` $extra");
        if ($result->num_rows > 0) {

            $users = array();

            while ($row = $result->fetch_assoc()) {

                $users[] = $row;

            }
            return $users;

        }else {
            return null;
        }

    }

//this function is get user By id

    public function getUserById($id){

        $user = $this->getAllUser("WHERE `id` = $id");
        if ($user && count($user) > 0 ) {
            return $user[0];
        }
        return null;
    }

//this function is login user

    public function login($username,$password){

        $users = $user = $this->getAllUser("WHERE `username` = '$username' AND `password` = '$password' ");

        if ($users && count($users) > 0 ) {
            return $users[0];
        }
        return null;
    }

    //closing database connection

    public function __distruct()
    {
      $this->connection->close();
    }


}
