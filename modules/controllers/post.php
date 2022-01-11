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


     /**
     * phương hiển thi bài viết theo url
     */
    public function viewPost($param = null)
    {
        global $configs;

        $data               = array();
        $data['detailPost'] = $this->MPost->getDetailPost($param);
        $data['meta']       = array(
            'title'         => $data['detailPost']['title'],
            'description'   => $data['detailPost']['description'],
            'keyword'       => $data['detailPost']['keyword'],
        );
        //bài viết cùng chuyên mục
        if(!empty($data['detailPost']['title']))
        {


            $relate['listblog']            = $this->MPost->getListPost($data['detailPost']['url_cate'],'times', 0, 3);
            $data['detailPost']['tags'] = $this->TagsPro($data['detailPost']['keyword']);
            $relate['info'] = array(
                'name' => 'Cùng Chuyên Mục',
                'alias'=> '/category/'.$data['detailPost']['url_cate']
            );
            $relate['page'] = '<div class="item" style="text-align: center"><a href="'.base_url().'/category/'.$data['detailPost']['url_cate'].'" title="'.$data['detailPost']['category'].'">Xem thêm</a></div>';

            $this->load->header($data['meta']);
            
            $this->load->view('posts/view_blog', $data['detailPost']);
            
            if(isset($relate))
                $this->load->view('posts/list_posts_related',$relate);

            $this->load->footer($data['meta']);           
        }
        else 
        {
            $this->load->header($data['meta']);
            show_alert(3, array('bài viết không tồn tại'));
            $this->load->footer($data['meta']);
        }


    }

    private function TagsPro($content) {
        $str_tag = '';
        if(trim($content) == '')
            return $str_tag;
        $arr = explode(',', $content);
        foreach ($arr as $tag) {
            $tag = trim($tag);
            $str_tag .=  ' <a href="'.base_url().'/tags/'.$tag.'.html" title="'.$tag.'">'.$tag.'</a> ,';
        }
        $str_tag = rtrim($str_tag,',');
        $str_tag = '<div class="tags_pro">'.$str_tag.'</div>';
        return rtrim($str_tag,',');
    }

}