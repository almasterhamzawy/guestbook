<?php

/**
 * this class for message
 */

class message
{

//connecting to database

    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli(HOST, USER, PASSWORD, DBNAME);
    }

//this function is adding message

    public function addMessage($title,$content,$name,$email)
    {
        $this->connection->query("INSERT INTO `message`(`title`, `content`, `name`, `email`) VALUES ('$title','$content','$name','$email')");

        if ($this->connection->affected_rows > 0) {
            return true;
        }

        return false;
    }

//this function is update message

public function updateMessage($id,$title,$content)
{
    $sql = "UPDATE `messages` SET `title`='$title',`content`='$content' WHERE `id` = $id";

    $this->connection->query($sql);

    if($this->connection->affected_rows>0)
        return true;

    return false;
}

//this function is delete message

    public function deleteMessage($id)
    {
        $this->connection->query("DELETE FROM `message` WHERE `id` = $id");

        if ($this->connection->affected_rows > 0) {
            return true;
        }

        return false;
    }

//this function is get all message

    public function getAllMessages($extra = '')
    {
        $result = $this->connection->query(" SELECT * FROM `message` $extra");
        if ($result->num_rows > 0) {
            $messages = array();

            while ($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
            return $messages;
        } else {
            return null;
        }
    }

//this function is get message By id

    public function getMessageById($id)
    {
        $message = $this->getAllmessages("WHERE `id` = $id");
        if ($message && count($message) > 0) {
            return $message[0];
        }
        return null;
    }

//closing database connection

public function __distruct()
{
    $this->connection->close();
}
}
