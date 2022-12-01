<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'pens';
$con = new mysqli($host, $user, $pass, $db);

if ($con->connect_errno) {
    echo 'Failed to connect to MySQL: ' . $con->connect_error;
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>TES IMPLEMENTATOR & PRODUCT SUPPORT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    .fakeimg {
      height: 200px;
      background: #aaa;
    }
    </style>
  </head>
  <body>
    <div class="p-2 bg-primary text-white text-center">
      <h1>SOAL TES IMPLEMENTATOR & PRODUCT SUPPORT</h1>
      <p>Nurul Azizah</p> 
    </div>
    <div class="container mt-5">
      <div class="row">
        <div class="col-sm-12">
          <h2>Mahasiswa</h2>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Umur</th>
                <th>No. Telepon</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $view = mysqli_query($con, "SELECT * FROM mahasiswa ORDER BY nrp ASC");
                while ($row = $view-> fetch_array()) {
                  $umur = date('Y')-$row['tahun_lahir'];
              ?>
              <tr>
                <td><?=$row['nrp']?></td>
                <td><?=$row['nama']?></td>
                <td><?=$row['address']?></td>
                <td><?=$row['gender']?></td>
                <td><?=$umur?></td>
                <td><?=$row['telp']?></td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
            
          <h2>Nilai</h2>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>NIM</th>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>SKS</th>
                <th>Nilai Angka</th>
                <th>Nilai Huruf</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $nilai = mysqli_query($con, "SELECT * FROM frs ORDER BY id DESC");
                while ($data = $nilai-> fetch_array()) {
                  $matkul_sql = mysqli_query($con, "SELECT * FROM matkul WHERE id=".$data['id_matkul']."");
                  $matkul = mysqli_fetch_array($matkul_sql);
                  $student_sql = mysqli_query($con, "SELECT * FROM mahasiswa WHERE id=".$data["student_id"]."");
                  $student = mysqli_fetch_array($student_sql);
              ?>
              <tr>
                <td><?=$student['nrp']?></td>
                <td><?=$matkul['kode_mk']?></td>
                <td><?=$matkul['nama']?></td>
                <td><?=$data['sks']?></td>
                <td><?=$data['nilai_angka']?></td>
                <td><?=$data['nilai_huruf']?></td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>

          <h2>Rata - rata Nilai</h2>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Nilai Tertinggi</th>
                <th>Nilai Terendah</th>
                <th>Nilai Rata2</th>
                <th>Jumlah MK</th>
                <th>Jumlah MK lulus</th>
                <th>IPK</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $mean = mysqli_query($con, "SELECT max(nilai_angka) as max_nilai,min(nilai_angka) as min_nilai,student_id,count(id_matkul) as total_mk,avg(nilai_angka) as mean, count(sks) as total_sks FROM frs GROUP BY student_id");
                while ($mean_data = $mean-> fetch_array()) {
                  $frs_sql = mysqli_query($con, "SELECT count(nilai_huruf) as mk_lulus FROM frs WHERE student_id=".$mean_data['student_id']." AND nilai_huruf != 'E' AND nilai_huruf != 'D'");
                  $frs = mysqli_fetch_array($frs_sql);
                  $ipk_sql = mysqli_query($con, "SELECT nilai_huruf FROM frs WHERE student_id=".$mean_data['student_id']."");
                  $ipk_total = [];
                  while ($ipk = $ipk_sql-> fetch_array()) {
                    if ($ipk['nilai_huruf'] == 'A') {
                      $nilai = '4';
                    } elseif($ipk['nilai_huruf'] == 'B'){
                      $nilai = '3';
                    } elseif($ipk['nilai_huruf'] == 'C'){
                      $nilai = '2';
                    } elseif($ipk['nilai_huruf'] == 'D'){
                      $nilai = '1';
                    } elseif($ipk['nilai_huruf'] == 'E'){
                      $nilai = '0';
                    }
                    array_push($ipk_total, $nilai);
                  }
                  $total_nilai = array_sum($ipk_total);
                  $ipk = $total_nilai/$mean_data['total_sks'];
                  $student_sql = mysqli_query($con, "SELECT * FROM mahasiswa WHERE id=".$mean_data["student_id"]."");
                  $student = mysqli_fetch_array($student_sql);
              ?>
              <tr>
                <td><?=$student['nrp']?></td>
                <td><?=$student['nama']?></td>
                <td><?=$mean_data['max_nilai']?></td>
                <td><?=$mean_data['min_nilai']?></td>
                <td><?=number_format($mean_data['mean'],1)?></td>
                <td><?=$mean_data['total_mk']?></td>
                <td><?=$frs['mk_lulus']?></td>
                <td><?=number_format($ipk,2)?></td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>

          <h2>Daftar Matkul</h2>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>Jumlah Mahasiswa yang mendapat nilai A atau B</th>
                <th>Nilai Rata-rata Pada Mahasiswa yang berumur Lebih dari 20 dan Kurang dari 22</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $matkul = mysqli_query($con, "SELECT id_matkul FROM frs GROUP BY id_matkul");
                while ($matkul_data = $matkul-> fetch_array()) {
                  $frs_sql = mysqli_query($con, "SELECT count(nilai_huruf) as jumlah_nilai FROM frs where nilai_huruf = 'A' or nilai_huruf = 'B' and id_matkul =".$matkul_data['id_matkul']."");
                  $frs = mysqli_fetch_array($frs_sql);

                  $frs_sql2 = mysqli_query($con, "SELECT * FROM frs where id_matkul =".$matkul_data['id_matkul']."");
                  $frs2 = mysqli_fetch_array($frs_sql2);
                  
                  $mk_sql = mysqli_query($con, "SELECT * FROM matkul WHERE id=".$matkul_data["id_matkul"]."");
                  $mk = mysqli_fetch_array($mk_sql);
                  
                  $student_sql = mysqli_query($con, "SELECT * FROM mahasiswa WHERE id=".$frs2["student_id"]." AND tahun_lahir BETWEEN '2000' AND '2002'");
                  $student = mysqli_fetch_array($student_sql);

                  $frs_sql3 = mysqli_query($con, "SELECT AVG(nilai_angka) as rata2 FROM frs where student_id =".$student['id']." AND id_matkul =".$matkul_data["id_matkul"]."");
                  $frs3 = mysqli_fetch_array($frs_sql3);
              ?>
              <tr>
                <td><?=$mk['kode_mk']?></td>
                <td><?=$mk['nama']?></td>
                <td><?=$frs['jumlah_nilai']?></td>
                <td><?=number_format($frs3['rata2'],1)?></td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
