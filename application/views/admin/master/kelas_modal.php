<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
              <label>Kode Kelas</label>
              <input name="kode" id="kode" type="text" value="KL-<?=time();?>" class="form-control" readonly>
          </div>
          <div class="form-group">
              <label>Nama Kelas</label>
              <input name="kelas" id="nama" type="text" placeholder="Nama kelas .." class="form-control" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" id="save" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Kode Kelas</label>
            <input name="kode" id="kodeEdit" type="text" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Nama Kelas</label>
            <input name="kelas" id="namaEdit" type="text" placeholder="Nama kelas .." class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" id="editSave" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>


<script>
  const kode = document.querySelector('#kode');
  const nama = document.querySelector('#nama');
  const kodeEdit = document.querySelector('#kodeEdit');
  const namaEdit = document.querySelector('#namaEdit');
  const save = document.querySelector('#save');
  const editSave = document.querySelector('#editSave');

  const editClick = (kode, nama) => {
    kodeEdit.value = kode;
    namaEdit.value = nama;
  }
  save.addEventListener('click',(e) => {
    e.preventDefault();
    if(!kode.value || !nama.value){
      swal('Warning', 'Nama Kelas tidak boleh kosong', { icon: 'warning' });
      return;
    }
    const data  ={
      method: 'post',
      body: new URLSearchParams({ kode: kode.value, kelas: nama.value }),
    }
    fetch(`<?=base_url('KelasController/store')?>`,data)
      .then(res => res.json())
      .then(data => {
        if(data.status === 'success'){
          swal(data.message,{
            icon:'success'
          }).then(status => {
            if(status) {
              window.location.reload();
            }
          })
        }else{
          swal(data.message,{
            icon:'warning'
          }).then(status => {
            if(status) {
              window.location.reload();
            }
          })
        }
      })
      .catch(err => console.log(err))
  });

  editSave.addEventListener('click',(e) => {
    e.preventDefault();
    const data = {
      method: 'post',
      body: new URLSearchParams({ kelas: namaEdit.value }),
    }
    console.log(namaEdit.value)
    fetch(`<?=base_url('KelasController/update/')?>${kodeEdit.value}`,data)
      .then(res => res.json())
      .then(data => {
        if(data.status === 'success'){
          swal(data.message,{
            icon:'success'
          }).then(status => {
            if(status) {
              window.location.reload();
            }
          })
        }else{
          swal(data.message,{
            icon:'warning'
          }).then(status => {
            if(status) {
              window.location.reload();
            }
          })
        }
      })
      .catch(err => console.log(err))
  })

  const deleteKelas = (kode) => {
    swal(`Apa Anda yakin ingin menghapus ${kode}`,{
      icon: 'warning',
      buttons: ['tidak','iya']
    }).then(data => {
      if(data){
        fetch(`<?=base_url('KelasController/delete/')?>${kode}`)
          .then(res => res.json())
          .then(data => {
            if (data.status === 'success'){
              window.location.reload();
            }
          })
      }
    })
  }

  $('#kelas').DataTable();
</script>

