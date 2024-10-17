<?php
namespace App\Models;

class Priority extends BaseModel{
    protected $table = 'priorities';
    protected $pk = 'id';
    protected $db;

    public function __construct()
    {
        parent::__construct();
    }

    protected function all()
    {
        return parent::all();
    }

    protected function find(int $id)
    {
        return parent::find($id);
    }

    public function create(array $data)
    {
        $sql = 'INSERT INTO `' . $this->table . '` (`name`) VALUES (:name)';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':name' => $data['name']
        ]);
    }

    public function update(int $id, array $data)
    {
        return parent::update($id, $data);
    }
    public function save()
    {
        $sql = 'UPDATE `' . $this->table . '` SET `name` = :name WHERE `' . $this->pk . '` = :id';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':name' => $this->name,
            ':id' => $this->id
        ]);
    }
    public function delete()
    {
        $sql = 'DELETE FROM `' . $this->table . '` WHERE `' . $this->pk . '` = :id';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':id' => $this->id
        ]);
    }
}