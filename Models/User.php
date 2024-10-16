<?php
namespace App\Models;

class User extends BaseModel
{
    protected $table = 'users';
    protected $pk = 'id';
    protected $db;

    public function __construct() {
        parent::__construct();
    }

    protected function all() {
        return parent::all();
    }

    protected function find(int $id) {
        return parent::find($id);
    }

    public function create(array $data) {
        $sql = 'INSERT INTO `' . $this->table . '` (`first_name`, `last_name`, `email`, `password`, `role_id`) VALUES (:first_name, :last_name, :email, :password, :role_id)';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':role_id' => $data['role_id']
        ]);
    }

    public function update (int $id, array $data) {
        $sql = 'UPDATE `' . $this->table . '` SET `first_name` = :first_name, `last_name` = :last_name, `email` = :email, `password` = :password, `role_id` = :role_id WHERE `' . $this->pk . '` = :id';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':role_id' => $data['role_id'],
            ':id' => $id
        ]);
    }
    public function delete() {
        $sql = 'DELETE FROM `' . $this->table . '` WHERE `' . $this->pk . '` = :id';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':id' => $this->id
        ]);
    }
}