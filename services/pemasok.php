<?php

require('config.php');

redirectLogin();

function tambah($data)
{
    global $con;

    $nama_pemasok = $data["nama_pemasok"];
    $alamat_pemasok = $data["alamat_pemasok"];
    $no_telp_pemasok = $data["no_telp_pemasok"];

    $query = "INSERT INTO pemasok VALUES('', '" . $nama_pemasok . "', '" . $alamat_pemasok . "', '" . $no_telp_pemasok . "')";

    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}


function hapus($id)
{
    global $con;

    mysqli_query($con, "DELETE FROM pemasok WHERE id='" . $id . "'");

    return mysqli_affected_rows($con);
}

function edit($data)
{
    global $con;

    $id = $data["id"];
    $nama_pemasok = $data["nama_pemasok"];
    $alamat_pemasok = $data["alamat_pemasok"];
    $no_telp_pemasok = $data["no_telp_pemasok"];

    $query = "UPDATE `pemasok` SET 
        `nama_pemasok`='$nama_pemasok',
        `alamat_pemasok`='$alamat_pemasok',        
        `no_telpon_pemasok`='$no_telp_pemasok'
        WHERE id='$id'";
    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}
