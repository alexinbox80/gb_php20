<?php
namespace twig\phpv20;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class BD {
    public function getData(int $listBegin, int $listCount): array
    {
        $data = [];

        // подключение к бд
        try {
            $dbh = new \PDO('mysql:dbname=world;host=127.0.0.1;port=8889', 'world', 'guessme');
        } catch (\PDOException $e) {
            echo "Error: Could not connect. " . $e->getMessage();
        }

// установка error режима
        $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

// выполняем запрос
        try {
            // формируем SELECT запрос
            // в результате каждая строка таблицы будет объектом

            $sql = "SELECT * FROM images LIMIT $listBegin, $listCount";

            $sth = $dbh->query($sql);
            while ($row = $sth->fetchObject()) {
                $data[] = $row;
            }

            // закрываем соединение
            unset($dbh);

        } catch (\Exception $e) {

            die ('ERROR: ' . $e->getMessage());
        }

        return $data;
    }
}
