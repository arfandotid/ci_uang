<?php

// Fungsi untuk menampilkan pesan
function alert($tipe, $pesan)
{
    $ci = get_instance();
    $tipe2 = $tipe == 'danger' ?  'error' : 'success';
    $ci->session->set_flashdata('pesan', "<div class='alert alert-{$tipe}'><strong class='text-uppercase'>{$tipe2}!</strong> {$pesan}</div>");
}

// Mengambil data user yang sudah login
function userInfo($key = null)
{
    $ci = get_instance();
    $user = $ci->session->userdata('user');
    if ($key != null) {
        return $user[$key];
    } else {
        return $user;
    }
}

// Cek apakah user sudah login? jika belum maka akan diarahkan ke halaman login
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->has_userdata('user')) {
        alert('danger', 'Silahkan anda login terlebih dahulu');
        redirect('login');
    }
}

// Fungsi untuk menampilkan tanggal lengkap "Senin, 21 Oktober 2019"
function full_tanggal($tgl)
{
    $d = date("D", $tgl);

    switch ($d) {
        case 'Sun':
            $hari = "Minggu";
            break;
        case 'Mon':
            $hari = "Senin";
            break;
        case 'Tue':
            $hari = "Selasa";
            break;
        case 'Wed':
            $hari = "Rabu";
            break;
        case 'Thu':
            $hari = "Kamis";
            break;
        case 'Fri':
            $hari = "Jumat";
            break;
        case 'Sat':
            $hari = "Sabtu";
            break;
        default:
            $hari = null;
            break;
    }

    $bulan = [1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $m = date('n', $tgl);

    return $hari . ', ' . date('d', $tgl) . ' ' . $bulan[$m] . ' ' . date('Y', $tgl);
}
