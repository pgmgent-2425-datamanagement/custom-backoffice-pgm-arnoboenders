<?php
namespace App\Models;

class Project extends BaseModel
{
    protected $table = 'projects';
    protected $pk = 'id';
    protected $db;

    public function __construct() {
        parent::__construct();
    }

    public function all() {
        return parent::all();
    }

    public function find(int $id) {
        return parent::find($id);
    }

    public function create(array $data) {
        return parent::create($data);
    }

    public function update(int $id, array $data) {
        return parent::update($id, $data);
    }
}