
<div class="row">
    <div class="col-md-12">
        <h5 class="card-header m-0"><?=$title?></h5>
    </div>

    <div class="col-md-12">
        <div class="form-group ps-4">
            <div id="texttags">
                <input type="text" class="fokus form-control" value="" data-role="tagsinput" placeholder="Add tags RFID"/>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-bordered mt-4" id="myTable">
            <thead style="background-color:#342a29;">
                <tr>
                    <th style="color:white;">ID Aset</th>
                    <th style="color:white;">Nama Aset</th>
                    <th style="color:white;">Lokasi</th>
                </tr>
            </thead>
            <tbody>
                <tr onclick="showData()">
                    <td>1237177</td>
                    <td>Leptop</td>
                    <td>Gudang</td>
                </tr>
                <tr onclick="showData()">
                    <td>1666666</td>
                    <td>Leptop Asus</td>
                    <td>Gudang</td>
                </tr>
                <tr onclick="showData()">
                    <td>1211111</td>
                    <td>Leptop Fujitsu</td>
                    <td>Gudang</td>
                </tr>
                <tr onclick="showData()">
                    <td>123712</td>
                    <td>Leptop Acer</td>
                    <td>Gudang</td>
                </tr>
            </tbody>
            </table>
        </div>

        <div class="modal fade" id="modalLong" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalLongTitle">Detail RFID</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
                </div>
                <div class="modal-body">
                <p>
                    Leptop Lenovo X1 Carbon<br>
                    Processor ci7 3000<br>
                    HDD 1Tera<br>
                    RAM 4gb DDR4<br>
                    VGA GTX 1500 Nvidia
                </p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
