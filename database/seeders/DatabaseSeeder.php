<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Pengguna, Kategori, Menu, Karyawan, Pesanan, DetailPesanan};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== PENGGUNA (5 record) =====
        $admin   = Pengguna::create(['nama'=>'Admin Utama',     'email'=>'admin@kopi.com',   'kata_sandi'=>bcrypt('password'), 'peran'=>'admin']);
        $kasir1  = Pengguna::create(['nama'=>'Budi Santoso',    'email'=>'budi@kopi.com',    'kata_sandi'=>bcrypt('password'), 'peran'=>'kasir']);
        $kasir2  = Pengguna::create(['nama'=>'Sari Dewi',       'email'=>'sari@kopi.com',    'kata_sandi'=>bcrypt('password'), 'peran'=>'kasir']);
        $pel1    = Pengguna::create(['nama'=>'Andi Pratama',    'email'=>'andi@gmail.com',   'kata_sandi'=>bcrypt('password'), 'peran'=>'pelanggan']);
        $pel2    = Pengguna::create(['nama'=>'Rina Kusuma',     'email'=>'rina@gmail.com',   'kata_sandi'=>bcrypt('password'), 'peran'=>'pelanggan']);

        // ===== KARYAWAN (2 record - relasi One to One) =====
        $kar1 = Karyawan::create(['pengguna_id'=>$kasir1->id, 'jabatan'=>'Kasir',   'telepon'=>'081234567890', 'tanggal_masuk'=>'2023-01-15']);
        $kar2 = Karyawan::create(['pengguna_id'=>$kasir2->id, 'jabatan'=>'Barista', 'telepon'=>'081298765432', 'tanggal_masuk'=>'2023-03-10']);

        // ===== KATEGORI (3 record) =====
        $kat1 = Kategori::create(['nama'=>'Kopi',     'slug'=>'kopi',     'keterangan'=>'Minuman berbasis espresso dan kopi']);
        $kat2 = Kategori::create(['nama'=>'Non-Kopi', 'slug'=>'non-kopi', 'keterangan'=>'Minuman tanpa kandungan kopi']);
        $kat3 = Kategori::create(['nama'=>'Makanan',  'slug'=>'makanan',  'keterangan'=>'Snack dan makanan pendamping']);

        // ===== MENU (10 record) =====
        $m1  = Menu::create(['kategori_id'=>$kat1->id, 'nama'=>'Americano',       'keterangan'=>'Espresso + air panas',          'harga'=>18000, 'tersedia'=>true]);
        $m2  = Menu::create(['kategori_id'=>$kat1->id, 'nama'=>'Cappuccino',      'keterangan'=>'Espresso + susu + busa susu',   'harga'=>25000, 'tersedia'=>true]);
        $m3  = Menu::create(['kategori_id'=>$kat1->id, 'nama'=>'Kopi Latte',      'keterangan'=>'Espresso + susu segar',         'harga'=>27000, 'tersedia'=>true]);
        $m4  = Menu::create(['kategori_id'=>$kat1->id, 'nama'=>'Kopi Dingin',     'keterangan'=>'Seduh dingin 12 jam',           'harga'=>30000, 'tersedia'=>true]);
        $m5  = Menu::create(['kategori_id'=>$kat2->id, 'nama'=>'Matcha Latte',    'keterangan'=>'Teh hijau + susu oat',          'harga'=>28000, 'tersedia'=>true]);
        $m6  = Menu::create(['kategori_id'=>$kat2->id, 'nama'=>'Teh Tarik',       'keterangan'=>'Teh susu kental manis',         'harga'=>15000, 'tersedia'=>true]);
        $m7  = Menu::create(['kategori_id'=>$kat2->id, 'nama'=>'Cokelat Panas',   'keterangan'=>'Dark chocolate premium',        'harga'=>22000, 'tersedia'=>true]);
        $m8  = Menu::create(['kategori_id'=>$kat3->id, 'nama'=>'Croissant',       'keterangan'=>'Croissant mentega panggang',    'harga'=>18000, 'tersedia'=>true]);
        $m9  = Menu::create(['kategori_id'=>$kat3->id, 'nama'=>'Roti Bakar',      'keterangan'=>'Roti bakar selai cokelat',      'harga'=>12000, 'tersedia'=>true]);
        $m10 = Menu::create(['kategori_id'=>$kat3->id, 'nama'=>'Sandwich Tuna',   'keterangan'=>'Sandwich isi tuna mayo',        'harga'=>25000, 'tersedia'=>true]);

        // ===== PESANAN & DETAIL PESANAN =====
        // Pesanan 1
        $p1 = Pesanan::create(['pengguna_id'=>$pel1->id, 'karyawan_id'=>$kar1->id, 'kode_pesanan'=>'PSN-001', 'status'=>'selesai', 'total_harga'=>52000, 'cara_bayar'=>'tunai', 'dipesan_pada'=>now()->subDays(3)]);
        DetailPesanan::create(['pesanan_id'=>$p1->id, 'menu_id'=>$m2->id,  'jumlah'=>1, 'harga_satuan'=>25000, 'subtotal'=>25000, 'catatan'=>'']);
        DetailPesanan::create(['pesanan_id'=>$p1->id, 'menu_id'=>$m8->id,  'jumlah'=>1, 'harga_satuan'=>18000, 'subtotal'=>18000, 'catatan'=>'']);
        DetailPesanan::create(['pesanan_id'=>$p1->id, 'menu_id'=>$m6->id,  'jumlah'=>1, 'harga_satuan'=>15000, 'subtotal'=>15000, 'catatan'=>'Kurang manis']);

        // Pesanan 2
        $p2 = Pesanan::create(['pengguna_id'=>$pel2->id, 'karyawan_id'=>$kar2->id, 'kode_pesanan'=>'PSN-002', 'status'=>'selesai', 'total_harga'=>57000, 'cara_bayar'=>'qris', 'dipesan_pada'=>now()->subDays(2)]);
        DetailPesanan::create(['pesanan_id'=>$p2->id, 'menu_id'=>$m5->id,  'jumlah'=>1, 'harga_satuan'=>28000, 'subtotal'=>28000, 'catatan'=>'Pakai susu oat']);
        DetailPesanan::create(['pesanan_id'=>$p2->id, 'menu_id'=>$m10->id, 'jumlah'=>1, 'harga_satuan'=>25000, 'subtotal'=>25000, 'catatan'=>'']);
        DetailPesanan::create(['pesanan_id'=>$p2->id, 'menu_id'=>$m9->id,  'jumlah'=>1, 'harga_satuan'=>12000, 'subtotal'=>12000, 'catatan'=>'Tambah selai']);

        // Pesanan 3
        $p3 = Pesanan::create(['pengguna_id'=>$pel1->id, 'karyawan_id'=>$kar1->id, 'kode_pesanan'=>'PSN-003', 'status'=>'selesai', 'total_harga'=>54000, 'cara_bayar'=>'transfer', 'dipesan_pada'=>now()->subDays(1)]);
        DetailPesanan::create(['pesanan_id'=>$p3->id, 'menu_id'=>$m3->id, 'jumlah'=>1, 'harga_satuan'=>27000, 'subtotal'=>27000, 'catatan'=>'']);
        DetailPesanan::create(['pesanan_id'=>$p3->id, 'menu_id'=>$m7->id, 'jumlah'=>1, 'harga_satuan'=>22000, 'subtotal'=>22000, 'catatan'=>'Extra cokelat']);

        // Pesanan 4 (sedang proses)
        $p4 = Pesanan::create(['pengguna_id'=>$pel2->id, 'karyawan_id'=>$kar2->id, 'kode_pesanan'=>'PSN-004', 'status'=>'proses', 'total_harga'=>30000, 'cara_bayar'=>'tunai', 'dipesan_pada'=>now()]);
        DetailPesanan::create(['pesanan_id'=>$p4->id, 'menu_id'=>$m4->id, 'jumlah'=>1, 'harga_satuan'=>30000, 'subtotal'=>30000, 'catatan'=>'Tanpa es']);
    }
}