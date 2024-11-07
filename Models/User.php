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

    public function search($query)
    {
        $sql = 'SELECT * FROM `' . $this->table . '` WHERE `first_name` LIKE :query OR `last_name` LIKE :query';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([':query' => '%' . $query . '%']);
        return self::castToModel($pdo_statement->fetchAll());
    }

    public function create(array $data) {
        $sql = 'INSERT INTO `' . $this->table . '` (`first_name`, `last_name`, `email`, `password`, `role_id`, `image`) VALUES (:first_name, :last_name, :email, :password, :role_id, :image)';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':role_id' => $data['role_id'],
            ':image' => $data['image']
        ]);
    }

    public function update (int $id, array $data) {
        $sql = 'UPDATE `' . $this->table . '` SET `first_name` = :first_name, `last_name` = :last_name, `email` = :email, `password` = :password, `role_id` = :role_id, `image` = :image WHERE `' . $this->pk . '` = :id';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':role_id' => $data['role_id'],
            ':image' => $data['image'],
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