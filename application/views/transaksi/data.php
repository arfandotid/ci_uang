<?= $this->session->flashdata('pesan'); ?>
<h1 class="h4 font-weight-light mb-3"><?= $judul; ?></h1>

<!-- Transaksi Hari ini -->
<ul class="list-group">
    <li class="list-group-item">
        <h3 class="h6">Hari ini : <?= full_tanggal(strtotime($today)); ?></h3>
        <p class="font-weight-bold border-bottom pb-1">
            <span class="text-muted d-block">Total Transaksi</span>
            <span class="d-block text-muted">
                <span class="font-weight-normal">
                    <i class="fa fa-fw fa-money"></i>
                    Pemasukan
                </span>
                <span class="float-right">
                    Rp. <?= number_format($tot_pemasukan[key($transaksi)]['jumlah'], 2, ',', '.'); ?>
                </span>
            </span>
            <span class="d-block text-muted">
                <span class="font-weight-normal">
                    <i class="fa fa-fw fa-money"></i>
                    Pengeluaran
                </span>
                <span class="float-right">
                    Rp. <?= number_format($tot_pengeluaran[key($transaksi)]['jumlah'], 2, ',', '.'); ?>
                </span>
            </span>
        </p>
        <span class="text-muted font-weight-bold mb-2">Detail Transaksi</span>
        <?php if (array_key_exists($today, $transaksi)) : ?>
            <!-- Tampilkan data transaksi -->
            <?php foreach ($transaksi[date('Y-m-d')] as $t) : ?>
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
        <?php else : ?>
            <span class="text-muted">Kosong</span>
        <?php endif; ?>
        <a href="#" class="btn btn-primary text-center btn-block btn-sm mt-4">Tambah</a>
    </li>
</ul>

<!-- Transaksi Hari lainnya -->
<ul class="list-group list-group-flush">
    <?php foreach ($transaksi as $tgl) : ?>
        <?php if (key($transaksi) != date('Y-m-d')) : ?>
            <li class="list-group-item list-group-item-action p-3">
                <div class="row m-0">
                    <div class="col-xl-1 col-2 d-flex justify-content-center text-white bg-primary p-0 rounded">
                        <div class="small align-self-center">
                            <h6 class="mb-0 font-weight-bold text-center">
                                <?= date('d', strtotime(key($transaksi))); ?>
                            </h6>
                            <span class="text-white font-weight-light">
                                <?= date('M y', strtotime(key($transaksi))); ?>
                            </span>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Menampilkan total transaksi -->
                        <table class="text-muted">
                            <tr>
                                <td class="text-right">Pemasukan</td>
                                <td class="pl-1 font-weight-bold">Rp. <?= number_format($tot_pemasukan[key($transaksi)]['jumlah'], 2, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td>Pengeluaran</td>
                                <td class="pl-1 font-weight-bold">Rp. <?= number_format($tot_pengeluaran[key($transaksi)]['jumlah'], 2, ',', '.'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <div class="align-self-center">
                            <a href="<?= base_url('transaksi/detail/') . strtotime(key($transaksi)); ?>" class="badge badge-primary">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        <?php endif; ?>
        <!-- Tanggal Selanjutnya -->
        <?php next($transaksi); ?>
    <?php endforeach; ?>
</ul>