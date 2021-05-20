<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
              <a class="btn btn-primary btn-sm text-white" href="<?=base_url('AdminController/tambahSiswa')?>"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm" id="Siswa">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NIS/NISN</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Tahun Masuk</th>
                  <th>Status</th>
                  <th>Foto</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!$siswa){ ?>
                  <tr>
                    <td colspan="8" class="text-center">Belum ada Data</td>
                  </tr>
                <?php } else { $no=1; foreach($siswa as $s): ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$s['nis']?></td>
                    <td><?=$s['nama_siswa']?></td>
                    <td><?=$s['nama_kelas']?></td>
                    <td><?=$s['tahun_angkatan']?></td>
                    <td><?=$s['status']?></td>
                    <td>
                      <div class="avatar avatar-sm">
                        <img src="<?=base_url('assets/images/profile/')?><?=$s['foto']?>" class="avatar-img rounded-circle" alt="Profile Siswa">
                      </div>
                    </td>
                    <td>
                      <div class="form-button-action">
                        <a data-toggle="tooltip" 
                          title="Edit siswa" href="<?=base_url('AdminController/editSiswa/')?><?=$s['nis']?>"
                          class="btn btn-link btn-primary btn-lg">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button"  data-toggle="tooltip" 
                        title="hapus Siswa" onclick='deleteSiswa(<?=$s["nis"]?>)'
                        class="btn btn-link btn-danger" data-original-title="Remove">
                          <i class="fa fa-times"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  const deleteSiswa = (nis) => {
    const url = `<?=base_url('SiswaController/deleteSiswa/')?>${nis}`;
    swal(`Apakah Anda yakin ingin menghapus siswa ${nis}`,{ icon: 'info', buttons: ['Tidak','Iya'] })
      .then(Iya => {
        if(Iya){
          fetch(url).then(res => res.json())
            .then(data => {
              swal(data.message, { icon: data.icon })
                .then(oK => {
                  if(oK){
                    window.location.reload();
                  }
                })
            })
        }
      })
  }
  window.onload = () => {
    $('#Siswa').DataTable();
  }
</script>
