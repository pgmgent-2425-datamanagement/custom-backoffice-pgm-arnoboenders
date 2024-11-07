<?php

namespace App\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Project;
use App\Models\Status;

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
        $projects = $team->projects();
        $users = $team->users();

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

    public static function edit($id)
    {
        if (isset($_POST['name'])) {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'user_ids' => $_POST['user_ids'],
                'project_ids' => $_POST['project_ids'],
            ];
            $team = Team::find($id);
            $team->update($data);
            header('Location: /teams');
            exit;
        } else {
            $team = Team::find($id);
            $users = User::all();
            $projects = Project::all();
            $selectedUsers = array_column($team->users(), 'id');
            $selectedProjects = array_column($team->projects(), 'id');
            self::loadView('/teams/edit', [
                'team' => $team,
                'users' => $users,
                'projects' => $projects,
                'selectedUsers' => $selectedUsers,
                'selectedProjects' => $selectedProjects
            ]);
        }
    }
}
