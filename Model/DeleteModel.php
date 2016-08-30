<?php


namespace Model;

use Library\DbConnection;

class DeleteModel
{
//    public $name;
//    public $ident;
    
    
    public function delete($ident)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "DELETE FROM experience WHERE id = '$ident'";
        $s = $db->prepare($sql);
        $s->execute();
        
    }


}