<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainModel extends CI_Model
{
    public function getTglTransaksi()
    {
        // $this->db->join('user u', 't.user_id=u.id_user');
        // $this->db->join('kategori k', 't.kategori_id=k.id_kategori');
        // return $this->db->get('transaksi t')->result();
        $this->db->select('tgl_transaksi');
        $this->db->group_by('tgl_transaksi');
        $this->db->order_by('tgl_transaksi', 'desc');
        return $this->db->get('transaksi')->result();
    }

    public function getTransaksiByTgl($tgl)
    {
        $this->db->join('kategori k', 't.kategori_id=k.id_kategori');
        $this->db->order_by('waktu', 'asc');
        return $this->db->get_where('transaksi t', ['tgl_transaksi' => $tgl])->result();
    }

    public function getTotalTransaksi($tgl, $tipe = null)
    {
        $this->db->select_sum('jumlah');
        $this->db->join('kategori k', 't.kategori_id=k.id_kategori');
        return $this->db->get_where('transaksi t', ['tgl_transaksi' => $tgl, 'tipe_kategori' => $tipe])->row_array();
    }
}
