<?php
namespace App\Models;

class Team extends BaseModel
{
    protected $table = 'teams';
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
        $this->db->beginTransaction();
        
        try {
            // Insert into teams table
            $sql = 'INSERT INTO `' . $this->table . '` (`name`, `description`) VALUES (:name, :description)';
            $pdo_statement = $this->db->prepare($sql);
            $pdo_statement->execute([
                ':name' => $data['name'],
                ':description' => $data['description']
            ]);
            
            $team_id = $this->db->lastInsertId();
            
            // Insert into team_user table
            if (!empty($data['user_ids'])) {
                $sql = 'INSERT INTO `team_user` (`team_id`, `user_id`) VALUES (:team_id, :user_id)';
                $pdo_statement = $this->db->prepare($sql);
                foreach ($data['user_ids'] as $user_id) {
                    $pdo_statement->execute([
                        ':team_id' => $team_id,
                        ':user_id' => $user_id
                    ]);
                }
            }
            
            // Insert into project_team table
            if (!empty($data['project_ids'])) {
                $sql = 'INSERT INTO `project_team` (`team_id`, `project_id`) VALUES (:team_id, :project_id)';
                $pdo_statement = $this->db->prepare($sql);
                foreach ($data['project_ids'] as $project_id) {
                    $pdo_statement->execute([
                        ':team_id' => $team_id,
                        ':project_id' => $project_id
                    ]);
                }
            }
            
            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function update (int $id, array $data) {
        $sql = 'UPDATE `' . $this->table . '` SET `name` = :name, `description` = :description WHERE `' . $this->pk . '` = :id';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':name' => $data['name'],
            ':description' => $data['description'],
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

    public function projects() {
        $sql = 'SELECT p.* FROM `projects` p 
                INNER JOIN `project_team` pt ON p.id = pt.project_id 
                WHERE pt.team_id = :team_id';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':team_id' => $this->id
        ]);
        return $pdo_statement->fetchAll();
    }
    public function users() {
        $sql = 'SELECT u.* FROM `users` u 
                INNER JOIN `team_user` tu ON u.id = tu.user_id 
                WHERE tu.team_id = :team_id';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute([
            ':team_id' => $this->id
        ]);
        return $pdo_statement->fetchAll();
    }
}