<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header"><h2>Daftar Wali Kelas</h2></div>
        <div class="card-body table-responsive">
          <table class="table" id="tableWaliKelas">
            <thead>
              <tr>
                <th>#</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Semester</th>
                <th>Tahun Ajaran</th>
              </tr>
            </thead>
            <tbody>
              <?php if($waliKelas){ $no = 1; foreach($waliKelas as $wk ) : ?>
                <tr>
                  <td><?=$no++?></td>
                  <td><?=$wk['nip']?></td>
                  <td><?=$wk['nama_wali_kelas']?></td>
                  <td><?=$wk['nama_kelas']?></td>
                  <td><?=$wk['semester']?></td>
                  <td><?=$wk['tahun_ajaran']?></td>
                </tr>
              <?php endforeach; } else { ?>
                <tr>
                  <td colspan="6" class="text-center">Belum Ada Data</td>
                </tr>
              <?php } ?>
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

<script>
  window.onload = () => {
    $('#tableWaliKelas').dataTable();
  }
</script>