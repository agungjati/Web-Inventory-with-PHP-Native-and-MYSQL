<?php

require('config.php');

redirectLogin();

function tambah($data)
{
    global $con;

    $no_faktur = $data["no_faktur"];
    $kode_barang = $data["kode_barang"];
    $customer_id = $data["customer_id"];
    $tgl_transaksi = $data["tgl_transaksi"];
    $jumlah_jual = $data["jumlah_jual"];
    $jumlah_harga = $data["jumlah_harga"];

    $query = "INSERT INTO transaksi_penjualan VALUES('', '" . $no_faktur . "', '" . $kode_barang . "', '" . $customer_id . "', '" . $tgl_transaksi . "', '" . $jumlah_jual . "', '" . $jumlah_harga . "')";

    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}


function hapus($id)
{
    global $con;

    mysqli_query($con, "DELETE FROM transaksi_penjualan WHERE id='" . $id . "'");

    return mysqli_affected_rows($con);
}

function edit($data)
{
    global $con;

    $id = $data["id"];
    $kode_barang = $data["kode_barang"];
    $customer_id = $data["customer_id"];
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
