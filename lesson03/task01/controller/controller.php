<?php

namespace controller\phpv20;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once "../public/gallery.php";
require_once "BD.php";

class Controller
{
    public function init(string $photo_id)
    {
        $action = '';

        if ($photo_id <> '') {
            $action = 'image';
        }

        $data = new \twig\phpv20\BD();
        $gallery = new \twig\phpv20\Gallery();

        switch ($action) {
            case 'image':
                $pics = $data->getData($photo_id);
                $title = "Show image";
                $content = [
                    'title' => $title,
                    'pics' => $pics
                ];
                $gallery->show($content, "image");
                break;
            default:
                $pics = $data->getData(-1);
                $title = "Gallery";
                $content = [
                    'title' => $title,
                    'pics' => $pics
                ];
                $gallery->show($content, "gallery");
        }
    }
}
