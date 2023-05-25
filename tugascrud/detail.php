<?php 
     include 'functions.php';
     $data = byId($_GET['id'])

     
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="style.css">
</head>
<body>
     <div class="container">
               <div class="card-title">
                    <h1>Detail</h1>
                    <a href="index.php" class="my-button1">
                         <span style="font-weight: 300; font-size: 18px;"> </span> Kembali</a>
               </div>
               <div class="card-subtitle">
                    <h1><?= $data['nama']; ?></h1>
                    <h1><?= $data['username']; ?></h1>
                    <h2><?= $data['password']; ?></h2>
               </div>
               <img class="card-image" src="img/<?= $data['gambar']; ?>">     
      </div>
</body>
</html>