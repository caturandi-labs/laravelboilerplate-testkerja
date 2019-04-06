

## Aplikasi Boilerplate Untuk Test Kerja

###Cara Menggunakan Aplikasi

1. Clone Repository ini.
2. Change Directory ke project anda, Jalankan perintah `composer install` pada terminal.
3. Setelah itu jalankan perintah berikut pada terminal `cp .env.example .env` sehingga dalam directory project terdapat file .env, Silahkan Isi dan setting database sesuai dengan environtment anda. Pastikan Anda telah membuat database kosong yang akan digunakan pada project.
4. Jalankan Perintah berikut pada terminal `php artisan migrate:fresh --seed`
5. Jalankan Aplikasi di Browser baik dengan `php artisan serve` atau dengan laravel valet.
6. Login dengan Credentials `Username : admin@test.com dan Password : admin123`
7. Thanks...
