<?php 
    include '../functions.php';

    if (isset($_POST['register'])) {
        
        if (register($_POST) > 0) {
            echo "
                <script>
                    alert('Anda berhasil melakukan registrasi')
                </script>
            ";
        } else {
            echo mysqli_error($mysqli);
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tugas Akhir</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <section class="registerasi">
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
                    <h2>Register</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="nama" name="nama" id="nama" required>
                        <label for="nama">Nama</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="username" name="username" id="username" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" id="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="bag-check-outline"></ion-icon>
                        <input type="password" name="password_verif" id="password_verif" required>
                        <label for="password_verif">Konfirmasi Password</label>
                    </div>
                    <button type="submit" name="register">Sign Up</button>
                    <div class="register">
                        <p>Sudah punya akun ? <a href="login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>