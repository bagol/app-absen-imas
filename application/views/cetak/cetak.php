<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan</title>
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
      size: 297.039mm 209.903mm;
      margin: 0.6cm; /* change the margins as you want them to be. */
      
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
      <div class="col-md-2  mt-4">
        <img src="<?=base_urL('./assets/img/mts.png')?>" width="150" alt="logo">
      </div>
      <div class="col-md-6">
        <h2 class="text-center mt-4">ABSENSI SISWA MTs INSAN KREASI</h2>
        <hr>
        <p class="text-center">
          <em> Jl. Parung Panjang - Tenjo RT 01 / RW 07, Batok, Tenjo, Batok, Kec. Tenjo,
          Bogor, Jawa Barat, Kode Pos (16370) </em> <br>
          <b>Email : mtsinsanikreasi13@gmail.com Telp.081234567890</b>
        </p>
      </div>
      <div class="col-md-4 mt-4">
        <table>
          <tr >
            <td><b style="border: 2px solid #000;" class="py-2 px-2"><?=$kelas['nama_kelas']?></b></td>
            <td><b style="border: 2px solid #000;" class="ml-4 py-2 px-2"><?=$kelas['semester']?></b></td>
          </tr>
          <tr>
            <td><br> Nama Guru</td>
            <td class="ml-4 px-4"><br><?=$guru['nama_guru']?></td>
          </tr>
          <tr>
            <td>Bidang Studi</td>
            <td class="ml-4 px-4"><?=$jadwal['nama_mapel']?> </td>
          </tr>
          <tr>
            <td>Wali Kelas</td>
            <td class="ml-4 px-4"><?=$wali_kelas['nama_wali_kelas']?></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="col-md-12 mt-4 text-center">
      <table border='1' class="text-center" width="100%">
        <thead>
          <tr id="bookAbsenHead">
          </tr>
        </thead>
        <tbody id="bookAbsen" >
          <tr>
            <td colspan="4" class="text-center">Silahkan Pilih Mapel</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
<script>
  window.onload = () => {
    fetch(`<?=base_url('AbsenController/getAbsen/')?><?=$mapel?>`)
      .then(res => res.json())
      .then(data => {
        let html = '';
        const dataAbsen = {
          hadir: 0 ,
          izin: 0,
          alpha: 0
        };
        data.data.forEach(item => {
          html += `<tr>`;
          html += `<td style="width:200px;">${item.nama}</td>`;
          item.absen.forEach(absen => {
            if(absen.ket === 'H') {
              dataAbsen.hadir++;
            }else if(absen.ket === 'I') {
              dataAbsen.izin++;
            }else if(absen.ket === 'A') {
              dataAbsen.alpha++;
            }
            html += `<td>${absen.ket}</td>`;
          })
          html += `
            <td>${ item.totalAbsen.hadir }</td>
            <td>${ item.totalAbsen.izin }</td>
            <td>${ item.totalAbsen.sakit }</td>
            <td>${ item.totalAbsen.alpha }</td>
          `;
          html += `</tr>`;
        })

        bookAbsen.innerHTML = html;
        let head = '<th>Nama Siswa</th>';
        console.log(data.pertemuan);
        data.pertemuan.forEach(pertemuan => {
          if(pertemuan.tanggal === null) return; 
          head += `<th><p>${pertemuan.tanggal}</p></th>`;
        })
        head += `
          <th><p>Hadir</p></th>
          <th><p>Izin</p></th>
          <th><p>Sakit</p></th>
          <th><p>Alpha</p></th>
        `;
        bookAbsenHead.innerHTML = head;
        window.print() 
      })

  }
</script>