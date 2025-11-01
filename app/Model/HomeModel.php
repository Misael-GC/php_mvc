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

    public function getAllContacts() {
        $stmt = $this->db->prepare("SELECT * FROM contact");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteContactById(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM contact WHERE coct_id_contact = ?");
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }

    public function getContactImg(int $id){
        $stmt = $this->db->prepare("SELECT coct_url_img_profile FROM contact WHERE coct_id_contact = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        // return $stmt->fetchColumn();
    }
}