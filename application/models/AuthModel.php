<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    public function cekUsername($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }

    public function getMaxId($table, $field, $prefix)
    {
        $this->db->select_max($field);
        $this->db->like($field, $prefix, 'after');
        return $this->db->get($table)->row_array()[$field];
    }
}
