<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Pengguna | Absensi</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>_login/vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>_login/fonts/iconic/css/material-design-iconic-font.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>_login/vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>_login/vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>_login/vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>_login/vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>_login/vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>_login/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>_login/css/main.css">
  <!--===============================================================================================-->
</head>

<body>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form method="post" action="" class="login100-form validate-form">
            <span class="login100-form-title p-b-5">
              <img src="<?=base_url('assets/')?>img/mts.png" width="100">
            </span>
            <span class="login100-form-title p-b-26">
              MTs INSAN KREASI
            </span>
            <div class="wrap-input100 validate-input">
              <input class="input100" type="text" id="username" autocomplete="off">
              <span class="focus-input100" data-placeholder="NIP / NISN / NUPK"></span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="password">
              <span class="btn-show-pass">
                <i class="zmdi zmdi-eye"></i>
              </span>
              <input class="input100" type="password" id="password" required>
              <span class="focus-input100" data-placeholder="Password"></span>
            </div>
            <div class="form-group mb-3">
              <select class="form-control" id="level">
                <option value="">Level</option>
                <option value="1">Guru</option>
                <option value="2">Siswa</option>
                <option value="3">Kepala Sekolah</option>
                <option value="4">Wali Kelas</option>
              </select>
            </div>
            <br>
            <div class="container-login100-form-btn">
              <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" id="login" class="login100-form-btn">
                  Login
                </button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!--===============================================================================================-->
  <script src="<?=base_url('assets/')?>_login/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="<?=base_url('assets/')?>_login/vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  <script src="<?=base_url('assets/')?>_login/vendor/bootstrap/js/popper.js"></script>
  <script src="<?=base_url('assets/')?>_login/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="<?=base_url('assets/')?>_login/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="<?=base_url('assets/')?>_login/vendor/daterangepicker/moment.min.js"></script>
  <script src="<?=base_url('assets/')?>_login/vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  <script src="<?=base_url('assets/')?>_login/vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
  <!-- Sweet Alert -->
  <script src="<?=base_url('assets/')?>js/plugin/sweetalert/sweetalert.min.js"></script>
  <script src="<?=base_url('assets/')?>_login/js/main.js"></script>
  <script>
    const login =  document.querySelector('#login');
    const username =  document.querySelector('#username');
    const password =  document.querySelector('#password');
    const level =  document.querySelector('#level');

    login.addEventListener('click', (e) => {
      e.preventDefault()
      if(!password.value) {
        swal('Gagal!!!','Passwaord Belum diisi',{ icon: 'warning'});
        return;
      }
      // Periksa apakah level sudah dipilih atau belu
      if(level.value === ''){
        // jika belum tampilkan alert pemberitahuan
        swal('Anda Belum Memilih Level', { icon: 'warning' })
        return;
      }

      /**
       * Jika User sudah memilih level priksa lagi level apa yg dipilih
       * dapatkan url sesuai level yang dipilih
       */
      const url = `<?=base_url('Auth/login')?>`;
      // ambil data dari form
      const form = {
        username: username.value,
        password: password.value,
        level: level.value
      };
      // configurasi untuk mengambil data menggunakan fetch
      const config = {
        method: 'post',
        body: new URLSearchParams(form)
      };
      fetch(url, config).then(res => res.json())
        .then(data => {
          if(data.status === 'success'){
            swal('Berhasil',data.message,{ icon: data.icon })
              .then(oK => {
                if (oK) {
                  window.location.href = `<?=base_url('Auth/cekSession')?>`;
                }
              })
          }else{
            swal(data.message, { icon: data.icon })
          }
        })
    })
  </script>