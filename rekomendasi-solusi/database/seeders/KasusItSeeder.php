<?php

namespace Database\Seeders;

use App\Models\KasusIt;
use App\Services\TextPreprocessor;
use Illuminate\Database\Seeder;

class KasusItSeeder extends Seeder
{
    public function run(): void
    {
        KasusIt::truncate();
        $pre = app(TextPreprocessor::class);

        $data = [
            [
                'user_id' => '000-it-sa1',
                'kasus'   => 'Job email kontrak digital tidak jalan',
                'solusi'  => 'Penyebab: mail from address belum diperbarui setelah alamat pengirim diganti. Solusi: update konfigurasi mail from address ke alamat pengirim yang benar (no-reply), lalu jalankan ulang job email.',
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus'   => 'Email notifikasi tidak masuk, error SMTP connection failed',
                'solusi'  => 'Penyebab: konfigurasi SMTP salah atau password email berubah. Solusi: cek host, port, username dan password SMTP di setting email, lalu lakukan test kirim email.',
            ],
            [
                'user_id' => 'gadis',
                'kasus'   => 'User tidak bisa membuatkan TR untuk karyawan',
                'solusi'  => 'Penyebab: skema approval belum mencentang lower position cabang terkait. Solusi: centang lower position (misal KA-001) pada skema di company cabang tersebut agar user mendapat akses.',
            ],
            [
                'user_id' => 'priska',
                'kasus'   => 'Error saat submit leave request cuti tahunan',
                'solusi'  => 'Penyebab: skema memakai position id cabang khusus, bukan cabang reguler. Solusi: ganti position id pada skema ke position cabang reguler (KA-001 bukan MKA-001), lalu coba submit ulang.',
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus'   => 'User tidak bisa mark location',
                'solusi'  => 'Penyebab: role group user salah. Solusi: ubah role group user ke role yang sesuai (misal BRANCH_STAFF menjadi BRANCH_PC_STAFF), lalu user logout dan login kembali.',
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus'   => 'Tidak bisa absensi di cabang baru karena PA Transfer belum diproses',
                'solusi'  => 'Penyebab: PA Transfer belum diproses sehingga jadwal kerja belum ada di cabang baru. Solusi: centang sementara flag Clocking All di Employee Schedule Assignment, lalu input absensi manual untuk tanggal yang terlewat.',
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus'   => 'Omzet di gadget tidak sama dengan macro',
                'solusi'  => 'Penyebab: data sumber omzet berbeda antara macro dan tampilan gadget. Solusi: koordinasi dengan tim SFA untuk memastikan sumber data gadget sama dengan macro, lalu sinkronkan ulang data omzet.',
            ],
            [
                'user_id' => 'gadis',
                'kasus'   => 'Tanggal terima NPL di sistem berbeda dengan tanggal asli',
                'solusi'  => 'Penyebab: data baru muncul setelah modul diaktifkan. Solusi: jelaskan ke user bahwa data tampil sesuai tanggal aktivasi modul, dan cek tanggal aktivasi di setting.',
            ],
            [
                'user_id' => 'priska',
                'kasus'   => 'Permintaan sesuaikan tanggal terima NPL secara massal',
                'solusi'  => 'Penyebab: perlu perubahan data massal yang tidak ada di fitur standar. Solusi: buat logic khusus untuk update data banyak sekaligus, lalu tambahkan kondisi filter pada class terkait.',
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus'   => 'Toko batal hadiah di luar brand dan ingin ganti hadiah',
                'solusi'  => 'Penyebab: tipe hadiah luar tidak memproses poin jenis T. Solusi: gunakan fitur Utility Hadiah Diluar Avian Brands untuk membatalkan pengajuan dan inject poin jenis T pada kontrak.',
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus'   => 'User tidak bisa login, akun terkunci',
                'solusi'  => 'Penyebab: password salah atau akun terkunci setelah beberapa kali gagal login. Solusi: reset password dari menu user management dan buka kunci akun, lalu minta user login ulang.',
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus'   => 'Menu tidak muncul di akun user',
                'solusi'  => 'Penyebab: user belum diberi role atau menu pada role group. Solusi: tambahkan menu yang dibutuhkan ke role group user, simpan, lalu user login ulang.',
            ],
            [
                'user_id' => 'gadis',
                'kasus'   => 'Halaman sering logout sendiri',
                'solusi'  => 'Penyebab: session habis atau cache browser bermasalah. Solusi: hapus cache dan cookies browser, logout, lalu login ulang. Jika masih terjadi periksa pengaturan session timeout.',
            ],
            [
                'user_id' => 'priska',
                'kasus'   => 'Laporan sangat lambat saat dibuka',
                'solusi'  => 'Penyebab: query terlalu berat atau index database belum ada. Solusi: optimalkan query, tambahkan index pada kolom yang sering dipakai filter, dan jalankan laporan di luar jam sibuk.',
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus'   => 'Muncul error maximum execution time exceeded',
                'solusi'  => 'Penyebab: batas waktu eksekusi atau memory limit terlampaui. Solusi: naikkan nilai max execution time dan memory limit, atau pecah proses menjadi batch lebih kecil.',
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus'   => 'Job terjadwal tidak berjalan otomatis',
                'solusi'  => 'Penyebab: scheduler atau cron job tidak aktif. Solusi: cek status cron job di server, aktifkan kembali, dan periksa log untuk melihat penyebab berhenti.',
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus'   => 'Antrian job menumpuk tidak diproses',
                'solusi'  => 'Penyebab: queue worker mati. Solusi: jalankan ulang queue worker, atur supervisor agar otomatis restart, dan proses ulang job yang gagal.',
            ],
            [
                'user_id' => 'gadis',
                'kasus'   => 'Muncul error SQLSTATE connection refused',
                'solusi'  => 'Penyebab: koneksi database terputus atau kredensial salah. Solusi: cek service database, host, username dan password pada file konfigurasi, lalu restart service.',
            ],
            [
                'user_id' => 'priska',
                'kasus'   => 'Error duplicate entry saat simpan data',
                'solusi'  => 'Penyebab: data duplikat melanggar unique constraint. Solusi: cari dan hapus atau gabungkan data duplikat, lalu simpan ulang data yang baru.',
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus'   => 'Error table doesn\'t exist setelah deploy',
                'solusi'  => 'Penyebab: tabel atau kolom belum ada karena migrasi belum dijalankan. Solusi: jalankan migrasi database di server, lalu clear cache aplikasi.',
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus'   => 'Perubahan kode tidak muncul setelah deploy',
                'solusi'  => 'Penyebab: file konfigurasi atau cache lama masih terpakai setelah deploy. Solusi: bersihkan cache konfigurasi, route dan view, lalu restart web server.',
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus'   => 'Error permission denied pada folder storage',
                'solusi'  => 'Penyebab: izin folder storage tidak sesuai. Solusi: ubah permission folder storage dan cache agar bisa ditulis oleh web server.',
            ],
            [
                'user_id' => 'gadis',
                'kasus'   => 'Upload dokumen gagal, file terlalu besar',
                'solusi'  => 'Penyebab: ukuran atau format file melebihi batas. Solusi: perbesar batas upload di pengaturan server (upload_max_filesize dan post_max_size) dan minta user memakai format yang didukung.',
            ],
            [
                'user_id' => 'priska',
                'kasus'   => 'Import Excel gagal muncul error format',
                'solusi'  => 'Penyebab: format template import tidak sesuai. Solusi: gunakan template terbaru, periksa header kolom dan format tanggal, lalu import ulang.',
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus'   => 'Export laporan menghasilkan file kosong',
                'solusi'  => 'Penyebab: format atau nilai kolom tidak valid pada file export. Solusi: periksa data sumber yang kosong atau bermasalah, perbaiki, lalu export ulang.',
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus'   => 'Printer tidak bisa mencetak dokumen',
                'solusi'  => 'Penyebab: printer atau driver cetak bermasalah. Solusi: cek koneksi printer, instal ulang driver, dan pastikan printer default sudah benar.',
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus'   => 'Cetak laporan tidak sesuai format',
                'solusi'  => 'Penyebab: template laporan atau ukuran kertas belum sesuai. Solusi: atur ulang layout laporan dan ukuran kertas pada pengaturan cetak.',
            ],
            [
                'user_id' => 'gadis',
                'kasus'   => 'Hasil perhitungan lembur salah',
                'solusi'  => 'Penyebab: perhitungan memakai data periode atau formula yang salah. Solusi: periksa formula dan periode perhitungan, perbaiki konfigurasi, lalu hitung ulang.',
            ],
            [
                'user_id' => 'priska',
                'kasus'   => 'Payroll karyawan tidak muncul',
                'solusi'  => 'Penyebab: komponen gaji atau tunjangan belum diset pada karyawan. Solusi: lengkapi komponen pada master karyawan, lalu proses ulang payroll.',
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus'   => 'Barang tidak muncul saat input transaksi',
                'solusi'  => 'Penyebab: master data belum lengkap atau belum aktif. Solusi: lengkapi dan aktifkan data master (barang, pelanggan, atau cabang), lalu ulangi transaksi.',
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus'   => 'Stok di sistem tidak sama dengan fisik',
                'solusi'  => 'Penyebab: stok tidak mencukupi atau belum tersinkron. Solusi: cek posisi stok, jalankan sinkronisasi stok, dan koreksi stok jika memang selisih.',
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus'   => 'Dokumen tidak bisa diedit',
                'solusi'  => 'Penyebab: dokumen terkunci atau status sudah final. Solusi: buka status dokumen melalui otoritas yang berwenang atau buat dokumen koreksi sesuai prosedur.',
            ],
            [
                'user_id' => 'gadis',
                'kasus'   => 'Pengajuan tidak sampai ke atasan',
                'solusi'  => 'Penyebab: approval tersangkut karena approver tidak aktif atau belum diset. Solusi: ganti atau aktifkan approver pada skema approval, lalu teruskan ulang dokumen.',
            ],
            [
                'user_id' => 'priska',
                'kasus'   => 'Atasan karyawan tidak sesuai di sistem',
                'solusi'  => 'Penyebab: struktur organisasi atau atasan langsung belum diperbarui. Solusi: perbarui data atasan dan posisi pada master karyawan agar alur approval benar.',
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus'   => 'Karyawan baru belum punya akun',
                'solusi'  => 'Penyebab: data karyawan baru belum dibuatkan user atau jadwal. Solusi: buat user dan assign jadwal kerja serta role karyawan, lalu informasikan akun ke user.',
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus'   => 'Absensi mobile gagal lokasi tidak terdeteksi',
                'solusi'  => 'Penyebab: GPS atau izin lokasi pada perangkat tidak aktif. Solusi: aktifkan GPS dan izinkan akses lokasi untuk aplikasi, lalu coba absen kembali.',
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus'   => 'Aplikasi mobile crash saat dibuka',
                'solusi'  => 'Penyebab: versi aplikasi mobile lama. Solusi: update aplikasi ke versi terbaru dari store, hapus data aplikasi jika masih error, lalu login ulang.',
            ],
            [
                'user_id' => 'gadis',
                'kasus'   => 'Data gadget tidak ter-upload ke server',
                'solusi'  => 'Penyebab: sinkronisasi data gadget gagal akibat koneksi tidak stabil. Solusi: pastikan koneksi internet stabil, lakukan sinkronisasi ulang, dan cek log sync di server.',
            ],
            [
                'user_id' => 'priska',
                'kasus'   => 'Tidak bisa mengakses sistem dari cabang',
                'solusi'  => 'Penyebab: jaringan atau VPN bermasalah. Solusi: cek koneksi jaringan dan VPN, restart router, lalu uji ping ke server aplikasi.',
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus'   => 'Browser menampilkan peringatan not secure',
                'solusi'  => 'Penyebab: sertifikat SSL kedaluwarsa. Solusi: perbarui sertifikat SSL di web server, lalu restart service dan cek ulang di browser.',
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus'   => 'Sistem error karena storage penuh',
                'solusi'  => 'Penyebab: disk server penuh. Solusi: bersihkan file log dan backup lama, tambah kapasitas disk, dan atur rotasi log otomatis.',
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus'   => 'Backup database harian gagal',
                'solusi'  => 'Penyebab: backup gagal karena ruang atau jadwal bermasalah. Solusi: cek log backup, pastikan ruang cukup, perbaiki jadwal, lalu jalankan backup manual.',
            ],
            [
                'user_id' => 'gadis',
                'kasus'   => 'Integrasi dengan sistem lain gagal',
                'solusi'  => 'Penyebab: integrasi API gagal karena token kedaluwarsa atau endpoint berubah. Solusi: perbarui API key atau token, cek URL endpoint, dan uji ulang koneksi.',
            ],
            [
                'user_id' => 'priska',
                'kasus'   => 'Muncul halaman error 500',
                'solusi'  => 'Penyebab: kode error 500 akibat bug di program. Solusi: lihat log aplikasi untuk menemukan baris error, perbaiki kode, lalu deploy dan uji ulang.',
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus'   => 'Muncul error 404 saat buka menu',
                'solusi'  => 'Penyebab: halaman atau route tidak ditemukan setelah perubahan. Solusi: periksa route dan nama menu, bersihkan cache route, dan pastikan file ada di server.',
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus'   => 'Error format tanggal saat input',
                'solusi'  => 'Penyebab: data tanggal atau periode tidak sesuai format. Solusi: gunakan format tanggal yang benar dan periksa pengaturan periode aktif.',
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus'   => 'Poin toko tidak bertambah',
                'solusi'  => 'Penyebab: poin atau kontrak promo belum diproses. Solusi: jalankan proses perhitungan poin dan pastikan kontrak aktif pada periode berjalan.',
            ],
            [
                'user_id' => 'gadis',
                'kasus'   => 'Faktur tidak muncul di laporan',
                'solusi'  => 'Penyebab: dokumen tagihan atau faktur belum diposting. Solusi: posting dokumen, cek status pembayaran, lalu cetak ulang faktur.',
            ],
            [
                'user_id' => 'priska',
                'kasus'   => 'User melihat data cabang lain',
                'solusi'  => 'Penyebab: hak akses data per cabang belum diatur. Solusi: atur hak akses cabang pada user agar data yang dilihat sesuai wilayah kerjanya.',
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus'   => 'Komputer user sangat lambat',
                'solusi'  => 'Penyebab: perangkat atau komputer user bermasalah. Solusi: restart perangkat, cek update sistem operasi, lalu instal ulang aplikasi pendukung jika perlu.',
            ],
        
            [
                'user_id' => '000-it-sa2',
                'kasus' => 'Tiba-tiba data transaksi hilang setelah disimpan',
                'solusi' => 'Penyebab: proses penyimpanan belum berhasil atau terjadi gangguan koneksi saat transaksi diproses. Solusi: periksa status transaksi dan log sistem, pastikan data belum tersimpan sebelumnya, lalu lakukan input ulang jika diperlukan.'
            ],
            [
                'user_id' => 'gadis',
                'kasus' => 'Tidak bisa melakukan approval padahal sudah menjadi atasan',
                'solusi' => 'Penyebab: hak akses approval atau struktur approver belum diperbarui. Solusi: periksa skema approval dan pastikan posisi user sudah terdaftar sebagai approver yang sesuai.'
            ],
            [
                'user_id' => 'priska',
                'kasus' => 'Data karyawan muncul dua kali di sistem',
                'solusi' => 'Penyebab: terdapat duplikasi data akibat proses input atau import berulang. Solusi: identifikasi data berdasarkan employee ID, verifikasi data yang benar, lalu lakukan penghapusan duplikasi melalui administrator.'
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus' => 'Sistem tiba-tiba tidak bisa digunakan pada jam kerja',
                'solusi' => 'Penyebab: server mengalami gangguan atau penggunaan resource terlalu tinggi. Solusi: periksa status server, penggunaan CPU dan RAM, serta log aplikasi. Eskalasikan kepada tim infrastruktur jika gangguan berlanjut.'
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus' => 'Tidak bisa mengubah data karyawan yang sudah tersimpan',
                'solusi' => 'Penyebab: data sedang terkunci atau user tidak memiliki hak akses perubahan. Solusi: periksa status data dan permission user, kemudian minta administrator melakukan perubahan jika diperlukan.'
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus' => 'Nomor dokumen otomatis tidak berurutan',
                'solusi' => 'Penyebab: konfigurasi penomoran dokumen mengalami perubahan atau terdapat transaksi yang gagal. Solusi: periksa konfigurasi numbering dan riwayat transaksi sebelum melakukan koreksi nomor dokumen.'
            ],
            [
                'user_id' => 'gadis',
                'kasus' => 'Data laporan bulan ini tidak lengkap',
                'solusi' => 'Penyebab: sebagian transaksi belum diposting atau filter periode laporan tidak sesuai. Solusi: periksa status transaksi, tanggal pencatatan, dan filter periode, kemudian generate ulang laporan.'
            ],
            [
                'user_id' => 'priska',
                'kasus' => 'Tidak bisa membuka file lampiran dari sistem',
                'solusi' => 'Penyebab: file tidak tersimpan dengan benar atau format file tidak didukung. Solusi: periksa keberadaan file pada server, koneksi penyimpanan, dan format dokumen. Lakukan upload ulang jika diperlukan.'
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus' => 'Setelah mengganti password, akun tidak bisa digunakan',
                'solusi' => 'Penyebab: perubahan password belum tersinkronisasi atau user masih menggunakan kredensial lama. Solusi: pastikan password baru sudah tersimpan, logout dari seluruh sesi, lalu login menggunakan password terbaru.'
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus' => 'Data pada dashboard berbeda dengan laporan Excel',
                'solusi' => 'Penyebab: dashboard dan laporan Excel menggunakan sumber data, filter, atau waktu pembaruan yang berbeda. Solusi: bandingkan query, periode, dan waktu sinkronisasi data pada kedua sumber.'
            ],
            [
                'user_id' => 'gadis',
                'kasus' => 'Transaksi berhasil tetapi tidak muncul di histori',
                'solusi' => 'Penyebab: proses pembaruan histori belum berjalan atau transaksi belum masuk ke status final. Solusi: periksa status transaksi dan log sistem, kemudian jalankan sinkronisasi ulang jika diperlukan.'
            ],
            [
                'user_id' => 'priska',
                'kasus' => 'Tidak bisa melakukan pembatalan transaksi',
                'solusi' => 'Penyebab: transaksi sudah diproses ke tahap berikutnya atau statusnya tidak mengizinkan pembatalan. Solusi: periksa status transaksi dan ikuti prosedur pembatalan melalui pihak yang memiliki otorisasi.'
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus' => 'Muncul notifikasi berhasil tetapi data tidak berubah',
                'solusi' => 'Penyebab: proses update tidak tersimpan ke database atau tampilan masih menggunakan cache lama. Solusi: periksa data langsung pada sistem, log aplikasi, dan proses update database sebelum mencoba kembali.'
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus' => 'Aplikasi meminta login berulang kali ketika digunakan',
                'solusi' => 'Penyebab: session tidak tersimpan dengan benar atau terdapat masalah konfigurasi autentikasi. Solusi: periksa konfigurasi session, cookies, dan koneksi server, kemudian lakukan pengujian login kembali.'
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus' => 'Data yang baru diinput tidak langsung muncul',
                'solusi' => 'Penyebab: proses sinkronisasi atau pembaruan data belum selesai. Solusi: periksa status penyimpanan dan sinkronisasi, refresh halaman, serta periksa log jika data tetap tidak muncul.'
            ],
            [
                'user_id' => 'gadis',
                'kasus' => 'Tidak menerima notifikasi ketika ada pengajuan baru',
                'solusi' => 'Penyebab: pengaturan notifikasi belum aktif atau alamat penerima tidak sesuai. Solusi: periksa konfigurasi notifikasi, alamat email, dan status pengiriman pesan pada sistem.'
            ],
            [
                'user_id' => 'priska',
                'kasus' => 'Nilai total pada transaksi tidak sesuai dengan perhitungan',
                'solusi' => 'Penyebab: formula perhitungan, pajak, diskon, atau pembulatan tidak sesuai. Solusi: periksa detail komponen perhitungan dan konfigurasi transaksi, lalu lakukan kalkulasi ulang.'
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus' => 'Tidak bisa menggunakan sistem setelah browser diperbarui',
                'solusi' => 'Penyebab: terdapat ketidakcocokan versi browser atau cache lama. Solusi: hapus cache browser, gunakan browser yang didukung, dan periksa kompatibilitas aplikasi.'
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus' => 'Proses sinkronisasi membutuhkan waktu sangat lama',
                'solusi' => 'Penyebab: jumlah data terlalu besar atau koneksi ke server tidak stabil. Solusi: periksa koneksi jaringan, log sinkronisasi, dan optimalkan proses pengiriman data secara bertahap.'
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus' => 'Tidak bisa mengakses menu tertentu meskipun sudah login',
                'solusi' => 'Penyebab: role user belum memiliki permission terhadap menu tersebut. Solusi: periksa role group dan permission user, kemudian tambahkan akses yang sesuai melalui administrator.'
            ],
            [
                'user_id' => 'gadis',
                'kasus' => 'Pengajuan yang sudah disetujui kembali menjadi pending',
                'solusi' => 'Penyebab: terjadi perubahan pada alur approval atau status dokumen belum tersinkronisasi. Solusi: periksa riwayat approval dan log perubahan status, kemudian koordinasikan dengan administrator untuk koreksi.'
            ],
            [
                'user_id' => 'priska',
                'kasus' => 'Tidak bisa melakukan import karena sebagian data ditolak',
                'solusi' => 'Penyebab: terdapat data yang tidak memenuhi validasi sistem seperti kode tidak ditemukan atau format kolom salah. Solusi: unduh hasil validasi, perbaiki baris yang bermasalah, dan lakukan import ulang.'
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus' => 'Data transaksi tercatat dengan tanggal yang berbeda',
                'solusi' => 'Penyebab: pengaturan timezone server atau perangkat tidak sesuai. Solusi: periksa timezone aplikasi, server, dan perangkat, kemudian koreksi data melalui prosedur yang berlaku.'
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus' => 'Sistem menampilkan pesan request timeout',
                'solusi' => 'Penyebab: server membutuhkan waktu terlalu lama untuk memproses permintaan. Solusi: periksa performa query database, koneksi jaringan, dan log aplikasi, kemudian optimalkan proses yang bermasalah.'
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus' => 'Tidak bisa mengunduh laporan dalam format PDF',
                'solusi' => 'Penyebab: proses generate PDF gagal atau library pembuat dokumen bermasalah. Solusi: periksa log aplikasi, konfigurasi library PDF, dan permission folder penyimpanan sementara.'
            ],
            [
                'user_id' => 'gadis',
                'kasus' => 'Data antar cabang tidak sama setelah dilakukan pemindahan',
                'solusi' => 'Penyebab: proses transfer data belum selesai atau terdapat data yang tidak ikut dipindahkan. Solusi: periksa riwayat transfer, validasi data asal dan tujuan, kemudian lakukan sinkronisasi ulang.'
            ],
            [
                'user_id' => 'priska',
                'kasus' => 'Tidak bisa membuat transaksi untuk periode baru',
                'solusi' => 'Penyebab: periode transaksi belum dibuka atau konfigurasi periode belum diperbarui. Solusi: periksa pengaturan periode aktif dan minta administrator membuka periode yang sesuai.'
            ],
            [
                'user_id' => '000-it-sa11',
                'kasus' => 'Muncul pesan invalid token ketika menyimpan data',
                'solusi' => 'Penyebab: token keamanan form sudah kedaluwarsa atau session berubah. Solusi: refresh halaman, login kembali jika diperlukan, dan pastikan konfigurasi session serta CSRF berjalan dengan benar.'
            ],
            [
                'user_id' => '000-it-sa1',
                'kasus' => 'Beberapa user mengalami error yang sama secara bersamaan',
                'solusi' => 'Penyebab: kemungkinan terdapat gangguan pada server, database, atau layanan yang digunakan bersama. Solusi: kumpulkan informasi waktu kejadian dan pesan error, periksa log server, lalu eskalasikan kepada tim IT.'
            ],
            [
                'user_id' => '000-it-sa2',
                'kasus' => 'Tidak mengetahui penyebab munculnya error pada sistem',
                'solusi' => 'Penyebab: informasi error belum cukup untuk mengidentifikasi sumber masalah. Solusi: dokumentasikan pesan error, screenshot, waktu kejadian, langkah sebelum error muncul, dan akun yang terdampak. Kirimkan informasi tersebut kepada tim IT untuk investigasi.'
            ],
        ];

        foreach ($data as $row) {
            $row['kasus_olahan'] = $pre->process($row['kasus']);
            KasusIt::create($row);
        }
    }
}