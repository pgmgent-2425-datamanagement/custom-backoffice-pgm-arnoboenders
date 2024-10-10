<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\User;

class ProjectController extends BaseController
{

    public static function index()
    {
        // Fetch all projects
        $projects = new Project();
        $projectsData = $projects->all();

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
        foreach ($projectsData as &$project) {
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
            'projects' => $projectsData
        ]);
    }

    public static function show($id)
    {
        $project = new Project();
        $projectData = $project->find($id);

        // Fetch manager details
        $manager = new User();
        $managerData = $manager->find($projectData->manager_id); // Use object property syntax

        // Fetch status details
        $status = new \App\Models\Status();
        $statusData = $status->find($projectData->status_id); // Use object property syntax

        self::loadView('/project', [
            'project' => $projectData,
            'manager' => $managerData,
            'status' => $statusData
        ]);
    }
    public static function showCreate()
    {
        // Fetch all users
        $user = new User();
        $usersData = $user->all();

        // Fetch all statuses
        $status = new \App\Models\Status();
        $statusesData = $status->all();

        // Load the view with users and statuses data
        self::loadView('/create-project', [
            'users' => $usersData,
            'statuses' => $statusesData
        ]);
    }

    public static function create()
    {
        // Check if the request is a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate CSRF token
            if (!isset($_POST['_token']) || $_POST['_token'] !== $_SESSION['_token']) {
                self::loadView('/create-project', [
                    'errors' => ['Invalid CSRF token.'],
                    'users' => (new User())->all(),
                    'statuses' => (new \App\Models\Status())->all()
                ]);
                return;
            }

            // Collect data from the POST request
            $data = [
                'name' => $_POST['name'] ?? null,
                'description' => $_POST['description'] ?? null,
                'start_date' => date('Y-m-d'),
                'end_date' => $_POST['end_date'] ?? null,
                'manager_id' => $_POST['manager'] ?? null,
                'status_id' => $_POST['status'] ?? null,
            ];

            // Validate required fields
            $errors = [];
            foreach ($data as $key => $value) {
                if (is_null($value)) {
                    $errors[] = "The $key field is required.";
                }
            }

            if (!empty($errors)) {
                // Load the view with errors
                self::loadView('/create-project', [
                    'errors' => $errors,
                    'users' => (new User())->all(),
                    'statuses' => (new \App\Models\Status())->all()
                ]);
                return;
            }

            try {
                // Create a new project with the collected data
                $project = new Project();
                $project->create($data);

                // Redirect to the projects index page after creation
                header('Location: /projects');
                exit;
            } catch (\Exception $e) {
                // Handle any exceptions during project creation
                self::loadView('/create-project', [
                    'errors' => [$e->getMessage()],
                    'users' => (new User())->all(),
                    'statuses' => (new \App\Models\Status())->all()
                ]);
                return;
            }
        }

        // If not a POST request, redirect to the showCreate method
        self::showCreate();
    }
}
