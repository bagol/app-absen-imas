<li class="nav-item">
	<a data-toggle="collapse" href="#kelas">
		<i class="fas fa-clipboard-list"></i>
		<p>Absen Kelas</p>
		<span class="caret"></span>
	</a>
	<div class="collapse" id="kelas">
		<ul class="nav nav-collapse">
			<?php 
				$kelas = $this->KelasSiswaModel->find(['kode_walikelas' => $this->session->userdata('nip')]);
				if($kelas->num_rows()){
					foreach($kelas->result_array() as $k): 
			?>
				<li>
					<a href="<?=base_url('WaliKelasController/jadwalKelas/')?><?=$k['kode_kelas_siswa']?>">
						<span class="sub-item"><?=$k['nama_kelas']?></span>
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
	<a data-toggle="collapse" href="#siswaKelas">
		<i class="fas fa-clipboard-list"></i>
		<p>Siswa Kelas</p>
		<span class="caret"></span>
	</a>
	<div class="collapse" id="siswaKelas">
		<ul class="nav nav-collapse">
			<?php 
				$kelas = $this->KelasSiswaModel->find(['kode_walikelas' => $this->session->userdata('nip')]);
				if($kelas->num_rows()){
					foreach($kelas->result_array() as $k): 
			?>
				<li>
					<a href="<?=base_url('WaliKelasController/siswaKelas/')?><?=$k['kode_kelas_siswa']?>">
						<span class="sub-item"><?=$k['nama_kelas']?></span>
					</a>
				</li>
			<?php
					endforeach;
				}
			?>
		</ul>
	</div>
</li>