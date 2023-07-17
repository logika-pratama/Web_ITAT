
<div class="row">
    <div class="col-md-12 mt-1">
        <div class="form-group">
            <input type="text" name="scanrfid" class="form-control scancuy" style="width:100%;"/>
        </div>    
    </div>
</div>


<div class="modal fade" id="modalLong" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
    <div class="modal-content ">
        <div class="modal-header">
            <h5 class="modal-title" id="modalLongTitle">Detail RFID</h5>
        </div>
        <div class="modal-body">
        <table>
            <tbody class="detail-data-rfid">
                <tr class="table-font-weight-bold">
                    <td style="vertical-align: top;">ID</td>
                    <td style="vertical-align: top;">:</td>
                    <td><span class="asset_id"></span></td>
                </tr>
                <tr>
                    <td class="table-font-weight-bold" style="vertical-align: top;">Aset</td>
                    <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                    <td><span class="name_asset"></span></td>
                </tr>
                <tr>
                    <td class="table-font-weight-bold" style="vertical-align: top;">Serial</td>
                    <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                    <td><span class="serial_number"></span></td>
                </tr>
                <tr>
                    <td class="table-font-weight-bold" style="vertical-align: top;">PPK</td>
                    <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                    <td><span class="ppk_user"></span></td>
                </tr>
                <tr>
                    <td class="table-font-weight-bold" style="vertical-align: top;">Proyek</td>
                    <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                    <td><span class="name_project"></span></td>
                </tr>
                <!-- <tr>
                    <td class="table-font-weight-bold" style="vertical-align: top;">Nilai</td>
                    <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                    <td><span class="price"></span></td>
                </tr> -->
                <tr>
                    <td class="table-font-weight-bold" style="vertical-align: top;">Tahun</td>
                    <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                    <td><span class="year_project"></span></td>
                </tr>
                <tr>
                    <td class="table-font-weight-bold" style="vertical-align: top;">Vendor</td>
                    <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                    <td><span class="name_vendor"></span></td>
                </tr>
            </tbody>
        </table>

        <table class="table table-striped table-bordered mt-3">
            <thead>
            </thead>
            <tbody class="list-data">
            </tbody>
        </table>

        <h5>History</h5>

        <table class="table table-striped table-bordered mt-3">
            <thead>
                <tr>
                    <td>Dari</td>
                    <td>Ke</td>
                    <td>Tanggal / Jam</td>
                </tr>
            </thead>
            <tbody class="list-data-history">
            </tbody>
        </table>

        </div>
        <div class="modal-footer">
        <button type="button" onclick="closeMat()" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
        </button>
        </div>
    </div>
    </div>
</div>
