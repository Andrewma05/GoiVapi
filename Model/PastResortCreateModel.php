<?php


namespace Model;

use Library\Request;
use Library\DbConnection;

class PastResortCreateModel
{
    public $id_jobseekers;
    public $organization;
    public $resort_date;
    public $result;
    public $posada;


    /**
     * UserCreate constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->id_jobseekers = $request->post('id_jobseekers');
        $this->organization = $request->post('organization');
        $this->resort_date = $request->post('resort_date');
        $this->result = $request->post('result');
        $this->posada = $request->post('posada');

    }

    public function showpastresort($id_pastresort)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM past_resort WHERE id = '$id_pastresort'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $pastresort = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$pastresort) {
            $pastresort = null;
        }
        return $pastresort;
    }

    /**
     * @return bool
     */
    function isValid()
    {
        $res = ($this->id_jobseekers !== '' &&
            $this->organization !== '' &&
            $this->resort_date !== '' &&
            $this->result !== '' &&
            $this->posada !== '');

        return $res;
    }

    public function save(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->query("SET NAMES 'utf8'");
        $sql = 'INSERT INTO past_resort (id_jobseekers, organization, resort_date, result, posada)
                VALUES (:id_jobseekers, :organization, :resort_date, :result, :posada)';
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

    public function updatepastresort(array $user)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sth = $db->query("SET NAMES 'utf8'");

        $sql = "UPDATE past_resort SET
                organization = :organization,         
                resort_date = :resort_date,
                result = :result,
                posada = :posada
                
                WHERE id = :id";

        $s = $db->prepare($sql);

        $s->execute($user);

    }

}