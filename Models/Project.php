<?php

namespace App\Models;

class Project extends BaseModel
{
    protected $table = 'projects';
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

    public function search(string $query)
    {
        $sql = 'SELECT * FROM `' . $this->table . '` WHERE `name` LIKE :query OR `description` LIKE :query';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':query' => '%' . $query . '%'
        ]);
        return $pdo_statement->fetchAll();
    }

    public function create(array $data)
    {
        $sql = 'INSERT INTO `' . $this->table . '` (`name`, `description`, `start_date`, `end_date`, `manager_id`, `status_id`) VALUES (:name, :description, :start_date, :end_date, :manager_id, :status_id)';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':start_date' => date('Y-m-d H:i:s'),
            ':end_date' => $data['end_date'],
            ':manager_id' => $data['manager_id'],
            ':status_id' => $data['status_id']
        ]);
        $lastInsertId = $this->db->lastInsertId();
        return $this->find($lastInsertId);
    }
    public function update()
    {
        $sql = 'UPDATE `' . $this->table . '` SET `name` = :name, `description` = :description, `start_date` = :start_date, `end_date` = :end_date, `manager_id` = :manager_id, `status_id` = :status_id WHERE `' . $this->pk . '` = :id';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':name' => $this->name,
            ':description' => $this->description,
            ':start_date' => $this->start_date,
            ':end_date' => $this->end_date,
            ':manager_id' => $this->manager_id,
            ':status_id' => $this->status_id,
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
    public function tasks()
    {
        $sql = 'SELECT * FROM `tasks` WHERE `project_id` = :project_id';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':project_id' => $this->id
        ]);
        return $pdo_statement->fetchAll();
    }
}
