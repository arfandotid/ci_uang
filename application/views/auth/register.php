<h1 class="h4 font-weight-light text-center">
    Daftar Akun
</h1>
<p class="text-muted small text-center mb-4">
    Silahkan isi form berikut ini untuk mendaftar akun
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
                <i class="fa fa-fw fa-calendar"></i>
            </span>
        </div>
        <input type="text" value="<?= set_value('tgl_lahir'); ?>" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir">
    </div>
    <?= form_error('tgl_lahir'); ?>
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
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-fw fa-refresh"></i>
            </span>
        </div>
        <input type="password" class="form-control" name="confirm_pin" id="confirm_pin" placeholder="Konfirmasi PIN">
    </div>
    <?= form_error('confirm_pin'); ?>
</div>
<button type="submit" class="btn btn-primary btn-block">
    Daftar
</button>
<a class="d-block mt-3 text-center text-muted small" href="<?= base_url('login') ?>">Sudah punya akun? Login</a>