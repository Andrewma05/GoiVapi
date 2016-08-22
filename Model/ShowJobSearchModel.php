<?php


namespace Model;


use Library\DbConnection;

class ShowJobSearchModel
{
    public function showjobseekers($jobseeker)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sql = "SELECT * FROM job_seekers WHERE id = '$jobseeker'";
        
        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);


        $regs = $sth->fetchAll(\PDO::FETCH_ASSOC);


        if (!$regs) {
            throw new NotFoundException('Шукача роботи не знайдено');
        }
        
        return $regs;
    }

    public function showeducation($jobseeker)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM education WHERE id_jobseekers = '$jobseeker'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $education = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$education) {
            $education = null;
        }
        return $education;
    }

    public function showexperience($jobseeker)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM experience WHERE id_jobseekers = '$jobseeker'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $experience = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$experience) {
            $experience = null;
        }
        return $experience;
    }

    public function showpastresort($jobseeker)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM past_resort WHERE id_jobseekers = '$jobseeker'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $pastresort = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$pastresort) {
            $pastresort = null;
        }
        return $pastresort;
    }

    public function showmorespecialty($jobseeker)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM more_specialty WHERE id_jobseekers = '$jobseeker'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $morespecialty = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$morespecialty) {
            $morespecialty = null;
        }
        return $morespecialty;
    }

    public function showmoreskills($jobseeker)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM more_skills WHERE id_jobseekers = '$jobseeker'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $moreskills = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$moreskills) {
            $moreskills = null;
        }
        return $moreskills;
    }

    public function showsearch($jobseeker)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM job_search WHERE id_jobseekers = '$jobseeker'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $search = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$search) {
            $search = null;
        }
        return $search;
    }

    public function showmoremade($jobseeker)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sql = "SELECT * FROM more_made WHERE id_jobseekers = '$jobseeker'";
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);
        $moremade = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (!$moremade) {
            $moremade = null;
        }
        return $moremade;
    }


}