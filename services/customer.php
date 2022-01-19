<?php

require('config.php');

redirectLogin();

function tambah($data)
{
    global $con;

    $name_customer = $data["name_customer"];
    $no_telpon = $data["no_telpon"];
    $email = $data["email"];
    $alamat_customer = $data["alamat_customer"];

    $query = "INSERT INTO customers VALUES('', '" . $name_customer . "', '" . $no_telpon . "', '" . $email . "', '" . $alamat_customer . "')";

    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}


function hapus($id)
{
    global $con;

    mysqli_query($con, "DELETE FROM customers WHERE id='" . $id . "'");

    return mysqli_affected_rows($con);
}

function edit($data)
{
    global $con;

    $id = $data["id"];
    $name_customer = $data["name_customer"];
    $no_telpon = $data["no_telpon"];
    $email = $data["email"];
    $alamat_customer = $data["alamat_customer"];

    $query = "UPDATE `customers` SET 
        `name_customer`='$name_customer',
        `no_telpon`='$no_telpon',        
        `email`='$email',
        `alamat_customer`='$alamat_customer'
        WHERE id='$id'";
    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}
