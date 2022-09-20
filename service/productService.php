<?php
require_once("../modal/Laptop.php");


class productService
{


    public function operateProduct($data)
    {
        $laptop = new Laptop();
        $laptop->setId($data['id']);
        $laptop->setName($data['name']);
        $laptop->setItem($data['item']);
        $laptop->setPrice($data['price']);
        $laptop->setDiscount($data['discount']);
        $laptop->setStock($data['qty']);

        if (isset($_FILES['image'])) {
            $laptop->setImage($_FILES["image"]["name"]);
            $tempname = $_FILES["image"]["tmp_name"];

            move_uploaded_file($tempname, "../images/products/" . $laptop->getImage());
        }

        switch (DatabaseHelper::checkOperation($laptop->getId(), $laptop->getName())) {
            case 1:
                $laptop->insert();
                return true;
                break;

            case 2:
                $laptop->update();
                return true;
                break;

            case 3:
                $laptop->delete();
                return true;
                break;

            default:
                break;
        }
        return false;
    }

    public function fetchAllLaptops()
    {
        $laptop = new Laptop();

        return $laptop->fetchAll();
    }
}
