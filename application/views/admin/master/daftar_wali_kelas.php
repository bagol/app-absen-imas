<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            Daftar Wali Kelas
              <!-- <button class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah</button> -->
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm" id="wali">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama wali kelas</th>
                  <th>Email wali kelas</th>
                  <th>Foto</th>
                  <th class='text-center'>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!$wali_kelas){ ?>
                  <tr>
                    <td colspan="6" class="text-center"> Tidak Ada data </td>
                  </tr>
                <?php } else { $no=1; foreach($wali_kelas as $wk): ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$wk['nama_wali_kelas']?></td>
                    <td><?=$wk['email_wali_kelas']?></td>
                    <td>
                      <div class="avatar avatar-lg">
                        <img src="<?=base_url('assets/images/profile/')?><?=$wk['foto']?>" alt="foto wali kelas" class="avatar-img rounded-circle">
                      </div>
                    </td>
                    <td>
                      <div class="form-button-action">
                        <button type="button" data-toggle="modal" 
                          onclick='editWaliKelas(<?=json_encode($wk)?>)'
                          data-target="#edit"  
                          class="btn btn-link btn-primary btn-lg">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button type="button"  data-toggle="tooltip" title="hapus kelas" 
                        class="btn btn-link btn-danger" data-original-title="Remove"
                        onclick='deleteWali(<?=$wk['nip']?>)'>
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
  window.onload = () => {
    $('#wali').DataTable();
  }

  const deleteWali = (nip) => {
    swal('Apa anda yakin ingin menghapus data '+nip, { icon: 'info',buttons: ['Tidak','Iya'] })
      .then(Iya => {
        if(Iya){
          fetch(`<?=base_url('ManageWaliKelasController/deleteWali/')?>${nip}`)
            .then(res => res.json())
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
</script>