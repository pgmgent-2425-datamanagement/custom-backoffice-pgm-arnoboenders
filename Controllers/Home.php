<?php

namespace App\Controllers;

use App\Models\Team;
use App\Models\Project;

class HomeController extends BaseController
{
    public static function index()
    {
        // Fetch teams and their project counts
        $teams = Team::all();
        $teamData = [];
        foreach ($teams as $team) {
            $projectCount = count($team->projects());
            $teamData[] = [
                'name' => $team->name,
                'projectCount' => $projectCount
            ];
        }
        $projects = Project::all();
        $taskData = [];
        foreach ($projects as $project) {
            $taskCount = count($project->tasks());
            $taskData[] = [
                'name' => $project->name,
                'taskCount' => $taskCount
            ];
        }
        self::loadView('/home', [
            'title' => 'Homepage',
            'teamData' => $teamData,
            'taskData' => $taskData
        ]);
    }
}
