<?php


namespace Model;

use Library\Request;
use Library\DbConnection;

class MoreSpecialtyCreateModel
{
    public $id_jobseekers;
    public $specialty;
    


    /**
     * UserCreate constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->id_jobseekers = $request->post('id_jobseekers');
        $this->specialty = $request->post('specialty');

    }

    public function showmorespecialty($id_morespecialty)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM more_specialty WHERE id = '$id_morespecialty'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $morespecialty = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$morespecialty) {
            $morespecialty = null;
        }
        return $morespecialty;
    }

    /**
     * @return bool
     */
    function isValid()
    {
        $res = ($this->id_jobseekers !== '' &&
                $this->specialty !== '');

        return $res;
    }

    public function save(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = 'INSERT INTO more_specialty (id_jobseekers, specialty)
                VALUES (:id_jobseekers, :specialty)';
        $s = $db->prepare($sql);
        $s->execute($user);
    }

    public function showreg()
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM region";
        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);


        $regs = $sth->fetchAll(\PDO::FETCH_ASSOC);

       

        return $regs;
    }

    public function updatemorespecialty(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sth = $db->query("SET NAMES 'utf8'");

        $sql = "UPDATE more_specialty SET
                specialty = :specialty
                
                WHERE id = :id";

        $s = $db->prepare($sql);

        $s->execute($user);

    }
}