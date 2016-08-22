<?php


namespace Controller;

use Library\MetaHelper;

use Library\Controller;
use Library\Password;
use Library\Request;
use Library\Router;
use Library\Session;
use Model\AllJobSeekeresModel;
use Model\ContactForm;
use Model\FeedBackModel;
use Model\AdminModel;
use Model\UserCreate;
use Model\JobSeekerCreateModel;
use Model\EducationCreateModel;
use Model\ExperienceCreateModel;
use Model\PastResortCreateModel;
use Model\MoreSpecialtyCreateModel;
use Model\MoreSkillsCreateModel;
use Model\JobSearchCreateModel;
use Model\ShowJobSearchModel;
use Model\AllUseresModel;
use Model\ShowUserModel;
use Model\CompanyCreateModel;
use Model\ShowAllCompanyModel;
use Model\UpdateModel;
use Model\MoreMadeCreateModel;
use Model\ZvitModel;
use Model\DeleteModel;
use Library\DbConnection;
use Model\JobSeekerModel;


class AdminController extends Controller
{
    public function firstpageAction(Request $request)
    {

        $adminModel = new AdminModel();
        $userMe = $adminModel->userMe();
        $regs = $adminModel->showreg();
        $reg = $adminModel->reg();
        $reg = $reg[0]['region'];


        $args = array(
            'user' => $userMe['0'],
            'regs' => $regs,
            'reg' => $reg
            
        );
        return $this->render('firstpage', $args);
    }
    

    public function thirdpageAction(Request $request)
    {

//        після створення бази даних створити запит для тогого щоб виводити випадаючий список


//        $adminModel = new AdminModel();
//        $userMe = $adminModel->userMe();
//
//        $args = array(
//            'user' => $userMe
//        );

//
        return $this->render('thirdpage');
    }
    


    public function usercreateAction(Request $request)
    {
        $form = new UserCreate($request);

        $regs = $form->showreg();

       

        if ($request->isPost()) {
            if ($form->isValid()) {
//                $feedbackModel = new FeedBackModel();
//                $datetime = (new \DateTime())->format('Y-m-d H:i:s');

                // mail()

                $form->save(array(
                    'surname' => $form->surname,
                    'username' => $form->username,
                    'father' => $form->father,
                    'region' => $form->region,
                    'startwork' => $form->startwork,
                    'contact' => $form->contact,
                    'foto' => $form->foto,
                    'status' => $form->status,
                    'email' => $form->email,
                    'password' => new Password($form->password)
                ));
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect('/firstpage');
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs
            
        );
        return $this->render('usercreate', $args);
    }

    public function jobseekercreateAction(Request $request)
    {
        $form = new JobSeekerCreateModel($request);

        $regs = $form->showreg();

        $vud_inval = $form ->showvud_inval();



        if ($request->isPost()) {
            if ($form->isValid()) {
//                $feedbackModel = new FeedBackModel();
//                $datetime = (new \DateTime())->format('Y-m-d H:i:s');

                // mail()

                $form->save(array(
                    'surname' => $form->surname,
                    'jobseekername' => $form->jobseekername,
                    'father' => $form->father,
                    'birthdate' => $form->birthdate,
                    'stat' => $form->stat,
                    'pasport' => $form->pasport,
                    'adress' => $form->adress,
                    'contact' => $form->contact,
                    'email' => $form->email,
                    'grup' => $form->grup,
                    'freedate' => $form->freedate,
                    'stvoreno' => (new \DateTime())->format('Y-m-d'),
                    'id_wuser' => $_SESSION['id'],
                    'id_region' => $_SESSION['id_region'],
                    'statuswork' => 'В пошуках'
                ));
                Session::setFlash('Success');
                
                $idseeker = $form->isip($form->pasport);

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$idseeker");
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs,
            'vud_invals' => $vud_inval

        );
        return $this->render('jobseekercreate', $args);
    }

    

    public function educationcreateAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $form = new EducationCreateModel($request);

        $regs = $form->showreg();



        if ($request->isPost()) {
            if ($form->isValid()) {

                $form->save(array(
                    'id_jobseekers' => $id_jobseekers,
                    'school' => $form->school,
                    'specialty' => $form->specialty,
                    'level_school' => $form->level_school,
                    'freedate' => $form->freedate                    
                ));
                
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$id_jobseekers");
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs

        );
        return $this->render('educationcreate', $args);
    }

    public function experiencecreateAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $form = new ExperienceCreateModel($request);

        $regs = $form->showreg();



        if ($request->isPost()) {
            if ($form->isValid()) {

                $form->save(array(
                    'id_jobseekers' => $id_jobseekers,
                    'organization' => $form->organization,
                    'experience' => $form->experience,
                    'specialty' => $form->specialty,
                    'posada' => $form->posada
                ));
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$id_jobseekers");
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs

        );
        return $this->render('experiencecreate', $args);
    }



    public function pastresortcreateAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $form = new PastresortCreateModel($request);

        $regs = $form->showreg();



        if ($request->isPost()) {
            if ($form->isValid()) {


                $form->save(array(
                    'id_jobseekers' => $id_jobseekers,
                    'organization' => $form->organization,
                    'resort_date' => $form->resort_date,
                    'result' => $form->result,
                    'posada' => $form->posada
                ));
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$id_jobseekers");
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs

        );
        return $this->render('pastresortcreate', $args);
    }

    public function morespecialtycreateAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $form = new MoreSpecialtyCreateModel($request);

        $regs = $form->showreg();



        if ($request->isPost()) {
            if ($form->isValid()) {

                $form->save(array(
                    'id_jobseekers' => $id_jobseekers,
                    'specialty' => $form->specialty
                ));
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$id_jobseekers");
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs

        );
        return $this->render('morespecialtycreate', $args);
    }

    public function moreskillscreateAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $form = new MoreSkillsCreateModel($request);

        $regs = $form->showreg();



        if ($request->isPost()) {
            if ($form->isValid()) {
                $form->save(array(
                    'id_jobseekers' => $id_jobseekers,
                    'skills' => $form->skills
                ));
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$id_jobseekers");
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs

        );
        return $this->render('moreskillscreate', $args);
    }
    
    
    
    public function jobsearchcreateAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $form = new JobSearchCreateModel($request);

        $regs = $form->showreg();



        if ($request->isPost()) {
            if ($form->isValid()) {


                $form->save(array(
                    'id_jobseekers' => $id_jobseekers,
                    'specialty' => $form->specialty,
                    'id_region' => $form->id_region,
                    'job_grapf' => $form->job_grapf,
                    'sort_job' => $form->sort_job,
                    'salary' => $form->salary
                ));

                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$id_jobseekers");
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs

        );
        return $this->render('jobsearchcreate', $args);
    }

    public function showjobsearchAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $start = new ShowJobSearchModel($request);
        $seekers = $start->showjobseekers($id_jobseekers);
        $seekers = $seekers[0];
        
        $educations = $start->showeducation($id_jobseekers);

        $experiences = $start->showexperience($id_jobseekers);

        $pastresorts = $start->showpastresort($id_jobseekers);

        $morespecialtes = $start->showmorespecialty($id_jobseekers);

        $moreskillses = $start->showmoreskills($id_jobseekers);

        $searches = $start->showsearch($id_jobseekers);

        $moremades = $start->showmoremade($id_jobseekers);
        
        $masuv = array(
            'seekers' => $seekers,
            'educations' => $educations,
            'experiences' => $experiences,
            'pastresorts' => $pastresorts,
            'morespecialtes' => $morespecialtes,
            'moreskillses' => $moreskillses,
            'searches' => $searches,
            'moremades' => $moremades,

        );

        return $this->render('showjobsearch', $masuv);
    }

    public function alljobseekeresAction(Request $request)
    {
        $search=null;
        $start = new AllJobSeekeresModel($request);
        $seekerses = $start->showalljobseekers();
        

        $masuv = array(
            'seekerses' => $seekerses,

        );

        return $this->render('alljobseekeres', $masuv);
    }

    public function alluseresAction(Request $request)
    {
        $start = new AllUseresModel($request);
        $useres = $start->showallusers();
        $regions = $start->showreg();


        $masuv = array(
            'useres' => $useres,
            'regions' => $regions,

        );

        return $this->render('alluseres', $masuv);
    }

    public function showuserAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $start = new ShowUserModel($request);
        $user = $start->showuser($id_jobseekers);
        $user = $user[0];
        
        $masuv = array(
            'user' => $user,
            

        );

        return $this->render('showuser', $masuv);
    }

    public function companycreateAction(Request $request)
    {
        $vud = $request -> get('id');
        
        $form = new CompanyCreateModel($request);

        $regs = $form->showreg();



        if ($request->isPost()) {
            if ($form->isValid()) {
//                $feedbackModel = new FeedBackModel();
//                $datetime = (new \DateTime())->format('Y-m-d H:i:s');

                // mail()

                $form->save(array(
                    'vud' => $vud,
                    'id_region' => $_SESSION['id_region'],
                    'company' => $form->company,
                    'PIB' => $form->PIB,
                    'contact' => $form->contact,
                    'telefon' => $form->telefon,
                    'email' => $form->email,
                    )
                );
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showallcompany/$vud");
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs

        );
        return $this->render('companycreate', $args);
    }
   
    

    public function showallcompanyAction(Request $request)
    {
        $vud = $request -> get('id');

        $start = new ShowAllCompanyModel($request);
        $companes = $start->showallcompany($vud);


        $masuv = array(
            'companes' => $companes,
            'vud' => $vud,

        );
//        var_dump($masuv['vud']);
//        die;

        return $this->render('showallcompany', $masuv);
    }

    public function jobseekerupdateAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $form = new ShowJobSearchModel($request);

        $oldjobseeker = $form->showjobseekers($id_jobseekers);
        
        $form = new JobSeekerCreateModel($request);

        if ($request->isPost()) {

//                $feedbackModel = new FeedBackModel();
//                $datetime = (new \DateTime())->format('Y-m-d H:i:s');

            // mail()

            $form->updatejobseekers(array(
                'surname' => $form->surname,
                'jobseekername' => $form->jobseekername,
                'father' => $form->father,
                'stat' => $form->stat,
                'birthdate' => $form->birthdate,
                'pasport' => $form->pasport,
                'adress' => $form->adress,
                'contact' => $form->contact,
                'email' => $form->email,
                'grup' => $form->grup,
                'freedate' => $form->freedate,
                'stvoreno' => $form->stvoreno,
                'id' => $id_jobseekers
            ));
            Session::setFlash('Success');


            // todo: function redirect($to)
            Router::redirect("/showjobsearch/$id_jobseekers");



        }

        $masuv = array(
            'form' => $form,
            'oldjobseeker' => $oldjobseeker[0]

        );

        return $this->render('jobseekerupdate', $masuv);
    }

    public function educationupdateAction(Request $request)
    {
        $id_education = $request -> get('id');

        $form = new EducationCreateModel($request);

        $oldeducation = $form->showeducation($id_education);
        
        $number = $oldeducation[0]['id_jobseekers'];

        if ($request->isPost()) {
            

                $form->updateeducation(array(
                    'id' => $id_education,
                    'school' => $form->school,
                    'specialty' => $form->specialty,
                    'level_school' => $form->level_school,
                    'freedate' => $form->freedate
                ));

                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$number");
            

    
        }

        $masuv = array(
            'form' => $form,
            'oldeducation' => $oldeducation[0]

        );
//        echo '<pre>';
//        var_dump($masuv);
//        echo '</pre>';
//        echo $oldeducation['school'];

        return $this->render('educationupdate', $masuv);
    }

    public function experienceupdateAction(Request $request)
    {
        $id_experience = $request -> get('id');

        $form = new ExperienceCreateModel($request);

        $oldexperience = $form->showexperience($id_experience);

        $number = $oldexperience[0]['id_jobseekers'];

        if ($request->isPost()) {


                $form->updateexperience(array(
                    'id' => $id_experience,
                    'organization' => $form->organization,
                    'experience' => $form->experience,
                    'specialty' => $form->specialty,
                    'posada' => $form->posada
                ));
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$number");

        }

        $masuv = array(
            'form' => $form,
            'oldexperience' => $oldexperience[0]

        );
        return $this->render('experienceupdate', $masuv);
    }



    public function pastresortupdateAction(Request $request)
    {
        $id_pastresort = $request -> get('id');

        $form = new PastresortCreateModel($request);

        $oldpastresort = $form->showpastresort($id_pastresort);

        $number = $oldpastresort[0]['id_jobseekers'];



        if ($request->isPost()) {
            


                $form->updatepastresort(array(
                    'id' => $id_pastresort,
                    'organization' => $form->organization,
                    'resort_date' => $form->resort_date,
                    'result' => $form->result,
                    'posada' => $form->posada
                ));
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$number");
            
        }

        $masuv = array(
            'form' => $form,
            'oldpastresort' => $oldpastresort[0]

        );
        return $this->render('pastresortupdate', $masuv);
    }

    public function morespecialtyupdateAction(Request $request)
    {
        $id_morespecialty = $request -> get('id');

        $form = new MoreSpecialtyCreateModel($request);

        $oldmorespecialty = $form->showmorespecialty($id_morespecialty);

        $number = $oldmorespecialty[0]['id_jobseekers'];



        if ($request->isPost()) {
            

                $form->updatemorespecialty(array(
                    'id' => $id_morespecialty,
                    'specialty' => $form->specialty
                ));
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$number");
            
        }

        $masuv = array(
            'form' => $form,
            'oldmorespecialty' => $oldmorespecialty[0]

        );
        return $this->render('morespecialtyupdate', $masuv);
    }
//
    public function moreskillsupdateAction(Request $request)
    {
        $id_moreskills = $request -> get('id');

        $form = new MoreSkillsCreateModel($request);

        $oldmoreskills = $form->showmoreskills($id_moreskills);

        $number = $oldmoreskills[0]['id_jobseekers'];

        if ($request->isPost()) {
            
                $form->updatemoreskills(array(
                    'id' => $id_moreskills,
                    'skills' => $form->skills
                ));
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$number");
            
        }

        $masuv = array(
            'form' => $form,
            'oldmoreskills' => $oldmoreskills[0]

        );
        return $this->render('moreskillsupdate', $masuv);
    }



    public function jobsearchupdateAction(Request $request)
    {
        $id_jobsearch = $request -> get('id');

        $form = new JobSearchCreateModel($request);

        $oldjobsearch = $form->showsearch($id_jobsearch);

        $regs = $form->showreg();

        $number = $oldjobsearch[0]['id_jobseekers'];



        if ($request->isPost()) {
            


                $form->updatesearch(array(
                    'id' => $id_jobsearch,
                    'specialty' => $form->specialty,
                    'id_region' => $form->id_region,
                    'job_grapf' => $form->job_grapf,
                    'sort_job' => $form->sort_job,
                    'salary' => $form->salary
                ));

                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$number");
           
        }

        $masuv = array(
            'form' => $form,
            'regs' => $regs,
            'oldjobsearch' => $oldjobsearch[0]

        );
        return $this->render('jobsearchupdate', $masuv);
    }


    public function userupdateAction(Request $request)
    {
        $id_user = $request -> get('id');

        $form = new UserCreate($request);

        $olduser = $form->showuser($id_user);

        $regs = $form->showreg();

        $number = $olduser[0]['id'];



        if ($request->isPost()) {

//                $feedbackModel = new FeedBackModel();
//                $datetime = (new \DateTime())->format('Y-m-d H:i:s');

                // mail()

                $form->updateuser(array(
                    'id' => $id_user,
                    'surname' => $form->surname,
                    'username' => $form->username,
                    'father' => $form->father,
//                    'region' => $form->region,
                    'startwork' => $form->startwork,
                    'contact' => $form->contact,
//                    'foto' => $form->foto,
                    'status' => $form->status,
                    'email' => $form->email
//                    'password' => new Password($form->password)
                ));
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showuser/$number");

        }

        $masuv = array(
            'form' => $form,
            'regs' => $regs,
            'olduser' => $olduser[0]

        );
        return $this->render('userupdate', $masuv);
    }

    public function zvitAction(Request $request)
    {


        $masuv = array(
//            'form' => $form,
//            'regs' => $regs,
//            'olduser' => $olduser[0]

        );
        return $this->render('zvit', $masuv);
    }

    public function moremadecreateAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $form = new MoreMadeCreateModel($request);

        $regs = $form->showreg();



        if ($request->isPost()) {
            
            if ($form->isValid()) {

                $form->save(array(
                    'id_jobseekers' => $id_jobseekers,
                    'vuddialnosti' => $form->vuddialnosti,
                    'made' => $form->made,
                    'id_wuser' => $_SESSION['id'],
                    'data_made' => (new \DateTime())->format('Y-m-d')
                ));
                Session::setFlash('Success');

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$id_jobseekers");
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs

        );
        return $this->render('moremadecreate', $args);
    }

    public function moremadeupdateAction(Request $request)
    {
        $id_moremade = $request -> get('id');

        $form = new MoreMadeCreateModel($request);

        $oldmoremade = $form->showmoreskills($id_moremade);

        $number = $oldmoremade[0]['id_jobseekers'];

        if ($request->isPost()) {

            $form->updatemoremade(array(
                'id' => $id_moremade,
                'vuddialnosti' => $form->vuddialnosti,
                'made' => $form->made
            ));
            Session::setFlash('Success');

            // todo: function redirect($to)
            Router::redirect("/showjobsearch/$number");

        }

        $masuv = array(
            'form' => $form,
            'oldmoremade' => $oldmoremade[0]

        );
        return $this->render('moremadeupdate', $masuv);
    }

    public function vidmovlenoAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $form = new MoreMadeCreateModel($request);

        $regs = $form->showreg();



        if ($request->isPost()) {

            if ($form->isValid()) {

                $form->save(array(
                    'id_jobseekers' => $id_jobseekers,
                    'vuddialnosti' => 'Відмовлено',
                    'made' => $form->made,
                    'id_wuser' => $_SESSION['id'],
                    'data_made' => (new \DateTime())->format('Y-m-d')
                ));
                $dizact = new JobSeekerCreateModel($request);
                
                $dizact->dizact(array(
                    'statuswork' => 'Відмовлено',
                    'id' => $id_jobseekers
                ));

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$id_jobseekers");
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs

        );
        return $this->render('vidmovleno', $args);
    }

    public function pratsevlashtovanoAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $form = new MoreMadeCreateModel($request);

        $regs = $form->showreg();



        if ($request->isPost()) {

            if ($form->isValid()) {

                $form->save(array(
                    'id_jobseekers' => $id_jobseekers,
                    'vuddialnosti' => 'Працевлаштовано',
                    'made' => $form->made,
                    'id_wuser' => $_SESSION['id'],
                    'data_made' => (new \DateTime())->format('Y-m-d')
                ));
                $dizact = new JobSeekerCreateModel($request);

                $dizact->dizact(array(
                    'statuswork' => 'Працевлаштовано',
                    'id' => $id_jobseekers
                ));

                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$id_jobseekers");
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs

        );
        return $this->render('pratsevlashtovano', $args);
    }


    public function napravlenoAction(Request $request)
    {
        $id_jobseekers = $request -> get('id');

        $form = new MoreMadeCreateModel($request);

        $regs = $form->showreg();



        if ($request->isPost()) {

            if ($form->isValid()) {

                $form->savenapravl(array(
                    'id_jobseekers' => $id_jobseekers,
                    'vuddialnosti' => 'Направлено',
                    'made' => $form->made,
                    'id_wuser' => $_SESSION['id'],
                    'data_made' => (new \DateTime())->format('Y-m-d'),
                    'id_company' => $form->id_company,
                ));


                // todo: function redirect($to)
                Router::redirect("/showjobsearch/$id_jobseekers");
            }

            Session::setFlash('Error');
        }

        $args = array(
            'form' => $form,
            'regs' => $regs

        );
        return $this->render('napravleno', $args);
    }
















    public function zvitcreateAction(Request $request)
    {
//        $id_moremade = $request -> get('id');
//
        $zvit = new ZvitModel($request);
        $zvernenman = $zvit->zvernenman();
        $zvernenwoman = $zvit->zvernenwoman();
        $zvernen = $zvernenman + $zvernenwoman;
        $grupuinval = $zvit->grupinval();
        $vudinval = 1;
        $rezultat = $zvit->rezultat();
        $statuswork = $zvit->statuswork();
        $reg = $zvit->reg();

        $choturu = $zvit->rezultatchoturu();
       

        $masuv = array(
            'zvernen' => $zvernen,
            'zvernenman' => $zvernenman,
            'zvernenwoman' => $zvernenwoman,
            'grupuinval' => $grupuinval,
            'rezultat' => $rezultat,
            'statuswork' => $statuswork,
            'reg' => $reg[0],
            'choturu' => $choturu


        );
        return $this->render('zvitcreate', $masuv);
    }

    public function showcompanyAction(Request $request)
    {
        $id_company = $request -> get('id');

        $start = new CompanyCreateModel($request);
        $company = $start->showcompany($id_company);
        $company = $company[0];
        

        $masuv = array(
            'company' => $company,
            

        );

        return $this->render('showcompany', $masuv);
    }

    public function updatecompanyAction(Request $request)
    {
        $id_company = $request -> get('id');

        $form = new CompanyCreateModel($request);

        $oldcompany = $form->showcompany($id_company);

        if ($request->isPost()) {

            $form->updatecompany(array(
                'id' => $id_company,
                'company' => $form->company,
                'PIB' => $form->PIB,
                'contact' => $form->contact,
                'telefon' => $form->telefon,
                'email' => $form->email

            ));
            Session::setFlash('Success');

            // todo: function redirect($to)
            Router::redirect("/showcompany/$id_company");

        }

        $masuv = array(
            'form' => $form,
            'oldcompany' => $oldcompany[0]

        );
        return $this->render('updatecompany', $masuv);
    }

    public function deleteAction(Request $request)
    {
        $id = $request -> get('id');
        var_dump($id);
        $db = DbConnection::getInstance()->getPdo();
        $sql = "DELETE FROM experience WHERE id = '$id'";
        $s = $db->prepare($sql);
        $s->execute();
    }

    public function onejobseekerAction(Request $request)
    {
        
        $search=$request->post('search');

        $start = new JobSeekerModel($request);
        $seekerses = $start->showjobseeker($search);
        $masuv = array(
            'seekerses' => $seekerses,
        );
        if (!isset($seekerses[0])){
            echo "<h1>$search не знайдено</h1>";}
        else{
            return $this->renderforjavascript('jobseeker', $masuv);
        };
    }
    public function onecompanyAction(Request $request)
    {

        $search=$request->post('search');

        $start = new CompanyCreateModel($request);
        $companes = $start->showsearchcompany($search);
        $masuv = array(
            'companes' => $companes,
        );
        if (!isset($companes[0])){
            echo "<h1>$search не знайдено</h1>";}
        else{
            return $this->renderforjavascript('company', $masuv);
        };
    }

    public function changeregAction(Request $request)
    {

        $search=$request->post('search');
//        Session::set('id_region', $search);
        $_SESSION['id_region']=$search;
        $adminModel = new AdminModel();

        $reg = $adminModel->reg();
        $reg = $reg[0]['region'];
//        var_dump($reg);
        $masuv = array(
            'reg' => $reg,
        );
//        return $masuv;
        return $this->renderforjavascript('reg', $masuv);

    }

}