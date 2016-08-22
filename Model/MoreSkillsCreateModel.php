<?php


namespace Model;

use Library\Request;
use Library\DbConnection;

class MoreSkillsCreateModel
{
    public $id_jobseekers;
    public $skills;



    /**
     * UserCreate constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->id_jobseekers = $request->post('id_jobseekers');
        $this->skills = $request->post('skills');

    }

    public function showmoreskills($id_moreskills)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM more_skills WHERE id = '$id_moreskills'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $moreskills = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$moreskills) {
            $moreskills = null;
        }
        return $moreskills;
    }

    /**
     * @return bool
     */
    function isValid()
    {
        $res = ($this->id_jobseekers !== '' &&
            $this->skills !== '');

        return $res;
    }

    public function save(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();
        
        $sql = 'INSERT INTO more_skills (id_jobseekers, skills)
                VALUES (:id_jobseekers, :skills)';
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

        if (!$regs) {
            throw new NotFoundException('Books not found');
        }

        return $regs;
    }

    public function updatemoreskills(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sth = $db->query("SET NAMES 'utf8'");

        $sql = "UPDATE more_skills SET
                skills = :skills
                
                WHERE id = :id";

        $s = $db->prepare($sql);

        $s->execute($user);

    }
}