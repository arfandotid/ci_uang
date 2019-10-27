<div class="row">
    <div class="col-xl">
        <h1 class="h4 font-weight-light"><?= $judul; ?></h1>
        <p class="small text-muted">Semua Catatan Transaksi</p>
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