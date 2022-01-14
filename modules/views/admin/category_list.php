<button class="btn btn-success" onclick="window.location.href ='<?php echo base_url(); ?>/admin/category/create';">Thêm mới</button>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách chuyên mục</h3>
    </div>
    <div class="panel-body">
        <table class="table">
            <tbody>
                <?php
                if (empty($data)) {
                    show_alert(4, array(
                        'chuyên mục rỗng'
                    ));
                }
                $i = 0;
                foreach ($data as $key => $category) :
                    if ($category['parent'] == 0) :
                ?>
                        <tr>
                            <th scope="row"><?php echo $i += 1; ?></th>
                            <td>
                                <a href="<?php echo base_url() . '/category/' . $category['slug']; ?>" title="<?php echo $category['name']; ?>"> <strong><?php echo $category['name']; ?></strong>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning" onclick="window.location.href ='<?php echo base_url() . '/admin/category/edit/' . $category['slug']; ?>'">Sửa</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="window.location.href ='<?php echo base_url() . '/admin/category/delete/' . $category['slug']; ?>'">Xóa</button>
                            </td>
                        </tr>
                        <?php
                        foreach ($data as $skey => $sub_category) :
                            if ($category['id'] == $sub_category['parent']) :
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $i += 1; ?></th>
                                    <td style="padding-left: 5rem;">--
                                        <a href="<?php echo base_url() . '/category/' . $sub_category['slug']; ?>" title="<?php echo $category['name']; ?>"><strong><?php echo $sub_category['name']; ?></strong>
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" onclick="window.location.href ='<?php echo base_url() . '/admin/category/edit/' . $sub_category['slug']; ?>'">Sửa</button>
                                    </td>
                                    <td><button type="button" class="btn btn-danger" onclick="window.location.href ='<?php echo base_url() . '/admin/category/delete/' . $sub_category['slug']; ?>'">Xóa</button>
                                    </td>
                                </tr>
                        <?php
                            endif;
                        endforeach;
                        ?>
                <?php
                    endif;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>