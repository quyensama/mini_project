<?php
/**
 * 
 */
class Category extends Controller
{
    
    private     $_limit = 10,
                $_total,
                $_page_current   = 1,
                $_record_current = 0,
                $Mcategory;

    function __construct()
    {
        global $configs;

        parent::__construct();

        $this->load->model('mcategory');

        $this->load->model('mpost');

        $this->load->controller('post');

        $this->Mcategory = new Mcategory;
    }


    function __destruct()
    {
        $this->load->footer($this->data['meta']);  
    }

        /**
     * phương thức chạy mặc định
     */
    function index($param = null)
    {
        $this->data['listcategories'] = $this->showListCategory(); 

        $this->data['meta'] = array(
            'title'         => 'Danh Sách Chuyên Mục',
            'description'   => 'Danh Sách Chuyên Mục',
            'keyword'       => 'Danh Sách Chuyên Mục',
        );
        $this->load->header($this->data['meta']);

        $this->load->view('categories/list_category', $this->data['listcategories']);
    }

    /**
     * phương thức load danh sách category
     */
    function showListCategory($param=null)
    {
        $where      = 'parent IS NULL OR parent = 0';
        return $this->Mcategory->getListCategory($where);
    }

    /**
     * phương thức load danh sách blog theo url của category
     */
    function listPost($url)
    {
        global $configs;
        
        $mpost          = new MPost; 
        
        $infoCategory   = $this->Mcategory->getInfo($url);

        $this->data['meta']         = array(
                                        'title'         => $infoCategory['name'],
                                        'description'   => $infoCategory['description'],
                                        'keyword'       => $infoCategory['keyword']
                                    );
        
        $this->data['listblog']     = $mpost->getPostByCategory($infoCategory['id'], $this->_record_current, $this->_limit, true);
        
        $this->_total = $this->Mcategory->countAll($infoCategory['id']);
        
        $this->data['info'] = array(
                                    'name' => $infoCategory['name'],
                                    'alias'=> '/category/'.$infoCategory['slug']
                                );
                            
        if($this->_total > $this->_limit)
        {
            $pagination = array(
                'limit'        => $this->_limit,
                'total_record' => $this->_total,
                'current_page' => $this->_page_current,
                'link'         => '/category/'.$url.'/',
                'endlink'      => ''

            );
            
            $this->data['page'] = createPage($pagination);
        }
        
        $this->load->header($this->data['meta']);

        $this->load->view('posts/list_posts_index', $this->data);
        
        if($infoCategory['parent'] == 0 )
        {
            $where      =" parent = {$infoCategory['id']}";
            
            $this->data['listcategories']   = $this->Mcategory->getListCategory($where);
            
            $this->load->view('categories/list_category', $this->data['listcategories']);
        }
    }

    /**
     * phương thức phân trang
     */
    function page($url,$p = 1)
    {
        $infoCategory   = $this->Mcategory->getInfo($url);
        
        if($p == null || $p <= 0)
        {
            $p = 1;
        }
        
        $this->Mcategory  = new Mcategory;
        
        $total_page = ceil($this->Mcategory->countAll($infoCategory['id'])/$this->_limit);
        
        $this->_page_current = abs((int)$p);
        
        if($this->_page_current <= 0 || $this->_page_current > $total_page )
            $this->_page_current = 1 ;
            
        $this->_record_current = ($this->_page_current - 1) * $this->_limit ;
        
        $this->listPost($url);
    }
}