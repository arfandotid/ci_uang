<a href="<?= base_url('transaksi') ?>" class="btn btn-sm btn-secondary mb-3">
    <i class="fa fa-fw fa-arrow-left"></i> Kembali
</a>
<h1 class="h4 font-weight-light"><?= $judul; ?></h1>
<p class="small text-muted">Silahkan isi form berikut ini</p>

<?= form_open('', '', ['id_transaksi' => $data->id_transaksi, 'user_id' => $user]); ?>
<form>
    <div class="form-group">
        <label for="id_transaksi">ID Transaksi</label>
        <input type="text" readonly value="<?= $data->id_transaksi; ?>" class="form-control" id="id_transaksi" placeholder="ID Transaksi">
    </div>
    <div class="form-group">
        <label for="dd-button">Tipe Kategori</label>
        <div class="dropdown">
            <button class="btn btn-block btn-outline-primary dropdown-toggle text-capitalize" type="button" id="dd-button" data-toggle="dropdown" aria-expanded="false">
                <?= $tipe; ?>
            </button>
            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="<?= base_url("transaksi/edit/{$data->id_transaksi}/0"); ?>">Pemasukan</a></li>
                <li><a class="dropdown-item" href="<?= base_url("transaksi/edit/{$data->id_transaksi}/1"); ?>">Pengeluaran</a></li>
            </ul>
        </div>
    </div>
    <div class="form-group">
        <label for="tgl_transaksi">Tanggal Transaksi</label>
        <input type="text" value="<?= set_value('tgl_transaksi', $data->tgl_transaksi); ?>" class="form-control" name="tgl_transaksi" id="tgl_transaksi" placeholder="Tanggal Transaksi">
        <?= form_error('tgl_transaksi'); ?>
    </div>
    <div class="form-group">
        <label for="waktu">Waktu Transaksi</label>
        <input type="text" value="<?= set_value('waktu', $data->waktu) ?>" class="form-control" name="waktu" id="waktu" placeholder="Tanggal Transaksi">
        <?= form_error('waktu'); ?>
    </div>
    <div class="form-group">
        <label for="kategori_id">Kategori "<span class="text-capitalize">Tipe <?= $tipe ?></span>"</label>
        <select class="form-control" name="kategori_id" id="kategori_id">
            <option>--- Pilih Kategori ---</option>
            <?php foreach ($kategori as $k) : ?>
                <?php $statusKategori = $data->id_kategori == $k->id_kategori ? true : false; ?>
                <option <?= set_select('kategori_id', $k->id_kategori, $statusKategori); ?> value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
            <?php endforeach; ?>
        </select>
        <?= form_error('kategori_id'); ?>
    </div>
    <div class="form-group">
        <label for="jumlah">Jumlah</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Rp.</span>
            </div>
            <input type="number" value="<?= set_value('jumlah', $data->jumlah); ?>" minlength="0" class="form-control" name="jumlah" id="jumlah" placeholder="0">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon1">,00</span>
            </div>
        </div>
        <?= form_error('jumlah'); ?>
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <input type="text" value="<?= set_value('keterangan', $data->keterangan); ?>" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan...">
        <?= form_error('keterangan'); ?>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-lg btn-block" type="submit">
            Update
        </button>
    </div>
</form>
<?= form_close(); ?>