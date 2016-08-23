<?php

use Library\Route;

return  array(
    

    'firstpage' => new Route('/', 'Admin', 'firstpage'),
    'thirdpage' => new Route('/thirdpage', 'Admin', 'thirdpage'),
    'usercreate' => new Route('/usercreate', 'Admin', 'usercreate'),
    'jobseekercreate' => new Route('/jobseekercreate', 'Admin', 'jobseekercreate'),
    'educationcreate' => new Route('/educationcreate/{id}', 'Admin', 'educationcreate', array('id' => '[0-9]+')),
    'experiencecreate' => new Route('/experiencecreate/{id}', 'Admin', 'experiencecreate', array('id' => '[0-9]+')),
    'pastresortcreate' => new Route('/pastresortcreate/{id}', 'Admin', 'pastresortcreate', array('id' => '[0-9]+')),
    'morespecialtycreate' => new Route('/morespecialtycreate/{id}', 'Admin', 'morespecialtycreate', array('id' => '[0-9]+')),
    'moreskillscreate' => new Route('/moreskillscreate/{id}', 'Admin', 'moreskillscreate', array('id' => '[0-9]+')),
    'jobsearchcreate' => new Route('/jobsearchcreate/{id}', 'Admin', 'jobsearchcreate', array('id' => '[0-9]+')),
    'showjobsearch' => new Route('/showjobsearch/{id}', 'Admin', 'showjobsearch', array('id' => '[0-9]+')),
    'alljobseekeres' => new Route('/alljobseekeres', 'Admin', 'alljobseekeres'),
    'alluseres' => new Route('/alluseres', 'Admin', 'alluseres'),
    'showuser' => new Route('/showuser/{id}', 'Admin', 'showuser', array('id' => '[0-9]+')),
    'companycreate' => new Route('/companycreate/{id}', 'Admin', 'companycreate', array('id' => '[0-9]+')),
    'showallcompany' => new Route('/showallcompany/{id}', 'Admin', 'showallcompany', array('id' => '[0-9]+')),
    'jobseekerupdate' => new Route('/jobseekerupdate/{id}', 'Admin', 'jobseekerupdate', array('id' => '[0-9]+')),
    'educationupdate' => new Route('/educationupdate/{id}', 'Admin', 'educationupdate', array('id' => '[0-9]+')),
    'experienceupdate' => new Route('/experienceupdate/{id}', 'Admin', 'experienceupdate', array('id' => '[0-9]+')),
    'pastresortupdate' => new Route('/pastresortupdate/{id}', 'Admin', 'pastresortupdate', array('id' => '[0-9]+')),
    'morespecialtyupdate' => new Route('/morespecialtyupdate/{id}', 'Admin', 'morespecialtyupdate', array('id' => '[0-9]+')),
    'moreskillsupdate' => new Route('/moreskillsupdate/{id}', 'Admin', 'moreskillsupdate', array('id' => '[0-9]+')),
    'jobsearchupdate' => new Route('/jobsearchupdate/{id}', 'Admin', 'jobsearchupdate', array('id' => '[0-9]+')),
    'userupdate' => new Route('/userupdate/{id}', 'Admin', 'userupdate', array('id' => '[0-9]+')),
    'moremadecreate' => new Route('/moremadecreate/{id}', 'Admin', 'moremadecreate', array('id' => '[0-9]+')),
    'moremadeupdate' => new Route('/moremadeupdate/{id}', 'Admin', 'moremadeupdate', array('id' => '[0-9]+')),
    'zvitcreate' => new Route('/zvitcreate', 'Admin', 'zvitcreate'),
    'showcompany' => new Route('/showcompany/{id}', 'Admin', 'showcompany', array('id' => '[0-9]+')),
    'updatecompany' => new Route('/updatecompany/{id}', 'Admin', 'updatecompany', array('id' => '[0-9]+')),
    'delete' => new Route('/delete/{id}', 'Admin', 'delete', array('id' => '[0-9]+')),
    'onejobseeker' => new Route('/onejobseeker', 'Admin', 'onejobseeker'),
    'onecompany' => new Route('/onecompany', 'Admin', 'onecompany'),
    'changereg' => new Route('/changereg', 'Admin', 'changereg'),
    'vidmovleno' => new Route('/vidmovleno/{id}', 'Admin', 'vidmovleno', array('id' => '[0-9]+')),
    'pratsevlashtovano' => new Route('/pratsevlashtovano/{id}', 'Admin', 'pratsevlashtovano', array('id' => '[0-9]+')),
    'napravleno' => new Route('/napravleno/{id}', 'Admin', 'napravleno', array('id' => '[0-9]+')),
    'showzvit' => new Route('/showzvit', 'Admin', 'showzvit'),
    
    
    
    'login' => new Route('/login', 'Security', 'login'),
    'logout' => new Route('/logout', 'Security', 'logout'),
    'ajax_test' => new Route('/ajax_test','Admin','ajax'),



);