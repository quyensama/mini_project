<?php
class MAdmin extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    function insertCategory($data)
    {
        $data_insert = array(
            'name' => $data['name']['value'],
            'description' => $data['description']['value'],
            'keyword' => $data['keyword']['value'],
            'parent' => $data['parent']['value'],
            'slug' => $data['slug']['value']
        );
        return $this->db->table('categories')->insert($data_insert)->affected_rows >= 1;
    }

    function updateCategory($data)
    {
        $data_update = array(
            'name' => $data['name']['value'],
            'description' => $data['description']['value'],
            'keyword' => $data['keyword']['value'],
            'parent' => $data['parent']['value'],
            'slug' => $data['slug']['value']
        );
        return $this->db->table('categories')->updateRow($data["id"]['value'], $data_update)->affected_rows >= 1;
    }

    function deleteCategory($slug)
    {
        $sql  = 'DELETE FROM categories WHERE slug = \'' . $slug . '\'';
        return $this->db->query($sql);
    }
    public function getInfoCategory($slug)
    {
        $query  =  $this->db->table('categories')->getAll('`slug` = \'' . $slug . '\'');
        return $query->fetch_array(MYSQLI_ASSOC);
    }

    function getListCategory()
    {
        $query = $this->db->table('categories')->getAll();
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getTotalBlog($idCategory)
    {
        $query  = $this->db->table('posts')->getAll('id_category = ' . $idCategory);
        return  $query->num_rows;
    }
    function checkCategory($slug)
    {
        $query = $this->db->table('categories')->getAll('`slug` = \'' . $slug . '\'');
        return  $query->fetch_array(MYSQLI_ASSOC);
    }
    function checkAlias($alias)
    {
        $query = $this->db->table('posts')->getAll('`slug` = \'' . $alias . '\'');
        return $query->fetch_array(MYSQLI_ASSOC);
    }
}
