<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="squareSelect">Ruang Kelas</label>
          <select class="form-control input-square" id="ruangKelas">
            <?php foreach($kelas as $k) : ?>
              <option value="<?=$k['kode_kelas']?>"><?=$k['nama_kelas']?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="squareSelect">Wali kelas</label>
          <select class="form-control input-square" id="waliKelas">
            <?php foreach($guru as $g) : ?>
              <option value="<?=$g['nip']?>"><?=$g['nama_guru']?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
            <label>Tahun Ajaran</label>
            <input id="tahunAjaran" type="text" placeholder="Tahun Ajaran..." class="form-control" required>
        </div>
        <div class="form-group">
          <label for="squareSelect">Semester</label>
          <select class="form-control input-square" id="semester">
            <option>Ganjil</option>
            <option>Genap</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" id="save" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edits -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kelas Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="squareSelect">Ruang Kelas</label>
          <select class="form-control input-square" id="ruangKelasEdit">
            <?php foreach($kelas as $k) : ?>
              <option value="<?=$k['kode_kelas']?>"><?=$k['nama_kelas']?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="squareSelect">Wali kelas</label>
          <select class="form-control input-square" id="waliKelasEdit">
            <?php foreach($guru as $g) : ?>
              <option value="<?=$g['nip']?>"><?=$g['nama_guru']?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Tahun Ajaran</label>
          <input id="tahunAjaranEdit" type="text" placeholder="Tahun Ajaran..." class="form-control" required>
        </div>
        <div class="form-group">
          <label for="squareSelect">Semester</label>
          <select class="form-control input-square" id="semesterEdit">
            <option>Ganjil</option>
            <option>Genap</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" id="saveEdit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>


<script>
  const fetchUrl = (url,data) => {
    return fetch(url,data)
      .then(res => res.json())
  }
  const ruangKelas = document.querySelector('#ruangKelas');
  const waliKelas = document.querySelector('#waliKelas');
  const tahunAjaran = document.querySelector('#tahunAjaran');
  const semester = document.querySelector('#semester');
  const save = document.querySelector('#save');
  save.addEventListener('click',(e) => {
    e.preventDefault();
    if(!tahunAjaran.value){
      swal('Warning','Tahun Ajaran tidak boleh kosong', { icon: 'warning' });
      return;
    }
    const data = {
      method: 'post',
      body: new URLSearchParams({
        ruang: ruangKelas.value,
        wali: waliKelas.value,
        tahun: tahunAjaran.value,
        semester: semester.value,
      }),
    };
    const url = `<?=base_url("KelasSiswaController/store")?>`;
    fetchUrl(url,data)
      .then(data => {
        if(data.status === 'fail') {
          swal(data.message,{ icon: data.icon })
          return;
        }
        swal(data.message,{ icon: data.icon })
          .then(ok => {
            if(ok){
              window.location.reload();
            }
          })
      })
  });

  const deleteKelas = (kode_kelas) => {
    const url = `<?=base_url("KelasSiswaController/delete/")?>${kode_kelas}`;
    const data = { method: 'get' }; 
    swal(`Anda yakin ingin menghapus kelas siswa ${kode_kelas}`,{ 
      icon: 'warning',
      buttons: ['Tidak','Iya'],
    }).then(res => {
      if(res){
        fetchUrl(url,data)
          .then(data => {
            swal(data.message,{ icon: data.icon })
              .then(ok => {
                if(ok){
                  window.location.reload();
                }
              })
          })
      }
    })
  }

  const ruangKelasEdit = document.querySelector('#ruangKelasEdit');
  const waliKelasEdit = document.querySelector('#waliKelasEdit');
  const tahunAjaranEdit = document.querySelector('#tahunAjaranEdit');
  const semesterEdit = document.querySelector('#semesterEdit');
  let kodeKelasEdit = '';
  const saveEdit = document.querySelector('#saveEdit');

  const modalEdit = (data) => {
    ruangKelasEdit.value = data.kode_kelas;
    waliKelasEdit.value = data.kode_walikelas;
    tahunAjaranEdit.value = data.tahun_ajaran;
    semesterEdit.value = data.semester;
    kodeKelasEdit = data.kode_kelas_siswa;
  }

  saveEdit.addEventListener('click',(e) =>{
    e.preventDefault();
    const data = {
      method: 'post',
      body: new URLSearchParams({
        ruang: ruangKelasEdit.value,
        wali: waliKelasEdit.value,
        tahun: tahunAjaranEdit.value,
        semester: semesterEdit.value,
      }),
    };
    const url = `<?=base_url('KelasSiswaController/update/')?>${kodeKelasEdit}`;
    fetchUrl(url,data)
      .then(data => {
        swal(data.message,{ icon: data.icon })
          .then(oK => {
            if(oK){
              window.location.reload();
            }
          })
      })
  })

  $('#kelas_siswa').DataTable();
</script>