<?php
include 'env.php';

$mysqli = $mysqli;


function query($query)
{
    global $mysqli;
    $result = mysqli_query($mysqli, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function cari($keyword)
{
    $query = "SELECT * FROM user 
                WHERE 
            nama LIKE '%$keyword%' OR 
            username LIKE '%$keyword%'";

    return query($query);
}

function tambah($data)
{
    global $mysqli;

    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = mysqli_real_escape_string($mysqli, $data['password']);
    $password_verif = mysqli_real_escape_string($mysqli, $data['password_verif']);

    //gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    //password
    $cek = mysqli_query($mysqli, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($cek)) {
        echo "
                <script>
                    alert('Username telah digunakan')
                </script>
            ";
        return false;
    }

    if ($password !== $password_verif) {
        echo "
                <script>
                    alert('Konfirmasi password anda tidak sesuai')
                </script>
            ";
        return false;
    };

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user VALUES ('', '$username', '$password', '$nama', '$gambar')";

    mysqli_query($mysqli, $query);

    return mysqli_affected_rows($mysqli);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah ada gambar yg diupload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
                </script>";
        return false;
    }

    //cek upload hanya gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
            alert('upload gambar yang benar!');
            </script>";
        return false;
    }

    //generate nama gambar
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function byId($id){
    global $mysqli;
    $result = mysqli_query($mysqli, "SELECT * FROM user WHERE id = $id");

    return $result->fetch_assoc();
}
function ubah($data)
{
    global $mysqli;

    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $password_verif = htmlspecialchars($data['password_verif']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    //cek upload gambar
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    //password
    if ($password !== $password_verif) {
        echo "
                <script>
                    alert('Konfirmasi password tidak sesuai')
                </script>
            ";
        return false;
    };

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE user SET 
        username = '$username',
        password = '$password',
        nama = '$nama',
        gambar = '$gambar' 
        WHERE id = $id";

    mysqli_query($mysqli, $query);

    return mysqli_affected_rows($mysqli);
}

function hapus($id)
{
    global $mysqli;
    mysqli_query($mysqli, "DELETE FROM user WHERE id = $id");

    return mysqli_affected_rows($mysqli);
}


function register($data)
{
    global $mysqli;

    $nama = htmlspecialchars($data['nama']);
    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($mysqli, $data['password']);
    $password_verif = mysqli_real_escape_string($mysqli, $data['password_verif']);

    //cek username
    $cek = mysqli_query($mysqli, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($cek)) {
        echo "
                <script>
                    alert('Username sudah digunakan')
                </script>
            ";
        return false;
    }

    //cek password
    if ($password !== $password_verif) {
        echo "
                <script>
                    alert('Konfirmasi password tidak sesuai')
                </script>
            ";
        return false;
    };

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($mysqli,  "INSERT INTO user (nama, username, password, gambar) VALUES ('$nama', '$username', '$password',  NULL)");

    return mysqli_affected_rows($mysqli);
}
