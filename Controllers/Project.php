<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Status;

class ProjectController extends BaseController
{

    public static function index()
    {
        // Fetch all projects
        $projects = Project::all();

        // Fetch all users at once to avoid multiple queries
        $user = new User();
        $usersData = $user->all();

        // Fetch all statuses at once to avoid multiple queries
        $status = new \App\Models\Status();
        $statusesData = $status->all();

        // Create a map of users keyed by their IDs
        $userMap = [];
        foreach ($usersData as $user) {
            $userMap[$user->id] = $user; // Use object property syntax
        }

        // Create a map of statuses keyed by their IDs
        $statusMap = [];
        foreach ($statusesData as $status) {
            $statusMap[$status->id] = $status; // Use object property syntax
        }

        // Add manager and status details to each project
        foreach ($projects as &$project) {
            $managerId = $project->manager_id; // Use object property syntax
            $statusId = $project->status_id; // Use object property syntax

            if (isset($userMap[$managerId])) {
                $managerData = $userMap[$managerId];
                $project->manager = $managerData; // Add manager object to project
            } else {
                // Handle case where manager does not exist
                $project->manager = null;
            }

            if (isset($statusMap[$statusId])) {
                $statusData = $statusMap[$statusId];
                $project->status = $statusData; // Add status object to project
            } else {
                // Handle case where status does not exist
                $project->status = null;
            }
        }

        // Load the view with the modified project data
        self::loadView('/projects', [
            'projects' => $projects
        ]);
    }

    public static function show($id)
    {
        $project = Project::find($id);

        // Fetch manager details
        $manager = new User();
        $managerData = $manager->find($project->manager_id); // Use object property syntax

        // Fetch status details
        $status = new \App\Models\Status();
        $statusData = $status->find($project->status_id); // Use object property syntax

        self::loadView('/project', [
            'project' => $project,
            'manager' => $managerData,
            'status' => $statusData
        ]);
    }

    public static function edit($id)
    {
        $project = Project::find($id);

        if(isset($_POST['name'])) {
            $project->name = $_POST['name'];
            $project->description = $_POST['description'];
            $project->start_date = $_POST['start_date'];
            $project->end_date = $_POST['end_date'];
            $project->manager_id = $_POST['manager'];
            $project->status_id = $_POST['status'];

            $project->save();
        }

        // Fetch all users
        $user = new User();
        $usersData = $user->all();

        // Fetch all statuses
        $status = new \App\Models\Status();
        $statusesData = $status->all();

        // Load the view with project, users, and statuses data
        self::loadView('/projects/edit', [
            'project' => $project,
            'users' => $usersData,
            'statuses' => $statusesData
        ]);
    }

    public static function delete($id)
    {
        $project = Project::find($id);
        $project->delete();

        header('Location: /projects');
        exit;
    }

    public static function create()
    {
        // Fetch all users
        $user = new User();
        $usersData = $user->all();

        // Fetch all statuses
        $status = new Status();
        $statusesData = $status->all();

        // Check if the request is a POST request
        if (isset($_POST['name'])) {
            // Collect data from the POST request
            $data = [
                'name' => $_POST['name'] ?? null,
                'description' => $_POST['description'] ?? null,
                'end_date' => $_POST['end_date'] ?? null,
                'manager_id' => $_POST['manager_id'] ?? null,
                'status_id' => $_POST['status_id'] ?? null,
            ];

            // Create a new project
            $project = new Project();
            $project->create($data);

        }

        // Load the view with users and statuses data
        self::loadView('/projects/create', [
            'users' => $usersData,
            'statuses' => $statusesData
        ]);
    }
}
