<?php
require_once("DatabaseHelper.php");

class Person extends DatabaseHelper
{
	public $password;
	public $email;

	function __construct($table_name)
	{
		parent::__construct($table_name);
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			exit("Invalid Email Format!");
		} else {
			$this->email = $email;
		}
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		if (strlen($password) < 6 || strlen($password) > 12) {
			exit("Invalid Password!");
		} else {
			$this->password = hash('sha256', $password);
		}
	}

	public function updatePassword()
	{
		if (empty($this->getPassword())) {
			return false;
		} else {
			$sql = 'UPDATE ' . $this->table_name . ' SET 
            password = :password
            WHERE id = :id';

			$stmt = $this->conn->prepare($sql);

			$stmt->bindParam(':password', $this->getPassword());

			$stmt->bindParam(':id', $this->getId());

			return $stmt->execute();
		}
	}

	public function isAdmin()
	{
		$query = "SELECT EXISTS (SELECT * from admins WHERE email = :email AND password = :password) as status";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':email', $this->getEmail());
		$stmt->bindParam(':password', $this->getPassword());

		if ($stmt->execute()) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$item = $status;
			}
		}
		if ($item == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function isClient()
	{
		$query = "SELECT EXISTS (SELECT * from clients WHERE email = :email AND password = :password) as status";
		$stmt = $this->conn->prepare($query);

		$stmt->bindValue(':email', $this->getEmail());
		$stmt->bindValue(':password', $this->getPassword());

		if ($stmt->execute()) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$item = $status;
			}
		}
		return $item == 1 ? true : false;
	}

	public function setLogin($type)
	{
		if ($type == "client") {
			$table = "clients";
		} else if ($type == "admin") {
			$table = "admins";
		} else {
			return false;
		}

		$query = "SELECT * from " . $table . " WHERE email = :email AND password = :password";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':email', $this->getEmail());
		$stmt->bindParam(':password', $this->getPassword());

		if ($stmt->execute()) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$item = array(
					'id' => $id,
					'name' => $email
				);
			}
		}
		$this->id = $item['id'];
		$this->name = $item['name'];
		return;
	}
}
