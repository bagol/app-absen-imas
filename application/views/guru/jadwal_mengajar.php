<div class="page-inner">
  <div class="row">
    <?php foreach( $jadwal as $j ): ?>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-3"><?=$j['nama_mapel']?></h5>
            <h6 class="card-subtitle mb-2 text-muted">Kelas <?=$j['nama_kelas']?></h6>
            <p class="card-text">
              Hari : <?=$j['hari']?><br>
              Jam Ke : <?=$j['jam_ke']?><br>
              Waktu : <?=$j['waktu']?>
            </p>
              
                  <a href="<?=base_url('GuruController/absen/')?><?=$j['kode_jadwal']?>" class="btn btn-primary" style="width:100%;"> 
                    <i class="fas fa-clipboard-list"></i>  Absen
                  </a>
                  <a href="<?=base_url('GuruController/rekapAbsen')?>" class="btn btn-info mt-2" style="width:100%;">
                    <i class="fas fa-list-alt"></i> Rekap Absen
                  </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>