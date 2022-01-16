<?php

require('config.php');

redirectLogin();

function tambah($data)
{
    global $con;

    $kode_barang = $data["kode_barang"];
    $id_pemasok = $data["id_pemasok"];
    $nama_barang = $data["nama_barang"];
    $stok = $data["stok"];
    $satuan = $data["satuan"];
    $harga_barang = $data["harga_barang"];

    $query = "INSERT INTO barang VALUES('', '" . $kode_barang . "', '" . $id_pemasok . "', '" . $nama_barang . "', '" . $stok . "', '" . $satuan . "', '" . $harga_barang . "')";

    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}


function hapus($id)
{
    global $con;

    mysqli_query($con, "DELETE FROM barang   WHERE id='" . $id . "'");

    return mysqli_affected_rows($con);
}

function edit($data)
{
    global $con;

    $id = $data["id"];
    $kode_barang = $data["kode_barang"];
    $id_pemasok = $data["id_pemasok"];
    $nama_barang = $data["nama_barang"];
    $stok = $data["stok"];
    $satuan = $data["satuan"];
    $harga_barang = $data["harga_barang"];

    $query = "UPDATE `barang` SET 
        `kode_barang`='$kode_barang',
        `id_pemasok`='$id_pemasok',
        `nama_barang`='$nama_barang',
        `stok`='$stok',
        `satuan`='$satuan',
        `harga_barang`='$harga_barang'
        WHERE id='$id'";
    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}
