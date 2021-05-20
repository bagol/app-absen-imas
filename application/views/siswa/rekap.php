<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header"><h2>Rekap Absen Siswa</h2></div>
        <div class="card-body">
          <table class="table">
            <tr>
              <th>Mata Pelajaran</th>
              <td><?=$nama_mapel?></td>
            </tr>
            <tr>
              <th>Nama Siswa</th>
              <td><?=$this->session->userdata('username')?></td>
            </tr>
            <tr>
              <th>Jumlah Absensi</th>
              <td><?=$jumlah_absen?></td>
            </tr>
            <tr class="text-success">
              <th>Jumlah Hadir</th>
              <td><?=$hadir?></td>
            </tr>
            <tr class="text-info">
              <th>Jumlah Izin</th>
              <td><?=$izin?></td>
            </tr>
            <tr class="text-danger">
              <th>Jumlah Alpha</th>
              <td><?=$alpha?></td>
            </tr>
          </table>
        </div>
        <div class="card-footer">
          <a href="<?=base_url('DashboardSiswaController/absen')?>" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>