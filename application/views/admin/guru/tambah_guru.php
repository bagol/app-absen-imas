<div class="page-inner">
  <div class="row">
    <div class="col-md-11">
      <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Form Tambah Guru</h3>
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>NIP/NUPTK</label>
                <input id="nip" type="text" class="form-control" placeholder="NIP/NUPTK" required>								
              </div>
              <div class="form-group">
                <label>Nama Guru</label>
                <input id="nama" type="text" class="form-control" placeholder="Nama dan Gelar" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input id="email" type="email" class="form-control" placeholder="Email" required>
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input onchange='preview(event)' id="foto" type="file" name="foto"><br>
                <div class="avatar avatar-xxl" id="display" style="display:none;">
                  <img id="gambar" alt="image upload" class="avatar-img rounded-circle" >
                </div>
              </div>
              <div class="form-group">
                <button id="saveGuru" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
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
    const saveGuru = document.querySelector('#saveGuru');
    saveGuru.addEventListener('click', (e) => {
      e.preventDefault();
      if(!nip.value || !nama.value || !email.value){
        swal('Warning', 'Tidak boleh ada data yang kosong', { icon: 'warning'});
        return;
      }
      const formData = new FormData();
      formData.append('nip',nip.value);
      formData.append('nama',nama.value);
      formData.append('email',email.value);
      formData.append('foto',foto.files[0]);
      const data = {
        method: 'post',
        // header: {
        //   'Conten-Type':'multipart/form-data',
        // },
        body: formData, 
      };
      const url = `<?=base_url("ManageGuruController/store")?>`;

      fetch(url,data)
        .then(res => res.json())
        .then(data => {
          if(data.status === 'success'){
            swal(data.message,{ icon: data.icon })
            .then(oK => {
              if(oK){
                window.location.href = `<?=base_url("AdminController/daftarGuru")?>`;
              }
            })
          }else{
            swal(data.message,{ icon: data.icon })
          }
        })
    });
  }
  
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