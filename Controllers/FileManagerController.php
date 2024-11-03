<?php

namespace App\Controllers;

class FileManagerController extends BaseController
{
    public static function index()
    {
        $list = scandir(BASE_DIR . '/public/images');

        self::loadView('/filemanager', [
            'list' => $list
        ]);
    }

    public static function delete($file)
    {
        $filePath = BASE_DIR . '/public/images/' . urldecode($file);
        if (is_file($filePath)) {
            unlink($filePath);
        }
        header('Location: /files');
        exit;
    }
}