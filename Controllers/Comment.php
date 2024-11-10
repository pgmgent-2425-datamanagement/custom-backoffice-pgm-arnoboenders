<?php
namespace App\Controllers;
use App\Models\Comment;
use App\Models\User;

class CommentController extends BaseController
{
    public static function index()
    {
        $comments = Comment::all();
        self::loadView('/comments', [
            'comments' => $comments
        ]);
    }
    public static function show($id)
    {
        $comment = Comment::find($id);

        $user = User::find($comment->user_id);
        if ($user) {
            $comment->user_first_name = $user->first_name;
            $comment->user_last_name = $user->last_name;
        }

        $comments = Comment::all();
        $users = User::all();

        // Attach user info to each comment
        foreach ($comments as $c) {
            $user = array_filter($users, function ($user) use ($c) {
                return $user->id == $c->user_id;
            });
            $user = reset($user);
            if ($user) {
                $c->user_first_name = $user->first_name;
                $c->user_last_name = $user->last_name;
            }
        }

        // Create an associative array to hold references to comments by their ID
        $commentMap = [];
        foreach ($comments as $c) {
            $commentMap[$c->id] = $c;
            $c->children = []; // Initialize the children array
        }

        // Organize comments into a tree structure
        $rootComments = [];
        foreach ($comments as $c) {
            if ($c->parent_comment_id == $id && $c->id != $id) {
                // Direct child of the comment with the given ID and not the comment itself
                $rootComments[] = $c;
            } elseif (isset($commentMap[$c->parent_comment_id])) {
                // Nested comment, add to its parent's children array
                $commentMap[$c->parent_comment_id]->children[] = $c;
            }
        }

        // Assign the tree-structured comments to the comment
        $comment->comments = $rootComments;

        self::loadView('/comments/detail', [
            'comment' => $comment
        ]);
    }
    public static function create()
    {
        if (isset($_POST['content'])) {
            $data = [
                'content' => $_POST['content'],
                'task_id' => $_POST['task_id'],
                'user_id' => $_POST['user_id']
            ];
            $comment = new Comment();
            $comment->create($data);
            header('Location: /comments');
            exit;
        } else {
            self::loadView('/comments/create');
        }
    }
    public static function edit($id)
    {
        $comment = Comment::find($id);
        if (isset($_POST['content'])) {
            $data = [
                'content' => $_POST['content'],
                'task_id' => $_POST['task_id'],
                'user_id' => $_POST['user_id']
            ];
            $comment->update($id, $data);
            header('Location: /comments');
            exit;
        } else {
            self::loadView('/comments/edit', [
                'comment' => $comment
            ]);
        }
    }
    public static function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        header('Location: /comments');
        exit;
    }
}