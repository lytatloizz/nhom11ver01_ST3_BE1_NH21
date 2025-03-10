<?php
class Product extends Db
{
    public function getAllProducts()
    {
        $sql = self::$connection->prepare("SELECT * FROM products LIMIT 5");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getRamdomProducts()
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 5");
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
        $sql = self::$connection->prepare("SELECT* FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getProductByFeature($feature)
    {
        $sql = self::$connection->prepare("SELECT* FROM products WHERE feature = ?");
        $sql->bind_param("i", $feature);
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
    public function get2ProductByManuId($manu_id, $limit)
    {
        // Tính số thứ tự trang bắt đầu
        $sql = self::$connection->prepare("SELECT * FROM products
        WHERE manu_id = ? LIMIT 0, ?");
        $sql->bind_param("ii", $manu_id, $limit);
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
    function paginate1($url, $total, $perPage)
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
        $firstLink = ($page - 1) * $perPage;
        $sql->bind_param("sii", $keyword, $firstLink, $perPage);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
}