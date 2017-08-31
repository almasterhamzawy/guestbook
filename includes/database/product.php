<?php
/**
 * this class for product
 */

class product
{

//connecting to database

    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli(HOST,USER,PASSWORD,DBNAME);
    }

//this function is adding user

    public function addProduct($title,$description,$image,$price,$available,$userId){

        $this->connection->query("INSERT INTO `product`(`title`, `description`, `image`, `price`, `available`, `user_id`) VALUES ('$title','$description','$image',$price,$available,$userId)");

        if ($this->connection->affected_rows > 0)
            return true;

        return false;


    }

//this function is update product

public function updateProduct($id,$title,$description,$image,$price,$available)
{
    $this->connection->query("UPDATE `product` SET `title`='$title',`description`='$description',`image`='$image',`price`=$price,`available`=$available WHERE `id`=$id");

    if($this->connection->affected_rows>0)
        return true;

    echo $this->connection->error;
    return false;
}
//this function is delete product

    public function deleteProduct($id){

        $this->connection->query("DELETE FROM `product` WHERE `id` = $id");

        if ($this->connection->affected_rows > 0)
            return true;

        return false;

    }

//this function is get all product

    public function getAllProducts($extra = ''){

        $result = $this->connection->query(" SELECT * FROM `product` $extra");
        if ($result->num_rows > 0) {

            $products = array();

            while ($row = $result->fetch_assoc()) {

                $products[] = $row;

            }
            return $products;

        }else {
            return null;
        }

    }

//this function is get product By id

    public function getProductById($id){

        $product = $this->getAllProducts("WHERE `id` = $id");
        if ($product && count($product) > 0 ) {
            return $product[0];
        }
        return null;
    }

//closing database connection

public function __distruct()
{
  $this->connection->close();
}

}
