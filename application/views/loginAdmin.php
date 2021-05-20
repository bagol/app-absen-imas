<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Admin | Absensi</title>
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

<script>
  const test = `<?=time()?>`;
  console.log(test);
</script>

<body>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form method="post" action="" class="login100-form validate-form">
            <span class="login100-form-title p-b-48">
              <img src="<?=base_url('assets/')?>img/mts.png" width="100">
            </span>
            <span class="login100-form-title p-b-26">
              MTs INSAN KREASI
            </span>
            <div class="wrap-input100 validate-input">
              <input class="input100" type="email" name="email">
              <span class="focus-input100" data-placeholder="Email"></span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="password">
              <span class="btn-show-pass">
                <i class="zmdi zmdi-eye"></i>
              </span>
              <input class="input100" type="password" name="password">
              <span class="focus-input100" data-placeholder="Password"></span>
            </div>
            <div class="container-login100-form-btn">
              <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" class="login100-form-btn">
                  Login
                </button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>


  <div id="dropDownSelect1"></div>

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
  <?php 
      if ($this->input->method() == 'post') {  
        $username = $this->input->post('email');
        $password = $this->input->post('password');
        $admin = $this->AdminModel->find(['email_admin' => $username]);
        
				if($admin->num_rows()){
					$admin = $admin->result_array()[0];
					if(password_verify($password,$admin['password'])){
            $adminSession = [
              'username' => $admin['nama_admin'],
              'kode_admin' => $admin['kode_admin'],
              'foto'  => $admin['foto'],
              'email' => $admin['email_admin'],
              'role' => 'admin',
            ];
            $this->session->set_userdata($adminSession);
            echo "
              <script>
                swal('(".$adminSession['username'].") ', 'Loggin Berhasil',{
                  icon: 'success'
                }).then(oK => {
                  if(oK){
                    window.location.href = `".base_url('Auth/cekSession')."`;
                  }
                })
              </script>
              ";
          }
					else{
						echo "
						<script>
							setTimeout(function () { 
								swal('(Peringatan) ', 'Password Salah', {
									icon : 'error',
									buttons: {        			
										confirm: {
										className : 'btn btn-success'
										}
									},
								});    
							},10);  
						</script>
						";
					}
				}else{
					echo "
						<script>
							setTimeout(function () { 
								swal('(Peringatan) ', 'Username tidak ditemukan', {
									icon : 'error',
									buttons: {        			
										confirm: {
										className : 'btn btn-success'
										}
									},
								});    
							},10);  
						</script>
						";
				}
      } ?>

</body>

</html>