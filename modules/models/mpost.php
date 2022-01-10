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
        $sql      = 'SELECT `posts`.`id` AS `post_id`, `posts`.`id_author`, `users`.`username`, `posts`.`id_category`, `categories`.`name` AS `category`, `posts`.`title`, `posts`.`content`, `posts`.`times`, `posts`.`thumbnail`, `posts`.`status`, `posts`.`slug` FROM `posts` INNER JOIN `categories` ON `categories`.`id` = `posts`.`id_category` INNER JOIN `users` ON `users`.`id` = `posts`.`id_author` WHERE `posts`.`status` = 1 '.$where.' ORDER BY '.$oder.' DESC LIMIT '.$start.','.$limit;
                     
        if($where != null){
            $sql   = 'SELECT `posts`.`id` AS `post_id`, `posts`.`id_author`, `users`.`username`, `posts`.`id_category`, `categories`.`name` AS `category`, `posts`.`title`, `posts`.`content`, `posts`.`times`, `posts`.`thumbnail`, `posts`.`status`, `posts`.`slug` FROM `posts` INNER JOIN `categories` ON `categories`.`id` = `posts`.`id_category` INNER JOIN `users` ON `users`.`id` = `posts`.`id_author` WHERE `posts`.`status` = 1 AND `posts`.`id_category` = (SELECT `id` AS `id_category` FROM `categories` WHERE `categories`.`slug`=\''.$where.'\') ORDER BY '.$oder.' DESC LIMIT '.$start.','.$limit;
        }
        $query    = $this->db->query($sql);
        $result   = $query->fetch_all(MYSQLI_ASSOC);
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