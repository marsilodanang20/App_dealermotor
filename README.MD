# Menjalankan Project CRUD Penjualan Sepeda Motor, Tugas Akhir Matakuliah Basis Data Lanjut:

1. Persiapan

	Sebelum menjalankan project, pastikan sudah menginstal:

	XAMPP (untuk Apache dan MySQL)

	Web Browser (Chrome/Firefox)

	Teks Editor (VS Code, Sublime Text, atau Notepad++)

2. Instalasi & Konfigurasi

   a. Masukkan Folder ke htdocs

	Download folder dan pastikan folder bernama: basdat

	Pindahkan folder basdat ke dalam direktori htdocs:

	contoh: C:\xampp\htdocs\

   b. Import Database ke phpMyAdmin

	Buka XAMPP Control Panel

	Jalankan Apache dan MySQL

	Buka browser dan akses:

	http://localhost/phpmyadmin/

	Klik Database > New > Buat database dengan nama: motor

	Pilih database motor di folder basdat/db/motor.sql

	Klik Import > Pilih file motor.sql > Klik Go

   c. Konfigurasi Koneksi Database

	Buka file env 

	Pastikan koneksi ke database sesuai dengan setup lokal:

      Contoh:

	DB_CONNECTION=mysql
    	DB_HOST=127.0.0.1
    	DB_PORT=3306
    	DB_DATABASE=motor
    	DB_USERNAME=root
    	DB_PASSWORD=
    	DB_CHARSET=utf8
    	BASE_URL=http://localhost/basdat/
    	CONTROLLER_URL=c:/xampp/htdocs/basdat/controllers/
    	THEME=fobia



3. Menjalankan Project

	Pastikan XAMPP Apache & MySQL berjalan

	Buka browser dan akses:

	http://localhost/basdat/

	Project siap digunakan! 🎉
