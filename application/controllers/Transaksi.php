<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MainModel', 'main');
	}

	private function template($view, $data = null)
	{
		$this->load->view('templates/header', $data);
		$this->load->view($view);
		$this->load->view('templates/footer');
	}

	public function index()
	{
		$data['judul'] = "Riwayat Transaksi";

		// Ambil tanggal transaksinya saja
		$tglTransaksi = $this->main->getTglTransaksi();

		// panggil data transaksi sesuai dengan tanggal yang telah diambil (Grouping)
		$transaksiByTgl = [];
		$tot_pengeluaran = [];
		$tot_pemasukan = [];
		foreach ($tglTransaksi as $tr) {
			$transaksiByTgl[$tr->tgl_transaksi] = $this->main->getTransaksiByTgl($tr->tgl_transaksi);

			// Total / Jumlah Pemasukan dan pengeluaran dalam sehari
			$tot_pengeluaran[$tr->tgl_transaksi] = $this->main->getTotalTransaksi($tr->tgl_transaksi, 'pengeluaran');
			$tot_pemasukan[$tr->tgl_transaksi] = $this->main->getTotalTransaksi($tr->tgl_transaksi, 'pemasukan');
		}
		$data['transaksi'] = $transaksiByTgl;
		$data['tot_pengeluaran'] = $tot_pengeluaran;
		$data['tot_pemasukan'] = $tot_pemasukan;
		$data['today'] = date('Y-m-d');

		$this->template('transaksi/data', $data);
	}
}
