<?php

class M_DB
{

    static $obj;
    static $connect;
    const HOST = 'localhost';
    const DBNAME = 'eshop';
    const USERNAME = 'eshop';
    const PASSWD = 'eshop';

    private $dbh = '';

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
        //$dbh ='';

        self::$connect = 'mysql:host=' . self::HOST . ';dbname=' . self::DBNAME;

        try {
            $this->dbh = new PDO(self::$connect, self::USERNAME, self::PASSWD);
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
        $data = [];

        try {

            echo "$sql <br>\n";

            $sth = $this->dbh->prepare($sql);

            $sth->execute();

            while ($row = $sth->fetch()) {
                $data[] = $row;
            }

            // закрываем соединение
            unset($this->dbh);

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
