<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header"><h2>Absen</h2></div>
        <div class="card-body">
          <?php if($jadwal){ ?>
          <?php foreach($jadwal as $j): ?>
            <a href="<?=base_url('WaliKelasController/absenSiswa/')?><?=$j['kode_jadwal']?>">
              <div class="alert alert-success alert-dismissible" role="alert">
                <strong><?=$j['nama_mapel']?></strong> 
              </div>
            </a>
          <?php endforeach;} else { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <strong>Tidak Ada Jadwal</strong> 
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>