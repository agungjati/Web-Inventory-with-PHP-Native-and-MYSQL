<?php
$con = mysqli_connect("localhost", "root", "", "inventory_2022014");


function query($query)
{
    global $con;
    $result = mysqli_query($con, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function redirectIndex()
{
    session_start();
    if (isset($_SESSION["login"])) {
        header("Location: index.php");
        exit;
    }
}

function redirectLogin()
{
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }
}
