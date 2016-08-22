<?php


namespace Model;

use Library\Request;
use Library\DbConnection;

class MoreMadeCreateModel
{
    public $id_jobseekers;
    public $vuddialnosti;
    public $made;
    public $id_wuser;
    public $data_made;
    public $id_company;



    /**
     * UserCreate constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->id_jobseekers = $request->post('id_jobseekers');
        $this->vuddialnosti = $request->post('vuddialnosti');
        $this->made = $request->post('made');
        $this->id_company = $request->post('id_company');
    }



    public function showmoreskills($id_moremade)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM more_made WHERE id = '$id_moremade'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $moremade = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$moremade) {
            $moremade = null;
        }
        return $moremade;
    }

    /**
     * @return bool
     */
    function isValid()
    {
        $res = ($this->id_jobseekers !== '' &&
            $this->made !== '');

        return $res;
    }

    public function save(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = 'INSERT INTO more_made (id_jobseekers, vuddialnosti, made, id_wuser, data_made)
                VALUES (:id_jobseekers, :vuddialnosti, :made, :id_wuser, :data_made)';
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

    public function updatemoremade(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sth = $db->query("SET NAMES 'utf8'");

        $sql = "UPDATE more_made SET
                    vuddialnosti = :vuddialnosti,
                    made = :made
                    
                    WHERE id = :id";

        $s = $db->prepare($sql);

        $s->execute($user);

    }

    public function savenapravl(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = 'INSERT INTO more_made (id_jobseekers, vuddialnosti, made, id_wuser, data_made, id_company)
                VALUES (:id_jobseekers, :vuddialnosti, :made, :id_wuser, :data_made, :id_company)';
        $s = $db->prepare($sql);
        $s->execute($user);
    }






}