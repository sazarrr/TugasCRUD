<?php 

    session_start();

    if (!isset($_SESSION['login'])) {
        header("Location: auth/login.php");
        exit;
    }
    
    include 'functions.php';

    $id = $_GET["id"];
    $user = query("SELECT * FROM user WHERE id = $id")[0];

    if ( isset($_POST["submit"])) {
        if ( ubah($_POST) > 0 ){
                echo "
                    <script>
                        alert('data berhasil diubah');
                        document.location.href = 'index.php'
                    </script>
                ";
            } else {
                echo "
                <script>
                    alert('data berhasil diubah');
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
    <title>Ubah Admin</title>
</head>
<body>
    <div class="top-bar">
        <div class="welcome">Selamat Datang, <?php echo $_SESSION['nama'] ?></div>
        <a class="logout" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>Log out</a>
    </div>
    
    <div class="container">
        <h1>Ubah User <?= $user["nama"] ?></h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$user["id"]?>">
            <input type="hidden" name="gambarLama" value="<?=$user["gambar"]?>">
            <ul>
                <li>
                    <label for="nama">Nama : </label>
                    <input required type="text" name="nama" id="nama" value="<?= $user["nama"] ?>">
                </li>
                <li>
                    <label for="username">Username : </label>
                    <input type="text" name="username" id="username" value="<?= $user["username"] ?>">
                </li>
                <li>
                    <label for="password">Password : </label>
                    <input required type="text" name="password" id="password">
                </li>
                <li>
                    <label for="password_verif">Password Verifikasi : </label>
                    <input required type="text" name="password_verif" id="password_verif">
                </li>
                <li>
                    <label for="gambar">Gambar : </label>
                    <img width="20%" src="img/<?= $user['gambar']?>" alt="">
                    <br><br>
                    <input type="file" name="gambar" id="gambar" value="<?= $user["gambar"] ?>">
                </li>
                <li>
                    <button type="submit" name="submit">Ubah Data</button>
                </li>
            </ul>
        </form>
    </div>
</body>
</html>