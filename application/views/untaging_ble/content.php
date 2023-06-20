<div class="row mt-2">
    <div class="col-md-12">
        <h5 class="card-header m-0"><?=$title?></h5>
    </div>
    <div class="col-md-12 mb-2 camp text-center visible">
        <div class="p-2 m-3">
            <video id="previewKamera" style="width: 100%;"></video>
        </div>
        <br>
        <label class="form-label">Pilih Kamera</label>
        <select id="pilihKamera" class="form-control pilihKamera">
        </select>
    </div>
    <input type="hidden" name="ble" class="ble" value="">
    <div class="col-md-12 text-center mb-3">
        <button onclick="showData(1)" class="btn btn-primary btn-xl">Pindai Qrcode TAG BLE</button>
        <h5 class="qrcode1"></h5>
        <input name="ble1" class="qrcode1 ble1" type="text">
    </div>
    <div class="col-md-12 text-center mb-3">
        <button onclick="konfirmasi()" class="btn btn-primary btn-xl">Konfirmasi</button>
    </div>
</div>