<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap4-toggle.min.css')?>">
<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h2 style="margin:0;">Absen Siswa</h2>
        </div>
        <form method="post">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Pertemuan</label>
                  <input name="pertemuan" value="<?=$pertemuan['pertemuan_ke'] + 1?>" type="text" class="form-control" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Tanggal</label>
                  <input name="tanggal" type="date" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Mata Pelajaran</label>
                  <input name="mapel" type="text" value="<?=$pertemuan['nama_mapel']?>" class="form-control" readonly>
                  <input type="hidden" name="kode_jadwal" value=<?=$pertemuan['kode_jadwal']?>>
                </div>
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Siswa</th>
                  <th>Absen</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach($siswa as $s): ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$s['nama_siswa']?></td>
                    <td>
                      <input type="hidden" name="nis[]" value="<?=$s['nis']?>">
                      <input type="checkbox" value="<?=$s['nis']?>" name="absen[]" onchange='handlechenge(event)' class="abasen-siswa" data-toggle="toggle" data-on="Hadir" data-off="Tidak Hadir" data-onstyle="success" data-offstyle="danger">
                    </td>
                    <td>
                      <select name="opsi[]" id="opsi-absen-<?=$s['nis']?>" >
                        <option value="A">Alpha</option>
                        <option value="I">Izin</option>
                        <option value="S">Sakit</option>
                        <option value="H" style='display:none;'>Hadir</option>
                      </select>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer text-right">
            <button type="submit" id="Absen" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  const handlechenge = (e) => {
    const hadir = 'Tidak Hadir';
    const opsi = document.querySelector(`#opsi-absen-${e.target.value}`);
    if(e.target.checked){
      opsi.style.display="none";
      opsi.value = 'H';
    }else{
      opsi.style.display="block";
      opsi.value = 'A';
    }
  }
  const absen = document.querySelector('#Absen');
  absen.addEventListener('click', (e) => {
    e.preventDefault();
    const myForm = document.querySelector('form');
    const formData = new FormData(myForm);
    const config = {
      method: 'post',
      body: formData
    };
    fetch(`<?=base_url('AbsenController/store')?>`, config)
      .then(res => res.json())
      .then(data => {
        if(data.status === 'success'){
          swal(data.message,{ icon: data.icon })
            .then(oK => {
              window.location.reload();
            })
        }else{
          swal(data.message, {icon: data.icon})
        }
      })
  })
</script>
