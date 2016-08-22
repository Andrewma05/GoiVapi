<?php


namespace Model;

use Library\DbConnection;

class AllUseresModel
{
    public function showallusers()
    {
        $db = DbConnection::getInstance()->getPdo();

        $sql = "SELECT * FROM wuser";

        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);


        $regs = $sth->fetchAll(\PDO::FETCH_ASSOC);


        if (!$regs) {
            throw new NotFoundException('Шукача не знайдено');
        }

        return $regs;
    }

    public function showreg()
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM region";
        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);


        $regions = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if (!$regions) {
            throw new NotFoundException('Регіон не знайдено');
        }

        return $regions;
    }

}