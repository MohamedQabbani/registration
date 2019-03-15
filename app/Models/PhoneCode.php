<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 15/03/19
 * Time: 10:23 م
 */

namespace App\Models;


use PDO;

class PhoneCode
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=registration", 'homestead', 'secret');
    }

    public function code()
    {
        return mt_rand(1000, 9999);
    }

    public function sentAt()
    {
        return date("Y-m-d H:i:s");
    }

    public function byPhone($phone)
    {
        $sth = $this->db->prepare("SELECT * FROM phone_code WHERE phone = :phone");
        $sth->execute(array(':phone' => $phone));
        return $sth->fetchAll();
    }

    public function save($data)
    {
        $result = $this->byPhone($data['phone']);

        if (count($result) > 0) {
            // update
            $sql = "UPDATE phone_code SET code=?, sent_at=? WHERE phone=?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$data['code'], $data['sent_at'], $data['phone']]);
        } else {
            // insert
            $sql = "INSERT INTO phone_code (phone, code, sent_at) VALUES (?,?,?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$data['phone'], $data['code'], $data['sent_at']]);
        }
    }
}