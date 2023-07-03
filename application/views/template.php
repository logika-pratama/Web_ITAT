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
                          <div class="main-content main-template" style="height:88vh;">
                            <div class="col-md-12">
                                <h5 class="card-header text-center m-0 font-weight-bold text-primary">ITAT MOBILE</h5>
                            </div>
                            <div class="content">
                                <div class="container-fluid">
                                    <div class="page-title-box">
                                        <div class="row align-items-center">
                                            <div class="col-md-12 mb-3" style="text-align:center;">    
                                                <img src="<?=base_url('assets/img/icon.png')?>" style="width:80px;">                                
                                            </div>
                                            <div class="col-4">
                                                <a href="<?=base_url('index.php/searching/waiting?url=')?>https://depo.divtik.polri.go.id/" class="btn btn-success btn-sm mb-2" style="height:85px; width:100%;">
                                                    <i class="bx bxs-file-find bx-md mb-1"></i>
                                                    <p class="icon-name text-capitalize">Pelacakan BLE</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="javascript:void(0)" onclick="changePageMain()" data-url="<?=base_url('index.php/pindai_rfid')?>" class="btn btn-danger btn-sm mb-2" style="height:85px; width:100%;">
                                                    <i class="bx bx-scan bx-md mb-1"></i>
                                                    <p class="icon-name text-capitalize">Pemindai RFID</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="javascript:void(0)" onclick="changePageMain()" data-url="<?=base_url('index.php/scan_rfid')?>" class="btn btn-secondary btn-sm mb-2" style="height:85px; width:100%;">
                                                    <i class="bx bx-scan bx-md mb-1"></i>
                                                    <p class="icon-name text-capitalize">Scan RFID</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="<?=base_url('index.php/searching/waiting?url=')?>https://10.230.200.158:8082/login" class="btn btn-warning btn-sm mb-2" style="height:85px; width:100%;">
                                                    <i class="bx bxs-box bx-md mb-1"></i>
                                                    <p class="icon-name text-capitalize">Aset Gudang</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="javascript:void(0)" onclick="changePageMain()" data-url="<?=base_url('index.php/taging_ble')?>" class="btn btn-dark btn-sm mb-2" style="height:85px; width:100%;">
                                                    <i class="bx bx-qr-scan bx-md mb-1"></i>
                                                    <p class="icon-name text-capitalize">Penandaan Tag BLE</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="javascript:void(0)" onclick="changePageMain()" data-url="<?=base_url('index.php/untaging_ble')?>" class="btn btn-info btn-sm mb-2" style="height:85px; width:100%;">
                                                    <i class="bx bx-qr bx-md mb-1"></i>
                                                    <p class="icon-name text-capitalize">Pelepasan Tag BLE</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="<?=base_url('index.php/searching/waiting?url=')?>http://10.230.200.158:8081/login"  class="btn btn-primary btn-sm mb-2" style="height:85px; width:100%;">
                                                    <i class="bx bx-package bx-md mb-1"></i>
                                                    <p class="icon-name text-capitalize">Aset Luar Gudang</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="<?=base_url('index.php/searching/waiting?url=')?>https://10.230.200.158/web?db=polri_prod#action=912&cids=1&menu_id=280" class="btn btn-light btn-sm mb-2" style="height:85px; width:100%;">
                                                    <i class="bx bxl-algolia bx-md mb-1"></i>
                                                    <p class="icon-name text-capitalize">Pelacakan Aset</p>
                                                </a>
                                            </div>
                                            <?php if($this->session->userdata('role') == 'superadmin'){ ?>
                                            <div class="col-4">
                                                <a href="javascript:void(0)" onclick="changePageMain()" data-url="<?=base_url('index.php/users')?>" class="btn btn-secondary btn-sm mb-2" style="height:85px; width:100%;">
                                                    <i class="bx bxl-algolia bx-md mb-1"></i>
                                                    <p class="icon-name text-capitalize">Akun Pengguna</p>
                                                </a>
                                            </div>
                                            <?php } ?>
                                            <div class="col-4">
                                                <a href="javascript:void(0)" onclick="changePageMain()" data-url="<?=base_url('index.php/ujimat_scanqr')?>" class="btn btn-warning btn-sm mb-2" style="height:85px; width:100%;">
                                                    <i class="bx bx-search bx-md mb-1"></i>
                                                    <p class="icon-name text-capitalize">Uji Mat (QR Code)</p>
                                                </a>
                                            </div>
                                        </div> <!-- end row -->
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="video-container frame-template">
                              <iframe class="content-frame" id="frame" style="background-color: #FFFFFF;" src="<?=base_url('index.php/main')?>" frameborder="0"></iframe>
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
    
       
      $( document ).ready(function() {
        $('.frame-template').hide();
        $('.main-template').show();
      });
      
      function changePage(){
        url = event.currentTarget.dataset.url;
        $('.content-frame').attr('src',url);
        window.Helpers.toggleCollapsed();
        
        if(url == '<?=base_url('index.php/main')?>'){
          $('.frame-template').hide();
          $('.main-template').show();
        } else {
          $('.frame-template').show();
          $('.main-template').hide();
        }
      }

      function changePageMain(){
        url = event.currentTarget.dataset.url;
        $('.content-frame').attr('src',url);
        if(url == '<?=base_url('index.php/main')?>'){
          $('.frame-template').hide();
          $('.main-template').show();
        } else {
          $('.frame-template').show();
          $('.main-template').hide();
        }
      }

      window.document.addEventListener('myCustomEvent', handleEvent, false)
      function handleEvent(e) {
        if(e.detail == '<?=base_url('index.php/main')?>'){
          $('.frame-template').hide();
          $('.main-template').show();
        } else {
          $('.frame-template').show();
          $('.main-template').hide();
        }
      }
    </script>
  </body>
</html>
