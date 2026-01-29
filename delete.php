<?php
include ('konek1.php');

if (isset($_GET['delete_nilai'])) {
    $id_nilai = $_GET['delete_nilai'];
    $sql_delete = "DELETE FROM nilai_rizki WHERE id_nilai='$id_nilai'";
    $query_delete = mysqli_query($koneksiRizkiArdiansyah, $sql_delete);

if ($query_delete) {
        echo "<script> alert ('Data berhasil dihapus!');
            window.location = 'rapot.php';</script>";
    } else {
       echo "<script> alert ('Gagal menghapus data: ')" . $koneksi->error;
    }
}
?>