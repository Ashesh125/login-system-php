<?php
require_once("Product.php");


class Laptop extends Product
{

    function __construct()
    {
        parent::__construct("products");
    }

    public function fetchAll()
    {
        return parent::fetch();
    }

    public function insert()
    {
        $sql = 'INSERT INTO ' . $this->table_name . '(name,item,price,image,discount,qty) VALUES(:name,:item,:price,:image,:discount,:qty)';
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':name', $this->getName());
        $stmt->bindValue(':item', $this->getItem());
        $stmt->bindValue(':price', $this->getPrice(), PDO::PARAM_INT);
        $stmt->bindValue(':image', $this->getImage());
        $stmt->bindValue(':discount', $this->getDiscount(), PDO::PARAM_INT);
        $stmt->bindValue(':qty', $this->getStock());

        return $stmt->execute();
    }

    public function update()
    {
        $sql = 'UPDATE ' . $this->table_name . ' SET 
            name = :name,
            price = :price,
            item = :item,
            discount = :discount,
            qty = :qty
            WHERE id = :id';

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':name', $this->getName());
        $stmt->bindValue(':price', $this->getPrice(), PDO::PARAM_INT);
        $stmt->bindValue(':discount', $this->getDiscount());
        $stmt->bindValue(':item', $this->getItem());
        $stmt->bindValue(':qty', $this->getStock());
        $stmt->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        if (!empty($this->getImage())) {
            parent::imageUpload();
        }
        return $stmt->execute();
    }

    public function delete()
    {
        parent::delete();
    }
}
