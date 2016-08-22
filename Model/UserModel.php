<?php

namespace Model;

use Library\DbConnection;

class UserModel
{
    public function find($email, $password)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('select * from wuser where email = :email and password = :password');
        $sth->execute(array(
            'email' => $email,
            'password' => $password
        ));

        $user = $sth->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }
}