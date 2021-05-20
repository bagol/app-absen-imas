<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Form Tambah Siswa</h3>
          </div>
          <div class="card-body">
            <form  id="myForm" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>NIS / NISN</label>
                    <input name="nisn" id="nisn" type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" class="form-control" placeholder="NISN Siswa" required>
                  </div>
                  <div class="form-group">
                    <label>Nama Peserta Didik</label>
                    <input name="nama_siswa" id="nama_siswa" type="text" class="form-control" placeholder="Nama Lengkap Siswa" required>
                  </div>
                  <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input name="tempat_lahir" id="tempat_lahir" type="text" class="form-control" placeholder="Tempat Lahir" required>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input name="tanggal_lahir" id="tanggal_lahir" type="date" class="form-control" placeholder="Tanggal Lahir" required>
                  </div>
                  <div class="form-group">
                    <label for="squareSelect">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control input-square" id="jenis_kelamin">
                      <option>laki-laki</option>
                      <option>perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="squareSelect">Status</label>
                    <select class="form-control input-square" id="status" name="status">
                      <option>aktif</option>
                      <option>non-aktif</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tahun Masuk</label>
                    <input id="tahun_angkatan" name="tahun_angkatan" type="text" class="form-control" placeholder="2020/2021" required>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input id="alamat" type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                  </div>
                  <div class="form-group">
                    <label for="squareSelect">Kelas</label>
                    <select class="form-control input-square" name="kelas" id="kelas">
                      <?php foreach($kelas as $k):?>
                        <option value="<?=$k['kode_kelas_siswa']?>"><?= $k['nama_kelas'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Foto</label>
                    <input id="foto" type="file" class="form-control" name="foto">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button id="saveSiswa" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

<script>
  const nisn = document.querySelector('#nisn');
  const nama_siswa = document.querySelector('#nama_siswa');
  const tempat_lahir = document.querySelector('#tempat_lahir');
  const tanggal_lahir = document.querySelector('#tanggal_lahir');
  const jenis_kelamin = document.querySelector('#jenis_kelamin');
  const status = document.querySelector('#status');
  const tahun_angkatan = document.querySelector('#tahun_angkatan');
  const kelas = document.querySelector('#kelas');
  const alamat = document.querySelector('#alamat');
  const foto = document.querySelector('#foto');
  const saveSiswa = document.querySelector('#saveSiswa');
  const myForm = document.querySelector('form');
  saveSiswa.addEventListener('click',(e) => {
    e.preventDefault();
    
    const formData = new FormData(myForm);
    const data = {
      method: 'post',
      body: formData,
    }
    const url = `<?=base_url("SiswaController/store")?>`;
    fetch(url, data).then(res => res.json())
      .then(data => {
        console.log(data)
        if(data.status === 'success'){
          swal(data.message, { icon: data.icon })
          .then(oK => {
            if (oK) {
              window.location.href = `<?=base_url('AdminController/daftarSiswa')?>`;
            }
          })
        }else{
          swal(data.message, { icon: data.icon })
        }
      })
  })
</script>