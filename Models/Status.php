<?php
namespace App\Models;

class Status extends BaseModel
{
    protected $table = 'status';
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
        return parent::create($data);
    }

    public function update(int $id, array $data) {
        return parent::update($id, $data);
    }
}