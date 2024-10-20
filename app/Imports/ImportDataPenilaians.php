<?php

namespace App\Imports;

use App\Models\DataPenilaian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportDataPenilaians implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Logika untuk jumlah hadir
        if ($row['jumlah_hadir'] < 5) {
            $bobot_hadir = 1;
        } elseif ($row['jumlah_hadir'] < 10) {
            $bobot_hadir = 2;
        } elseif ($row['jumlah_hadir'] < 15) {
            $bobot_hadir = 3;
        } elseif ($row['jumlah_hadir'] < 20) {
            $bobot_hadir = 4;
        } else {
            $bobot_hadir = 5;
        }

        // Total nilai hadir
        $total_hadir = 10 * $bobot_hadir;
        
        // Logika untuk jumlah ijin
        if ($row['jumlah_izin'] < 5) {
            $bobot_ijin = 1;
        } elseif ($row['jumlah_izin'] < 10) {
            $bobot_ijin = 2;
        } elseif ($row['jumlah_izin'] < 15) {
            $bobot_ijin = 3;
        } elseif ($row['jumlah_izin'] < 20) {
            $bobot_ijin = 4;
        } else {
            $bobot_ijin = 5;
        }

        // Total nilai ijin
        $total_ijin = 10 * $bobot_ijin;
        
        // Logika untuk jumlah sakit
        if ($row['jumlah_sakit'] < 5) {
            $bobot_sakit = 1;
        } elseif ($row['jumlah_sakit'] < 10) {
            $bobot_sakit = 2;
        } elseif ($row['jumlah_sakit'] < 15) {
            $bobot_sakit = 3;
        } elseif ($row['jumlah_sakit'] < 20) {
            $bobot_sakit = 4;
        } else {
            $bobot_sakit = 5;
        }

        // Total nilai sakit
        $total_sakit = 10 * $bobot_sakit;

        return new DataPenilaian([
            'pegawai_id' => $row['pegawaiid'],
            'jumlah_hadir' => $row['jumlah_hadir'],
            'jumlah_izin' => $row['jumlah_izin'],
            'jumlah_sakit' => $row['jumlah_sakit'],
            'periode' => $row['periode'],
            'nilai_total_hadir' => $total_hadir,
            'nilai_total_izin' => $total_ijin,
            'nilai_total_sakit' => $total_sakit,
            'nilai_bobot_hadir' => $bobot_hadir,
            'nilai_bobot_izin' => $bobot_ijin,
            'nilai_bobot_sakit' => $bobot_sakit
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }
}
