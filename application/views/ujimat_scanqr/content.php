<div class="row mt-2">
    <div class="col-md-12">
        <h5 class="card-header m-0"><?=$title?></h5>
    </div>

    <!-- Kontrak -->
    <div class="col-md-12 mb-1 text-center">
        <div class="p-1 m-3">
            <label class="form-label">Pilih Kontrak</label>
            <select class="form-control kontrak ellipsis-option">
                <option value="-1">-- Pilih Kontrak --</option>
            </select>
        </div>
    </div>

    <!-- <div class="col-md-12 mb-1 text-center">
        <div class="p-1 m-3">
            <div class="form-group">
                <div id="texttags">
                    <input type="text" name="scanrfid" class="fokus form-control" style="width:100%;" data-role="tagsinput"/>
                </div>
            </div>  
        </div>  
    </div> -->

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

    <!-- <div class="col-md-12 text-center mb-3">
        <div class="form-group mt-2">
            <a href="javascript:void(0)" onclick="resetScan()" class="btn btn-danger btn-sm text-white">Reset Scan</a>
        </div>
    </div> -->

    <!-- Content -->
    <div class="col-md-12 mb-3 content"></div>


    <!-- <div class="col-md-12 mb-3 content">
        <div class="p-1 m-3">

            <h5>Detail Data</h5>

            <table>
                <tbody>
                    <tr class="table-font-weight-bold">
                        <td style="vertical-align: top;">ASSET ID</td>
                        <td><span class="asset_id">442520000000000000000007</span></td>
                    </tr>
                    <tr>
                        <td class="table-font-weight-bold" style="vertical-align: top;">Nama Aset</td>
                        <td> : <span class="name_asset">Lap top Asus</span></td>
                    </tr>
                    <tr>
                        <td class="table-font-weight-bold" style="vertical-align: top;">Kode Lokasi</td>
                        <td> : <span class="kode_lokasi">A-03-A</span></td>
                    </tr>
                    <tr>
                        <td class="table-font-weight-bold" style="vertical-align: top;">Nama Lokasi</td>
                        <td> : <span class="nama_lokasi">WHC-A-03-A</span></td>
                    </tr>
                    <tr>
                        <td class="table-font-weight-bold" style="vertical-align: top;">Nama Proyek</td>
                        <td> : <span class="nama_proyek">Pengadaan Perangkat Hyper Converged Infrastruktur Private Cloud untuk Virtual Developer Worksapce Pada Private Cloud T.A. 2023</span></td>
                    </tr>
                    <tr>
                        <td class="table-font-weight-bold" style="vertical-align: top;">Tahun Proyek</td>
                        <td> : <span class="year_proyek">2023</span></td>
                    </tr>
                    <tr>
                        <td class="table-font-weight-bold" style="vertical-align: top;">Nilai Proyek</td>
                        <td> : <span class="nilai_proyek">32670000</span></td>
                    </tr>
                    <tr>
                        <td class="table-font-weight-bold" style="vertical-align: top;">PPK</td>
                        <td> : <span class="ppk">Mario Prahatinto</span></td>
                    </tr>
                    <tr>
                        <td class="table-font-weight-bold" style="vertical-align: top;">Nama Vendor</td>
                        <td> : <span class="nama_vendor">PT. AKA KARYA GEMILANG</span></td>
                    </tr>
                </tbody>
            </table>

            <h5 class="mt-3">Spek Tek</h5>

            <table class="table table-striped table-bordered mt-3">
                <thead>
                </thead>
                <tbody class="list-data">

                
                    <tr>
                        <td class="table-font-weight-bold">Keterangan</td>
                        <td>Laptop 15,6-in, AMD Ryzen™ 7 6800H</td>
                    </tr>
                    <tr>
                        <td class="table-font-weight-bold">Tipe Laptop</td>
                        <td>ASUS / ROG STRIX G15</td>
                    </tr>


                </tbody>
            </table>

            <h5 class="mt-3">History</h5>

            <table class="table table-striped table-bordered mt-3">
                <thead>
                    <tr class="table-font-weight-bold">
                        <td>Dari</td>
                        <td>Ke</td>
                        <td>Tanggal / Jam</td>
                    </tr>
                </thead>
                <tbody class="list-data-history">


                    <tr>
                        <td>Partner Locations/Vendors</td>
                        <td>WHC-A-03-A</td>
                        <td>2023-06-21 16:20:02</td>
                    </tr>
                    <tr>
                        <td>WHC-A-03-A</td>
                        <td>WHC/ujimat area</td>

                        <td>2023-06-23 03:38:21</td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div> -->

                        <!-- <td>2023-06-23 03:38:21.195167</td> -->
</div>