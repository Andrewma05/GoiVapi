<?php
namespace Model;

use Library\DbConnection;
use Library\NotFoundException;

class AdminModel
{
    public function showreg()
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM region";
        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $regs = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$regs) {
            throw new NotFoundException('Регіон не знайдено');
        }
        return $regs;
    }    
    
    public function userMe()
    {
        $db = DbConnection::getInstance()->getPdo();
        $identif = $_SESSION['id'];
        $sql = "SELECT * FROM wuser LEFT JOIN region ON wuser.id_region = region.id WHERE wuser.id='$identif'";
        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $user = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $user;
    }

    public function reg()
    {
        $db = DbConnection::getInstance()->getPdo();
        $reg= $_SESSION['id_region'];
        $sql = "SELECT * FROM region WHERE id = '$reg'";
        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $reg = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$reg) {
            throw new NotFoundException('Регіон не знайдено');
        }
        return $reg;
    }


}