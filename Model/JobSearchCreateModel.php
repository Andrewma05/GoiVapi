<?php


namespace Model;

use Library\Request;
use Library\DbConnection;

class JobSearchCreateModel
{
    public $id_jobseekers;
    public $specialty;
    public $id_region;
    public $job_grapf;
    public $sort_job;
    public $salary;


    /**
     * UserCreate constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->id_jobseekers = $request->post('id_jobseekers');
        $this->specialty = $request->post('specialty');
        $this->region = $request->post('id_region');
        $this->job_grapf = $request->post('job_grapf');
        $this->sort_job = $request->post('sort_job');
        $this->salary = $request->post('salary');

    }

    public function showsearch($id_jobsearch)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM job_search WHERE id = '$id_jobsearch'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $search = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$search) {
            $search = null;
        }
        return $search;
    }

    /**
     * @return bool
     */
    function isValid()
    {
        $res = ($this->id_jobseekers !== '' &&
            $this->specialty !== '' &&
            $this->id_region !== '' &&
            $this->job_grapf !== '' &&
            $this->sort_job !== '' &&
            $this->salary !== '');

        return $res;
    }

    public function save(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = 'INSERT INTO job_search (id_jobseekers, specialty, id_region, job_grapf, sort_job, salary)
                VALUES (:id_jobseekers, :specialty, :id_region, :job_grapf, :sort_job, :salary)';
//    var_dump($user);
//        die;
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

    public function updatesearch(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sth = $db->query("SET NAMES 'utf8'");

        $sql = "UPDATE job_search SET
                specialty = :specialty,         
                id_region = :id_region,
                job_grapf = :job_grapf,
                sort_job = :sort_job,
                salary = :salary
                
                WHERE id = :id";

        $s = $db->prepare($sql);

        $s->execute($user);

    }

}