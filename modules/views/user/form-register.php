<div class="col-sm-12">
    <form action="<?php echo base_url(); ?>/user/register" method="post">
        <div class="form-group">
        <label for="fullname">Họ và tên</label> 
          <input class="form-control" type="text" name="fullName" id="fullname" value="">
        </div>
        <div class="form-group">
        <label for="username">Tên đăng nhập</label>
          <input class="form-control" type="text" name="username" id="username" value="">
        </div>
        <div class="form-group">
        <label for="password">Mật khẩu</label>
          <input class="form-control" type="password" name="password" id="password">
        </div>
        <div class="form-group">
        <label for="repassword">Nhập lại mật khẩu</label>
          <input class="form-control" type="password" name="rePassword" id="repassword">
        </div>
        <div class="form-group">
        <label for="email">Email</label>
          <input class="form-control" type="text" name="email" id="email" value="">
        </div>
        <div class="form-group">
          <span class="row1" style="width:20%">
          <input class="btn btn-primary" type="submit" name="login" value="Đăng Ký">
        </div>
    </form>
</div>