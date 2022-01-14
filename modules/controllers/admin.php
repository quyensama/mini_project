<?php
class Admin extends Controller
{
    private $_listError = array(),
            $Madmin;
    function __construct()
    {
        parent::__construct();
        $this->load->model('madmin');
        $this->Madmin = new Madmin;
        
        $this->data['meta']       = array(
                                    'title'         => 'Admin Panel ',
                                    'description'   => 'Admin Panel ',
                                    'keyword'       => 'Admin Panel ',
                                );
        if(isLogin() == false){
            $this->load->header($this->data['meta']);
            show_alert(2,array('Bạn Không Quyền Vào Trang Này'));
            $this->load->footer($this->data['meta']);
            exit();
        }
    }
    function index()
    {
        $this->load->header($this->data['meta']);
        $this->load->view('admin/main');
        $this->load->footer($this->data['meta']);
    }
    public function category($type = '', $param = '')
    {
        if($_SESSION['level'] < 9) {
            $this->data['meta']['title'] = 'Stop !!!';
            $this->load->header($this->data['meta']);
            show_alert(3,array('bạn không có quyền vào trang này'));
            $this->load->footer($this->data['meta']);
            die();
        }
        $this->load->model('mcategory');
        $this->Mcategory = new Mcategory;
        $data['listcategories'] = $this->Mcategory->getListCategory();
        switch ($type) 
        {

            case 'list':
                $this->data['meta']['title']  = 'Danh Sách Chuyên Mục';
                $this->load->header($this->data['meta']);
                $data = $this->Madmin->getListCategory();
                $this->load->view('admin/category_list', $data);
                break;

            case 'create':
                $this->data['meta']['title']  = 'Tạo Chuyên Mục';
                $this->load->header($this->data['meta']);

                $data["name"]['value']          =  (isset($_POST['name']))          ? addslashes($_POST['name'])        : '';
                $data["description"]['value']   =  (isset($_POST['description']))   ? addslashes($_POST['description']) : '';
                $data["keyword"]['value']       =  (isset($_POST['keyword']))       ? addslashes($_POST['keyword'])     : '';
                $data["parent"]['value']        =  (isset($_POST['parent']))        ? $_POST['parent']                  : '';
                $data["slug"]['value']         =  (isset($_POST['slug']) && $_POST['slug'] != null) ? convertString($_POST['slug']) : 'ten-chuyen-muc';

                $data["name"]['title']          = 'Tên chuyên mục';
                $data["description"]['title']   = 'description';
                $data["keyword"]['title']       = 'keyword';

                if(isset($_POST['save'])){
                    if (!is_string($data['name']['value']) || strlen($data['name']['value']) < 4 ||strlen($data['name']['value']) > 255 ) {
                        $this->_listError[] = 'Tên chuyên mục phải là một chuỗi, lớn hơn 4 và nhỏ hơn 255 ký tự';
                    }
                    if (!is_string($data['description']['value']) || strlen($data['description']['value']) > 255 ) {
                        $this->_listError[] = 'Mô tả phải là một chuỗi, nhỏ hơn 255 ký tự';
                    }
                    if (!is_string($data['keyword']['value']) || strlen($data['keyword']['value']) > 255 ) {
                        $this->_listError[] = 'Keyword phải là một chuỗi, nhỏ hơn 255 ký tự';
                    }
                    if($data["parent"]['value'] == 0){
                        $data["parent"]['value'] = NULL;
                    }
                    if(!empty($checkAlias) > 0 || $data['slug']['value'] == null){
                        $this->_listError[]      = 'Url chuyên mục không hợp lệ(có thể đã tồn tại)';
                        $data['slug']['value']  = convertString($data["title"]['value']);
                    }

                    $checkAlias       = $this->Madmin->checkCategory($data['slug']['value']);

                    if($checkAlias > 0 || $data['slug']['value'] == null){
                        $this->_listError[]         = 'Url chuyên mục không hợp lệ(có thể đã tồn tại)';
                        $data["slug"]['value']     = convertString($data["name"]['value']);
                    }

                    if(count($this->_listError)){
                        show_alert(2,$this->_listError);
                        unset($this->_listError);
                        unset($_POST);
                    }else{

                        if($this->Madmin->insertCategory($data)){
                           show_alert(1,array('Tạo Chuyên Mục Thành Công, <a href="'.base_url().'/admin/category/list">Trở về</a>'));
                        }
                        else{
                            show_alert(2,array('Tạo Chuyên Mục Thất Bại'));
                        }
                    }
                }
                $this->load->view('admin/category_create', $data);
                break;

            case 'edit':

                $this->data['meta']['title']  = 'Chỉnh Sửa Chuyên Mục';
                $this->load->header($this->data['meta']);

                $infoCategory = $this->Madmin->getInfoCategory($param);
                if(!empty($infoCategory)){

                    $data["id"]['value']            =  $infoCategory['id'];
                    $data["main_slug"]['value']    =  $infoCategory['slug'];
                    $data["name"]['value']          =  (isset($_POST['name']))          ? addslashes($_POST['name'])        : $infoCategory['name'];
                    $data["parent"]['value']        =  (isset($_POST['parent']))        ? $_POST['parent']                  : $infoCategory['parent'];
                    $data["description"]['value']   =  (isset($_POST['description']))   ? addslashes($_POST['description']) : $infoCategory['description'];
                    $data["keyword"]['value']       =  (isset($_POST['keyword']))       ? addslashes($_POST['keyword'])     : $infoCategory['keyword'];
                    $data["slug"]['value']         =  (isset($_POST['slug']) && $_POST['slug'] != null) ? convertString($_POST['slug']) : $infoCategory['slug'];

                    $data["name"]['title']          = 'Tên chuyên mục';
                    $data["description"]['title']   = 'description';
                    $data["keyword"]['title']       = 'keyword';

                    $data['listCategory']   = $this->Madmin->getListCategory();
                    $checkAlias             = $this->Madmin->checkAlias($data['slug']['value']);
                    if(isset($_POST['save'])){
                        
                        if (!is_string($data['name']['value']) || strlen($data['name']['value']) < 4 ||strlen($data['name']['value']) > 255 ) {
                            $this->_listError[] = 'Tên chuyên mục phải là một chuỗi, lớn hơn 4 và nhỏ hơn 255 ký tự';
                        }
                        if (!is_string($data['description']['value']) || strlen($data['description']['value']) > 255 ) {
                            $this->_listError[] = 'Mô tả phải là một chuỗi, nhỏ hơn 255 ký tự';
                        }
                        if (!is_string($data['keyword']['value']) || strlen($data['keyword']['value']) > 255 ) {
                            $this->_listError[] = 'Keyword phải là một chuỗi, nhỏ hơn 255 ký tự';
                        }
                        if($data["parent"]['value'] == 0){
                            $data["parent"]['value'] = NULL;
                        }

                        $checkAlias       = $this->Madmin->checkCategory($data['slug']['value']);
    
                        if(( !empty($checkAlias) || $data['slug']['value'] == null) && $data['slug']['value'] != $data['main_slug']['value']){
                            $this->_listError[] = 'Url bài viết không hợp lệ(có thể đã tồn tại)';
                            $data["slug"]['value']  = convertString($data['title']['value']);
                        }
                        if(count($this->_listError)){
                            show_alert(2,$this->_listError);
                            unset($this->_listError);
                            unset($_POST);
                        }else{
                            if($this->Madmin->updateCategory($data)){
                                show_alert(1,array('Chỉnh Sửa Chuyên Mục Thành Công, <a href="'.base_url().'/admin/category/list">Trở về</a>'));
                            }else{
                                show_alert(2,array('Chỉnh Sửa Chuyên Mục Thất Bại'));
                            }
                        }
                    }
                    
                    $this->load->view('admin/category_edit', $data);
                }else{
                    show_alert(2,array('Bài viết không tồn tại'));
                }
                header("Location: ");
                break;
            case 'delete':
                $this->data['meta']['title']  = 'Xóa Chuyên Mục';
                $this->load->header($this->data['meta']);
                $data = $this->Madmin->getInfoCategory($param);
                if(!empty($data)){
                    if(isset($_POST['delete'])){
                        if($this->Madmin->deleteCategory($param)){
                            show_alert(1, array('Xóa chuyên mục " ' . $data['name'] . ' " thành công, <a href="'.base_url().'/admin/category/list">Trở về</a>'));
                        }else{
                            show_alert(2, array('Xóa chuyên mục thất bại'));
                        }
                    }else{
                        $this->load->view('admin/category_delete', $data);
                    }
                }else{
                    show_alert(2, array('Chuyên mục không tồn tại'));
                }
                break;

            default:
                $this->data['meta']['title']  = 'Quản Lý Chuyên Mục';
                $this->load->header($this->data['meta']);
                $this->load->view('admin/category-main');
                break;
        }

        $this->load->footer($this->data['meta']);
    }
    
}
