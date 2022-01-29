<?php

namespace controller\phpv20;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once "../public/gallery.php";
require_once "BD.php";

class Controller
{
    public function init(): void
    {
        $action = '';

        $data = new \twig\phpv20\BD();
        $gallery = new \twig\phpv20\Gallery();

        switch ($action) {
            case 'img':

                break;
            default:
                $pics = $data->getData(0, 10);
                $title = "Gallery";
                $content = [
                    'title' => $title,
                    'pics' => $pics
                ];
                $gallery->show($content, "gallery");
        }
    }
}
