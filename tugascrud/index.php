<?php 
    session_start();
    
    if (!isset($_SESSION['login'])) {
        header("Location: auth/login.php");
        exit;
    }

    include 'functions.php';
    $user = query("SELECT * FROM user");

    if ( isset($_POST['cari']) ) {
        $user = cari($_POST['keyword']);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="index">
            <div class="top-bar">
                <!-- <div class="welcome">Selamat Datang, <?php echo $_SESSION['nama'] ?></div> -->
                <a class="logout" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>Log out</a>
            </div>
            
        <div class="container">
            <!-- <h2 style="font-weight: bold;">Admin</h2> -->
            <!-- <div class="br"></div> -->
            <div class="att">
                <!-- <form class="search-form" action="" method="post">
                    <div class="search-container">
                        <input type="text" placeholder="Search" name="keyword" autocomplete="off" class="search-input">
                        <button type="submit" name="search" class="search-button">Search</button>
                    </div>
                </form>                 -->
                <a href="add.php" class="my-button"><span style="font-weight: 700; font-size: 18px;">+ </span> Tambah Data</a>
            </div>
            
            <table cellpadding="10" border="1" cellspacing="0" width="100%" class="table">
                <tr>
                    <th class="table-1">No.</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th class="table-2">Gambar</th>
                    <th class="table-3">Aksi</th>
                </tr>
                <?php $i = 1 ?>
                <?php if (count($user) == 0) : ?>
                    <tr>
                        <td class="text-center" colspan="5" >Data tidak ditemukan</td>
                    </tr>
                    <?php else :  ?>
                        <?php foreach ($user as $row) : ?>
                            <tr>
                                <td class="text-center"><?= $i ?>.</td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td>
                                    <?php if ($row['gambar'] == null) : ?>
                                            Tidak ada Gambar
                                        <?php else : ?>
                                            <img src="img/<?= $row['gambar']?>" alt="Foto" width="15%">
                                        <?php endif; ?>
                                        </td>
                                        <td style="display: flex; justify-content: center; gap: 10px">
                                            <a class="detail" href="detail.php?id=<?=$row['id']?>"><button><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></button></ion-icon></a>
                                            <a class="edit" href="update.php?id=<?=$row['id']?>"><button><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button></ion-icon></a> 
                                            <a onclick="deleteUser(<?=$row['id']?>)" class="delete" href=""><button><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button></ion-icon></a>
                                </td>
                            </tr>
                            <?php $i++ ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </table>
        </div>
        <script>
            function deleteUser(id) {
                event.preventDefault();
                
                const confirmed = confirm('Apakah Anda yakin?');
                if (confirmed) {
                    window.location.href = `delete.php?id=${id}`;
                }

        }
        </script>
    </div>
</body>
</html>