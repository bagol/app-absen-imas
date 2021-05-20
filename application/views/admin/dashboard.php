<div class="panel-header bg-primary-gradient">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<div>
				<h2 class="text-white pb-2 fw-bold">Administrator</h2>
				<h5 class="text-white op-7 mb-2">Selamat Datang, <b class="text-warning"><?=$this->session->userdata('username') ?></b> | Aplikasi Absensi Siswa</h5>
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
							<img src="<?=base_url('assets/')?>img/mts.png" width="80">
							<br>
							<b>MTs INSAN KREASI</b>
					</div>
					<div class="card-category text-center">
						Jl. Raya Parung Panjang - Tenjo Kp. Ciapus RT. 07/02 Ds. Batok Kec. Tenjo Kab. Bogor 16370
            <br>Telp. 081381902218 E-mail : insankreasi2013@gmail.com
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="row">
							<div class="col-sm-6 col-md-6">
								<div class="card card-stats card-secondary card-round">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="flaticon-users"></i>
												</div>
											</div>
											<div class="col-7 col-stats">
												<div class="numbers">
													<p class="card-category">Total Siswa</p>
													<h4 class="card-title"><?php echo $jumlahSiswa; ?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="card card-stats card-default card-round">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="fas fa-user-tie"></i>
												</div>
											</div>
											<div class="col-7 col-stats">
												<div class="numbers">
													<p class="card-category">Total Guru</p>
													<h4 class="card-title"><?php echo $jumlahGuru; ?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>