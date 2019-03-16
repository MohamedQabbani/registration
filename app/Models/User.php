<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 15/03/19
 * Time: 10:23 م
 */

namespace App\Models;


use PDO;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=registration", 'homestead', 'secret');
    }

    public function save($data)
    {
        $sql = "INSERT INTO users (first_name, last_name, email_name, phone_number, created_at, updated_at) VALUES (?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data['first_name'], $data['last_name'], $data['email_name'], $data['phone_number'], $data['created_at'], $data['updated_at']]);
    }

    public function createdAt()
    {
        return date("Y-m-d H:i:s");
    }

    public function updatedAt()
    {
        return date("Y-m-d H:i:s");
    }
}