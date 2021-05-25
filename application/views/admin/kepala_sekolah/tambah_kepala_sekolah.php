<div class="page-inner">
  <div class="row">
    <div class="col-md-11">
      <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Form Tambah Kepala Sekolah</h3>
          </div>
          <div class="card-body">
            <form method="post" id="formKepsek" enctype="multipart/form-data">
              <div class="form-group">
                <label>NIP/NUKS</label>
                <input name="nip" id="nip" type="text" class="form-control" placeholder="NIP/NUPTK" required>								
              </div>
              <div class="form-group">
                <label>Nama Kepala Sekolah</label>
                <input name="nama" id="nama" type="text" class="form-control" placeholder="Nama dan Gelar" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input name="email" id="email" type="email" class="form-control" placeholder="Email" required>
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input onchange='preview(event)' id="foto" type="file" name="foto"><br>
                <div class="avatar avatar-xxl" id="display" style="display:none;">
                  <img id="gambar" alt="image upload" class="avatar-img rounded-circle" >
                </div>
              </div>
              <div class="form-group">
                <button id="saveKepsek" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

<script>
  const form = document.querySelector('#formKepsek');
  const saveKepsek = document.querySelector('#saveKepsek');
  const nip = document.querySelector('#nip');
  const nama = document.querySelector('#nama');
  const email = document.querySelector('#email');
  saveKepsek.addEventListener('click',(e) => {
    e.preventDefault();
    if(!nip.value || !nama.value || !email.value){
      swal('Warning', 'Tidak Boleh ada data yang kosong', { icon: 'warning'});
      return;
    }
    const option = {
      method: 'post',
      body: new FormData(form)
    }

    fetch(`<?=base_url('ManageKepalaSekolahController/simpanKepsek')?>`,option)
      .then(res => res.json())
      .then(data => {
        if(data.status === 'success'){
          swal(data.status, data.message, { icon: data.icon })
            .then(oK => {
              if(oK){
                window.location.href = `<?=base_url('AdminController/daftarKepsek')?>`;
              }
            })
        return;
        }
        swal(data.status, data.message, { icon: data.icon})
      })
  })

  const preview = (event) => {
    const gambar = document.querySelector('#gambar');
    const display = document.querySelector('#display');
    display.style.display = 'block';
    gambar.src = URL.createObjectURL(event.target.files[0]);
    gambar.onload = function() {
      URL.revokeObjectURL(gambar.src) // free memory
    }
  }
</script>