<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
              <button class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah</button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm" id="kelas_siswa">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Ruang Kelas</th>
                  <th>Wali Kelas</th>
                  <th>Tahun Ajaran</th>
                  <th>Semester</th>
                  <th>Jumlah Siswa</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($kelas_siswa) { foreach($kelas_siswa as $ks): ?>
                  <tr>
                    <td><?=$ks['kode_kelas_siswa']?></td>
                    <td><?=$ks['nama_kelas']?></td>
                    <td><?=$ks['nama_wali_kelas']?></td>
                    <td><?=$ks['tahun_ajaran']?></td>
                    <td><?=$ks['semester']?></td>
                    <td ><?=$ks['siswa_per_kelas']?> Siswa</td>
                    <td class="text-center">
                      <div class="form-button-action">
                        <button type="button" data-toggle="modal" 
                          data-target="#edit" onclick='modalEdit(<?=json_encode($ks)?>)'
                          class="btn btn-link btn-primary btn-lg">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" data-toggle="tooltip" 
                        onclick='deleteKelas(`<?=$ks["kode_kelas_siswa"]?>`)'
                        title="hapus kelas siswa" class="btn btn-link btn-danger" 
                        data-original-title="Remove">
                          <i class="fa fa-times"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; } else { ?>
                  <tr>
                    <td colspan="7" class="text-center">Belum ada data</td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  