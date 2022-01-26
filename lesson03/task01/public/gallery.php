<?php
namespace twig\phpv20;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require '../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Gallery
{

    public function show(array $content, string $tmpl): void
    {
        $loader = new FilesystemLoader('../templates');
        $gallery = new Environment($loader);

        switch ($tmpl) {
            case 'image':
                echo $gallery->render('image.tmpl', $content);
                break;
            case 'gallery':
                echo $gallery->render('gallery.tmpl', $content);
                break;
            default:
                echo "Wrong template! <br>\n";
        }


    }
}
