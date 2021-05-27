<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header"><h1>Laporan Absen Kelas (<?=$kelas[0]['nama_kelas']?>)</h1></div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <?php foreach($mapel as $m): ?>
                  <th><p style="writing-mode: tb-rl; margin:0;"><?=$m['nama_mapel']?></p></th>
                <?php endforeach; ?>
                <th><p style="writing-mode: tb-rl; margin:0;">Persentase</p></th>
              </tr>
            </thead>
            <tbody id="laporan">
            
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <a href="javascript:history.back()" class="btn btn-sm btn-dark"><i class="fa fa-arrow-left"></i> kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.onload = () => {
    const laporan = document.querySelector('#laporan');
    const getData = (kodeKelas) => {
      const url = `<?=base_url('LaporanAbsen/getDataLaporan/')?><?=$kode_kelas?>`;
      fetch(url).then(res => res.json())
        .then(data => {
          let html = '';
          let no = 1;
          data.forEach(item => {
            html += `<tr>`;
            html += `
              <td>${no++}</td>
              <td>${item.nama}</td>
            `;
            item.absen.forEach(absen => {
              html += `<td>${absen.jumlah_hadir}</td>`;
            })
            html += `
              <td>${item.persentase} %</td>
            </tr>`;
          })

          laporan.innerHTML = html;
        });
    }

    getData();
  }
</script>