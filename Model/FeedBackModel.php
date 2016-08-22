<?php


namespace Model;


use Library\DbConnection;

class FeedBackModel
{
    public function save(array $feedback)
    {
        // todo: check if feedback has keys username, email and so on

        $db = DbConnection::getInstance()->getPdo();
        $sql = 'INSERT INTO feedback (username, email, message, created)
                VALUES (:username, :email, :message, :created)';
        $s = $db->prepare($sql);
        $s->execute($feedback);
    }

}