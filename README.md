# Web Kampus

Project ini adalah aplikasi manajemen data kampus berbasis web menggunakan PHP dan MySQL. Dikembangkan untuk kebutuhan pengelolaan data dosen, mata kuliah, prodi, dan mahasiswa.

## Fitur
- Manajemen data Dosen (tambah, edit, hapus)
- Manajemen data Mata Kuliah (tambah, edit, hapus)
- Manajemen data Program Studi (tambah, edit, hapus)
- Manajemen data Mahasiswa
- Notifikasi interaktif (Bootstrap Alert)
- Konfirmasi hapus data
- Tampilan responsif dengan Bootstrap

## Instalasi Lokal (XAMPP)
1. **Clone repository**
   ```bash
   git clone https://github.com/MassDika/web_kampus.git
   ```
2. **Pindahkan folder** ke direktori `htdocs` XAMPP jika belum:
   ```bash
   # Misal sudah di htdocs, lewati langkah ini
   ```
3. **Import database**
   - Buat database baru di phpMyAdmin, misal: `db_kampus`
   - Import file SQL (jika tersedia) ke database tersebut
   - Atur koneksi database di file `koneksi.php` jika perlu
4. **Jalankan XAMPP** (Apache & MySQL aktif)
5. **Akses aplikasi**
   - Buka browser dan akses: `http://localhost/web_kampus` (atau nama folder project Anda)

## Struktur Folder
- `bootstrap-5.3.5-dist/` : Library Bootstrap
- `images/` : Logo dan favicon
- `*.php` : File utama aplikasi

## Kontribusi
1. Fork repo ini
2. Buat branch baru untuk fitur/bugfix
3. Pull request ke branch `main`

## Kontak
- GitHub: [MassDika](https://github.com/MassDika)
- M yuspi indi kurniawan

---

> Project ini dibuat untuk pembelajaran dan pengembangan aplikasi kampus sederhana. 