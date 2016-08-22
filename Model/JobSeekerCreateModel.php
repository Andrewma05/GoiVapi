<?php


namespace Model;

use Library\Request;
use Library\DbConnection;


class JobSeekerCreateModel
{
    public $surname;
    public $jobseekername;
    public $father;
    public $stat;
    public $birthdate;
    public $pasport;
    public $adress;
    public $contact;
    public $email;
    public $grup;
    public $freedate;
    public $stvoreno;
    public $id_wuser;
    public $id_region;
    public $statuswork;

    /**
     * UserCreate constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->surname = $request->post('surname');
        $this->jobseekername = $request->post('jobseekername');
        $this->father = $request->post('father');
        $this->stat = $request->post('stat');
        $this->birthdate = $request->post('birthdate');
        $this->pasport = $request->post('pasport');
        $this->adress = $request->post('adress');
        $this->contact = $request->post('contact');
        $this->email = $request->post('email');
        $this->grup = $request->post('grup');
        $this->freedate = $request->post('freedate');
    }

    /**
     * @return bool
     */
    function isValid()
    {
        $res = ($this->surname !== '' &&
            $this->jobseekername !== '' &&
            $this->father !== '' &&
            $this->stat !== '' &&
            $this->birthdate !== '' &&
            $this->pasport !== '' &&
            $this->adress !== '' &&
            $this->contact &&
            $this->email !== '' &&
            $this->grup !== '' &&
            $this->freedate !== '');


        return $res;
    }

    public function save(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = 'INSERT INTO job_seekers (surname, jobseekername, father, stat, birthdate, pasport, adress, contact, email, grup, freedate, stvoreno, id_wuser, id_region, statuswork)
                VALUES (:surname, :jobseekername, :father, :stat, :birthdate, :pasport, :adress, :contact, :email, :grup, :freedate, :stvoreno, :id_wuser, :id_region, :statuswork)';
        $s = $db->prepare($sql);
        $s->execute($user);
    }

    public function showvud_inval()
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM vud_inval";
        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);


        $vud_inval = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if (!$vud_inval) {
            throw new NotFoundException('Видів інвалідності незнайдено');
        }

        return $vud_inval;
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

    public function isip($passport)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT id FROM job_seekers WHERE pasport = '$passport'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $idseeker = $sth->fetchAll(\PDO::FETCH_ASSOC);
        $idseeker = $idseeker[0];

        $idseeker = $idseeker['id'];
        

        return $idseeker;
    }

    public function updatejobseekers(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sth = $db->query("SET NAMES 'utf8'");

        $sql = "UPDATE job_seekers SET
                surname = :surname,         
                jobseekername = :jobseekername,
                father = :father,
                stat = :stat,
                birthdate = :birthdate,
                pasport = :pasport,
                adress = :adress,
                contact = :contact,
                email = :email,
                grup = :grup,
                freedate = :freedate,
                stvoreno = :stvoreno
                
                WHERE id = :id";

        $s = $db->prepare($sql);

        $s->execute($user);

    }

    public function dizact(array $chomy)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sth = $db->query("SET NAMES 'utf8'");
        
        $sql = "UPDATE job_seekers SET
                statuswork = :statuswork
                
                WHERE id = :id";

        $s = $db->prepare($sql);

        $s->execute($chomy);

    }
    
    

}