<h1 class="h4 font-weight-light text-center">
    Login Aplikasi
</h1>
<p class="text-muted small text-center mb-4">
    Silahkan login untuk masuk ke aplikasi
</p>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-fw fa-user"></i>
            </span>
        </div>
        <input type="text" value="<?= set_value('username'); ?>" class="form-control" name="username" id="username" placeholder="Username">
    </div>
    <?= form_error('username'); ?>
</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-fw fa-lock"></i>
            </span>
        </div>
        <input type="password" class="form-control" name="pin" id="pin" placeholder="PIN">
    </div>
    <?= form_error('pin'); ?>
</div>
<button type="submit" class="btn btn-primary btn-block">
    Login
</button>
<a class="d-block mt-3 text-center text-muted small" href="<?= base_url('register') ?>">Belum punya akun? Daftar</a>