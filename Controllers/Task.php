<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\Comment;
use App\Models\User;
use App\Models\Project;
use App\Models\Status;
use App\Models\Priority;

class TaskController extends BaseController
{
    public static function index()
    {
        $tasks = Task::all();
        foreach ($tasks as $task) {
            $commentCount = count(array_filter(Comment::all(), function ($comment) use ($task) {
                return $comment->task_id == $task->id;
            }));
        }
        foreach ($tasks as $task) {
            $task->comment_count = count(array_filter(Comment::all(), function ($comment) use ($task) {
                return $comment->task_id == $task->id;
            }));
        }

        self::loadView('/tasks/index', [
            'tasks' => $tasks
        ]);
    }

    public static function show($id)
    {
        $task = Task::find($id);

        // Fetch all comments
        $comments = Comment::all();
        $users = User::all(); // Assuming you have a User model to fetch user data
        $comments = array_filter($comments, function ($comment) use ($id) {
            return $comment->task_id == $id;
        });

        // Attach user info to each comment
        foreach ($comments as $comment) {
            $user = array_filter($users, function ($user) use ($comment) {
                return $user->id == $comment->user_id;
            });
            $user = reset($user);
            if ($user) {
                $comment->user_first_name = $user->first_name;
                $comment->user_last_name = $user->last_name;
            }
        }

        // Create an associative array to hold references to comments by their ID
        $commentMap = [];
        foreach ($comments as $comment) {
            $commentMap[$comment->id] = $comment;
            $comment->children = []; // Initialize the children array
        }

        // Organize comments into a tree structure
        $rootComments = [];
        foreach ($comments as $comment) {
            // Check if the comment is a root comment (no parent or parent_comment_id is null/0)
            if ($comment->parent_comment_id === $comment->id) {
                // Root-level comment
                $rootComments[] = $comment;
            } else {
                // Nested comment, add to its parent's children array
                if (isset($commentMap[$comment->parent_comment_id])) {
                    $commentMap[$comment->parent_comment_id]->children[] = $comment;
                }
            }
        }

        // Assign the tree-structured comments to the task
        $task->comments = $rootComments;
        // Attach user info to the task
        $user = User::find($task->user_id);
        if ($user) {
            $task->user = $user->first_name . ' ' . $user->last_name;
            $task->user_id = $user->id;
        }

        // Assuming you have a Project model to fetch project data
        $project = Project::find($task->project_id);
        if ($project) {
            $task->project_name = $project->name;
            $task->project_id = $project->id;
        }

        // Add status and priority to the task
        $task->status = Status::find($task->status_id)->name;
        $task->priority = Priority::find($task->priority_id)->name;
        self::loadView('/tasks/detail', [
            'task' => $task
        ]);
    }
}
