<?php


namespace Model;

use Library\DbConnection;

class ZvitModel
{
    public function zvernenman($str, $fin)
    {

        $db = DbConnection::getInstance()->getPdo();

        $sql = "SELECT COUNT(*) FROM job_seekers WHERE stat = 'male' AND stvoreno BETWEEN '$str' AND '$fin'";


        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);

        $zvernenman = $sth->fetchAll(\PDO::FETCH_ASSOC);
        $zvernenman = $zvernenman[0]['COUNT(*)'];
        

        if (!$zvernenman) {
            $zvernen = '0';
//           
        }

        return $zvernenman;
    }

    public function zvernenwoman($str, $fin)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sql = "SELECT COUNT(*) FROM job_seekers WHERE stat = 'female' AND stvoreno BETWEEN '$str' AND '$fin'";



        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);

        $zvernenwoman = $sth->fetchAll(\PDO::FETCH_ASSOC);
        $zvernenwoman = $zvernenwoman[0]['COUNT(*)'];


//        echo '<pre>';
//        echo($regs);
//        echo '</pre>';
//        die;

        if (!$zvernenwoman) {
            $zvernenwoman = '0';
//
        }

        return $zvernenwoman;
    }

    public function grupinval($str, $fin)
    {
        $db = DbConnection::getInstance()->getPdo();

//        $sql = "SELECT grup, COUNT(*) FROM job_seekers GROUP BY grup WHERE stvoreno BETWEEN '$str' AND '$fin'";
        $sql = "SELECT grup, stvoreno, COUNT(*) FROM job_seekers WHERE stvoreno BETWEEN '$str' AND '$fin' GROUP BY grup";

        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);

        $grupinval = $sth->fetchAll(\PDO::FETCH_ASSOC);
//        $grupinval = $grupinval[0]['COUNT(*)'];


//        echo '<pre>';
//        var_dump($grupinval);
//        echo '</pre>';
//        die;

//        if (!$grupinval) {
//            $zvernenwoman = '0';
////
//        }

        return $grupinval;
    }



    public function rezultat($str, $fin)
    {
        $pratsevlash=0;
        $lust=0;
        $dzvinock=0;
        $konsyl=0;
        $zystrich=0;
        $vidmovleno=0;
        $documentu=0;
        $sots=0;

        $db = DbConnection::getInstance()->getPdo();

//        $sql = "SELECT vuddialnosti, COUNT(*) FROM more_made GROUP BY vuddialnosti";
        $sql = "SELECT vuddialnosti, data_made, COUNT(*) FROM more_made WHERE data_made BETWEEN '$str' AND '$fin' GROUP BY vuddialnosti";

        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);

        $rezultat = $sth->fetchAll(\PDO::FETCH_ASSOC);

        foreach($rezultat as $rezul){
            if ($rezul['vuddialnosti']=='Лист'){$lust=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Дзвінок'){$dzvinock=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Надано консультації'){$konsyl=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Зустріч з роботодавцем'){$zystrich=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Відмовлено'){$vidmovleno=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Допомога з оформлення документів'){$documentu=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Соціальний супровід'){$sots=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Працевлаштовано'){$pratsevlash=$rezul['COUNT(*)'];};

        }

        $pynkt_tru_odun = $pratsevlash;
        $pynkt_tru_dva = $lust+$dzvinock+$zystrich;
        $pynkt_tru_tru = $documentu;
        $pynkt_tru_piat = $vidmovleno;
        $pynkt_tru_shist = $konsyl;
        $pynkt_piat = $sots;



        $rezultat = array(
            'pynkt_tru_odun' => $pynkt_tru_odun,
            'pynkt_tru_dva' => $pynkt_tru_dva,
            'pynkt_tru_tru' => $pynkt_tru_tru,
            'pynkt_tru_piat' => $pynkt_tru_piat,
            'pynkt_tru_shist' => $pynkt_tru_shist,
            'pynkt_piat' => $pynkt_piat
        );

        return $rezultat;
    }


    public function showallcompany($vud)
    {
        $db = DbConnection::getInstance()->getPdo();

        $sql = "SELECT * FROM company WHERE vud ='$vud'";

        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);


        $regs = $sth->fetchAll(\PDO::FETCH_ASSOC);


        if (!$regs) {
            $regs = null;
//            throw new NotFoundException('Шукача не знайдено');
        }

        return $regs;
    }

    public function statuswork()
    {
        $db = DbConnection::getInstance()->getPdo();

        $sql = "SELECT COUNT(*) FROM job_seekers WHERE statuswork = 'В пошуках'";



        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);

        $statuswork = $sth->fetchAll(\PDO::FETCH_ASSOC);
//        var_dump($statuswork);
        $statuswork = $statuswork[0]['COUNT(*)'];
//        var_dump($statuswork);
//    die;
//        echo '<pre>';
//        echo($regs);
//        echo '</pre>';
//        die;

        if (!$statuswork) {
            $zvernen = '0';
//
        }

        return $statuswork = 'переробити запит';

    }

    public function reg()
    {
        $db = DbConnection::getInstance()->getPdo();
        $reg= $_SESSION['id_region'];
        $sql = "SELECT * FROM region WHERE id = '$reg'";
        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $sth = $db->query("SET NAMES 'utf8'");
        $sth = $db->query($sql);


        $reg = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if (!$reg) {
            throw new NotFoundException('Регіон не знайдено');
        }

        return $reg;
    }

    public function rezultatchoturu($str, $fin)
    {
        $pynkt_choturu_odun=0;
        $pynkt_choturu_dva=0;
        $pynkt_choturu_tru=0;
        $pynkt_choturu_choturu=0;


        $db = DbConnection::getInstance()->getPdo();


        $sql = "SELECT id_company, data_made, COUNT(*) FROM more_made WHERE data_made BETWEEN '$str' AND '$fin' GROUP BY id_company";


        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);

        $rezultat = $sth->fetchAll(\PDO::FETCH_ASSOC);
//        $rezultat = $rezultat[2]['COUNT(*)'];
        foreach($rezultat as $rezul){
            if ($rezul['id_company']=='1'){$pynkt_choturu_odun=$rezul['COUNT(*)'];};
            if ($rezul['id_company']=='2'){$pynkt_choturu_dva=$rezul['COUNT(*)'];};
            if ($rezul['id_company']=='3'){$pynkt_choturu_tru=$rezul['COUNT(*)'];};
            if ($rezul['id_company']=='4'){$pynkt_choturu_choturu=$rezul['COUNT(*)'];};
        }
        $rezultat = array(
            'pynkt_choturu_odun' => $pynkt_choturu_odun,
            'pynkt_choturu_dva' => $pynkt_choturu_dva,
            'pynkt_choturu_tru' => $pynkt_choturu_tru,
            'pynkt_choturu_choturu' => $pynkt_choturu_choturu
        );
        return $rezultat;
    }


}