<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\Comment;
use App\Models\User;

class TaskController extends BaseController
{
    public static function index()
    {
        $tasks = (new Task())->all();
        $comments = (new Comment())->all();
        $users = (new User())->all(); // Assuming you have a User model to fetch user data

        // Attach user info to each comment
        foreach ($comments as &$comment) {
            $user = array_filter($users, function ($user) use ($comment) {
                return $user->id == $comment->user_id;
            });
            $user = reset($user);
            if ($user) {
                $comment->user_first_name = $user->first_name;
                $comment->user_last_name = $user->last_name;
            }
        }

        $tasksWithComments = [];

        foreach ($tasks as $task) {
            // Get comments for this task
            $taskComments = array_filter($comments, function ($comment) use ($task) {
                return $comment->task_id == $task->id;
            });

            // Create an associative array to hold references to comments by their ID
            $commentMap = [];
            foreach ($taskComments as $comment) {
                $commentMap[$comment->id] = $comment;
                $comment->children = []; // Initialize the children array
            }

            // Organize comments into a tree structure
            $rootComments = [];
            foreach ($taskComments as $comment) {
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

            $tasksWithComments[] = $task;
        }

        self::loadView('/tasks', [
            'tasks' => $tasksWithComments
        ]);
    }
    public static function show($id)
    {
        self::loadView('/task', [
            'task' => (new Task())->find($id)
        ]);
    }
}
