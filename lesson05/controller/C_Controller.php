<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require 'vendor/autoload.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class C_Controller
{
    protected abstract function render();

    protected abstract function before();

    public function Request($action)
    {
        $this->before();
        $this->$action();
        $this->render();
    }

    protected function makePasswdMd5($login, $passwd)
    {
        $salt = "zyjdfhm";
        return strrev(md5($salt) . $passwd . md5($login));
    }

    protected function IsGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    protected function IsPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function setSiteSession(string $name, array $arr): bool
    {
        $_SESSION[$name] = $arr;

        return true;
    }

    protected function getSiteSession(string $name)
    {
        if (isset($_SESSION[$name])){
            $result = $_SESSION[$name];
        } else {
            $result = false;
        }
        return $result;
    }

    public function Template(string $filename, array $content): string
    {
        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader);
        return $twig->render($filename, $content);
    }

    public function __call($name, $params)
    {
        die('Wrong url address!<br>');
    }
}
