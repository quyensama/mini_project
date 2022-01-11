<div class="col-sm-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			Danh Sách Chuyên Mục
		</div>
		<div class="list-group">
<?php
foreach ( $data as $key => $category ) {
	?>
<div class="list-group-item">
	<i class="fa fa-book"></i> <a
		href="<?php echo base_url().'/category/'.$category['slug']; ?>"
		title="<?php echo $category['name']; ?>"> <b><?php echo $category['name']; ?></b>
	</a>
</div>
<?php
}
if (empty ( $data )) {
	show_alert ( 4, array (
			'Chuyên mục rỗng' 
	) );
}
?>
	</div>
</div>