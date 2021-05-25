<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h2>Data Siswa Kelas (<?=$kelas['nama_kelas']?>)</h2>
        </div>
        <div class="card-body table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Tempat Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Foto</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($siswa as $s): ?>
                <tr>
                  <td><?=$no++?></td>
                  <td><?=$s['nis']?></td>
                  <td><?=$s['nama']?></td>
                  <td><?=$s['tempat_lahir']?>, <?=$s['tanggal_lahir']?></td>
                  <td><?=$s['jenis_kelamin']?></td>
                  <td><?=$s['alamat']?></td>
                  <td>
                    <div class="avatar-thumbnail avatar-xl">
                      <img src="<?=base_url('assets/images/profile/')?><?=$s['foto']?>" alt="foto profile <?=$s['nama']?>" class="avatar-img rounded-circle">
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <a href="javascript:history.back()" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>