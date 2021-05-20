<div class="page-inner">
  <div class="row"> 
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h2 class="h2">
            Profile
          </h2>
        </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <img src="<?=base_url('assets/images/profile/')?><?=$akun['foto']?>" alt="Foto Perofile" class="img-thumbnail" width="200px">
              </div>
              <div class="col-md-6">
                <table>
                  <tr>
                    <th>
                      <p>
                        <?php
                          if($this->session->userdata('role') === 'guru'){
                            echo "NIP";
                          }else if($this->session->userdata('role') === 'admin'){
                            echo "Kode Admin";
                          }else if($this->session->userdata('role') === 'siswa'){
                            echo "NIS";
                          }else if($this->session->userdata('role') === 'wali_kelas'){
                            echo "NIP";
                          }else if($this->session->userdata('role') === 'kepala_sekolah'){
                            echo "NUKS";
                          }
                        ?>  
                      </p>
                    </th>
                    <td> 
                      <p class="ml-4">
                        <?=$akun['kode']?>  
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <th><p>Nama</p></th>
                    <td> 
                      <p class="ml-4"> 
                        <?=$akun['nama']?>  
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <th><p>Email</p></th>
                    <td> 
                      <p class="ml-4">
                      <?= $akun['email'] ?>  
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <th><p>Status</p></th>
                    <td> <p class="ml-4"><?=$akun['status']?></p></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" data-toggle="modal" data-target="#profile-img"><i class="fa fa-image"></i> Ganti Foto</button>
          <button class="btn btn-warning" data-toggle="modal" data-target="#ganti-password"><i class="fa fa-key"></i> Ganti Password</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="profile-img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <form method="post" enctype="multipart/form-data" id="profile-form">
          <div class="custom-file">
            <input type="hidden" id="kode" >
            <input type="file" onchange='preview(event)' accept="image/x-png,image/gif,image/jpeg"" class="custom-file-input" id="customFile">
            <label class="custom-file-label" id="gambar_label" for="customFile">Choose file</label>
          </div>
          <div class="mt-4" >
            <img name="gambar" id="gambar" alt="image upload" width="200" class="img-thumbnail" >
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" id="saveProfile" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ganti Password -->
<div class="modal fade" id="ganti-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="profile-form">
          <div class="form-group">
            <label>Password</label>
            <input name="password" id="password" type="password" class="form-control" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label>Ulangi Password</label>
            <input name="newPassword" id="newPassword" type="password" class="form-control" placeholder="Ketik Ulang password" required>
            <small id="err" class="text-danger"></small>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" id="savePassword" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
  const gambar = document.querySelector('#gambar');
  const saveProfile = document.querySelector('#saveProfile');
  const savePassword = document.querySelector('#savePassword');
  const password = document.querySelector('#password');
  const newPassword = document.querySelector('#newPassword');
  const gambar_label = document.querySelector('#gambar_label');
  window.onload = () => {
    gambar.src = `<?=base_url('assets/images/profile/')?><?=$akun['foto']?>`;
    
  }
  const preview = (event) => {
    gambar_label.innerHTML = event.target.files[0].name;
    gambar.src= URL.createObjectURL(event.target.files[0]);
    gambar.onload = function() {
      URL.revokeObjectURL(gambar.src) // free memory
    }
  }
  saveProfile.addEventListener('click',(e) => {
    e.preventDefault();
    const formData = new FormData();
    const foto = document.querySelector('#customFile');
    formData.append('foto',foto.files[0]);
    const config = {
      method: 'post',
      body: formData
    };
    fetch(`<?=base_url('AkunController/gantiFoto/').$akun['kode']?>`, config)
    .then(res => res.json())
    .then(data => {
      swal( data.status, data.message, { icon: data.icon })
        .then(oK => {
          if(oK){
            window.location.reload();
          }
        })
    })
  })

  newPassword.addEventListener('keyup',(e) => {
    cekPassword(password.value,newPassword.value);
  })

  savePassword.addEventListener('click', (e) => {
    const cek = cekPassword(password.value,newPassword.value);
    if(cek){
      const data = {
        password: newPassword.value,
      }
      fetch(`<?=base_url('AkunController/gantiPassword/').$akun['kode']?>`,{
        method: 'post',
        body: new URLSearchParams(data)
      })
        .then(res => res.json())
        .then(data => {
          if(data.status === 'success'){
            swal(data.status, data.message, { icon: data.icon })
            .then(oK => {
                if(oK) {
                  console.log('ok diclick');
                  window.location.href = `<?=base_url('Auth/logout')?>`;
                }
              })

            return;
          }
          swal(data.status, data.message, { icon: data.icon })
        })
      return;
    }

    swal('Gagal!!!','Password tidak sama', { icon: 'warning' });
  })

  const cekPassword = (password,newPassword) => {
    const err = document.querySelector('#err');
    if(password !== newPassword) {
      err.innerHTML = 'Password tidak sama';
      return false;
    }
    err.innerHTML = '';
    return true;
  }
</script>