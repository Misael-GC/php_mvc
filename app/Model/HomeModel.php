<?php

namespace App\Model;

use App\Database\Database;
class HomeModel {
    // private $db;
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function insertContact(array $contact, string $url_img_profile): bool{
        $stmt = $this->db->prepare("INSERT INTO contact (coct_name, coct_last_name, coct_age, coct_email, coct_description, coct_url_img_profile) VALUES (?,?,?,?,?,?)");
        $stmt->bindParam(1, $contact['name']);
        $stmt->bindParam(2, $contact['lastName']);
        $stmt->bindParam(3, $contact['age']);
        $stmt->bindParam(4, $contact['email']);
        $stmt->bindParam(5, $contact['descripcion']);
        $stmt->bindParam(6, $url_img_profile);
        return $stmt->execute();
    }

    // public function getData() {
    //     $stmt = $this->db->prepare("SELECT * FROM some_table");
    //     $stmt->execute();
    //     return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    // }
}