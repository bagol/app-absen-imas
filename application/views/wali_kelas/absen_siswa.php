
<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body table-responsive">
            <table class="table text-center">
              <thead>
                <tr id="bookAbsenHead">
                  <th>Nama Siswa</th>
                  <th>Hadir</th>
                  <th>Izin</th>
                  <th>Alpha</th>
                </tr>
              </thead>
              <tbody id="bookAbsen">
                <tr>
                  <td colspan="4" class="text-center">Silahkan Pilih Mapel</td>
                </tr>
              </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="javascript:history.back()" class="btn btn-sm btn-dark"><i class="fa fa-arrow-left"></i>Kembali</a>
            <a class="btn btn-sm btn-primary" id="cetak" target="_blank"><i class="fa fa-print"></i> Cetak </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const cetak = document.querySelector('#cetak');
  const bookAbsen = document.querySelector('#bookAbsen');
  const bookAbsenHead = document.querySelector('#bookAbsenHead');

  window.onload = () => {
    fetch(`<?=base_url('AbsenController/getAbsen/')?><?=$kode_jadwal?>`)
      .then(res => res.json())
      .then(data => {
        let html = '';
        const dataAbsen = {
          hadir: 0 ,
          izin: 0,
          alpha: 0
        };
        data.data.forEach(item => {
          html += `<tr>`;
          html += `<td ><p style="width:200px;">${item.nama}</p></td>`;
          item.absen.forEach(absen => {
            if(absen.ket === 'H') {
              dataAbsen.hadir++;
            }else if(absen.ket === 'I') {
              dataAbsen.izin++;
            }else if(absen.ket === 'A') {
              dataAbsen.alpha++;
            }
            html += `<td >${absen.ket}</td>`;
          })
          html += `
            <td class="text-success"><b>${ item.totalAbsen.hadir }</b></td>
            <td class="text-warning"><b>${ item.totalAbsen.izin }</b></td>
            <td class="text-danger"><b>${ item.totalAbsen.alpha }</b></td>
          `;
          html += `</tr>`;
        })

        bookAbsen.innerHTML = html;
        let head = '<th>Nama Siswa</th>';
        data.pertemuan.forEach(pertemuan => {
          if(pertemuan.tanggal === null) return; 
          head += `<th><p style="writing-mode: tb-rl;">${pertemuan.tanggal}</p></th>`;
        })
        head += `
          <th><p style="writing-mode: tb-rl; margin:0;">Hadir</p></th>
          <th><p style="writing-mode: tb-rl; margin:0;">Izin</p></th>
          <th><p style="writing-mode: tb-rl; margin:0;">Alpha</p></th>
        `;
        bookAbsenHead.innerHTML = head;
        cetak.href = `<?=base_url("CetakController/cetak/")?><?=$kode_jadwal?>`;
      })
  }
</script>