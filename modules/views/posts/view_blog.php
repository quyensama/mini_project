<div class="col-sm-9">

<?php
if(empty($data['content'])){
    show_alert(3,array('Bài viết không tồn tại'));
}else{
    $arrBreadcrumb = array(
                        array(
                            'link'  => base_url().'/category/'.$data['url_cate'],
                            'title' => $data['category']
                        )
                    );
    echo breadcrumb($arrBreadcrumb);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title topic-name">
            <span class="label label-default"><?php echo $data['category']; ?></span> 
            <a href="<?php echo base_url().'/'.$data['slug']; ?>.html" title="<?php echo $data['title']; ?>"><?php echo $data['title']; ?></a>
        </h1>
    </div>
    <div class="list-group">
        <div class="list-group-item">
            <i class="fa fa-pencil-square-o"></i> Tác giả: <b><span style="color:red;"><?php echo $data['username']; ?></span></b> <br />
            <i class="fa fa-clock-o"></i> Thời gian: <?php echo convertTimeToString($data['times']); ?>
        </div>
        <div class="list-group-item">
            <?php echo $data['content']; ?>
        </div>
        <div class="list-group-item">
            Tags: <?php echo $data['tags']; ?>
        </div>

    </div>
</div>

</div>

<div class="col-sm-3">



<!--kết thúc show nội dung bài viết-->

<?php } ?>