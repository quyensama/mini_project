<?php
/**
 * 
 */
class Mcategory extends Model
{
	
	private $_total;
    
    function __construct(){
        parent::__construct();
    }

    public function getListCategory($where = null){

        $query  = $this->db->table('categories')->getAll($where);
        $result   = array();
        
        while($data  = $query->fetch_array(MYSQLI_ASSOC)){
            $result[] = $data;
            $totlBlog[] = $this->getTotalBlog($data['id']);
        }
        $this->_total = count($result);
        for($i = 0; $i < $this->_total ; $i++ ){
            $result[$i]['blog'] = $totlBlog[$i];
        }
        return $result;
    }

    public function getTotalBlog($idCategory){
        $query  = $this->db->table('posts')->getAll('id_category = '.$idCategory);
        return  $query->num_rows;
    }

    public function getInfo($url){
        $query  = $this->db->table('categories')->getAll('slug = \''.$url.'\'');
        return  $query->fetch_array(MYSQLI_ASSOC);
    }

    public function countAll($id_category){
        $query  = $this->db->table('categories')->getAll('parent = '.$id_category);
        $listID = array();
        while ($data = $query->fetch_array(MYSQLI_ASSOC)){
            $listID[] = "'{$data['id']}'";
        }
        $listID = rtrim("'$id_category',".implode(',', $listID), ',');
        $sql = "SELECT b.id FROM posts AS b, categories AS c WHERE b.id_category = c.id AND id_category IN ({$listID})";
        $query  = $this->db->query($sql);
        return  $query->num_rows;
    }
}