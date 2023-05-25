<?php 
    session_start();
    include '../functions.php';

    if (isset($_SESSION['login'])) {
        header("Location: ../index.php");
        exit;
    }

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = mysqli_query($mysqli, "SELECT * FROM user WHERE username = '$username'");

        //cek username
        if (mysqli_num_rows($result) === 1) {

            //cek password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {

                //set session
                $_SESSION['login'] = true;
                $_SESSION['nama'] = $row['nama'];
                if ($_SESSION['failed-login']) {
                    unset($_SESSION['failed-login']);
                }
                

                header("Location: ../index.php");
            } else if (!password_verify($password, $row['password']) ){
                $_SESSION['failed-login'] = true;
            }
        }

        $error = true;

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="auth.css">
  <title>Login CRUD</title>
</head>
<body>
    <section class="login">
        <div class="form-box">
            <form action="" method="post" class="form-value">
                    <h2>Login CRUD</h2>
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
                    <button type="submit" name="login">Log in</button>
                    <div class="register">
                        <p>Don't have a account <a href="register.php">Register</a></p>
                    </div>
            </form>
        </div>
    </section>
    <!-- <div class="modal" id="modal-failed">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Hapus Data</h3>
                <svg onclick="closeModal()" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </div>
            <div class="modal-body" style="text-align: center;">
                <svg style="color: red; width: 90; height: 90;" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                </svg>
                <h1 style="margin-bottom: 8px; margin-top: 15px;">Gagal Login</h1>
                <p>Pastikan Data Yang Anda Masukan Valid !</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-red w-100" form="form-delete" type="button" onclick="closeModal()" style="margin-inline: auto; border-radius: 90px;">Ok</button>
            </div>
        </div>
    </div> -->
    <!-- <script>
        function closeModal() {
            const modal = document.querySelector('#modal-failed')
            modal.classList.remove('show')
        }
    </script>
    <?php if (isset($_SESSION['failed-login'])) : ?>
        <script>
            const modal = document.querySelector('#modal-failed')
            modal.classList.add('show')
        </script>
        <?php unset($_SESSION['failed-login']); ?>
    <?php endif; ?> -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>