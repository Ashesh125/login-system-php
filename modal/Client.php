<?php
require_once('Person.php');

class Client extends Person
{

    function __construct()
    {
        parent::__construct("clients");
    }

    public function fetchAll()
    {
        $query = "Select id,email from " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $datas = array();
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    'id' => $id,
                    'email' => $email
                );
                array_push($datas, $item);
            }
            $resp = array(
                'datas' => $datas
            );
        }
        return $resp;
    }

    public function checkExists()
    {
        $query = "Select count(*) as total from " . $this->table_name . " Where email =:email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $this->getEmail());

        $item = 0;
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $item = $row['total'];
            }
        }
        return $item == 0 ? true : false;
    }

    public function insert()
    {
        $sql = 'INSERT INTO ' . $this->table_name . '(email,password) VALUES(:email,:password)';
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':email', $this->getEmail());
        $stmt->bindValue(':password', $this->getPassword());

        return $stmt->execute();
    }

    public function update()
    {
        $sql = 'UPDATE ' . $this->table_name . ' SET 
            email = :email,
            WHERE id = :id';

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':name', $this->getName());
        $stmt->bindValue(':email', $this->getEmail());

        if (!empty($this->getPassword())) {
            parent::updatePassword();
        }

        $stmt->bindParam(':id', $this->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete()
    {
        parent::delete();
    }
}
