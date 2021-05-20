<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Aplikasi Presensi</h2>
        <h5 class="text-white op-7 mb-2">Selamat Datang, <b class="text-warning"><?=$this->session->userdata('username') ?></b></h5>
      </div>
    </div>
  </div>
</div>
<div class="page-inner mt--5">
  <div class="row mt--2">
    <div class="col-md-6">
      <div class="card full-height">
        <div class="card-body">
          <div class="card-title text-center">
            <img src="<?=base_url('')?>assets/img/mts.png" width="50">
            <br>
            <b>MTs INSAN KREASI</b>
          </div>
          <div class="card-category text-center">
            Kp. Ciapus RT/RW 07/02 Ds. Batok Kec. Tenjo Kab. Bogor 16370 Prov. Jawa Barat 
            <br>Email : mtsinsanikreasi@gmail.com Telp.081234567890
          </div>
        
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
            <li class="nav-item">
              <a class="nav-link" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
                <i class="fas fa-clipboard-list"></i>
                Absen
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
                <i class="fas fa-list-alt"></i>
                Rekap
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-contact-tab-icon" data-toggle="pill" href="#pills-contact-icon" role="tab" aria-controls="pills-contact-icon" aria-selected="false">
                <i class="fas fa-user-astronaut"></i>
                About
              </a>
            </li>
          </ul>
          <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
          
            <div class="tab-pane fade" id="pills-contact-icon" role="tabpanel" aria-labelledby="pills-contact-tab-icon">
              <p>
                <hr>
                Aplikasi Absensi siswa ini dibuat untuk mendokumentasikan kehadiran siswa, Aplikasi sangat Mudah digunakan (Berbasis Web)
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>