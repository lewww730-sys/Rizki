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
include('konek1.php');

$id_nilai = '';
$nis = '';
$nilai_tugas = '';
$nilai_uts = '';
$nilai_uas = '';
$nilai_akhir = '';
$semester = '';
$tahun_ajaran = '';

if (isset($_GET['id_nilai'])) {
    $id_nilai = $_GET['id_nilai'];

    $query = mysqli_query(
        $koneksiRizkiArdiansyah,
        "SELECT * FROM nilai_rizki WHERE id_nilai='$id_nilai'"
    );

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $nis = $data['nis'];
        $nilai_tugas = $data['nilai_tugas'];
        $nilai_uts = $data['nilai_uts'];
        $nilai_uas = $data['nilai_uas'];
        $semester = $data['semester'];
        $tahun_ajaran = $data['tahun_ajaran'];
        $nilai_akhir = $data['nilai_akhir'];
    } else {
        echo "<script>alert('Data tidak ditemukan');window.location='rapot.php';</script>";
        exit;
    }
}

if (isset($_POST['simpan'])) {

    $id_nilai = $_POST['id_nilai'];
    $nis = $_POST['nis'];
    $nilai_tugas = $_POST['nilai_tugas'];
    $nilai_uts = $_POST['nilai_uts'];
    $nilai_uas = $_POST['nilai_uas'];
    $semester = $_POST['semester'];
    $tahun_ajaran = $_POST['tahun_ajaran'];


    $nilai_akhir = round(($nilai_tugas + $nilai_uts + $nilai_uas) / 3, 2);

    if ($id_nilai != '') {
        $query = mysqli_query($koneksiRizkiArdiansyah, "
            UPDATE nilai_rizki SET
                nilai_tugas='$nilai_tugas',
                nilai_uts='$nilai_uts',
                nilai_uas='$nilai_uas',
                nilai_akhir='$nilai_akhir',
                semester='$semester',
                tahun_ajaran='$tahun_ajaran'
            WHERE id_nilai='$id_nilai'
        ");
        $msg = "diperbarui";
    } else {
        $query = mysqli_query($koneksiRizkiArdiansyah, "
            INSERT INTO nilai_rizki
            (nis, nilai_tugas, nilai_uts, nilai_uas, nilai_akhir, semester, tahun_ajaran)
            VALUES
            ('$nis','$nilai_tugas','$nilai_uts','$nilai_uas','$nilai_akhir','$semester','$tahun_ajaran')
        ");
        $msg = "ditambahkan";
    }

    if ($query) {
        echo "<script>alert('Data berhasil $msg');window.location='rapot.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>

<form method="post">

    <input type="hidden" name="id_nilai" value="<?php echo htmlspecialchars($id_nilai); ?>">

    <table>
        <tr>
            <td>NIS</td>
            <td>
                <input type="number" name="nis" readonly
                       value="<?php echo htmlspecialchars($nis); ?>" required>
            </td>
        </tr>

        <tr>
            <td>Nilai Tugas</td>
            <td>
                <input type="number" name="nilai_tugas"
                       value="<?php echo htmlspecialchars($nilai_tugas); ?>" required>
            </td>
        </tr>

        <tr>
            <td>Nilai UTS</td>
            <td>
                <input type="number" name="nilai_uts"
                       value="<?php echo htmlspecialchars($nilai_uts); ?>" required>
            </td>
        </tr>

        <tr>
            <td>Nilai UAS</td>
            <td>
                <input type="number" name="nilai_uas"
                       value="<?php echo htmlspecialchars($nilai_uas); ?>" required>
            </td>
        </tr>

        <tr>
            <td>Nilai Akhir</td>
            <td>
                <input type="number" name="nilai_akhir" readonly
                       value="<?php echo htmlspecialchars($nilai_akhir); ?>">
            </td>
        </tr>

        <tr>
            <td>Semester</td>
            <td>
                <select name="semester" required>
                    <option value="">-- Pilih Semester --</option>
                    <option value="Ganjil" <?php if($semester=='Ganjil') echo 'selected';?>>Ganjil</option>
                    <option value="Genap" <?php if($semester=='Genap') echo 'selected';?>>Genap</option>
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
            <td class="btn-container">
                <input type="submit" name="simpan"
                       value="<?php echo $id_nilai ? 'Perbarui' : 'Simpan'; ?>">
            </td>
        </tr>
    </table>
</form>
