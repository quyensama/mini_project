<?php
show_alert(4, array(
	'Bạn muốn xóa ' . $data['name'] . ' '
));
?>
<div class="item">
	<form action="<?php echo base_url(); ?>/admin/category/delete/<?php echo $data['slug'] ?>" method="post">
		<button class="btn btn-primary" name="delete" type="submit">Xác Nhận Xóa</button>
		<button type="button" class="btn btn-default" onclick="window.location.href ='<?php echo base_url(); ?>/admin/category/list';">Hủy</button>
	</form>
</div>