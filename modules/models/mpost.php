<?php
/**
 * 
 */
class MPost extends Model
{
    
    function __construct(){
        parent::__construct();
    }

    //phuong thức lấy danh sách bài viết
    public function getListPost($where ='',$oder = 'times', $start, $limit)
    {
        $sql      = 'SELECT `posts`.`id` AS `post_id`, `posts`.`id_author`, `users`.`username`, `posts`.`id_category`, `categories`.`name` AS `category`, `categories`.`slug` AS `url_cate`, `posts`.`title`, `posts`.`content`, `posts`.`times`, `posts`.`thumbnail`, `posts`.`status`, `posts`.`slug` FROM `posts` INNER JOIN `categories` ON `categories`.`id` = `posts`.`id_category` INNER JOIN `users` ON `users`.`id` = `posts`.`id_author` WHERE `posts`.`status` = 1 '.$where.' ORDER BY '.$oder.' DESC LIMIT '.$start.','.$limit;
                     
        if($where != null){
            $sql   = 'SELECT `posts`.`id` AS `post_id`, `posts`.`id_author`, `users`.`username`, `posts`.`id_category`, `categories`.`name` AS `category`, `categories`.`slug` AS `url_cate`, `posts`.`title`, `posts`.`content`, `posts`.`times`, `posts`.`thumbnail`, `posts`.`status`, `posts`.`slug` FROM `posts` INNER JOIN `categories` ON `categories`.`id` = `posts`.`id_category` INNER JOIN `users` ON `users`.`id` = `posts`.`id_author` WHERE `posts`.`status` = 1 AND `posts`.`id_category` = (SELECT `id` AS `id_category` FROM `categories` WHERE `categories`.`slug`=\''.$where.'\') ORDER BY '.$oder.' DESC LIMIT '.$start.','.$limit;
        }
        $query    = $this->db->query($sql);
        $result   = $query->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    //phuong thức lấy thông tin 1 bài viết
    public function getDetailPost($url)
    {
        $sql      = 'SELECT `posts`.`id` AS `post_id`, `posts`.`id_author`, `users`.`username`, `posts`.`id_category`, `categories`.`name` AS `category`, `categories`.`slug` AS `url_cate`, `categories`.`parent` AS `id_parent`, `posts`.`title`, `posts`.`content`, `posts`.`description`, `posts`.`keyword`, `posts`.`times`, `posts`.`thumbnail`, `posts`.`status`, `posts`.`slug` FROM `posts` INNER JOIN `categories` ON `categories`.`id` = `posts`.`id_category` INNER JOIN `users` ON `users`.`id` = `posts`.`id_author` WHERE `posts`.`slug` = \''.$url.'\' ;';

        $query    = $this->db->query($sql);
        $result   = $query->fetch_array(MYSQLI_ASSOC);
        return $result;
    }

    function getPostByCategory($id_category,$start, $limit, $full = false)
    {
        $sql = 'SELECT `posts`.`id` AS `post_id`, `posts`.`id_author`, `users`.`username`, `posts`.`id_category`, `categories`.`name` AS `category`, `categories`.`slug` AS `url_cate`, `categories`.`parent` AS `id_parent`, `posts`.`title`, `posts`.`description`, `posts`.`keyword`, `posts`.`times`, `posts`.`thumbnail`, `posts`.`status`, `posts`.`slug` FROM `posts` INNER JOIN `categories` ON `categories`.`id` = `posts`.`id_category` INNER JOIN `users` ON `users`.`id` = `posts`.`id_author` WHERE `posts`.`status` = 1 AND `posts`.`id_category` IN (SELECT `id` AS `id_category` FROM `categories` WHERE `parent`='.$id_category.' OR `id` = '.$id_category.') ORDER BY `times` DESC LIMIT '.$start.','.$limit;
        if($full == true)
        {
            $query = $this->db->table('categories')->getAll("`parent` = {$id_category}");
            $listID = array();
            while ($data = $query->fetch_array(MYSQLI_ASSOC)){
                $listID[] = "'{$data['id']}'";
            }
            $listID = rtrim("'$id_category',".implode(',', $listID), ',');
            $sql = 'SELECT `posts`.`id` AS `post_id`, `posts`.`id_author`, `users`.`username`, `posts`.`id_category`, `categories`.`name` AS `category`, `categories`.`slug` AS `url_cate`, `categories`.`parent` AS `id_parent`, `posts`.`title`, `posts`.`description`, `posts`.`keyword`, `posts`.`times`, `posts`.`thumbnail`, `posts`.`status`, `posts`.`slug` FROM `posts` INNER JOIN `categories` ON `categories`.`id` = `posts`.`id_category` INNER JOIN `users` ON `users`.`id` = `posts`.`id_author` WHERE `posts`.`status` = 1 AND `posts`.`id_category` IN ('.$listID.') ORDER BY `times` DESC LIMIT '.$start.','.$limit;
        }
        $query    = $this->db->query($sql);
        $result   = array();
        $result  = $query->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    /**
     * countAll
     * param
     * $where is string 
     * ex id_category = 1
     *return total record
     */
    public function countAll($where = null){
        $where  = (isset($where)) ? "WHERE b.index = 1 and  $where and b.id_category = c.id" : "WHERE b.status = 1 and  b.id_category = c.id";
        $sql    = "SELECT b.id FROM posts b, categories c $where";
        $query  = $this->db->query($sql);
        $result = $query->num_rows;
        return $result;
    }

}