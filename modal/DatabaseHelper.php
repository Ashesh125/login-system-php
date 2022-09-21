<?php
require_once("Database.php");

abstract class DatabaseHelper extends Database
{

    public $conn;
    public $table_name;

    public $id;
    public $name;

    function __construct($table_name)
    {
        $this->conn = parent::connect();
        $this->table_name = $table_name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


    public function delete()
    {
        $sql = 'DELETE FROM ' . $this->table_name . ' WHERE id = :id';
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':id', $this->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function fetch()
    {

        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $datas = $stmt->fetchAll();
        $resp = array(
            'datas' => $datas
        );
        return $resp;
    }

    static function checkOperation($id, $name)
    {
        if (($id == 0 || empty($id)) && !empty($name)) {
            return "insert";
        } else if ($id > 0 && !empty($name)) {
            return "update";
        } else if ($id > 0 && empty($name)) {
            return "delete";
        } else {
            return 0;
        }
    }
}
