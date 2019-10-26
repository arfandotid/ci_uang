<a href="<?= base_url('transaksi') ?>" class="btn btn-sm btn-secondary mb-3">
    <i class="fa fa-fw fa-arrow-left"></i> Kembali
</a>
<h1 class="h4 font-weight-light"><?= $judul; ?></h1>
<p class="small text-muted"><?= full_tanggal($tgl); ?></p>
<ul class="list-group">
    <li class="list-group-item">
        <?php if (!$transaksi) : ?>
            Data masih kosong
        <?php else : ?>
            <p class="font-weight-bold border-bottom pb-1">
                <span class="text-muted d-block">Total Transaksi</span>
                <span class="d-block text-muted">
                    <span class="font-weight-normal">
                        <i class="fa fa-fw fa-money"></i>
                        Pemasukan
                    </span>
                    <span class="float-right">
                        Rp. <?= number_format($tot_pemasukan['jumlah'], 2, ',', '.'); ?>
                    </span>
                </span>
                <span class="d-block text-muted">
                    <span class="font-weight-normal">
                        <i class="fa fa-fw fa-money"></i>
                        Pengeluaran
                    </span>
                    <span class="float-right">
                        Rp. <?= number_format($tot_pengeluaran['jumlah'], 2, ',', '.'); ?>
                    </span>
                </span>
            </p>
            <span class="text-muted font-weight-bold mb-2">Detail Transaksi</span>
            <?php foreach ($transaksi as $t) : ?>
                <div class="row <?= $t->tipe_kategori == 'pemasukan' ? 'text-success' : 'text-danger' ?>">
                    <span class="col-md text-muted">
                        <i class="fa fa-fw fa-<?= $t->tipe_kategori == 'pemasukan' ? 'plus' : 'minus' ?>"></i>
                        <span class="badge badge-secondary">
                            <?= date('H:i', strtotime($t->waktu)); ?>
                        </span>
                        <?= $t->keterangan ?>
                    </span>
                    <span class="col-md text-right">
                        Rp. <?= number_format($t->jumlah, 2, ',', '.'); ?>
                        <a href="<?= base_url('transaksi/edit/') . $t->id_transaksi; ?>" class="badge badge-secondary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="<?= base_url('transaksi/delete/') . $t->id_transaksi; ?>" class="badge badge-secondary">
                            <i class="fa fa-trash"></i>
                        </a>
                    </span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <a href="#" class="btn btn-primary text-center btn-block btn-sm mt-4">Tambah</a>
    </li>
</ul>