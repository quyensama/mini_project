<div class="col-sm-8">
    <div class="panel panel-default margin-bottom">
        <div class="panel-heading clearfix">
            <div>
                <a href="<?php echo base_url() .'/'. $data['info']['alias'] ?>"
                    title="<?php echo $data['info']['name'] ?>"><?php echo $data['info']['name']?>
                </a>
            </div>
        </div>

<?php
$page = '';
if (isset ( $data ['page'] )) {
    $page = $data ['page'];
    unset ( $data ['page'] );
}
if (! empty ( $data ['listblog'] )) {
    foreach ( $data ['listblog'] as $value ) {
        ?>
<div class="list-group list-group-sm">
    <div class="list-group-item">
        <div class="kmedia">
            <a class="pull-left" href="<?php echo base_url().'/'.$value['slug']; ?>.html"><img src="<?php echo $value['thumbnail']; ?>" alt="<?php echo $value['title']; ?>" title="<?php echo $value['title']; ?>" width="100%" height="100%" /></a>
            <div class="kmedia-body">
                <h4 class="kmedia-heading nowrap"><a href="<?php echo base_url().'/'.$value['slug']; ?>.html" title="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></a>
                </h4>
                <p class="gray">Đăng Bởi: <i class="fa fa-user"></i> <?php echo $value['username']; ?></p>
                <p class="gray"><i class="fa fa-book"></i> <a href="<?php echo base_url().'/category/'.$value['url_cate']; ?>" title="<?php echo $value['category']; ?>"><?php echo $value['category']; ?></a></p>
                <p class="gray"><i class="fa fa-clock-o"></i> <?php echo convertTimeToString($value['times']); ?></p>
            </div>

        </div>
    </div>
</div>
<?php
    }
} else {
    show_alert ( 4, array (
            'không có bài viết nào' 
    ) );
}
echo $page;
?>
    </div>
</div>