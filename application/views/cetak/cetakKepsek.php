<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Absen Persentase</title>
  <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
  <style>
    th {
      text-align: -webkit-center;
    }
    th p {
      writing-mode: tb-rl; 
      margin:0;
    }
    @page {
      body {
        size: 297.039mm 209.903mm;
        margin: 0.6cm;
      } /* change the margins as you want them to be. */
      
    }
    @media print {
      th,td{ 
        font-size: 7pt;
      }
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3  mt-4 text-center">
        <img src="<?=base_urL('./assets/img/mts.png')?>" width="150" alt="logo">
      </div>
      <div class="col-md-8">
        <h2 class="text-center mt-4">ABSENSI SISWA MTs INSAN KREASI</h2>
        <hr>
        <p class="text-center">
          <em> Jl. Parung Panjang - Tenjo RT 01 / RW 07, Batok, Tenjo, Batok, Kec. Tenjo,
          Bogor, Jawa Barat, Kode Pos (16370) </em> <br>
          <b>Email : mtsinsanikreasi13@gmail.com Telp.081234567890</b>
        </p>
      </div>
      <div class="col-md-12 mt-2">
        <table border="1" width="100%">
          <thead>
            <tr id="nama_mapel">
              <th>Nama Siswa</th>
            </tr>
          </thead>
          <tbody id="dataSiswa">
          </tbody>
        </table>
      </div>
    </div>
  </div>
  

  
  <script>
    const namaMapel = document.querySelector('#nama_mapel');
    const dataSiswa = document.querySelector('#dataSiswa');
    fetch(`<?=base_url('LaporanAbsen/getDataLaporan/')?><?=$kode_kelas?>`)
      .then(res => res.json())
      .then(data => {
        namaMapel.innerHTML += data[0].absen.map((mapel) => `<th><p>${mapel.nama_mapel}</p></th>`).join('');
        namaMapel.innerHTML += '<th><p>Persentase</p></th>';
        dataSiswa.innerHTML += data.map((siswa) => {
          return `
          <tr>
            <td>${siswa.nama}</td>
            ${siswa.absen.map((absen) => `<td>${absen.jumlah_hadir}</td>`).join('')}
            <td>${siswa.persentase} %</td>
          </tr>`;
        }).join('');
      window.print();
      });
  </script>
</body>
</html>