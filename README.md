1. Daftar username & password
    (ADMIN ROLE)
        'email' => 'admin@admin.admin',
        'password' => admin123
    
    (USER ROLE)
        'email' => 'user@user.user',
        'password' => user123

Cara menggunakan aplikasi :
    1. Buka terminal arahkan ke direktori root
    2. Clone aplikasi via https atau SSH (git clone https://github.com/hendrikusriko/geekgarden-test.git)
    3. masuk ke folder project
    4. jalankan composer instal
    5. Duplikat file .env.example dengan nama .env
    6. Buka file .env dan ubah konfigurasi database seperti berikut lalu save
       - DB_DATABASE=db_geekgarden_test
       - DB_USERNAME=root
       - DB_PASSWORD=
    7. jalankan perintah php artisan key:generate
    8. Jalankan perintah php artisan migrate
    9. Jalankan perintah php artisan db:seed
    10. Jalankan perintah php artisan serve melalui terminal

Cara menggunakan API :
    1. Buka aplikasi postman
    2. import file postman collection (terlampir di email)
    3. klik endpoint login
    4. isi request, lalu send
    5. salin token lalu masukkan pada endpoint lain pada bagian authorization->bearer token
    6. lalu gunakan endpoint
