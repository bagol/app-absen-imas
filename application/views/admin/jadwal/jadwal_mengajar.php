<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
              <a class="btn btn-primary btn-sm text-white" href="<?=base_url("AdminController/tambahJadwal")?>"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Mata Pelajaran</th>
                  <th>Pengajar</th>
                  <th>Kelas</th>
                  <th>Hari</th>
                  <th>Jam Ke</th>
                  <th>Waktu</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!$jadwal) { ?>
                  <tr>
                    <td colspan="7">Belum ada Data</td>
                  </tr>
                <?php }else{ $no= 1; foreach($jadwal as $k) : ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$k['nama_mapel']?></td>
                    <td><?=$k['nama_guru']?></td>
                    <td><?=$k['nama_kelas']?></td>
                    <td><?=$k['hari']?></td>
                    <td><?=$k['jam_ke']?></td>
                    <td><?=$k['waktu']?></td>
                    <td>
                      <div class="form-button-action">
                        <a data-toggle="tooltip" 
                          title="Edit Jadwal" href="<?=base_url('AdminController/editJadwal/')?><?=$k['kode_jadwal']?>"
                          class="btn btn-link btn-primary btn-lg">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button"  data-toggle="tooltip" 
                        title="hapus Jadwal" onclick='deleteJadwal(<?=$k['kode_jadwal']?>)'
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
  const deleteJadwal = (kode) => {
    const url = `<?=base_url('JadwalController/deleteJadwal/')?>${kode}`;
    swal(`Apakah anda yakin ingin menghapus Jadwal ${kode}`,{
      icon: 'info',
      buttons: ['Tidak','Iya']
    }).then(iya => {
      if(iya){
        fetch(url).then(res => res.json())
          .then(data => {
            swal(data.message,{ icon: data.icon })
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