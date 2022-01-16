<?php

require('config.php');

redirectLogin();


function tambah($data)
{
    global $con;

    $full_name = $data["full_name"];
    $username = $data["username"];
    $password = $data["password"];
    $password = password_hash($password, PASSWORD_BCRYPT);
    $foto = upload();

    if (!$foto) return false;

    $query = "INSERT INTO users VALUES('', '" . $full_name . "', '" . $username . "', '" . $foto . "', '" . $password . "')";

    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}


function hapus($id)
{
    global $con;

    mysqli_query($con, "DELETE FROM users WHERE id='" . $id . "'");

    return mysqli_affected_rows($con);
}

function edit($data)
{
    global $con;

    $id = $data["id"];
    $full_name = $data["full_name"];
    $username = $data["username"];
    $password = $data["password"];
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_BCRYPT);
    }

    $fotoLama = $data["fotoLama"];

    if ($_FILES["foto"]["error"] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload();
    }

    $query = "UPDATE `users` SET 
        `full_name`='$full_name',
        `username`='$username',
        `foto`='$foto'
        " . (empty($password) ? "" : ",password='$password'") . "
        WHERE id='$id'";
    var_dump($query);
    mysqli_query($con, $query);
    return mysqli_affected_rows($con);
}

function upload()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
        <script>
            alert('yang anda upload bukan gambar!');
        </script>
        ";

        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "
        <script>
            alert('file gambar terlalu besar');
        </script>
        ";

        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'foto/' . $namaFileBaru);

    return $namaFileBaru;
}
