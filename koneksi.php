<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $nama_db = "crud_mp";
    $koneksi = mysqli_connect($host,$user,$pass,$nama_db);

    if(!$koneksi){
        die ("connection was lost please try again: ".mysqli_connect_error());
    }
?>