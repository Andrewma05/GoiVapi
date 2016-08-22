<?php

namespace Library;

abstract class Controller
{
//    public static $layout = 'default_layout.phtml';

//    $layout = 'login_layout.phtml';

    public static function setMyLayout()
    {
        isset($_SESSION['status']) ? $b=$_SESSION['status'] : $b=$_SESSION['status']=null;
        if($b==null){
           $layout = 'login_layout.phtml';
        } elseif ($b==1){
           $layout = 'default_layout.phtml';
        } elseif ($b==2){
           $layout = 'manager_layout.phtml';
        } elseif ($b==3){
           $layout = 'user_layout.phtml';
        } else {
           $layout = 'login_layout.phtml';
        }

        return $layout;
        //добавити умову яку розмітку підгружати




    }

    public static function setAdminLayout()
    {
        self::$layout = 'admin_layout.phtml';
    }


    protected function render($viewName, array $args = array())
    {
        extract($args);

        $tplDir = str_replace('Controller', '', get_class($this)); // Index
        $tplDir = trim($tplDir, '\\');
        $tplDir = str_replace('\\', DS, $tplDir);

        $path = VIEW_DIR . $tplDir . DS . $viewName . '.phtml';

        if (!file_exists($path)) {
            throw new \Exception("{$path} not found", 500);
        }

        ob_start();
        require $path;
        $content = ob_get_clean();

        ob_start();
        require VIEW_DIR . self::setMyLayout();
        return ob_get_clean();
    }

    public static function renderError($message, $code)
    {
        ob_start();
        require VIEW_DIR . 'error.phtml';
        $content = ob_get_clean();

        ob_start();
        require VIEW_DIR . 'login_layout.phtml';
        return ob_get_clean();
    }
    
    protected function renderforjavascript($viewName, array $args = array())
    {
        extract($args);

        $tplDir = str_replace('Controller', '', get_class($this)); // Index
        $tplDir = trim($tplDir, '\\');
        $tplDir = str_replace('\\', DS, $tplDir);

        $path = VIEW_DIR . $tplDir . DS . $viewName . '.phtml';


        ob_start();
        require $path;
        $content = ob_get_clean();

//        ob_start();
//        require VIEW_DIR . self::setMyLayout();
//        return ob_get_clean();
        return $content;
    }
}