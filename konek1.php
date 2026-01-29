<?php
$koneksiRizkiArdiansyah  = mysqli_connect("localhost","root","","db_rapot");

if (mysqli_connect_errno()){
    echo "koneksi database gagal : " . mysqli_connect_errno();
}

?>