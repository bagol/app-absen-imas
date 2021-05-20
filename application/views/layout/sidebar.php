<ul class="nav nav-primary">
  <li class="nav-item active">
    <a href="<?=base_url("Auth/cekSession")?>" class="collapsed">
      <i class="fas fa-home"></i>
      <p>Dashboard</p>
    </a>
  </li>
  <li class="nav-section">
    <span class="sidebar-mini-icon">
      <i class="fa fa-ellipsis-h"></i>
    </span>
    <h4 class="text-section">Main Utama</h4>
  </li>
<?php 
$userrRole = $this->session->userdata('role');
if( $userrRole === 'admin'){
  $this->load->view('admin/sidebar');
}else if ($userrRole === 'guru'){
  $this->load->view('guru/sidebar');
}else if ($userrRole === 'siswa'){
  $this->load->view('siswa/sidebar');
}else if ($userrRole === "wali_kelas") {
  $this->load->view('wali_kelas/sidebar');
}else if ($userrRole === "kepala_sekolah") {
  $this->load->view('kepala_sekolah/sidebar');
}
?>
  <li class="nav-item active mt-3">
    <?php if ($this->session->userdata('role') !== 'admin'){ ?>
    <a href="<?=base_url('Auth/logout')?>" class="collapsed">
    <?php } else { ?>
    <a href="<?=base_url('Auth/logoutAdmin')?>" class="collapsed">
    <?php } ?>
      <i class="fas fa-arrow-alt-circle-left"></i>
      <p>Logout</p>
    </a>							
  </li>
</ul>