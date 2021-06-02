<li class="nav-item">
  <a data-toggle="collapse" href="#base">
    <i class="fas fa-folder-open"></i>
    <p>Data Umum</p>
    <span class="caret"></span>
  </a>
  <div class="collapse" id="base">
    <ul class="nav nav-collapse">
      <li>
        <a href="<?=base_url('AdminController/masterKelas')?>">
          <span class="sub-item">Ruang Kelas</span>
        </a>
      </li>
      <li>
        <a href="<?=base_url('AdminController/masterMapel')?>">
          <span class="sub-item">Mata Pelajaran</span>
        </a>
      </li>
      <li>
        <a href="<?=base_url('AdminController/masterKelasSiswa')?>">
          <span class="sub-item">Kelas Siswa</span>
        </a>
      </li>
      <li>
        <a href="<?=base_url('AdminController/masterwaliKelas')?>">
          <span class="sub-item">Wali Kelas</span>
        </a>
      </li>
    </ul>
  </div>
</li>
<li class="nav-item">
  <a data-toggle="collapse" href="#sidebarLayouts">
    <i class="fas fa-clipboard-list"></i>
    <p>Jadwal Mengajar</p>
    <span class="caret"></span>
  </a>
  <div class="collapse" id="sidebarLayouts">
    <ul class="nav nav-collapse">
      <li>
        <a href="<?=base_url('AdminController/tambahJadwal')?>">
          <span class="sub-item"> Tambah Jadwal </span>
        </a>
      </li>
      <li>
        <a href="<?=base_url('AdminController/jadwal')?>">
          <span class="sub-item"> Daftar Mengajar </span>
        </a>
      </li>
    </ul>
  </div>
</li>
<li class="nav-item">
  <a data-toggle="collapse" href="#kepsek">
    <i class="fas fa-user-tie"></i>
    <p>Data Kepala Sekolah</p>
    <span class="caret"></span>
  </a>
  <div class="collapse" id="kepsek">
    <ul class="nav nav-collapse">
      <li>
        <a href="<?=base_url('AdminController/tambahKepsek')?>">
          <span class="sub-item"> Tambah Kepala Sekolah </span>
        </a>
      </li>
      <li>
        <a href="<?=base_url('AdminController/daftarKepsek')?>">
          <span class="sub-item"> Daftar Kepala Sekolah </span>
        </a>
      </li>
    </ul>
  </div>
</li>
<li class="nav-item">
  <a data-toggle="collapse" href="#guru">
    <i class="fas fa-user-tie"></i>
    <p>Data Guru</p>
    <span class="caret"></span>
  </a>
  <div class="collapse" id="guru">
    <ul class="nav nav-collapse">
      <li>
        <a href="<?=base_url('AdminController/tambahGuru')?>">
          <span class="sub-item"> Tambah Guru </span>
        </a>
      </li>
      <li>
        <a href="<?=base_url('AdminController/daftarGuru')?>">
          <span class="sub-item"> Daftar Guru </span>
        </a>
      </li>
    </ul>
  </div>
</li>
<li class="nav-item">
  <a data-toggle="collapse" href="#siswa">
    <i class="fas fa-user-friends"></i>
    <p>Data Siswa</p>
    <span class="caret"></span>
  </a>
  <div class="collapse" id="siswa">
    <ul class="nav nav-collapse">
      <li>
        <a href="<?=base_url('AdminController/tambahSiswa')?>">
          <span class="sub-item"> Tambah Siswa </span>
        </a>
      </li>
      <li>
        <a href="<?=base_url('AdminController/importDataSiswa')?>">
          <span class="sub-item"> Import Data Siswa </span>
        </a>
      </li>
      <li>
        <a href="<?=base_url('AdminController/daftarSiswa')?>">
          <span class="sub-item"> Daftar Siswa </span>
        </a>
      </li>
    </ul>
  </div>
</li>
<li class="nav-item">
  <a data-toggle="collapse" href="#rekapAbsen">
    <i class="fas fa-list-alt"></i>
    <p>Rekap Absen</p>
    <span class="caret"></span>
  </a>
  <div class="collapse" id="rekapAbsen">
    <ul class="nav nav-collapse">
      <!-- -->
      <li>
        <a href="<?=base_url('AdminController/rekapAbsen')?>">
          <span class="sub-item"> Absen Siswa </span>
        </a>
      </li>
    </ul>
  </div>
</li>
