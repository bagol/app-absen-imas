<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
              <a class="btn btn-primary btn-sm text-white" href="<?=base_url('AdminController/tambahKepsek')?>"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NUPK</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Foto</th>
                  <th>Status</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
              <tbody>
               <?php if(!$kepala_sekolah){ ?>
                <tr>
                  <td colspan="7" class="text-center">Belum Ada Data</td>
                </tr>
               <?php } else{ $no=1; foreach ($kepala_sekolah as $ks): ?>
                <tr>
                  <td><?=$no++?></td>
                  <td><?=$ks['nuks']?></td>
                  <td><?=$ks['nama_kepala_sekolah']?></td>
                  <td><?=$ks['email_kepala_sekolah']?></td>
                  <td>
                    <div class="avatar avatar-xl">
                      <img src="<?=base_url('assets/images/profile/')?><?=$ks['foto']?>" alt="Foto Profoile <?=$ks['nuks']?>" class="avatar-img rounded-circle">
                    </div>
                  </td>
                  <td><?=$ks['status']?></td>
                  <td>
                    <div class="form-button-action">
                      <a data-toggle="tooltip" 
                        title="Edit Data Kepala Sekolah" href="<?=base_url('AdminController/editKepsek/')?><?=$ks['nuks']?>"
                        class="btn btn-link btn-primary btn-lg">
                        <i class="fa fa-edit"></i>
                      </a>
                      <button type="button"  data-toggle="tooltip" 
                      title="Hapus Data Kepala Sekolah" onclick='deleteKepsek(<?=$ks['nuks']?>)'
                      class="btn btn-link btn-danger" data-original-title="Remove">
                        <i class="fa fa-times"></i>
                      </button>
                    </div>
                  </td>
                </tr>
               <?php endforeach;} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  

<script>
  const deleteKepsek = (nuks) => {
    const url = `<?=base_url('ManageKepalaSekolahController/deleteKepsek/')?>${nuks}`;
    swal(`Apa anda yakin ingin menghapus Kepala Sekolah (${nuks})`,{ icon: 'info', buttons: ['Tidak', 'Iya'] })
      .then(iya => {
        if(iya){
          fetch(url)
            .then(res => res.json())
            .then(data => {
              swal(data.status, data.message, { icon: data.icon })
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