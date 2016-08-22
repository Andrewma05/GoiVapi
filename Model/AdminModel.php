<?php
namespace Model;

use Library\DbConnection;
use Library\NotFoundException;

class AdminModel
{
  

//    public function showuser()
//    {
//        $db = DbConnection::getInstance()->getPdo();
////        $sql = "
////            select b.title, b.id, b.price, b.status, group_concat(a.name) as authors
////            from book b join  book_author ba on b.id = ba.book_id
////            join author a on ba.author_id = a.id
////            group by b.id
////
////        ";   - запит, показати всіх користувачів
//        $sth = $db->query("SET NAMES 'utf8'");
//        $sth = $db->query($sql);
//        $users = $sth->fetchAll(\PDO::FETCH_ASSOC);
//
//        if (!$users) {
//            throw new NotFoundException('Books not found');
//        }
//
//        return $users;
//    }

    public function showreg()
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM region";
        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);


        $regs = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if (!$regs) {
            throw new NotFoundException('Books not found');
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