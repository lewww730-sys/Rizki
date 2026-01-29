<?php
include 'konek1.php';

$sqlRizkiArdiansyah = "SELECT * FROM `nilai_rizki` WHERE 1";

$resultRizkiArdiansyah = $koneksiRizkiArdiansyah->query($sqlRizkiArdiansyah);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabel Kelas</title>
  <style>
    body {
      font-family: "Poppins", Arial, sans-serif;
      background-color: #f5f7fa;
      color: #333;
      margin: 40px;
    }

    h1 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 25px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    table {
      border-collapse: collapse;
      margin: 0 auto;
      width: 85%;
      background-color: #ffffff;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 12px 15px;
      text-align: center;
    }

    th {
      background-color: #007bff;
      color: white;
      text-transform: uppercase;
      font-weight: 600;
      letter-spacing: 0.05em;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #e3f2fd;
      transition: 0.3s;
    }

    td {
      color: #444;
    }

    .btn {
      display: inline-block;
      padding: 8px 14px;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      border-radius: 6px;
      transition: 0.3s;
    }

    .btn-edit {
      background-color: #007bff;
      color: white;
      margin-right: 6px;
    }

    .btn-edit:hover {
      background-color: #0056b3;
    }

    .btn-delete {
      background-color: #dc3545;
      color: white;
    }

    .btn-delete:hover {
      background-color: #b02a37;
    }

    .no-data {
      text-align: center;
      font-style: italic;
      color: #999;
    }

    @media (max-width: 768px) {
      body {
        margin: 20px;
      }

      table {
        width: 100%;
        font-size: 14px;
      }

      th, td {
        padding: 8px 10px;
      }

      .btn {
        display: block;
        width: 90%;
        margin: 4px auto;
      }
    }
  </style>
</head>
<body>
  <h1>Tabel Nilai</h1>
  <table>
    <tr>
      <th>ID Nilai</th>
      <th>Nis</th>
      <th>Nilai Tugas</th>
      <th>Nilai UTS</th>
      <th>Nilai UAS</th>
      <th>Nilai Akhir</th>
      <th>Deskripsi</th>
      <th>Semester</th>
      <th>Tahun Ajaran</th>
      <th>Aksi</th>
    </tr>

    <?php if (mysqli_num_rows($resultRizkiArdiansyah) > 0):?>
      <?php while($data = mysqli_fetch_assoc($resultRizkiArdiansyah)): ?>
        <?php $rata = ($data['nilai_tugas'] + $data['nilai_uts'] + $data['nilai_uas']) / 3; ?>
        <?php
        if ($rata >= 88) {
          $x = "sangat baik Terus tingkatkan";
        } elseif ($rata >= 75 && $rata <= 88) {
          $x = "Cukup Baik Semangat Terus Yaa";
        } else {
          $x = "sangat kurang Tingkatkan Lagi Yaa Semangat";
        }
        ?>
        <tr>
          <td><?php echo $data["id_nilai"]; ?></td>
          <td><?php echo $data["nis"]; ?></td>
          <td><?php echo $data["nilai_tugas"]; ?></td>
          <td><?php echo $data["nilai_uts"]; ?></td>
          <td><?php echo $data["nilai_uas"]; ?></td>
          <td style = "color:red;"><?php echo $rata; ?></td>
          <td style = "color:red;"><?php echo $x; ?></td>
          <td><?php echo $data["semester"]; ?></td>
          <td><?php echo $data["tahun_ajaran"]; ?></td>
          <td>
            <a href="delete.php?delete_nilai=<?php echo $data['id_nilai']; ?>" class="btn btn-delete" onclick="return confirm('Yakin data ingin dihapus?')">HAPUS</a>
            <a href="edit.php?id_nilai=<?php echo $data['id_nilai']; ?>" class="btn btn-delete">EDIT</a>
</a>

        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr>
        <td colspan="4" class="no-data">Data tidak ditemukan</td>
      </tr>
    <?php endif; ?>
  </table>
  <center>
  <a href="tambah.php" class="btn btn-edit" style="margin-top: 20px; display: inline-block;">TAMBAH</a>
  <a href="siswa.php" class="btn btn-edit" style="margin-top: 20px; display: inline-block;">Tabel Siswa</a>
    </center>
</body>
</body>
</html>
