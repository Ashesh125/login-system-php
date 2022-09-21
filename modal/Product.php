<?php
require_once("DatabaseHelper.php");

class Product extends DatabaseHelper
{

	public $price;
	public $image;
	public $discount;
	public $description;
	public $item;
	public $stock;
	public $status;

	function __construct($table_name)
	{
		parent::__construct($table_name);
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function setPrice($price)
	{
		$this->price = $price;
	}

	public function getImage()
	{
		return $this->image;
	}

	public function setImage($image)
	{
		$this->image = $image;
	}

	public function getDiscount()
	{
		return $this->discount;
	}

	public function setDiscount($discount)
	{
		$this->discount = $discount;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}


	public function getItem()
	{
		return $this->item;
	}

	public function setItem($item)
	{
		$this->item = $item;

		return $this;
	}

	public function getStock()
	{
		return $this->stock;
	}

	public function setStock($stock)
	{
		$this->stock = $stock;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	public function imageUpload()
	{
		if (empty($this->getImage())) {
			return false;
		} else {
			$sql = 'UPDATE ' . $this->table_name . ' SET 
            image = :image
            WHERE id = :id';

			$stmt = $this->conn->prepare($sql);

			$stmt->bindValue(':image', $this->getImage());
			$stmt->bindValue(':id', $this->getId());

			return $stmt->execute();
		}
	}

	public function deleteImage()
	{
		$sql = "Select image from " . $this->table_name . " WHERE id = :id";

		$stmt = $this->conn->prepare($sql);

		$stmt->bindValue(':id', $this->getId());

		$stmt->execute();
		$file = $stmt->fetchAll();

		return unlink("../images/products/" . $file[0]['image']);
	}
}
