<div class="col-sm-10">
    <h2>Tạo chuyên mục</h2>
    <form action="<?php echo base_url(); ?>/admin/category/create" method="post">
        <div class="form-group">
            <label for="name">Tên Chuyên Mục:</label>
            <input class="form-control" type="text" id="name" name="name" value="<?php echo stripslashes($data["name"]['value']); ?>">
        </div>
        <div class="form-group">
            <label for="slug">Url Chuyên Mục (Slug):</label>
            <input class="form-control" type="slug" id="slug" name="slug" placeholder="ten-chuyen-muc" value="<?php echo $data["slug"]['value']; ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="parent">Chuyên mục</label>
            <select id="parent" name="parent" class="form-control">
                <option value='0'>Chuyên mục gốc</option>
                <?php
                foreach ($data['listcategories'] as $category) {
                    if ($category['parent'] == 0) {
                        echo '<option value="' . $category['id'] . '"><span class="main-cate">' . $category['name'] . '</span></option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Miêu tả:</label>
            <textarea class="form-control" rows="5" id="description" name="description"><?php echo stripslashes($data["description"]['value']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="keyword">Từ khóa:</label>
            <textarea class="form-control" rows="2" id="keyword" name="keyword"><?php echo stripslashes($data["keyword"]['value']); ?></textarea>
        </div>
        <button type="submit" name="save" class="btn btn-primary">Tạo</button>
        <button type="button" class="btn btn-default" onclick="window.location.href ='<?php echo base_url(); ?>/admin/category/list';">Hủy</button>
    </form>
</div>