<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainModel extends CI_Model
{
    public function insert($table, $data, $batch = false)
    {
        if ($batch) {
            return $this->db->insert_batch($table, $data);
        } else {
            return $this->db->insert($table, $data);
        }
    }

    public function update($table, $data = [], $where = [])
    {
        return $this->db->update($table, $data, $where);
    }

    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function getTransaksiById($id)
    {
        $this->db->join('kategori k', 't.kategori_id=k.id_kategori');
        $this->db->where('user_id', userInfo('id_user'));
        return $this->db->get_where('transaksi t', ['id_transaksi' => $id])->row();
    }

    public function getTglTransaksi()
    {
        $this->db->select('tgl_transaksi');
        $this->db->group_by('tgl_transaksi');
        $this->db->order_by('tgl_transaksi', 'desc');
        $this->db->where('user_id', userInfo('id_user'));
        return $this->db->get('transaksi')->result();
    }

    public function getTransaksiByTgl($tgl)
    {
        $this->db->join('kategori k', 't.kategori_id=k.id_kategori');
        $this->db->order_by('waktu', 'asc');
        $this->db->where('user_id', userInfo('id_user'));
        return $this->db->get_where('transaksi t', ['tgl_transaksi' => $tgl])->result();
    }

    public function getTotalTransaksi($tgl, $tipe = null)
    {
        $this->db->select_sum('jumlah');
        $this->db->join('kategori k', 't.kategori_id=k.id_kategori');
        $this->db->where('user_id', userInfo('id_user'));
        return $this->db->get_where('transaksi t', ['tgl_transaksi' => $tgl, 'tipe_kategori' => $tipe])->row_array();
    }

    public function getKategoriByTipe($tipe)
    {
        $this->db->join('user_kategori uk', 'uk.kategori_id=k.id_kategori');
        $this->db->where('k.tipe_kategori', $tipe);
        $this->db->where('uk.user_id', userInfo('id_user'));
        return $this->db->get('kategori k')->result();
    }

    public function getMaxIdTransaksi($prefix)
    {
        $this->db->select_max('id_transaksi');
        $this->db->like('id_transaksi', $prefix, 'after');
        $this->db->where('user_id', userInfo('id_user'));
        return $this->db->get('transaksi')->row_array()['id_transaksi'];
    }

    public function cariTransaksi($keyword = null, $tipe = null, $tgl = null, $waktu = null)
    {
        $this->db->join('kategori k', 't.kategori_id=k.id_kategori');
        $this->db->where('t.user_id', userInfo('id_user'));
        if ($tipe) {
            $this->db->where('tipe_kategori', $tipe);
        }
        if ($tgl) {
            $this->db->or_like('tgl_transaksi', $tgl);
        }
        if ($waktu) {
            $this->db->or_like('waktu', $waktu);
        }
        if ($keyword) {
            $this->db->like('keterangan', $keyword);
            $this->db->or_like('jumlah', $keyword);
        }
        return $this->db->get('transaksi t')->result();
    }
}
