<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header"><h2>Daftar Kelas</h2></div>
        <div class="card-body">
          <table class="table">
            <thead>
              <th>#</th>
              <th>Kode Kelas</th>
              <th>Nama Kelas</th>
              <th>Tahun Ajaran</th>
              <th>Semester</th>
              <th>Jumlah Siswa</th>
              <th class="text-center">Opsi</th>
            </thead>
            <tbody>
              <?php if(!$kelas){ ?>
                <tr>
                  <td class="text-center" colspan="5">Belum ada Data</td>
                </tr>
              <?php }else{ $no=1; foreach ($kelas as $k):?>
                <tr>
                  <td><?=$no++?></td>
                  <td><?=$k['kode_kelas_siswa']?></td>
                  <td><?=$k['nama_kelas']?></td>
                  <td><?=$k['tahun_ajaran']?></td>
                  <td><?=$k['semester']?></td>
                  <td><?=$k['siswa_per_kelas']?></td>
                  <td class="d-flex justify-content-around align-items-center">
                    <a href="<?=base_url('DashboardKepalaSekolahController/jadwalKelas/')?><?=$k['kode_kelas_siswa']?>" class="btn btn-sm btn-success"><i class="fa fa-list"></i> Jadwal</a>
                    <a href="<?=base_url('DashboardKepalaSekolahController/kelasSiswa/')?><?=$k['kode_kelas_siswa']?>" class="btn btn-sm btn-primary"><i class="fa fa-users"></i> siswa</a>
                  </td>
                </tr>
              <?php endforeach; }?>
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <a href="javascript:history.back()" class="btn btn-sm btn-dark"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>