<?php
/**
 * 
 */
class Post extends Controller
{
    private $_limit = 20,
            $_total,
            $_page_current,
            $_total_page,
            $_record_current = 0,
            $MPost;
            
    function __construct()
    {
        parent::__construct();
        global $configs;
        $this->load->model('mpost');
        $this->MPost = new MPost;
    }

    /**
     * phương thức chạy mặc định
     */
    function index($param = null)
    {
        $this->showListPost();
    }
 
    /**
     * phương thức hiển thị danh sách bài viết
     */
    function showListPost($param=null){
        global $configs;

        $this->_total = $this->MPost->countAll();
        $data                 = array();
        $prefix_title ='';
        if($this->_page_current != 1 && $this->_page_current != null) $prefix_title = 'Trang '.$this->_page_current .' - ';
        $data['meta']         = array(
                                    'title'         => $prefix_title .$configs['meta']['title'],
                                    'description'   => $configs['meta']['description'],
                                    'keyword'       => $configs['meta']['keyword'],
                                );
        $data['info'] = array(
                            'name' => 'Bài Viết Mới',
                            'alias'=> ''
                        );
        $data['listblog']     = $this->MPost->getListPost('','times', $this->_record_current, $this->_limit);
        if($this->_total > $this->_limit){
            $pagination = array(
                'limit'           => $this->_limit,
                'total_record'    =>$this->_total,
                'current_page'    => $this->_page_current,
                'link'            => '/page/',
                'endlink'         => ''
            );
            $data['page'] = createPage($pagination);
        }

        print_r($data);
        $this->load->header($data['meta']);

        $this->load->view('posts/list_posts_index', $data);


        $this->showCategory();

        $this->load->footer();
    }



    /**
     * phương thức lấy bài viết cùng chuyên mục
     */
    function showCategory()
    {
        $this->load->model('mcategory');
        $Mcategory      = new Mcategory;
        $where          = 'parent IS NULL OR parent = 0';
        $this->data['listcategories']   = $Mcategory->getListCategory($where);
        $this->load->view('categories/list_category', $this->data['listcategories']);
    }

}