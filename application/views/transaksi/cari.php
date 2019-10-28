<div class="row">
    <div class="col-xl">
        <h1 class="h4 font-weight-light"><?= $judul; ?></h1>
        <p class="small text-muted">
            Data "disaring"
            <a href="<?= base_url('transaksi'); ?>">Tampilkan Semua</a>
        </p>
    </div>
    <div class="col-xl text-center text-xl-right align-self-center">
        <button data-toggle="collapse" data-target="#filter" class="btn btn-sm btn-secondary mb-3">
            <i class="fa fa-fw fa-filter"></i> Cari Berdasarkan
        </button>
    </div>
</div>
<?= form_open('transaksi/cari'); ?>
<div class="filter row collapse" id="filter">
    <div class="form-group col-md-4 mb-3">
        <select name="tipe_kategori" id="tipe_kategori" class="form-control">
            <option value="">Semua Tipe</option>
            <option value="pemasukan">Pemasukan</option>
            <option value="pengeluaran">Pengeluaran</option>
        </select>
    </div>
    <div class="form-group col-md-4">
        <input type="text" name="tgl_transaksi" id="tgl_transaksi" class="form-control" placeholder="Tanggal">
    </div>
    <div class="form-group col-md-4">
        <input type="text" name="waktu" id="waktu" class="form-control" placeholder="Waktu">
    </div>
</div>
<div class="form-group row">
    <div class="form-group col-lg-8">
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Cari jumlah atau nama transaksi">
    </div>
    <div class="form-group col-lg-4">
        <button type="submit" class="btn btn-block btn-outline-primary">
            <i class="fa fa-fw fa-search"></i> Carikan
        </button>
    </div>
</div>
<?= form_close(); ?>
<h3 class="h5 font-weight-light">Hasil Pencarian <span class="font-weight-bold"><?= set_value('keyword'); ?></span></h3>
<?php if ($data) : ?>
    <?php foreach ($data as $d) : ?>
        <div class="row">
            <span class="col-md text-muted">
                <i class="fa fa-fw fa-<?= $d->tipe_kategori == 'pemasukan' ? 'plus' : 'minus' ?>"></i>
                <span class="badge badge-primary">
                    <?= date('d/m/Y', strtotime($d->tgl_transaksi)); ?>
                </span>
                <span class="badge badge-secondary">
                    <?= date('H:i', strtotime($d->waktu)); ?>
                </span>
                <?= $d->keterangan ?>
            </span>
            <span class="col-md text-right font-weight-bold text-muted">
                Rp. <?= number_format($d->jumlah, 2, ',', '.'); ?>
                <div class="btn-group">
                    <a href="#" class="badge badge-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <h6 class="dropdown-header">Atur</h6>
                        <a href="<?= base_url('transaksi/edit/') . $d->id_transaksi; ?>" class="dropdown-item">
                            <i class="fa fa-fw fa-edit"></i> Edit
                        </a>
                        <a onclick="return confirm('Yakin ingin hapus data?')" href="<?= base_url('transaksi/delete/') . $d->id_transaksi; ?>" class="dropdown-item">
                            <i class="fa fa-fw fa-trash"></i> Hapus
                        </a>
                    </div>
                </div>
            </span>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p class="text-muted">Data tidak ditemukan.</p>
<?php endif; ?>