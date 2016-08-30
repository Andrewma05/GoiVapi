<?php


namespace Model;

use Library\DbConnection;

class ShowAllCompanyModel
{
    public function showallcompany($vud)
    {
        $db = DbConnection::getInstance()->getPdo();

        if ($_SESSION['id_region'] != 26){
            $reg=$_SESSION['id_region'];
            $sql = "SELECT * FROM company WHERE vud ='$vud' AND id_region = '$reg'";
        }else{
            $sql = "SELECT * FROM company WHERE vud ='$vud' ";
        };


        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);


        $regs = $sth->fetchAll(\PDO::FETCH_ASSOC);


        if (!$regs) {
            $regs = null;
        }

        return $regs;
    }

}