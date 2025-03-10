# Stockify: Aplikasi Manajemen Stok Barang

Stockify adalah aplikasi web untuk mengelola stok barang secara efisien, meningkatkan akurasi data, serta mempermudah penerimaan, pengeluaran, dan pemantauan stok.

![Stockify Landing Page](public/images/2025-03-06%2014_34_20-STOCKIFY.png)

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

![Stockify Dashboard Admin](public/images/2025-03-06%2014_34_07-Dashboard%20Admin%20Gudang.png)

### 🔹 **Manajer Gudang**

- **Dashboard**: Ringkasan stok menipis, barang masuk, dan barang keluar hari ini.
- **Produk**: Melihat daftar dan detail produk.
- **Transaksi**: Mencatat transaksi masuk/keluar dan stock opname.
- **Supplier**: Melihat daftar supplier.
- **Laporan**: Laporan stok dan transaksi barang.

![Stockify Dashboard Manajer](public/images/2025-03-06%2014_33_38-Dashboard%20Manajer%20Gudang.png)

### 🔹 **Staff Gudang**

- **Dashboard**: Daftar tugas barang masuk/keluar yang perlu diperiksa/disiapkan.
- **Transaksi**: Konfirmasi penerimaan dan pengeluaran barang.

![Stockify Dashboard Staff](public/images/2025-03-06%2014_32_43-Window.png)

---

## 🚀 Cara Menjalankan Project

### 1️⃣ Clone Repository
```bash
git clone https://github.com/Setaarya/stockify.git
cd stockify
```

### 2️⃣ Install Dependency
Pastikan sudah menginstal **Composer** dan **Node.js** di sistem Anda.
```bash
composer install
npm install
```

### 3️⃣ Generate App Key
```bash
php artisan key:generate
```

### 4️⃣ Jalankan Migrasi dan Seeder
```bash
php artisan migrate:fresh --seed
```
Seeder akan membuat user default:
- **Admin** → `admin@example.com` / `password123`
- **Manajer Gudang** → `manager@example.com` / `password123`
- **Staff Gudang** → `staff@example.com` / `password123`

### 5️⃣ Hubungkan Storage
Hubungkan storage dengan website.
```bash
php artisan storage:link
```

### 6️⃣Jalankan Aplikasi
```bash
php artisan serve
```
Buka **http://127.0.0.1:8000** di browser untuk mengakses Stockify.

