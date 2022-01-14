<div class="col-sm-12">
    <form action="<?php echo base_url(); ?>/user/login" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="text" id="username" name="username" value="<?php if (isset($_COOKIE['username'])) {echo $_COOKIE['username']; }?>" placeholder="Enter username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" id="password" name="password" value="" placeholder="Password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="saveLogin" name="saveLogin" <?php if(isset($_COOKIE["saveLogin"])) { ?> checked <?php } ?>>
            <label class="form-check-label" for="saveLogin">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>