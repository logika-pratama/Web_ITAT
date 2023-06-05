
<div class="row">
    <div class="col-md-12">
        <h5 class="card-header m-0"><?=$title?></h5>
    </div>

    <div class="col-md-12">
        <div class="form-group ps-4">
            <div id="texttags">
                <input type="text" name="scanrfid" class="fokus form-control" style="width:100%;" data-role="tagsinput"/>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group ps-4 mt-2">
            <a class="btn btn-danger text-white" onclick="reset()">Reset Scan</a>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group ps-4 mt-2">
            <span class="btn btn-success text-white total-item">Total : </span>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="">
            <table class="table table-striped table-bordered mt-3" style="font-size:10px;" id="myTable">
            <input name="nomer" type="hidden" value="0">
            <thead style="background-color:#342a29;">
                <tr>
                    <th style="color:white;">ID Aset</th>
                    <th style="color:white;">Nama</th>
                    <th style="color:white;">Lokasi</th>
                </tr>
            </thead>
            <tbody class="listtable">
            </tbody>
            </table>
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
            <tbody>
                <tr>
                    <td>ASSET ID</td>
                    <td><span class="asset_id"></span></td>
                </tr>
                <tr>
                    <td>Nama Aset</td>
                    <td> : <span class="name_asset"></span></td>
                </tr>
                <tr>
                    <td>Serial Number</td>
                    <td> : <span class="serial_number"></span></td>
                </tr>
                <tr>
                    <td>Tahun Project</td>
                    <td> : <span class="year_project"></span></td>
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
