<div class="page-inner">
  <div class="row">
    <div class="col-md-11">
      <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Form Edit Kepala Sekolah</h3>
          </div>
          <div class="card-body">
            <form id="formKepsek" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>NIP/NUKS</label>
                <input id="nip" type="text" value="<?=$kepsek['nuks']?>" class="form-control" readonly>								
              </div>
              <div class="form-group">
                <label>Nama Kepala Sekolah</label>
                <input name="nama" type="text" value="<?=$kepsek['nama_kepala_sekolah']?>" class="form-control"  required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" value="<?=$kepsek['email_kepala_sekolah']?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="squareSelect">Status</label>
                <select class="form-control input-square" name="status">
                  <option <?= $kepsek['status'] === 'aktif'? 'checked' :'';?>>aktif</option>
                  <option <?= $kepsek['status'] === 'non-aktif' ? 'checked' :'';?>>non-aktif</option>
                </select>
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input onchange='preview(event)' id="foto" type="file" name="foto"><br>
                <div class="avatar avatar-xxl">
                  <img id="gambar" src="<?=base_url('assets/images/profile/')?><?=$kepsek['foto']?>" class="avatar-img rounded-circle" alt="Profile Image" width="300px" >
                </div>
              </div>
              <div class="form-group">
                <button id="saveKepsek" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

<script>
  const formKepsek = document.querySelector('#formKepsek');
  const saveKepsek = document.querySelector('#saveKepsek');
  const nuks = document.querySelector('#nip');

  saveKepsek.addEventListener('click',(e) => {
    e.preventDefault();
    const option = {
      method: 'post',
      body: new FormData(formKepsek)
    };

    fetch(`<?=base_url('ManageKepalaSekolahController/editKepsek/')?>${nuks.value}`, option)
      .then(res => res.json())
      .then(data => {
        swal(data.status, data.message, { icon: data.icon })
      })
  })

  const preview = (event) => {
    const gambar = document.querySelector('#gambar');
    gambar.style.display = 'block';
    gambar.src = URL.createObjectURL(event.target.files[0]);
    gambar.onload = function() {
      URL.revokeObjectURL(gambar.src) // free memory
    }
  }
</script>