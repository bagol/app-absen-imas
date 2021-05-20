<li class="nav-item">
	<a href="<?=base_url('GuruController/jadwalMengajar')?>">
		<i class="fas fa-clipboard-check"></i>
		<p>Jadwal Mengajar</p>
	</a>
</li>
<li class="nav-item">
	<a data-toggle="collapse" href="#absen">
		<i class="fas fa-clipboard-list"></i>
		<p>Absensi</p>
		<span class="caret"></span>
	</a>
	<div class="collapse" id="absen">
		<ul class="nav nav-collapse">
			<?php 
				$jadwal = $this->JadwalModel->getJadwalByNip($this->session->userdata('nip'));
				if($jadwal->num_rows()){
					foreach($jadwal->result_array() as $j): 
			?>
				<li>
					<a href="<?=base_url('GuruController/absen/')?><?=$j['kode_jadwal']?>">
						<span class="sub-item"><?=$j['nama_mapel']?></span>
					</a>
				</li>
			<?php
					endforeach;
				}
			?>
		</ul>
	</div>
</li>
<li class="nav-item">
	<a href="<?=base_url('GuruController/rekapAbsen')?>">
		<i class="fas fa-list-alt"></i>
		<p>Rekap Absen</p>
	</a>
</li>