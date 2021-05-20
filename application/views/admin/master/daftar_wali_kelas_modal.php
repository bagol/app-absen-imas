<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Wali Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="saveForm">
          <div class="form-group">
            <label>NIP/NUPTK</label>
            <input name="nip" type="text" 
              class="form-control" placeholder="NIP/NUPTK" 
              onkeyup="this.value=this.value.replace(/[^\d]/,'')" required
            >								
          </div>
          <div class="form-group">
            <label>Nama Wali Kelas</label>
            <input name="nama" type="text" class="form-control" placeholder="Nama dan Gelar" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="form-group">
            <label>Foto</label>
            <input id="foto" type="file" name="foto"><br>
            <div class="avatar avatar-xxl" id="display" style="display:none;">
              <img name="gambar" id="gambar" alt="image upload" class="avatar-img rounded-circle" >
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" id="saveWali" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Wali Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="editForm">
          <div class="form-group">
            <label>NIP/NUPTK</label>
            <input id="nip" name="nip" type="text" 
              class="form-control" placeholder="NIP/NUPTK" readonly
            >								
          </div>
          <div class="form-group">
            <label>Nama Wali Kelas</label>
            <input name="nama" id="nama" type="text" class="form-control" placeholder="Nama dan Gelar" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input name="email" id="email" type="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="form-group">
            <label>Foto</label>
            <input id="fotoEdit" type="file" name="foto"><br>
            <div class="avatar avatar-xxl" >
              <img name="gambar" id="fotoWali" alt="image upload" class="avatar-img rounded-circle" >
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" id="saveEditWali" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>


<script>
  const foto = document.querySelector('#foto');
  const saveWali = document.querySelector('#saveWali');
  saveWali.addEventListener('click', (e) => {
    e.preventDefault();
    const myForm = document.querySelector('form');
    const formData = new FormData(saveForm);
    const data = {
      method: 'post',
      'body': formData
    };
    const url= `<?=base_url('ManageWaliKelasController/store')?>`;
    fetch(url, data).then(res => res.json())
      .then(data => {
        swal(data.message, { icon: data.icon })
          .then(oK => {
            if (oK) {
              window.location.reload();
            }
          })
      })
  })
  foto.addEventListener('change',(e) => {
    preview(e);
  })
  const preview = (event) => {
    const gambar = document.querySelector('#gambar');
    const display = document.querySelector('#display');
    display.style.display = 'block';
    gambar.src= URL.createObjectURL(event.target.files[0]);
    gambar.onload = function() {
      URL.revokeObjectURL(gambar.src) // free memory
    }
  }

  // data Bagian Modal edit
  const nip = document.querySelector('#nip');
  const nama = document.querySelector('#nama');
  const email = document.querySelector('#email');
  const fotoWali = document.querySelector('#fotoWali');
  const saveEditWali = document.querySelector('#saveEditWali');
  const fotoEdit = document.querySelector('#fotoEdit');
  fotoEdit.addEventListener('change',(e) => {
    console.log(e)
    previewEdit(e);
  })
  const editWaliKelas = (data) => {
    nip.value = data.nip;
    nama.value = data.nama_wali_kelas;
    email.value = data.email_wali_kelas;
    fotoWali.src = `<?=base_url('assets/images/profile/')?>${data.foto}`;
  }

  saveEditWali.addEventListener('click', (e) => {
    e.preventDefault();
    const form = document.querySelector('#editForm');
    const editData = new FormData(form);
    const data = {
      method: 'post',
      body: editData,
    };
    const url = `<?=base_url('ManageWaliKelasController/update/')?>${nip.value}`;
    fetch(url, data).then(res => res.json())
      .then(data => {
        swal(data.message, { icon: data.icon })
          .then(oK => {
            if(oK){
              window.location.reload();
            }
          })
      })
  })
  const previewEdit = (event) => {
    fotoWali.src= URL.createObjectURL(event.target.files[0]);
    fotoWali.onload = function() {
      URL.revokeObjectURL(fotoWali.src) // free memory
    }
  }
  
  
</script>
