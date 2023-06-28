<div class="row mt-2">
    <div class="col-md-12">
        <h5 class="card-header m-0"><?=$title?></h5>
    </div>

    <!-- Kontrak -->
    <div class="col-md-12 mb-1 text-center">
        <div class="p-1 m-3">
            <label class="form-label">Pilih Kontrak</label>
            <select class="form-control kontrak">
                <option value="-1">-- Pilih Kontrak --</option>
            </select>
        </div>
    </div>

    <!-- Kamera -->
    <div class="col-md-12 mb-2 camp text-center visible">
        <div class="p-2 m-3">
            <video id="previewKamera" style="width: 100%;"></video>
        </div>
        <div class="p-1 m-3">
            <label class="form-label">Pilih Kamera</label>
            <select id="pilihKamera" class="form-control pilihKamera">
            </select>
        </div>
    </div>

    <!-- Reset Scan -->
    <div class="col-md-12 text-center mb-3">
        <button id="resetScan" class="btn btn-primary btn-xl">Reset Scan</button>
    </div>

    <!-- Content -->
    <div class="col-md-12 mb-3 content"></div>



    <!-- <div class="col-md-12 text-center mb-3">
        <button onclick="showData(1)" class="btn btn-primary btn-xl">Pindai Qrcode TAG BLE</button>
        <h5 class="qrcode1"></h5>
        <input name="ble1" class="qrcode1 ble1" type="hidden">
    </div>
    <div class="col-md-12 text-center mb-3">
        <button onclick="showData(2)" class="btn btn-primary btn-xl">Pindai Qrcode TAG RFID</button>
        <h5 class="qrcode2"></h5>
        <input name="ble2" class="qrcode2 ble2" type="hidden">
    </div>
    <div class="col-md-12 text-center mb-3">
        <button onclick="konfirmasi()" class="btn btn-primary btn-xl">Konfirmasi</button>
    </div> -->
</div>