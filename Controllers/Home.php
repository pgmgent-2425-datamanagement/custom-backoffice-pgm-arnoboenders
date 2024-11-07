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
        self::loadView('/home', [
            'title' => 'Homepage',
            'teamData' => $teamData
        ]);
    }
}
