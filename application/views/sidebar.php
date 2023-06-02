<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
    <a href="javascript:void(0)" class="app-brand-link">
        <span class="app-brand-logo demo">
            <img src="<?=base_url('assets/img/icon.png')?>" style="width:30px;">
        </span>
        <span class="app-brand-text menu-text fw-bolder ms-2">ITAT Mobile</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
        <a href="javascript:void(0)" onclick="changePage()" data-url="<?=base_url('index.php/main')?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Home</div>
        </a>
    </li>

    <li class="menu-item">
        <a href="javascript:void(0)" onclick="changePage()" data-url="https://depo.divtik.polri.go.id/" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-file-find"></i>
        <div data-i18n="Analytics">Pelacakan BLE</div>
        </a>
    </li>

    <li class="menu-item">
        <a href="<?=base_url('index.php/searching/waiting?url=')?>http://10.230.200.154/#/dashboard"  class="menu-link">
        <i class='menu-icon tf-icons bx bxs-pie-chart-alt-2' ></i>
        <div data-i18n="Analytics">Dashboard ITAT</div>
        </a>
    </li>

    <!-- Layouts -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div data-i18n="Layouts">Modul Integrasi</div>
        </a>

        <ul class="menu-sub">
        <li class="menu-item">
            <a href="javascript:void(0)" onclick="changePage()" data-url="<?=base_url('index.php/scan_rfid')?>" class="menu-link">
            <div data-i18n="Without menu">Pemindai Barang</div>
            </a>
        </li>
        
        <li class="menu-item">
            <a href="<?=base_url('index.php/searching/waiting?url=')?>https://10.230.200.158:8082/" class="menu-link">
            <div data-i18n="Without navbar">Aset Gudang</div>
            </a>
        </li>
        
        <li class="menu-item">
            <a href="javascript:void(0)" onclick="changePage()" data-url="<?=base_url('index.php/taging_ble')?>"  class="menu-link">
            <div data-i18n="Container">Penandaan Tag BLE</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0)" onclick="changePage()" data-url="<?=base_url('index.php/untaging_ble')?>"  class="menu-link">
            <div data-i18n="Container">Pelepasan Tag BLE</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?=base_url('index.php/searching/waiting?url=')?>http://10.230.200.158:8081/" class="menu-link">
            <div data-i18n="Fluid">Aset Luar Gudang</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?=base_url('index.php/searching/waiting?url=')?>https://10.230.200.158" class="menu-link">
            <div data-i18n="Blank">Pelacakan Aset</div>
            </a>
        </li>
        </ul>

        <li class="menu-item">
            <a href="<?=base_url('index.php/dashboard/logout')?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div data-i18n="Analytics">Keluar</div>
            </a>
        </li>
    </li>
    </ul>
</aside>