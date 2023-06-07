
<div class="main-content main-template">
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
                        <a href="<?=base_url('index.php/searching/waiting?url=')?>http://10.230.200.154/#/dashboard" class="btn btn-secondary btn-sm mb-2" style="height:85px; width:100%;">
                            <i class="bx bxs-pie-chart-alt-2 bx-md mb-1"></i>
                            <p class="icon-name text-capitalize">Dasbhoard ITAT</p>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="<?=base_url('scan_rfid')?>" class="btn btn-danger btn-sm mb-2" style="height:85px; width:100%;">
                            <i class="bx bx-scan bx-md mb-1"></i>
                            <p class="icon-name text-capitalize">Pemindai Barang</p>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="<?=base_url('index.php/searching/waiting?url=')?>https://10.230.200.158:8082/login" class="btn btn-warning btn-sm mb-2" style="height:85px; width:100%;">
                            <i class="bx bxs-box bx-md mb-1"></i>
                            <p class="icon-name text-capitalize">Aset Gudang</p>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="<?=base_url('taging_ble')?>" class="btn btn-dark btn-sm mb-2" style="height:85px; width:100%;">
                            <i class="bx bx-qr-scan bx-md mb-1"></i>
                            <p class="icon-name text-capitalize">Penandaan Tag BLE</p>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="<?=base_url('untaging_ble')?>" class="btn btn-info btn-sm mb-2" style="height:85px; width:100%;">
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
                </div> <!-- end row -->
            </div>
        </div>
    </div>
</div>
