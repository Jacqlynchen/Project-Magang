<?php

namespace App\Console\Commands;

use App\Services\SolutionRecommender;
use Illuminate\Console\Command;

class UjiMetode extends Command
{
    protected $signature = 'kasus:uji';
    protected $description = 'Bandingkan akurasi Cosine, Euclidean, dan Minkowski';

    public function handle(SolutionRecommender $rec)
    {
        // [kalimat uji, teks kasus yang BENAR di database]
        $uji = [
            ['email kontrak tidak terkirim ke vendor',   'Job email kontrak digital tidak jalan'],
            ['notifikasi email gagal smtp',              'Email notifikasi tidak masuk, error SMTP connection failed'],
            ['tidak bisa buat TR karyawan',              'User tidak bisa membuatkan TR untuk karyawan'],
            ['gagal submit cuti tahunan',                'Error saat submit leave request cuti tahunan'],
            ['user gagal mark location toko',            'User tidak bisa mark location'],
            ['tidak bisa absensi karena PA Transfer',    'Tidak bisa absensi di cabang baru karena PA Transfer belum diproses'],
            ['omzet gadget beda dengan macro',           'Omzet di gadget tidak sama dengan macro'],
            ['laporan lambat dibuka',                    'Laporan sangat lambat saat dibuka'],
            ['akun user terkunci tidak bisa login',      'User tidak bisa login, akun terkunci'],
            ['printer tidak mencetak',                   'Printer tidak bisa mencetak dokumen'],
            ['backup database gagal',                    'Backup database harian gagal'],
            ['halaman error 500',                        'Muncul halaman error 500'],
            ['stok sistem beda dengan fisik',            'Stok di sistem tidak sama dengan fisik'],
            ['approval tidak sampai atasan',             'Pengajuan tidak sampai ke atasan'],
            ['unduh laporan PDF gagal',                  'Tidak bisa mengunduh laporan dalam format PDF'],
        ];

        // nama => [metode, p]
        $metode = [
            'Cosine'          => ['cosine', 2],
            'Euclidean'       => ['euclidean', 2],
            'Manhattan (p=1)' => ['minkowski', 1],
            'Minkowski (p=3)' => ['minkowski', 3],
        ];

        $n = count($uji);
        $baris = [];

        foreach ($metode as $nama => [$m, $p]) {
            $top1 = $top3 = 0;

            foreach ($uji as [$kalimat, $benar]) {
                $kasus = array_column($rec->recommend($kalimat, 3, $m, $p), 'kasus');

                if (($kasus[0] ?? null) === $benar) {
                    $top1++;
                }
                if (in_array($benar, $kasus, true)) {
                    $top3++;
                }
            }

            $baris[] = [
                $nama,
                "$top1/$n (" . round($top1 / $n * 100) . '%)',
                "$top3/$n (" . round($top3 / $n * 100) . '%)',
            ];
        }

        $this->table(['Metode', 'Top-1', 'Top-3'], $baris);
    }
}