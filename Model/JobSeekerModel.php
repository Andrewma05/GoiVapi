<?php
/**
 * Created by PhpStorm.
 * User: Cent
 * Date: 20.08.2016
 * Time: 13:24
 */

namespace Model;

use Library\Request;
use Library\DbConnection;

class JobSeekerModel
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

    public function showjobseeker($surname)
    {
        $db = DbConnection::getInstance()->getPdo();

        if ($_SESSION['id_region'] != 26){
            $reg=$_SESSION['id_region'];
            $sql = "SELECT * FROM job_seekers WHERE surname = '$surname' AND id_region = '$reg'";
        }else{
            $sql = "SELECT * FROM job_seekers WHERE surname = '$surname'";
        };

        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $idseeker = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $idseeker;
    }
}