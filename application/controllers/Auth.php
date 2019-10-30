<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel', 'main');
        $this->load->model('AuthModel', 'auth');

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
        // Cek Login
        if ($this->session->has_userdata('user')) {
            redirect('transaksi');
        }

        $data['judul'] = "Login - Catatan Keuangan";

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('pin', 'PIN', 'required|trim|numeric|min_length[4]|max_length[6]');
        if ($this->form_validation->run() == false) {
            $this->template('auth/login', $data);
        } else {
            $input = $this->input->post(null, true);
            $cekUsername = $this->auth->cekUsername($input['username']);
            $pin = $cekUsername['pin'];

            if (count($cekUsername) > 0) {
                if (password_verify($input['pin'], $pin)) {
                    $user = [
                        'id_user'   => $cekUsername['id_user'],
                        'username'  => $cekUsername['username'],
                        'logged_in_at' => time()
                    ];
                    $this->session->set_userdata('user', $user);
                    redirect('transaksi');
                } else {
                    alert('danger', 'Password salah.');
                    redirect('login');
                }
            } else {
                alert('danger', 'Username tidak terdaftar.');
                redirect('login');
            }
        }
    }

    private function getNewId($tgl_lahir, $char)
    {
        $table = "U";
        $field = 'id_user';

        $tgl = date('ymd', strtotime($tgl_lahir));

        $prefix = $char . $tgl;

        $lastId = $this->auth->getMaxId($table, $field, $prefix);
        $noUrut = (int) substr($lastId, -4, 4);
        $noUrut += 1;

        $newId = $char . $tgl . sprintf('%04s', $noUrut);
        return $newId;
    }

    public function register()
    {
        $data['judul'] = "Daftar Akun - Catatan Keungan";

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('pin', 'PIN', 'required|trim|numeric|min_length[4]|max_length[6]');
        $this->form_validation->set_rules('confirm_pin', 'Konfirmasi PIN', 'required|trim|matches[pin]');

        if ($this->form_validation->run() == false) {
            $this->template('auth/register', $data);
        } else {
            $input = $this->input->post(null, true);
            $userId = $this->getNewId($input['tgl_lahir'], 'U');
            $userData = [
                'id_user' => $userId,
                'username' => $input['username'],
                'tgl_lahir' => $input['tgl_lahir'],
                'pin' => password_hash($input['pin'], PASSWORD_DEFAULT)
            ];
            // Insert data user
            $insert = $this->main->insert('user', $userData);
            if ($insert) {
                alert('success', 'Anda berhasil mendaftar, silahkan login.');
            } else {
                $this->session->set_flashdata('pesan', "<div class='alert alert-danger'><strong>ERROR!</strong> Gagal menyimpan data anda</div>");
            }
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect('login');
    }
}
