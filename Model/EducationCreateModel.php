<?php


namespace Model;

use Library\Request;
use Library\DbConnection;

class EducationCreateModel
{
    public $id_jobseekers;
    public $school;
    public $specialty;
    public $level_school;
    public $freedate;
    

    /**
     * UserCreate constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->id_jobseekers = $request->post('id_jobseekers');
        $this->school = $request->post('school');
        $this->specialty = $request->post('specialty');
        $this->level_school = $request->post('level_school');
        $this->freedate = $request->post('freedate');
        
    }

    /**
     * @return bool
     */
    function isValid()
    {
        $res = ($this->id_jobseekers !== '' &&
            $this->school !== '' &&
            $this->specialty !== '' &&
            $this->level_school !== '' &&
            $this->freedate !== '');

        return $res;
    }

    public function showeducation($id_education)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM education WHERE id = '$id_education'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $education = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$education) {
            $education = null;
        }
        return $education;
    }
    

    public function save(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = 'INSERT INTO education (id_jobseekers, school, specialty, level_school, freedate)
                VALUES (:id_jobseekers, :school, :specialty, :level_school, :freedate)';
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

    public function updateeducation(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sth = $db->query("SET NAMES 'utf8'");

        $sql = "UPDATE education SET
                school = :school,         
                specialty = :specialty,
                level_school = :level_school,
                freedate = :freedate
                
                WHERE id = :id";

        $s = $db->prepare($sql);

        $s->execute($user);

    }

}