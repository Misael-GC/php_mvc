<?php

namespace App\Model;

use App\Database\Database;
class HomeModel {
    // private $db;
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getData() {
        $stmt = $this->db->prepare("SELECT * FROM some_table");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}