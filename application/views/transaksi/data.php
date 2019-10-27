<?= $this->session->flashdata('pesan'); ?>
<h1 class="h4 font-weight-light mb-3"><?= $judul; ?></h1>

<!-- Transaksi Hari ini -->
<ul class="list-group">
    <li class="list-group-item">
        <h3 class="h6">Hari ini : <?= full_tanggal(strtotime($today)); ?></h3>

        <?php

        // if (!in_array($today, $tot_pemasukan) && !in_array($today, $tot_pengeluaran)) {
        //     $tot_pemasukan[$today]['jumlah'] = 0;
        //     $tot_pengeluaran[$today]['jumlah'] = 0;
        // }

        ?>

        <p class="font-weight-bold border-bottom pb-1">
            <span class="text-muted d-block">Total Transaksi</span>
            <span class="d-block text-muted">
                <span class="font-weight-normal">
                    <i class="fa fa-fw fa-money"></i>
                    Pemasukan
                </span>
                <span class="float-right">
                    <?php $masuk = array_key_exists($today, $tot_pemasukan) ? $tot_pemasukan[$today]['jumlah'] : 0; ?>
                    Rp. <?= number_format($masuk, 2, ',', '.'); ?>
                </span>
            </span>
            <span class="d-block text-muted">
                <span class="font-weight-normal">
                    <i class="fa fa-fw fa-money"></i>
                    Pengeluaran
                </span>
                <span class="float-right">
                    <?php $keluar = array_key_exists($today, $tot_pemasukan) ? $tot_pengeluaran[$today]['jumlah'] : 0; ?>
                    Rp. <?= number_format($keluar, 2, ',', '.'); ?>
                </span>
            </span>
        </p>
        <span class="text-muted font-weight-bold mb-2">Detail Transaksi</span>
        <?php if (array_key_exists($today, $transaksi)) : ?>
            <!-- Tampilkan data transaksi -->
            <?php foreach ($transaksi[date('Y-m-d')] as $t) : ?>
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
        <?php else : ?>
            <p class="text-muted">Kosong</p>
        <?php endif; ?>
        <a href="<?= base_url('transaksi/add'); ?>" class="btn btn-primary text-center btn-block btn-sm mt-4">Tambah</a>
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