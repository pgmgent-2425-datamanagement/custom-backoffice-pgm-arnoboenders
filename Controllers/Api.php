<?php

namespace App\Controllers;

use App\Models\Project;

class ApiController extends BaseController
{
    public static function projects()
    {
        $projects = Project::all();
        $projectsArray = [];

        foreach ($projects as $project) {
            $projectsArray[] = [
                'id' => $project->id,
                'name' => $project->name,
                'description' => $project->description,
                'start_date' => $project->start_date,
                'end_date' => $project->end_date,
                'manager_id' => $project->manager_id,
                'status_id' => $project->status_id,
            ];
        }

        echo json_encode($projectsArray);
    }
    public static function project($id)
    {
        $project = Project::find($id);
        echo json_encode($project);
    }
    public static function searchProjects()
    {
        $query = $_GET['query'] ?? '';
        $projects = new Project();
        $projects = $projects->search($query);
        $projectsArray = [];
        foreach ($projects as $project) {
            $projectsArray = [
                'id' => $project['id'],
                'name' => $project['name'],
                'description' => $project['description'],
                'start_date' => $project['start_date'],
                'end_date' => $project['end_date'],
                'manager_id' => $project['manager_id'],
                'status_id' => $project['status_id'],
            ];
        }
        echo json_encode($projectsArray);
    }

    public static function createProject()
    {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'manager_id' => $_POST['manager_id'],
            'status_id' => $_POST['status_id'],
        ];
        $project = new Project();
        $createdProject = $project->create($data);
        echo json_encode($createdProject);
    }
}