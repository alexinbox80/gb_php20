<?php

class M_DB
{

    static $obj;
    static $connect;
    const HOST = 'localhost';
    const DBNAME = 'mydbname';
    const USERNAME = 'world';
    const PASSWD = 'guessme';

    public static function getObject(): object
    {
        if (self::$obj == null) {
            //self::$obj = new DB();
            self::$obj = new self;
        }
        return self::$obj;
    }

    private function __construct()
    {
        $dbh ='';

        self::$connect = 'mysql:host=' . self::HOST . ';dbname=' . self::DBNAME;

        try {
            $dbh = new PDO(self::$connect, self::USERNAME, self::PASSWD);
        } catch (PDOException $e) {
            echo "Error: Could not connect. " . $e->getMessage();
        }

// установка error режима
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    private function __clone()
    {
    }

    public function select($dbh, $sql): array
    {
        $data = [];

        try {

            $sth = $dbh->query($sql);

            while ($row = $sth->fetchObject()) {
                $data[] = $row;
            }

            // закрываем соединение
            unset($dbh);

        } catch (Exception $e) {

            die ('ERROR: ' . $e->getMessage());
        }

        return $data;
    }

    public function insert(): array
    {
        $a = [];
        return $a;
    }

    public function update(): array
    {
        $a = [];
        return $a;
    }

    public function delete(): array
    {
        $a = [];
        return $a;
    }
}
