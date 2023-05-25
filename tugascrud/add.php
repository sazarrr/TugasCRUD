<?php 

    session_start();

    if (!isset($_SESSION['login'])) {
        header("Location: auth/login.php");
        exit;
    }
    
    include 'functions.php';

    if ( isset($_POST["submit"])) {

        if ( tambah($_POST) > 0 ){
                echo "
                    <script>
                        alert('data berhasil ditambahkan');
                        document.location.href = 'index.php'
                    </script>
                ";
            } else {
                echo "
                <script>
                    alert('data berhasil ditambahkan');
                    document.location.href = 'index.php'
                </script>";
            };
        };

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tambah Admin</title>
</head>
<body>
    <div class="add">
        <div class="top-bar">
            <div class="welcome">Selamat Datang, <?php echo $_SESSION['nama'] ?></div>
            <a class="logout" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>Log out</a>
        </div>
                
        <div class="container">
            <h2>Tambah User</h2>
            <div class="br"></div>
            <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-form">
                        <label for="nama">Nama : </label>
                        <input required type="text" name="nama" id="nama">
                    </div>
                    <div class="input-form">
                        <label for="username">Username : </label>
                        <input required type="text" name="username" id="username">
                    </div>
                    <div class="input-form">
                        <label for="password">Password : </label>
                        <input required type="password" name="password" id="password">
                    </div>
                    <div class="input-form">
                        <label for="password_verif">Password Verifikasi : </label>
                        <input required type="password" name="password_verif" id="password_verif">
                    </div>
                    <div class="input-form">
                        <label for="gambar">Gambar : </label>
                        <input type="file" name="gambar" id="gambar">
                        <button type="submit" name="submit"> Tambah Data</button>
                    </div>
            </form>
        </div>
    </div>
</body>
</html>