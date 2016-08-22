<?php


namespace Model;

use Library\DbConnection;

class ShowUserModel
{
    public function showuser($jobseeker)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sql = "SELECT * FROM wuser WHERE id = '$jobseeker'";

        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);


        $regs = $sth->fetchAll(\PDO::FETCH_ASSOC);


        if (!$regs) {
            throw new NotFoundException('Шукача не знайдено');
        }

        return $regs;
    }

    public function updete(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = 'INSERT INTO wuser (surname, username, father, id_region, startwork, contact, foto,status, email, password)
                VALUES (:surname, :username, :father, :region, :startwork, :contact, :foto,:status, :email, :password)';
        $s = $db->prepare($sql);
        $s->execute($user);
    }
}