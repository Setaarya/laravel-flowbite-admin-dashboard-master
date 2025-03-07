# Stockify: Aplikasi Manajemen Stok Barang  

Stockify adalah aplikasi web untuk mengelola stok barang secara efisien, meningkatkan akurasi data, serta mempermudah penerimaan, pengeluaran, dan pemantauan stok.  

![Stockify Landing Page](public\images\2025-03-06 14_34_20-STOCKIFY.png)

## 🚀 Fitur Utama  

- **📦 Manajemen Produk**: Kelola data produk, kategori, supplier, dan atribut.  
- **📊 Manajemen Stok**: Catat transaksi masuk/keluar, monitoring stok, dan stock opname.  
- **👥 Manajemen Pengguna**: Atur akun dengan peran Admin, Manajer Gudang, dan Staff Gudang.  
- **📑 Laporan**: Sediakan laporan stok dan transaksi yang informatif.  

## 🚀 Role

### 🔹 **Admin**

- **Dashboard**: Ringkasan produk, transaksi stok, grafik, dan aktivitas pengguna terbaru.
- **Produk**: CRUD produk, kategori, atribut, serta import/export data.
- **Transaksi**: Riwayat transaksi, stock opname, dan stok minimum.
- **Supplier**: CRUD data supplier.
- **Pengguna**: CRUD data pengguna.
- **Laporan**: Laporan stok, transaksi barang, dan aktivitas pengguna.
- **Pengaturan**: Konfigurasi umum aplikasi (logo, nama, dll.).

![Stockify Landing Page](public\images\2025-03-06 14_34_07-Dashboard Admin Gudang.png)

### 🔹 **Manajer Gudang**

- **Dashboard**: Ringkasan stok menipis, barang masuk, dan barang keluar hari ini.
- **Produk**: Melihat daftar dan detail produk.
- **Transaksi**: Mencatat transaksi masuk/keluar dan stock opname.
- **Supplier**: Melihat daftar supplier.
- **Laporan**: Laporan stok dan transaksi barang.

![Stockify Landing Page](public\images\2025-03-06 14_33_38-Dashboard Manajer Gudang.png)

### 🔹 **Staff Gudang**

- **Dashboard**: Daftar tugas barang masuk/keluar yang perlu diperiksa/disiapkan.
- **Transaksi**: Konfirmasi penerimaan dan pengeluaran barang.

![Stockify Landing Page](public\images\2025-03-06 14_32_43-Window.png)

🚀 Cara Menjalankan Project

1️⃣ Clone Repository

git clone <https://github.com/Setaarya/stockify.git>
cd stockify

2️⃣ Install Dependency

Pastikan sudah menginstal Composer dan Node.js di sistem Anda.

composer install
npm install

3️⃣ Konfigurasi Environment

Salin file .env.example menjadi .env lalu sesuaikan konfigurasi database.

cp .env.example .env

Edit .env dan sesuaikan dengan koneksi database Anda.

4️⃣ Generate App Key

php artisan key:generate

5️⃣ Jalankan Migrasi dan Seeder

php artisan migrate --seed

Seeder akan membuat user default:

Admin → <admin@example.com> / password

Manajer Gudang → <manager@example.com> / password

Staff Gudang → <staff@example.com> / password

6️⃣ Jalankan Aplikasi

php artisan serve

Buka <http://127.0.0.1:8000> di browser untuk mengakses Stockify.
