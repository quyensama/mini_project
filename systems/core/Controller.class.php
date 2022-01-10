<?php 

class Controller{
    
    public $config = array();
    
    public $load;
    
    public $data = array();
    
    public function __construct()
    {
        $this->_load();
    }
    
    public function __destruct()
    {
        
    }
    
    //method load
    public function _load()
    {
        require_once __SYSTEMS_PATH.'/core/Loader.class.php';
        $this->load   = new Loader;
    }
    
}