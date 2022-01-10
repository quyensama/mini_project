<?php

class Model {

    //thuộc tính lưu trữ các phương thức truy vấn csdl
    public $db;
    
    public function __construct(){
        global $configs;
        $this->db = new Database($configs['database']);
    }
}