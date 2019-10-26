<h1 class="h4 font-weight-light"><?= $judul; ?></h1>
<p class="small text-muted">Silahkan isi form berikut ini</p>

<?= form_open('', '', ['id_transaksi' => $id_transaksi]); ?>
<form>
    <div class="form-group">
        <label for="id_transaksi">ID Transaksi</label>
        <input type="text" readonly value="<?= $id_transaksi; ?>" class="form-control" id="id_transaksi" placeholder="ID Transaksi">
    </div>
    <div class="form-group">
        <label for="dd-button">Tipe Kategori</label>
        <div class="dropdown">
            <button class="btn btn-block btn-outline-primary dropdown-toggle text-capitalize" type="button" id="dd-button" data-toggle="dropdown" aria-expanded="false">
                <?= $tipe; ?>
            </button>
            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="<?= base_url('transaksi/add/0'); ?>">Pemasukan</a></li>
                <li><a class="dropdown-item" href="<?= base_url('transaksi/add/1'); ?>">Pengeluaran</a></li>
            </ul>
        </div>
    </div>
    <div class="form-group">
        <label for="tgl_transaksi">Tanggal Transaksi</label>
        <input type="text" value="<?= $tgl ?>" class="form-control" id="tgl_transaksi" placeholder="Tanggal Transaksi">
        <small class="form-text text-muted">yyyy-mm-dd</small>
    </div>
    <div class="form-group">
        <label for="waktu">Waktu Transaksi</label>
        <input type="text" value="<?= date('H:i') ?>" class="form-control" id="waktu" placeholder="Tanggal Transaksi">
        <small class="form-text text-muted">H:i</small>
    </div>
    <div class="form-group">
        <label for="kategori_id">Kategori "<span class="text-capitalize">Tipe <?= $tipe ?></span>"</label>
        <select class="form-control" id="kategori_id">
            <option>--- Pilih Kategori ---</option>
            <?php foreach ($kategori as $k) : ?>
                <option value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="jumlah">Jumlah</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Rp.</span>
            </div>
            <input type="number" minlength="0" class="form-control" name="jumlah" id="jumlah" placeholder="0">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon1">,00</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan...">
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-lg btn-block" type="submit">
            Simpan
        </button>
    </div>
</form>
<?= form_close(); ?>