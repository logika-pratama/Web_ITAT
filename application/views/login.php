<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?=base_url()?>assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>ITAT Mobile</title>

    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.min.css"/>
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/pages/page-auth.css" />
    <script src="<?=base_url()?>assets/vendor/js/helpers.js"></script>
    <script src="<?=base_url()?>assets/js/config.js"></script>
  </head>

  <body>

  <section>
		<div id="preloader">
			<div id="ctn-preloader" class="ctn-preloader">
				<div class="animation-preloader">
					<div class="text-center mb-3" style="margin-top:-100px;">
          <img src="<?=base_url('assets/img/icon.png')?>" style="width:100px;">
          </div>
					<div class="txt-loading">
						<span data-text-preloader="I" class="letters-loading">
							I
						</span>
						
						<span data-text-preloader="T" class="letters-loading">
							T
						</span>
						
						<span data-text-preloader="A" class="letters-loading">
							A
						</span>
						
						<span data-text-preloader="T" class="letters-loading">
							T
						</span>
						
						<span data-text-preloader=" " class="letters-loading">
							 
						</span>
						
						<span data-text-preloader="M" class="letters-loading">
							M
						</span>
						
						<span data-text-preloader="O" class="letters-loading">
							O
						</span>

            <span data-text-preloader="B" class="letters-loading">
							B
						</span>

            <span data-text-preloader="I" class="letters-loading">
							I
						</span>

            <span data-text-preloader="L" class="letters-loading">
							L
						</span>

            <span data-text-preloader="E" class="letters-loading">
							E
						</span>
					</div>
				</div>	
				<div class="loader-section section-left"></div>
				<div class="loader-section section-right"></div>
			</div>
		</div>
	</section>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-header p-3 m-0 text-center text-primary" style="font-weight:bold;">SELAMAT DATANG</h5>
              <div class="app-brand justify-content-center">
                <a href="javascript:void(0)" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                      <img src="<?=base_url('assets/img/icon.png')?>" style="width:80px;">
                  </span>
                </a>
              </div>
              <!-- /Logo -->
              <?php echo $this->session->flashdata('msg'); ?>
              <form method="post" action="javascript:void(0)" class="form-horizontal form-login">
                <div class="mb-3">
                  <label for="email" class="form-label">Email or Username</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" onclick="login()" type="submit">Sign in</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?=base_url()?>assets/vendor/js/menu.js"></script>
    <script src="<?=base_url()?>assets/js/main.js"></script>
    <script>
      function login(){
        $.ajax({
            url : "<?=base_url()?>index.php/login/login",
            type: "POST",
            data : $(".form-login").serialize(),
            dataType:"JSON",
        success: function(data){
            if(data.status == true){
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'success',
                title: 'Signed in successfully'
              })
              setTimeout(function(){
                window.location.replace("<?=base_url('dashboard')?>");
              },1000)
            } else {
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'error',
                title: data.massage
              })
            }
        },
        error: function (xhr, status, error){
        }
        });
      }

    $(document).ready(function() {
      setTimeout(function() {
        $('#ctn-preloader').addClass('loaded');
        // Una vez haya terminado el preloader aparezca el scroll
        $('body').removeClass('no-scroll-y');

        if ($('#ctn-preloader').hasClass('loaded')) {
          // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
          $('#preloader').delay(1000).queue(function() {
            $(this).remove();
          });
        }
      }, 2000);
    });
    </script>
  </body>
</html>
