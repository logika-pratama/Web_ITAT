<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	    <!-- Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link rel="stylesheet" href="<?=base_url()?>assets/vendor/fonts/boxicons.css" />
		<!-- Core CSS -->
		<link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/core.css" class="template-customizer-core-css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" />
		<!-- Vendors CSS -->
		<link rel="stylesheet" href="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
		<!-- Page CSS -->
		<!-- Helpers -->
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
						<span data-text-preloader="L" class="letters-loading">
							L
						</span>
						
						<span data-text-preloader="O" class="letters-loading">
							O
						</span>
						
						<span data-text-preloader="A" class="letters-loading">
							A
						</span>
						
						<span data-text-preloader="D" class="letters-loading">
							D
						</span>
						
						<span data-text-preloader="I" class="letters-loading">
							I
						</span>
						
						<span data-text-preloader="N" class="letters-loading">
							N
						</span>
						
						<span data-text-preloader="G" class="letters-loading">
							G
						</span>
					</div>
				</div>	
				<div class="loader-section section-left"></div>
				<div class="loader-section section-right"></div>
			</div>
		</div>
	</section>
	<script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
	<script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
	<script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
	<script src="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
	<script src="<?=base_url()?>assets/vendor/js/menu.js"></script>
	<script src="<?=base_url()?>assets/js/main.js"></script>
  <script>
     $(document).ready(function() {
    //   setTimeout(function() {
    //     $('#ctn-preloader').addClass('loaded');
    //     // Una vez haya terminado el preloader aparezca el scroll
    //     $('body').removeClass('no-scroll-y');

    //     if ($('#ctn-preloader').hasClass('loaded')) {
    //       // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
    //       $('#preloader').delay(500).queue(function() {
    //         $(this).remove();
    //       });
    //     }
    //   }, 500);
    });
  </script>
  </body>
</html>
