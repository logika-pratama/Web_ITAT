<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>ITAT Mobile</title>
    <meta name="description" content="" />
	  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/libs/apex-charts/apex-charts.css" />
    <script src="<?=base_url()?>assets/vendor/js/helpers.js"></script>
    <script src="<?=base_url()?>assets/js/config.js"></script>
    <style>
    #frame {
        -ms-zoom: 1;
        -webkit-transform: scale(1);
        -webkit-transform-origin: top centre;
    }
    </style>
  </head>

  <body>
  <section>
	</section>

    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
		<?php
			$this->load->view('sidebar');
		?>
        <!-- / Menu -->
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
			<?php
				$this->load->view('menu');
			?>
          <!-- / Navbar -->
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 col-md-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-12">
                        <div class="card-body p-1">
                          <div class="video-container">
                              <iframe class="content-frame" id="frame" style="background-color: #FFFFFF;" src="<?=base_url('index.php/main')?>" frameborder="0" allowfullscreen></iframe>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
   
    <script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?=base_url()?>assets/vendor/js/menu.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="<?=base_url()?>assets/js/main.js"></script>
    <script src="<?=base_url()?>assets/js/dashboards-analytics.js"></script>
    <script>
      function changePage(){
        url = event.currentTarget.dataset.url;
        $('.content-frame').attr('src',url);
        window.Helpers.toggleCollapsed();
      }
    </script>
  </body>
</html>
