# TP8DPBO2425C1

## Janji
Janji: Saya Muhammad Ilal Zhafran dengan NIM 2502623 mengerjakan Tp 8 dalam mata kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

## 2. Tujuan Program

- Menyimpan dan mengelola data akademik.
- Menyediakan operasi Create, Read, Update, dan Delete (CRUD) untuk setiap modul.
- Menghubungkan data antarentitas menggunakan foreign key.
- Menerapkan pemisahan tanggung jawab dengan arsitektur MVC.

## 3. Aktor dan Fitur

| Aktor | Fitur |
|---|---|
| Pengguna aplikasi | Melihat, menambah, mengubah, dan menghapus data dosen |
| Pengguna aplikasi | Melihat, menambah, mengubah, dan menghapus data departemen |
| Pengguna aplikasi | Melihat, menambah, mengubah, dan menghapus data mata kuliah |
| Pengguna aplikasi | Melihat, menambah, mengubah, dan menghapus jadwal mata kuliah |

## 4. Arsitektur Program

```mermaid
flowchart LR
    Browser[Browser / Pengguna] --> Entry[index.php]
    Entry --> Router[Pemilihan page dan action]
    Router --> Controller[Controller]
    Controller --> Model[Model]
    Model --> DB[(MariaDB / MySQL)]
    Model --> Controller
    Controller --> View[View PHP]
    View --> Template[templates/index.html atau templates/form.html]
    Template --> Browser
```
## 5. Alur Kerja Request

1. Pengguna membuka tautan atau mengirim form dari browser.
2. Request masuk ke `index.php` dengan parameter `page` dan `action`.
3. Router memilih controller yang sesuai.
4. Controller memanggil model untuk membaca atau mengubah data.
5. Model berkomunikasi dengan database menggunakan query berparameter.
6. Untuk halaman daftar atau form, controller mengirim data ke view.
7. View dirender bersama template dan dikirim sebagai HTML kepada browser.
8. Setelah operasi simpan atau hapus, aplikasi mengarahkan pengguna kembali ke daftar modul.

