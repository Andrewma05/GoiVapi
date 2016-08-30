<?php


namespace Model;

use Library\DbConnection;

class ZvitModel
{

    public function zvernenman($str, $fin)
    {
        $db = DbConnection::getInstance()->getPdo();

        if ($_SESSION['id_region'] !== '26'){
            $regin=$_SESSION['id_region'];
            $sql = "SELECT COUNT(*) FROM job_seekers WHERE stat = 'male' AND stvoreno BETWEEN '$str' AND '$fin' AND id_region = '$regin'";
        }else{
            $sql = "SELECT COUNT(*) FROM job_seekers WHERE stat = 'male' AND stvoreno BETWEEN '$str' AND '$fin'";
        };

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

        if ($_SESSION['id_region'] !== '26'){
            $regin=$_SESSION['id_region'];
            $sql = "SELECT COUNT(*) FROM job_seekers WHERE stat = 'female' AND stvoreno BETWEEN '$str' AND '$fin' AND id_region = '$regin'";
        }else{
            $sql = "SELECT COUNT(*) FROM job_seekers WHERE stat = 'female' AND stvoreno BETWEEN '$str' AND '$fin'";
        };

        // $sth = $db->query('SELECT * FROM book WHERE status = 1 ORDER BY price DESC ');
        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);

        $zvernenwoman = $sth->fetchAll(\PDO::FETCH_ASSOC);
        $zvernenwoman = $zvernenwoman[0]['COUNT(*)'];


        if (!$zvernenwoman) {
            $zvernenwoman = '0';
//
        }

        return $zvernenwoman;
    }

    public function kilkzdrupinval($str, $fin)
    {

        $db = DbConnection::getInstance()->getPdo();



        if ($_SESSION['id_region'] !== '26'){
            $regin=$_SESSION['id_region'];
            $sql = "SELECT COUNT(*) FROM job_seekers WHERE grup != 'Без інвалідності' AND stvoreno BETWEEN '$str' AND '$fin' AND id_region = '$regin'";
        }else{
            $sql = "SELECT COUNT(*) FROM job_seekers WHERE grup != 'Без інвалідності' AND stvoreno BETWEEN '$str' AND '$fin'";
        };

        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);

        $kilkzdrupinval = $sth->fetchAll(\PDO::FETCH_ASSOC);
        $kilkzdrupinval = $kilkzdrupinval[0]['COUNT(*)'];


        if (!$kilkzdrupinval) {
            $kilkzdrupinval = '0';
//
        }

        return $kilkzdrupinval;
    }

    public function grupinval($str, $fin)
    {


            $oduna = 0;
            $odunb = 0;
            $dva = 0;
            $tru = 0;
            $bez =0;


        $db = DbConnection::getInstance()->getPdo();

        if ($_SESSION['id_region'] !== '26'){
            $regin=$_SESSION['id_region'];
            $sql = "SELECT grup, COUNT(*) FROM job_seekers WHERE stvoreno BETWEEN '$str' AND '$fin' AND id_region = '$regin' GROUP BY grup";
        }else{
            $sql = "SELECT grup, COUNT(*) FROM job_seekers WHERE stvoreno BETWEEN '$str' AND '$fin' GROUP BY grup";
        };

        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);

        $grupinvales = $sth->fetchAll(\PDO::FETCH_ASSOC);

        foreach($grupinvales as $grupinval){
            if ($grupinval['grup']=='І А - група'){$oduna=$grupinval['COUNT(*)'];};
            if ($grupinval['grup']=='І Б - група'){$odunb=$grupinval['COUNT(*)'];};
            if ($grupinval['grup']=='ІІ - група'){$dva=$grupinval['COUNT(*)'];};
            if ($grupinval['grup']=='ІІІ - група'){$tru=$grupinval['COUNT(*)'];};
            if ($grupinval['grup']=='Без інвалідності'){$bez=$grupinval['COUNT(*)'];};
        }

        
        $grupinval = array(
            'oduna' => $oduna,
            'odunb' => $odunb,
            'dva' => $dva,
            'tru' => $tru,
            'bez' => $bez
        );


        return $grupinval;
    }

    public function vudinval($str, $fin)
    {

        $db = DbConnection::getInstance()->getPdo();

//        $sql = "SELECT grup, COUNT(*) FROM job_seekers GROUP BY grup WHERE stvoreno BETWEEN '$str' AND '$fin'";
//        $sql = "SELECT grup, stvoreno, COUNT(*) FROM job_seekers WHERE stvoreno BETWEEN '$str' AND '$fin' GROUP BY grup";
//        $sql = "SELECT job_seekers.id_vud_inval, vud_inval.vud COUNT(*) FROM job_seekers WHERE stvoreno BETWEEN '$str' AND '$fin' GROUP BY id_vud_inval
//                LEFT JOIN vud_inval ON job_seekers.id_vud_inval = vud_inval.id";



        if ($_SESSION['id_region'] !== '26'){
            $regin=$_SESSION['id_region'];
            $sql = "SELECT vud_inval.vud, COUNT( job_seekers.id )
                FROM job_seekers
                LEFT JOIN vud_inval ON job_seekers.id_vud_inval = vud_inval.id
                WHERE job_seekers.stvoreno
                BETWEEN  '$str'
                AND  '$fin'
                AND job_seekers.id_region = '$regin'
                GROUP BY id_vud_inval";
        }else{
            $sql = "SELECT vud_inval.vud, COUNT( job_seekers.id )
                FROM job_seekers
                LEFT JOIN vud_inval ON job_seekers.id_vud_inval = vud_inval.id
                WHERE job_seekers.stvoreno
                BETWEEN  '$str'
                AND  '$fin'
                GROUP BY id_vud_inval";
        };



        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);


        $grupinval = $sth->fetchAll(\PDO::FETCH_ASSOC);


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


        if ($_SESSION['id_region'] !== '26'){
            $regin=$_SESSION['id_region'];
            $sql = "SELECT vuddialnosti, COUNT(*) FROM more_made WHERE data_made BETWEEN '$str' AND '$fin' AND id_region = $regin GROUP BY vuddialnosti";
        }else{
            $sql = "SELECT vuddialnosti, COUNT(*) FROM more_made WHERE data_made BETWEEN '$str' AND '$fin' GROUP BY vuddialnosti";
        };

        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);

        $rezultat = $sth->fetchAll(\PDO::FETCH_ASSOC);

        foreach($rezultat as $rezul){
            if ($rezul['vuddialnosti']=='Дзвінок'){$dzvinock=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Надано консультації'){$konsyl=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Зустріч з роботодавцем'){$zystrich=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Відмовлено'){$vidmovleno=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Допомога з оформлення документів'){$documentu=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Соціальний супровід'){$sots=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Працевлаштовано'){$pratsevlash=$rezul['COUNT(*)'];};

        }

        $pynkt_tru_odun = $pratsevlash;
        $pynkt_tru_dva = $dzvinock+$zystrich;
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

      

        return $reg;
    }

    public function rezultatchoturu($str, $fin)
    {
        $pynkt_choturu_odun=0;
        $pynkt_choturu_dva=0;
        $pynkt_choturu_tru=0;
        $pynkt_choturu_choturu=0;


        $db = DbConnection::getInstance()->getPdo();




        if ($_SESSION['id_region'] !== '26'){
            $regin=$_SESSION['id_region'];

            $sql = "SELECT id_company, data_made, COUNT(*) FROM more_made 
                    WHERE vuddialnosti = 'Направлено лист, клопотання (звернення)'
                    AND id_region = '$regin' 
                    AND data_made BETWEEN '$str' AND '$fin' GROUP BY id_company";
        }else{
            $sql = "SELECT id_company, data_made, COUNT(*) FROM more_made 
                    WHERE vuddialnosti = 'Направлено лист, клопотання (звернення)' 
                    AND data_made BETWEEN '$str' AND '$fin' GROUP BY id_company";
        };

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















    public function minusposhuk($str, $fin)
    {
        $pratsevlash=0;
        $vidmovleno=0;
        $povtorn=0;

        $db = DbConnection::getInstance()->getPdo();


        if ($_SESSION['id_region'] !== '26'){
            $regin=$_SESSION['id_region'];
            $sql = "SELECT vuddialnosti, COUNT(*) FROM more_made WHERE data_made BETWEEN '0000-00-00' AND '$fin' AND id_region = $regin GROUP BY vuddialnosti";
        }else{
            $sql = "SELECT vuddialnosti, COUNT(*) FROM more_made WHERE data_made BETWEEN '0000-00-00' AND '$fin' GROUP BY vuddialnosti";
        };

        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);

        $rezultat = $sth->fetchAll(\PDO::FETCH_ASSOC);

        foreach($rezultat as $rezul){
            if ($rezul['vuddialnosti']=='Повторне звернення'){$povtorn=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Відмовлено'){$vidmovleno=$rezul['COUNT(*)'];};
            if ($rezul['vuddialnosti']=='Працевлаштовано'){$pratsevlash=$rezul['COUNT(*)'];};
        }



        $minusposhuk = array(
            'povtorn' => $povtorn,
            'vidmovleno' => $vidmovleno,
            'pratsevlash' => $pratsevlash

        );

//        var_dump($minusposhuk['povtorn']);
//        echo '<br>';
//        var_dump($minusposhuk['vidmovleno']);
//        echo '<br>';
//        var_dump($minusposhuk['pratsevlash']);
//        die;

        return $minusposhuk;
    }

    public function plusposhuk($str, $fin)
    {
        $plusposhuk=0;

        $db = DbConnection::getInstance()->getPdo();


        if ($_SESSION['id_region'] !== '26'){
            $regin=$_SESSION['id_region'];
            $sql = "SELECT COUNT(*) FROM job_seekers WHERE stvoreno BETWEEN '0000-00-00' AND '$fin' AND id_region = '$regin'";
        }else{
            $sql = "SELECT COUNT(*) FROM job_seekers WHERE stvoreno BETWEEN '0000-00-00' AND '$fin'";
        };

        $norm = $db->query("SET NAMES 'utf8'");

        $sth = $db->query($sql);

        $plusposhuk = $sth->fetchAll(\PDO::FETCH_ASSOC);

        $plusposhuk = $plusposhuk[0]['COUNT(*)'];

        return $plusposhuk;
    }














}