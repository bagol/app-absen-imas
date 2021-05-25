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
              <label>Kode Mapel</label>
              <input id="kode" type="text" value="<?="MP-".date("Y").rand(9000,10000)?>" class="form-control" readonly>
          </div>
          <div class="form-group">
              <label>Nama Mapel</label>
              <input id="nama" type="text" placeholder="Nama Mata Pelajaran .." class="form-control" autocomplete="off" required>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
              <label>Kode Mapel</label>
              <input id="kodeEdit" type="text" class="form-control" readonly>
          </div>
          <div class="form-group">
              <label>Nama Mapel</label>
              <input id="namaEdit" type="text" class="form-control" autocomplete="off" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" id="saveEdit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- script -->
<script>
  const kodeMapel = document.querySelector('#kode');
  const namaMapel = document.querySelector('#nama');
  const kodeEdit = document.querySelector('#kodeEdit');
  const namaEdit = document.querySelector('#namaEdit');
  const save = document.querySelector('#save');
  const saveEdit = document.querySelector('#saveEdit');
  const editModal = (data) => {
    kodeEdit.value = data.kode_mapel;
    namaEdit.value = data.nama_mapel;
  }
  save.addEventListener('click',(e) => {
    e.preventDefault();
    if(!namaMapel.value){
      swal('Warning','Nama Mapel Tidak boleh Kosong', { icon: 'warning'});
      return;
    }
    const data = {
      method: 'post',
      body: new URLSearchParams({ kode: kodeMapel. value,mapel: namaMapel.value }),
    };
    const url = `<?=base_url('MapelController/store')?>`;
    console.log(url)
    fetchUrl(url,data)
      .then(data => {
        if(data.status === 'success'){
          swal(data.message,{
            icon: 'success',
          }).then(oK => {
            if(oK){
              window.location.reload();
            }
          })
        }else{
          swal(data.message,{
            icon: 'warning',
          }).then(oK => {
            if(oK){
              window.location.reload();
            }
          })
        }
      })
  })

  saveEdit.addEventListener('click',(e) => {
    e.preventDefault();
    const data = {
      method: 'post',
      body: new URLSearchParams({ mapel: namaEdit.value}),
    }
    const url = `<?=base_url('MapelController/update/')?>${kodeEdit.value}`;
    fetchUrl(url,data)
      .then(data => {
        if(data.status === 'success'){
          swal(data.message,{ icon: 'success' })
            .then(oke => {
              if(oke){
                window.location.reload();
              }
            })
        }else{
          swal(data.message,{ icon: 'warnig' })
            .then(oke => {
              if(oke){
                window.location.reload();
              }
            })
        }
      })
  })

  const fetchUrl = (url,data) => {
    return fetch(url,data)
            .then(res => res.json());
  }

  const deleteMapel = (kode,mapel) => {
    const url = `<?=base_url('MapelController/delete/')?>`;
    const data = {
      method: 'get'
    };
    swal(`Apa Anda Yakin ingin menghapus Mata Pelajaran (${mapel})`,{
      icon: 'warning',
      buttons: ['Tidak','Iya']
    })
      .then(Iyas => {
        if(Iyas){
          fetchUrl(url+kode,data)
            .then(data => {
              if(data.status === 'success'){
                swal('data berhasil dihapus',{icon:'success'})
                  .then(data => {
                    if(data){
                      window.location.reload();
                    }
                  })
              }else{
                swal(data.message,{icon:'warning'})
                  .then(data => {
                    if(data){
                      window.location.reload();
                    }
                  })
              }
            })
        }
      })
  }
</script>