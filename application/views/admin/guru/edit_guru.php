<div class="page-inner">
  <div class="row">
    <div class="col-md-11">
      <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Form Edit Guru</h3>
          </div>
          <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>NIP/NUPTK</label>
                <input id="nip" type="text" value="<?=$guru['nip']?>" class="form-control" readonly>								
              </div>
              <div class="form-group">
                <label>Nama Guru</label>
                <input id="nama" type="text" value="<?=$guru['nama_guru']?>" class="form-control"  required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input id="email" type="email" value="<?=$guru['email_guru']?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="squareSelect">Status</label>
                <select class="form-control input-square" id="status">
                  <option <?= $guru['status'] === 'aktif'? 'checked' :'';?>>aktif</option>
                  <option <?= $guru['status'] === 'non-aktif' ? 'checked' :'';?>>non-aktif</option>
                </select>
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input onchange='preview(event)' id="foto" type="file" name="foto"><br>
                <div class="avatar avatar-xxl">
                  <img id="gambar" src="<?=base_url('assets/images/profile/')?><?=$guru['foto']?>" class="avatar-img rounded-circle" alt="Profile Image" width="300px" >
                </div>
              </div>
              <div class="form-group">
                <button id="saveGuru" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.onload = () => {
    const nip = document.querySelector('#nip');
    const nama = document.querySelector('#nama');
    const email = document.querySelector('#email');
    const foto = document.querySelector('#foto');
    const status = document.querySelector('#status');
    const saveGuru = document.querySelector('#saveGuru');
    saveGuru.addEventListener('click', (e) => {
      e.preventDefault()
      const formData = new FormData();
      formData.append('nama',nama.value);
      formData.append('email',email.value);
      formData.append('status',status.value);
      formData.append('foto',foto.files[0]);
      const url = `<?=base_url('ManageGuruController/editGuru/')?>${nip.value}`;
      const data = {
        method: 'post',
        // header: {
        //   'Conten-Type': 'multipart/form-data',
        // },
        body: formData,
      };
      fetch(url, data)
        .then(res => res.json())
        .then(data => {
          swal(data.message,{ icon: data.icon })
            .then(oK => {
              if(oK){
                window.location.reload();
              }
            });
        })
    })
  }
  const preview = (event) => {
    const gambar = document.querySelector('#gambar');
    gambar.style.display = 'block';
    gambar.src = URL.createObjectURL(event.target.files[0]);
    gambar.onload = function() {
      URL.revokeObjectURL(gambar.src) // free memory
    }
  }
</script>
