<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
              <a class="btn btn-primary btn-sm text-white" href="<?=base_url('AdminController/tambahGuru')?>"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Foto</th>
                  <th>Status</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; if ($guru) { foreach($guru as $g) : ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$g['nip']?></td>
                    <td><?=$g['nama_guru']?></td>
                    <td><?=$g['email_guru']?></td>
                    <td>
                      <div class="avatar avatar-sm">
                        <img src="<?=base_url('assets/images/profile/')?><?=$g['foto']?>" class="avatar-img rounded-circle" alt="Profile Siswa">
                      </div>
                    </td>
                    <td><?=$g['status']?></td>
                    <td>  
                      <div class="form-button-action">
                        <a data-toggle="tooltip" 
                          title="Edit Guru" href="<?=base_url('AdminController/editGuru/')?><?=$g['nip']?>"
                          class="btn btn-link btn-primary btn-lg">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button"  data-toggle="tooltip" 
                        title="hapus guru" onclick='deleteGuru(<?= $g["nip"] ?>)'
                        class="btn btn-link btn-danger" data-original-title="Remove">
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

<script>
  const deleteGuru = (nip) => {
    const url = `<?=base_url('ManageGuruController/deleteGuru/')?>${nip}`;
    const data = { method: 'get' };
    swal(`Apa anda yakin ingin menghapus Guru (${nip})`,{ icon: 'info', buttons: ['Tidak', 'Iya'] })
      .then(iya => {
        if(iya){
          fetch(url, data)
            .then(res => res.json())
            .then(data => {
              swal(data.message, { icon: data.icon })
                .then(oK => {
                  if (oK) {
                    window.location.reload();
                  }
                })
            })
        }
      })
  }
</script>