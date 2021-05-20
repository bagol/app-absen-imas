<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header"><h2>Absen</h2></div>
        <div class="card-body">
          <?php foreach($jadwal as $j): ?>
            <a href="<?=base_url('DashboardSiswaController/rekapAbsen/')?><?=$j['kode_jadwal']?>">
              <div class="alert alert-success alert-dismissible" role="alert">
                <strong><?=$j['nama_mapel']?></strong> 
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>