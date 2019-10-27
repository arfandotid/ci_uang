<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MainModel', 'main');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');
		$this->form_validation->set_message('required', 'Silahkan isi kolom {field}.');
		$this->form_validation->set_message('greater_than_equal_to', 'Isilah kolom {field} dengan nilai minimal {param}');
	}

	private function template($view, $data = null)
	{
		$this->load->view('templates/header', $data);
		$this->load->view($view);
		$this->load->view('templates/footer');
	}

	public function index()
	{
		$data['judul'] = "Semua Transaksi";

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

	public function detail($getTgl)
	{
		$data['judul'] 		= "Detail Transaksi";
		$data['tgl'] 		= encode_php_tags($getTgl);
		$format_tgl 		= date('Y-m-d', $data['tgl']);

		$data['transaksi'] 			= $this->main->getTransaksiByTgl($format_tgl);
		$data['tot_pemasukan'] 		= $this->main->getTotalTransaksi($format_tgl, 'pemasukan');
		$data['tot_pengeluaran']	= $this->main->getTotalTransaksi($format_tgl, 'pengeluaran');

		$this->template('transaksi/detail', $data);
	}

	private function generateIdTransaksi()
	{
		$char = "T-";
		$today = date('ymd');

		$prefix = $char . $today;

		$lastKode = $this->main->getMaxIdTransaksi($prefix);
		$noUrut = (int) substr($lastKode, -6, 6);
		$noUrut += 1;

		$newKode = $char . $today . sprintf('%06s', $noUrut);
		return $newKode;
	}

	private function _validasiTransaksi()
	{
		$this->form_validation->set_rules('tgl_transaksi', 'Tanggal Transaksi', 'required|trim');
		$this->form_validation->set_rules('waktu', 'Waktu Transaksi', 'required|trim');
		$this->form_validation->set_rules('kategori_id', 'Kategori', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric|greater_than_equal_to[1]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
	}

	public function add($getTipe = 0, $tgl = null)
	{
		$getTipe = encode_php_tags($getTipe);
		$tgl = encode_php_tags($tgl);

		$data['judul'] = "Tambah Transaksi";
		$data['tgl'] = $tgl != null ? date('Y-m-d', strtotime($tgl)) : date('Y-m-d');
		$data['user'] = '1';

		$tipe = ['pemasukan', 'pengeluaran'];
		$data['kategori'] = $this->main->getKategoriByTipe($tipe[$getTipe]);
		$data['tipe'] = $tipe[$getTipe];
		$data['id_transaksi'] = $this->generateIdTransaksi();

		// Validasi Form
		$this->_validasiTransaksi();
		if ($this->form_validation->run() == FALSE) {
			$this->template('transaksi/add', $data);
		} else {
			$input = $this->input->post(null, true);
			$insert = $this->main->insert('transaksi', $input);
			if ($insert) {
				$this->session->set_flashdata('pesan', "<div class='alert alert-success'>Data berhasil disimpan</div>");
			} else {
				$this->session->set_flashdata('pesan', "<div class='alert alert-danger'>Gagal menyimpan data</div>");
			}
			redirect('transaksi');
		}
	}

	public function delete($getId)
	{
		$id = encode_php_tags($getId);
		$delete = $this->main->delete('transaksi', ['id_transaksi' => $id]);
		if ($delete) {
			$this->session->set_flashdata('pesan', "<div class='alert alert-success'>Data berhasil dihapus.</div>");
		} else {
			$this->session->set_flashdata('pesan', "<div class='alert alert-danger'>Gagal hapus data.</div>");
		}
		redirect('transaksi');
	}
}
