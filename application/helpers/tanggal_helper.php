<?php

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
