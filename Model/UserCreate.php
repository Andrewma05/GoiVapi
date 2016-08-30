<?php

namespace Model;

use Library\Request;
use Library\DbConnection;


class UserCreate
{
    public $surname;
    public $username;
    public $father;
    public $region;
    public $startwork;
    public $contact;
    public $foto=null;
    public $status='admin';
    public $email;
    public $password;
    public $passworddabl;

    /**
     * UserCreate constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->surname = $request->post('surname');
        $this->username = $request->post('username');
        $this->father = $request->post('father');
        $this->region = $request->post('region');
        $this->startwork = $request->post('startwork');
        $this->contact = $request->post('contact');
        $this->foto = $request->post('foto');
        $this->status = $request->post('status');
        $this->email = $request->post('email');
        $this->password = $request->post('password');
        $this->passworddabl = $request->post('passworddabl');
    }

    public function showuser($id_user)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM wuser WHERE id = '$id_user'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $user = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$user) {
            $user = null;
        }
        return $user;
    }
    
    

    /**
     * @return bool
     */
    function isValid()
    {
        $res = ($this->surname !== '' &&
        $this->username !== '' &&
        $this->father !== '' &&
        $this->region !== '' &&
        $this->startwork !== '' &&
        $this->contact !== '' &&
//        $this->foto &&
        $this->status !== '' &&
        $this->email !== '' &&
        $this->password !== '' &&
        $this->password === $this->passworddabl);
        
        
//        $res = $this->username !== '' && $this->email !== '' && $this->message !== '';
        return $res;
    }

    public function save(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = 'INSERT INTO wuser (surname, username, father, id_region, startwork, contact, foto,status, email, password)
                VALUES (:surname, :username, :father, :region, :startwork, :contact, :foto,:status, :email, :password)';
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

    public function updateuser(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sth = $db->query("SET NAMES 'utf8'");

        $sql = "UPDATE wuser SET
                surname = :surname,         
                username = :username,
                father = :father,
                
                startwork = :startwork,
                contact = :contact,         
               
                status = :status,
                email = :email
                                
                WHERE id = :id";

        $s = $db->prepare($sql);

        $s->execute($user);

    }
    
}
