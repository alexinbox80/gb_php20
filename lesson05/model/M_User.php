<?php
//include_once('M_DB.php');
class M_User {

    private $db;

    function __construct()
    {
        $this->db = M_DB::getObject();
    }

    public function auth(string $login, string $passwdMd5): bool
    {
        $sql = "SELECT id, user_id, role FROM users WHERE login = '$login' AND passwd = '$passwdMd5'";

        $this->db->select($this->db, $sql);

        //connect k BD
        echo $login . ' : ' . $passwd . "<br>\n";
        return true;
    }
}