<?php

class M_Goods
{
    private $db;

    function __construct()
    {
        $this->db = M_DB::getObject();
    }

    public function getGoods(): array
    {
        $sql = "SELECT * FROM images LIMIT 18";

        $data = $this->db->select($sql);

        return $data;
    }
}
