<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Form Import Data Siswa</h3>
          </div>
          <div class="card-body">
            <form enctype="multipart/form-data">
              <div class="row justify-content-center">
                <div class="col-md-3">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="kelas">Kelas</label>
                    </div>
                    <select class="custom-select" id="kelas">
                      <option value="" selected>Pilih Kelas</option>
                      <?php foreach($kelas as $k): ?>
                        <option value="<?=$k['kode_kelas_siswa']?>"><?=$k['nama_kelas']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-file"></i></span>
                    </div>
                    <div class="custom-file">
                      <input type="file" name="siswa" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="custom-file-input" id="file_siswa">
                      <label class="custom-file-label" for="file_siswa" id="siswa_label">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <button type="submit" id="importFile" class="btn btn-primary"><i class="fas fa-file-import"></i> Import</button>
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
		<div class="col-md-12">
		  <div class="card">
			  <div class="card-header">
					<b>Data Berhasil diimport</b>
				</div>
				<div class="card-body">
					<table class="table table-sm" id='success'>
						<thead>
							<tr>
								<th>NISN / NIS</th>
								<th>Nama Siswa</th>
								<th>Alamat</th>
								<th>Tahun Masuk</th>
							</tr>
						</thead>
						<tbody id="tSuccess">
							<tr>
								<td colspan="4" class="text-center"> Belum Ada data </td>
								<td style="display:none;"></td>
								<td style="display:none;"></td>
								<td style="display:none;"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
    <div class="col-md-12">
      <div class="card">
				<div class="card-header">
				  <b>Data Gagal diimport</b>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-sm" id="fail">
							<thead>
								<tr>
									<th>NISN / NIS</th>
									<th>Nama Siswa</th>
									<th>Alamat</th>
								<th>Tahun Masuk</th>
									<th>Error</th>
								</tr>
							</thead>
							<tbody id="tFail">
								<tr>
									<td colspan="5" class="text-center">Belum Ada Data</td>
									<td style="display:none;"></td>
									<td style="display:none;"></td>
									<td style="display:none;"></td>
									<td style="display:none;"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="<?=base_url('assets/loading/')?>slick-loader.min.css" />
<script src="<?=base_url('assets/loading/')?>slick-loader.min.js"></script>
<script>
  const file_siswa = document.querySelector('#file_siswa');
  const siswa_label = document.querySelector('#siswa_label');
  const kelas = document.querySelector('#kelas');
  const importFile = document.querySelector('#importFile');
  const tSuccess = document.querySelector('#tSuccess');
  const tFail = document.querySelector('#tFail');

	// get filename for label inport file
  file_siswa.addEventListener('change',(e)=> {
    siswa_label.innerText = e.target.files[0].name;
  })

	// import file
  importFile.addEventListener('click', (e) => {
    e.preventDefault();
    if(kelas.value === ''){
      swal('Kelas harus dipilih',{ icon: 'info'})
      return;
    }
		SlickLoader.setText('Mohon Tunggu','Data Seadang diimport...');
    SlickLoader.enable();
    const myForm = document.querySelector('form');
    const formData = new FormData(myForm);
    const data = {
      method: 'post',
      body: formData,
    }
    const url = `<?=base_url('SiswaController/importSiswa/')?>${kelas.value}`;
    fetch(url, data).then(res => res.json())
    .then(data => {
      SlickLoader.disable();
      if(data.status === 'success'){
        displaySuccess(data.dataSuccess)
				displayFail(data.dataFail)
      }else{
        swal(data.message, { icon: data.icon })
      }
    })
  })

	const displaySuccess = (data) => {
		let html = '';
		data.forEach(siswa => {
			html += `
				<tr>
					<td>${siswa.nis}</td>
					<td>${siswa.nama_siswa}</td>
					<td>${siswa.alamat}</td>
					<td>${siswa.tahun_angkatan}</td>
				</tr>
			`;
		})
		tSuccess.innerHTML = html;
		$('#success').DataTable();
	}
	const displayFail = (data) => {
		let html = '';
		data.forEach(siswa => {
			html += `
				<tr>
					<td>${siswa.nis}</td>
					<td>${siswa.nama_siswa}</td>
					<td>${siswa.alamat}</td>
					<td>${siswa.tahun_angkatan}</td>
					<td>${siswa.error}</td>
				</tr>
			`;
		})
		tFail.innerHTML = html;
		$('#fail').DataTable();
	}
</script>