<div class="row mt-2">
    <div class="col-md-12">
        <h5 class="card-header m-0"><?=$title?></h5>
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

    <div class="col-md-12 mb-2 text-center" id="qrcodeContainer">
        <img id="resultImg" src="" alt="" style="max-width: 93.5%; max-height: 93.5%;"/>
        <p id="resultAssetId"></p>
    </div>

    <!-- Reset Scan -->
    <div class="col-md-12 mb-3 text-end">
        <div class="p-1 m-3">
            <button id="resetScan" class="btn btn-danger btn-sm text-white">Reset Scan</button>
        </div>
    </div>

    <!-- Content -->
    <div class="col-md-12 mb-3 content"></div>
</div>