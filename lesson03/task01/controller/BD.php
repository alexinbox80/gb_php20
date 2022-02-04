<?php
namespace twig\phpv20;

class BD {
    public function getData(int $id = -1): array
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
            if ($id == -1) {
                $sql = "SELECT * FROM images ORDER BY count DESC";
            } else {
                $sql = "UPDATE images SET count = count + 1 WHERE id = $id";
                $sth = $dbh->query($sql);

                $sql = "SELECT * FROM images WHERE id = $id";
            }

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