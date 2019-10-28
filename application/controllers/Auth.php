<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">* ', '</small>');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi');
        $this->form_validation->set_message('numeric', 'Isi kolom {field} dengan angka (0-9)');
        $this->form_validation->set_message('min_length', 'Kolom {field} minimal {param} digit');
        $this->form_validation->set_message('max_length', 'Kolom {field} maksimal {param} digit');
        $this->form_validation->set_message('is_unique', '%s ini sudah ada');
        $this->form_validation->set_message('matches', 'Kolom {field} harus sama dengan kolom {param}');
    }

    private function template($page, $data = null)
    {
        $this->load->view('templates/auth/header', $data);
        $this->load->view($page);
        $this->load->view('templates/auth/footer');
    }

    public function index()
    {
        $data['judul'] = "Login - Catatan Keuangan";

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('pin', 'PIN', 'required|trim|numeric|min_length[4]|max_length[6]');
        if ($this->form_validation->run() == false) {
            $this->template('auth/login', $data);
        } else {
            $input = $this->input->post(null, true);
            var_dump($input);
        }
    }

    public function register()
    {
        $data['judul'] = "Daftar Akun - Catatan Keungan";

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
        $this->form_validation->set_rules('pin', 'PIN', 'required|trim|numeric|min_length[4]|max_length[6]');
        $this->form_validation->set_rules('confirm_pin', 'Konfirmasi PIN', 'required|trim|matches[pin]');

        if ($this->form_validation->run() == false) {
            $this->template('auth/register', $data);
        } else {
            $input = $this->input->post(null, true);
            var_dump($input);
        }
    }
}
