<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Form Tambah Jadwal</h3>
          </div>
          <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="squareSelect">Mata Pelajaran</label>
                    <select class="form-control input-square" id="mapel">
                      <?php foreach($mapel as $m): ?>
                        <option value="<?=$m['kode_mapel']?>"><?=$m['nama_mapel']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="squareSelect">Kelas</label>
                    <select class="form-control input-square" id="kelas">
                      <?php foreach($kelas as $k): ?>
                        <option value="<?=$k['kode_kelas_siswa']?>"><?=$k['nama_kelas']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="squareSelect">Guru</label>
                    <select class="form-control input-square" id="Guru">
                      <?php foreach($guru as $g): ?>
                        <option value="<?=$g['nip']?>"><?=$g['nama_guru']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="squareSelect">Hari</label>
                    <select class="form-control input-square" id="hari">
                      <?php foreach($hari as $h): ?>
                        <option><?=$h?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Jam Ke</label>
                    <input id="jam_ke" type="text" class="form-control" placeholder="1-10" required>
                  </div>
                  <div class="form-group">
                    <label>Waktu</label>
                    <input id="waktu" type="text" class="form-control" placeholder="00.00-00.00" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button id="saveJadwal" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

<script>
  const mapel = document.querySelector('#mapel');
  const kelas = document.querySelector('#kelas');
  const guru = document.querySelector('#Guru');
  const hari = document.querySelector('#hari');
  const jam_ke = document.querySelector('#jam_ke');
  const waktu = document.querySelector('#waktu');
  const saveJadwal = document.querySelector('#saveJadwal');
  saveJadwal.addEventListener('click',(e)=>{
    e.preventDefault();
    if (!jam_ke.value) {
      swal('Warning', 'Jam Pelajaran Tidak boleh kosong', { icon: 'warning'});
      return;
    }
    if (!waktu.value) {
      swal('Warning', 'Waktu Pelajaran Tidak boleh kosong', { icon: 'warning'});
      return;
    }
    const data = {
      method: 'post',
      body: new URLSearchParams({
        mapel: mapel.value,
        kelas: kelas.value,
        guru: guru.value,
        hari: hari.value,
        jam_ke: jam_ke.value,
        waktu: waktu.value,
      }),
    };
    const url = `<?=base_url('JadwalController/store')?>`;
    fetch(url, data)
      .then(res => res.json())
      .then(data => {
        swal(data.message,{ icon: data.icon })
          .then(oK => {
            if(oK){
              window.location.href = `<?=base_url('AdminController/jadwal')?>`;
            }
          })
      })
  })
</script>
