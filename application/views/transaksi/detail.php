<a href="<?= base_url('transaksi') ?>" class="btn btn-sm btn-secondary mb-3">
    <i class="fa fa-fw fa-arrow-left"></i> Kembali
</a>
<h1 class="h4 font-weight-light"><?= $judul; ?></h1>
<p class="small text-muted"><?= full_tanggal($tgl); ?></p>
<ul class="list-group">
    <li class="list-group-item">
        <?php if (!$transaksi) : ?>
            <p class="text-muted">Data masih kosong</p>
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
                <div class="row">
                    <span class="col-md text-muted">
                        <i class="fa fa-fw fa-<?= $t->tipe_kategori == 'pemasukan' ? 'plus' : 'minus' ?>"></i>
                        <span class="badge badge-secondary">
                            <?= date('H:i', strtotime($t->waktu)); ?>
                        </span>
                        <?= $t->keterangan ?>
                    </span>
                    <span class="col-md text-right font-weight-bold text-muted">
                        Rp. <?= number_format($t->jumlah, 2, ',', '.'); ?>
                        <div class="btn-group">
                            <a href="#" class="badge badge-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <h6 class="dropdown-header">Atur</h6>
                                <a href="<?= base_url('transaksi/edit/') . $t->id_transaksi; ?>" class="dropdown-item">
                                    <i class="fa fa-fw fa-edit"></i> Edit
                                </a>
                                <a onclick="return confirm('Yakin ingin hapus data?')" href="<?= base_url('transaksi/delete/') . $t->id_transaksi; ?>" class="dropdown-item">
                                    <i class="fa fa-fw fa-trash"></i> Hapus
                                </a>
                            </div>
                        </div>
                    </span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <a href="<?= base_url('transaksi/add/0/') . $tgl ?>" class="btn btn-primary text-center btn-block btn-sm mt-4">Tambah</a>
    </li>
</ul>