<?php

class M_Goods
{
    private object $db;

    function __construct()
    {
        $this->db = M_DB::getObject();
    }

    public function getGoods(): array
    {
        $sql = "SELECT * FROM images WHERE id>0 LIMIT 18";

        $data = $this->db->select($sql);

        return $data;
    }
}
