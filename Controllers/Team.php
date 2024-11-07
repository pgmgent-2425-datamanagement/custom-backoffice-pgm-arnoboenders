<?php
namespace App\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Status;
use App\Models\Project;

class TeamController extends BaseController
{
    public static function index()
    {
        $teams = Team::all();
        self::loadView('/teams', [
            'teams' => $teams
        ]);
    }
    public static function show($id)
    {
        $team = Team::find($id);
        $projects = $team->projects(); // Assuming there's a relationship method in the Team model
        $users = $team->users(); // Assuming there's a relationship method in the Team model

        // Fetch manager names and statuses for each project
        foreach ($projects as &$project) {
            $manager = User::find($project['manager_id']);
            $status = Status::find($project['status_id']);

            $project['manager_name'] = $manager ? $manager->first_name . ' ' . $manager->last_name : 'Unknown';
            $project['status'] = $status ? $status->name : 'No Status';
        }
        unset($project);

        self::loadView('/teams/team', [
            'team' => $team,
            'projects' => $projects,
            'users' => $users
        ]);
    }
    public static function create()
    {
        if (isset($_POST['name'])) {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'user_ids' => $_POST['user_ids'],
                'project_ids' => $_POST['project_ids'],
            ];
            $team = new Team();
            $team->create($data);
            header('Location: /teams');
            exit;
        } else {
            $users = User::all();
            $projects = Project::all();
            self::loadView('/teams/create', [
                'users' => $users,
                'projects' => $projects
            ]);
        }
    }
}