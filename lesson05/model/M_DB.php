<?php

class M_DB
{
    static $obj;
    static $connect;

    public static function getObject(): object
    {
        if (self::$obj == null) {
            self::$obj = new self;
        }
        return self::$obj;
    }

    private function __construct()
    {
        self::$connect = 'mysql:host=' . DB_conf::HOST . ';dbname=' . DB_conf::DBNAME;

        try {
            $this->dbh = new PDO(self::$connect, DB_conf::USERNAME, DB_conf::PASSWD);
        } catch (PDOException $e) {
            echo "Error: Could not connect. " . $e->getMessage();
        }
// установка error режима
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    private function __clone()
    {
    }

    public function select(string $sql): array
    {

        try {
            $sth = $this->dbh->prepare($sql);

            $sth->execute();

            $data = $sth->fetchAll();

        } catch (Exception $e) {

            die ('ERROR: ' . $e->getMessage());
        }

        return $data;
    }

    public function insert(string $sql): int
    {

        try {
            $sth = $this->dbh->prepare($sql);

            $sth->execute();

            $index = $this->dbh->lastInsertId();

        } catch (Exception $e) {

            die ('ERROR: ' . $e->getMessage());
        }

        return $index;
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
