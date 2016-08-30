<?php


namespace Model;

use Library\Request;
use Library\DbConnection;

class ExperienceCreateModel
{
    public $id_jobseekers;
    public $organization;
    public $experience;
    public $specialty;
    public $posada;


    /**
     * UserCreate constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->id_jobseekers = $request->post('id_jobseekers');
        $this->organization = $request->post('organization');
        $this->experience = $request->post('experience');
        $this->specialty = $request->post('specialty');
        $this->posada = $request->post('posada');

    }

    public function showexperience($id_experience)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM experience WHERE id = '$id_experience'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $experience = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$experience) {
            $experience = null;
        }
        return $experience;
    }
    
    

    /**
     * @return bool
     */
    function isValid()
    {
        $res = ($this->id_jobseekers !== '' &&
            $this->organization !== '' &&
            $this->experience !== '' &&
            $this->specialty !== '' &&
            $this->posada !== '');

        return $res;
    }

    public function save(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = 'INSERT INTO experience (id_jobseekers, organization, experience, specialty, posada)
                VALUES (:id_jobseekers, :organization, :experience, :specialty, :posada)';
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

    public function updateexperience(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sth = $db->query("SET NAMES 'utf8'");

        $sql = "UPDATE experience SET
                organization = :organization,         
                experience = :experience,
                specialty = :specialty,
                posada = :posada
                
                WHERE id = :id";
        

        $s = $db->prepare($sql);

        $s->execute($user);

    }

}