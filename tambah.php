<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
}

body {
    background: linear-gradient(120deg, #e0eafc, #cfdef3);
    padding: 30px 15px;
}

form {
    width: 520px;
    margin: auto;
    background: #ffffff;
    padding: 28px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    animation: fadeIn 0.5s ease;
}

.form-title {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #2c3e50;
}

table {
    width: 100%;
    border-collapse: collapse;
}

td {
    padding: 10px 8px;
    vertical-align: middle;
}

td:first-child {
    width: 35%;
    font-weight: 600;
    color: #34495e;
}

input[type="number"],
input[type="text"] {
    width: 100%;
    padding: 10px 12px;
    border: 1.6px solid #ccd1d9;
    border-radius: 8px;
    outline: none;
    transition: all 0.25s ease;
    font-size: 14px;
}

input:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 2px rgba(52,152,219,0.2);
}

input[readonly] {
    background: #f2f4f7;
    cursor: not-allowed;
}

.btn-container {
    text-align: right;
    padding-top: 10px;
}

input[type="submit"] {
    background: linear-gradient(135deg, #3498db, #1d6fa5);
    color: #fff;
    padding: 10px 22px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.3s;
}

input[type="submit"]:hover {
    background: linear-gradient(135deg, #1d6fa5, #155a8a);
    transform: translateY(-1px);
}

.back-link {
    display: block;
    width: 520px;
    margin: 18px auto 0;
    color: #1d6fa5;
    text-decoration: none;
    font-weight: 600;
}

.back-link:hover {
    text-decoration: underline;
}

@media (max-width: 600px) {
    form,
    .back-link {
        width: 100%;
    }

    td:first-child {
        width: 40%;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

select {
    width: 100%;
    padding: 10px 12px;
    border: 1.6px solid #ccd1d9;
    border-radius: 8px;
    outline: none;
    font-size: 14px;
    background-color: #fff;
    transition: all 0.25s ease;
    cursor: pointer;
}

select:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 2px rgba(52,152,219,0.2);
}

select option {
    padding: 10px;
}

select:disabled {
    background: #f2f4f7;
    cursor: not-allowed;
}
</style>

<?php
include 'konek1.php';

if (isset($_POST['simpan'])) {
    $query_rizki = mysqli_query($koneksiRizkiArdiansyah, "SELECT id_nilai FROM nilai_rizki ORDER BY id_nilai DESC LIMIT 1");
    $data_rizki = mysqli_fetch_assoc($query_rizki);
    if ($data_rizki) {
        $no = (int) substr($data_rizki['id_nilai'], 2, 3);
        $no++;
    } else {
        $no = 1;
    }
    $id_nilai = "NP" . str_pad($no, 3, "0", STR_PAD_LEFT);


    $nis         = $_POST['nis'];
    $id_mapel    = $_POST['id_mapel'];
    $nilai_tugas = $_POST['nilai_tugas'];
    $nilai_uts   = $_POST['nilai_uts'];
    $nilai_uas   = $_POST['nilai_uas'];
    $semester    = $_POST['semester'];
    $tahun_ajaran = $_POST['tahun_ajaran'];


    $nilai_akhir = ($nilai_tugas + $nilai_uts + $nilai_uas) / 3;


    if ($nilai_akhir >= 88) {
        $deskripsi = "Sangat Baik";
    } elseif ($nilai_akhir >= 75) {
        $deskripsi = "Cukup Baik";
    } else {
        $deskripsi = "Sangat Kurang";
    }


    $query = mysqli_query($koneksiRizkiArdiansyah, "
        INSERT INTO nilai_rizki 
        (id_nilai, nis, id_mapel, nilai_tugas, nilai_uts, nilai_uas, nilai_akhir, deskripsi, semester, tahun_ajaran) 
        VALUES 
        ('$id_nilai', '$nis', '$id_mapel', '$nilai_tugas', '$nilai_uts', '$nilai_uas', '$nilai_akhir', '$deskripsi', '$semester', '$tahun_ajaran')
    ");

    if ($query) {
        echo "<script>alert('Data berhasil ditambahkan');window.location='rapot.php';</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan');</script>";
    }
}
?>

<form method="post">
    <table>
        <tr>
            <td>NIS</td>
            <td>
                <select name="nis" required>
                    <option value="">-- Pilih Siswa --</option>
                    <?php
                    $siswa = mysqli_query($koneksiRizkiArdiansyah, "SELECT nis FROM siswa_rizki");
                    while ($row = mysqli_fetch_assoc($siswa)) {
                        echo "<option value='{$row['nis']}'>{$row['nis']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td>Mata Pelajaran</td>
            <td>
                <select name="id_mapel" required>
                    <option value="">-- Pilih Mapel --</option>
                    <?php
                    $mapel = mysqli_query($koneksiRizkiArdiansyah, "SELECT id_mapel, nama_mapel FROM mapel_rizki");
                    while ($m = mysqli_fetch_assoc($mapel)) {
                        echo "<option value='{$m['id_mapel']}'>{$m['nama_mapel']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td>Nilai Tugas</td>
            <td><input type="number" name="nilai_tugas" required></td>
        </tr>

        <tr>
            <td>Nilai UTS</td>
            <td><input type="number" name="nilai_uts" required></td>
        </tr>

        <tr>
            <td>Nilai UAS</td>
            <td><input type="number" name="nilai_uas" required></td>
        </tr>

        <tr>
            <td>Semester</td>
            <td>
                <select name="semester" required>
                    <option value="">-- Pilih Semester --</option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
            </td>
        </tr>

      <tr>
    <td>Tahun Ajaran</td>
    <td>
        <select name="tahun_ajaran" required>
            <option value="">-- Pilih Tahun Ajaran --</option>
            <?php
            for ($tahun = 2000; $tahun <= 2050; $tahun++) {
                $tahun_ajaran = $tahun . '/' . ($tahun + 1);
                echo "<option value='$tahun_ajaran'>$tahun_ajaran</option>";
            }
            ?>
        </select>
    </td>
</tr>


        <tr>
            <td></td>
            <td><input type="submit" name="simpan" value="Simpan"></td>
        </tr>
    </table>
</form>

<a href="rapot.php">← Kembali ke Daftar Nilai</a>
