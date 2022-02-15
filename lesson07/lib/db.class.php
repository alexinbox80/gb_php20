<?php

class db
{
    private static $_instance = null;

    private $db; // Ресурс работы с БД

    /*
     * Получаем объект для работы с БД
     */
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new db();
        }
        return self::$_instance;
    }

    /*
     * Запрещаем копировать объект
     */
    private function __construct()
    {
    }

    private function __sleep()
    {
    }

    private function __wakeup()
    {
    }

    private function __clone()
    {
    }

    /*
     * Выполняем соединение с базой данных
     */
    public function Connect($user, $password, $base, $host = 'localhost', $port = 3306)
    {
        // Формируем строку соединения с сервером
        $connectString = 'mysql:host=' . $host . ';port= ' . $port . ';dbname=' . $base . ';charset=UTF8;';
        $this->db = new PDO($connectString, $user, $password,
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // возвращать ассоциативные массивы
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // возвращать Exception в случае ошибки
            ]
        );
    }

    public function QueryBindParam($query, $params = array(), $debug = false)
    {
        $res = '';

        if ($debug) {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }

        $result = $this->db->prepare($query);

        foreach ($params as $param) {
            $result->bindParam($param['name'], $param['data'], $param['type']);
        }

        $result->execute();

        if ($result) {
            $sqlAction = strtolower(trim(explode(' ', $query)[0], 0x20));

            switch ($sqlAction) {
                case 'select':
                    $res = $result->fetchAll();
                    break;
                case 'insert':
                    $res = $this->db->lastInsertId();
                    break;
                case 'update':
                    $res = $result->rowCount();
                    break;
                case 'delete':
                    $res = $result->rowCount();
                    break;
                default:
                    $res = 'Wrong sql action!';
            }
        }

        if ($debug) {
            echo '<pre>';
            print_r($result->debugDumpParams());
            echo '</pre>';

            $res = [];
        }

        return $res;
    }

    /*
     * Выполнить запрос к БД
     */
    public function Query($query, $params = array())
    {

        $res = $this->db->prepare($query);

        $res->execute($params);

        return $res;
    }

    /*
     * Выполнить запрос с выборкой данных
     */
    public function Select($query, $params = array())
    {
        $result = $this->Query($query, $params);

        if ($result) {
            return $result->fetchAll();
        }
    }

    public function beginTransaction():bool
    {
        return $this->db->beginTransaction();
    }

    public function commit():bool
    {
        return $this->db->commit();
    }

    public function rollBack():bool
    {
        return $this->db->rollBack();
    }

    public function inTransaction():bool
    {
        return $this->db->inTransaction();
    }
}
