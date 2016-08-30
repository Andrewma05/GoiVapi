<?php


namespace Model;

use Library\DbConnection;

class VudInvalModel
{
    public function showallvudinval()
    {

        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM vud_inval";

        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);


        $vudinval = $sth->fetchAll(\PDO::FETCH_ASSOC);


        return $vudinval;
    }

    public function showvud_inval()
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM vud_inval";
        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);


        $vud_inval = $sth->fetchAll(\PDO::FETCH_ASSOC);

  

        return $vud_inval;
    }

    public function save(array $vud)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = 'INSERT INTO vud_inval (vud)
                VALUES (:vud)';
        $s = $db->prepare($sql);
        $s->execute($vud);
    }

}