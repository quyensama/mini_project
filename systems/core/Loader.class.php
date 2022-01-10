<?php
class Loader {
    
    public  $_nameController,
            $_nameModel,
            $_nameView,
            $_meta = array();

    public function __construct() {
        $this->_templateDefault = 'plus';
    }
    
    /**
    *
    *method load view
    *
    */
    public function view($fileName, $value = array())
    {
        global $configs;

        $data     = $value;  

        $pathFile = __MODULES_PATH.'/views/'. $fileName .'.php';

        if(file_exists($pathFile))
        {
            include $pathFile;
        }
        else
        {
            show_alert(2,array('view <b>'. $fileName .'</b> not exists'));
        }
    }
    
   /**
    *
    *method load model
    *
    */
    public function model($fileName)
    {
        global $configs;

        $pathFile           = __MODULES_PATH.'/models/' . $fileName .'.php';   

        if(file_exists($pathFile))
        {
            require_once $pathFile;
        }
        else
        {
            echo "Model $fileName not exists";
        }
    }
    
    /**
    *
    *method load controller
    *
    */
    public function controller($fileName)
    {
        global $configs;
        $pathFile   = __MODULES_PATH.'/controllers/' . $fileName .'.php';

        if(file_exists($pathFile))
        {
            require_once $pathFile;
        }
        else
        {
            $this->header();
            show_alert(3, array('Trang này không tồn tại'));
            $this->footer();
        }
    }
    
    /**
    *
    *method load header
    *
    */
    public function header($data = array())
    {
        global $configs;
        
        $meta   = (!empty($data)) ? $data : $configs['meta'];
        
        $pathFile = __MODULES_PATH.'/views/layout/header.php';
        
        if(file_exists($pathFile))
        {
            require_once $pathFile;
        }
        else
        {
            show_alert(2,array('Header not exists'));
        }
    }
    
    /**
    *
    *method load footer
    *
    */
    public function footer($data = array())
    {
        global $configs;
        $tag   = (!empty($data)) ? $data : $configs['meta'];
        
        if(isset($tag['keyword'])) unset($tag['keyword']);
        
        $pathFile = __MODULES_PATH.'/views/layout/footer.php';
        
        if(file_exists($pathFile))
        {
            require_once $pathFile;
        }
        else
        {
            show_alert(2,array('Header not exists'));
        }
    }
}