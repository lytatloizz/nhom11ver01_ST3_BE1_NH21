<?php
class Product extends Db
{
    public function getAllProducts()
    {
        $sql = self::$connection->prepare("SELECT * 
        FROM products,manufactures,protypes
        WHERE products.manu_id = manufactures.manu_id
        AND products.type_id = protypes.type_id
        ORDER BY id DESC");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getTenProducts()
    {
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE id LIMIT 10");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function Search($keyword)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE `name` LIKE ?");
        $keyword = "%$keyword%";
        $sql->bind_param("s", $keyword);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getProductById($id)
    {
        $sql = self::$connection->prepare("SELECT* FROM products,manufactures,protypes WHERE products.manu_id = manufactures.manu_id
        AND products.type_id = protypes.type_id AND id = ?");
        $sql->bind_param("i",$id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getProductByManuId($manu_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE manu_id = ?");
        $sql->bind_param("i", $manu_id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getProductByTypeId($type_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE `type_id` = ?");
        $sql->bind_param("i", $type_id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function get3ProductByManuId($manu_id, $page, $perPage)
    {
        // Tính số thứ tự trang bắt đầu
        $firstLink = ($page - 1) * $perPage;
        $sql = self::$connection->prepare("SELECT * FROM products
        WHERE manu_id = ? LIMIT ?, ?");
        $sql->bind_param("iii", $manu_id, $firstLink, $perPage);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    function paginate($url, $total, $perPage)
    {
        $totalLinks = ceil($total/$perPage);
        $link ="";
            for($j=1; $j <= $totalLinks ; $j++)
            {
                $link = $link."<li><a href='$url&page=$j'> $j </a></li>";
            }
            return $link;
    }
    public function Search1($keyword,$page, $perPage)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE `name` LIKE ? LIMIT ?, ?");
        $keyword = "%$keyword%";
        $sql->bind_param("sii", $keyword, $firstLink, $perPage);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function insertProducts($name,$price,$manu_id,$type_id,$description,$image,$feature)
    {
        $sql = self::$connection->prepare("
        INSERT INTO `products`(`name`, `manu_id`, `type_id`, `price`, `image`, `description`,`feature`) 
        VALUES (?,?,?,?,?,?,?)");
        $sql->bind_param("siiissi", $name,$manu_id,$type_id,$price,$image,$description,$feature);
        return $sql->execute();
        
    }
    public function deleteProducts($id)
    {
        $sql = self::$connection->prepare("DELETE FROM `products` WHERE `id` = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
    public function editProducts($id,$name,$price,$manu_id,$type_id,$description,$image,$feature)
    {
        $sql = self::$connection->prepare("UPDATE `products` SET`name`= ?,`manu_id`= ?,
        `type_id`= ?,`price`= ?,`image`= ?,`description`= ?,`feature`= ? WHERE `id` = ?");
        $sql->bind_param("siiissii", $name,$manu_id,$type_id,$price,$image,$description,$feature,$id);
        return $sql->execute();
    }
    
}
