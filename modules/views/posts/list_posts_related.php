    <div class="panel panel-default margin-bottom">
        <div class="panel-heading clearfix">
            <div>
                <a href="<?php echo base_url() .'/'. $data['info']['alias'] ?>"
                    title="<?php echo $data['info']['name'] ?>"><?php echo $data['info']['name']?>
                </a>
            </div>
        </div>
        <div class="list-group list-group-sm">

<?php
$page = '';
if (isset ( $data ['page'] )) {
    $page = $data ['page'];
    unset ( $data ['page'] );
}
if (! empty ( $data ['listblog'] )) {
    foreach ( $data ['listblog'] as $value ) {
        ?>
    <div class="list-group-item">
        <h5 class="kmedia-heading nowrap"><a href="<?php echo base_url().'/'.$value['slug']; ?>.html" title="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></a></h5>
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