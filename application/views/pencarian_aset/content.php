
<div class="row p-3">
    <!-- Filter -->
    <!-- <div class="col-sm-12">
        <div class="form-group m-1">
            <label for="input_PPK">PPK</label>
            <input type="text" id="input_PPK" name="input_PPK" style="width:100%;" class="form-control" />
        </div>
    </div> -->
    <div class="col-sm-12" style="min-width: 200px;">
        <h3>Pencarian Aset</h3>   
    </div>

    <div class="col-sm-12">
        <div class="form-group m-1">
            <label for="input_PPK"><strong>Nama PPK</strong></label>
            <select class="form-control input_PPK" style="width:100%;">
                <option value="">-- Semua PPK --</option>
            </select>
        </div>    
    </div>
    <div class="col-sm-6">
        <div class="form-group m-1">
            <label for="input_IDAset"><strong>ID Aset</strong></label>
            <input type="text" id="input_IDAset" name="input_IDAset" style="width:100%; height: 29px;" class="form-control" />
            <!-- <input type="text" id="input_IDAset" name="input_IDAset" style="width:100%;" class="form-control"  data-role="tagsinput"/> -->
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group m-1">
            <label for="input_tahunPengadaan"><strong>Tahun Pengadaan</strong></label>
            <!-- <input type="text" id="input_tahunPengadaan" name="input_tahunPengadaan" style="width:100%; height: 30px;" class="form-control" /> -->
            <select class="form-control input_tahunPengadaan" style="width:100%;">
                <option value="">-- Semua Tahun Pengadaan --</option>
            </select>
        </div>
    </div>
    <!-- <div class="col-sm-6">
        <div class="form-group m-1">
            <label for="input_tahunPengadaan"><strong>Tahun Pengadaan</strong></label>
            <input type="text" id="input_tahunPengadaan" name="input_tahunPengadaan" style="width:100%; height: 30px;" class="form-control" />
        </div>
    </div> -->
    <div class="col-sm-12">
        <div class="m-1 mt-3">
            <button onclick="findAssets()" type="submit" class="btn btn-info btn-sm float-end ms-4" style="width: 80px">Cari</button>
            <button onclick="clearFilter()" type="submit" class="btn btn-danger btn-sm float-end" style="width: 80px">Bersihkan</button>
        </div>
    </div>

    <!-- Content -->
    <div class="col-sm-12 mt-3">
        <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3" style="font-size:14px;" id="myTable">
            <input name="nomer" type="hidden" value="0">
            <thead style="background-color:#342a29;">
                <tr>
                    <th style="color:white;">ID</th>
                    <th style="color:white;">Nama</th>
                    <th style="color:white;">PPK</th>
                    <th style="color:white;">Proyek</th>
                    <th style="color:white;">Tahun</th>
                    <th style="color:white;">Vendor</th>
                    <th style="color:white;">Nilai</th>
                </tr>
            </thead>
            <tbody class="listtable">
            </tbody>
            </table>
        </div>
    </div>

    <div id="pagingInfo" class="col-sm-12 mt-2"></div>


    <div class="col-sm-12-mt-3">
        <ul class="pagination float-end m-1">
            
        </ul>
    </div>
</div>

<div class="modal fade" id="modalLong" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLongTitle">Detail Aset</h5>
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
                            <td nowrap class="table-font-weight-bold" style="vertical-align: top;">Aset</td>
                            <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                            <td><span class="name_asset"></span></td>
                        </tr>
                        <tr>
                            <td nowrap class="table-font-weight-bold" style="vertical-align: top;">Serial</td>
                            <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                            <td><span class="serial_number"></span></td>
                        </tr>
                        <tr>
                            <td nowrap class="table-font-weight-bold" style="vertical-align: top;">PPK</td>
                            <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                            <td><span class="ppk_user"></span></td>
                        </tr>
                        <tr>
                            <td nowrap class="table-font-weight-bold" style="vertical-align: top;">No Kontrak</td>
                            <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                            <td><span class="no_kontrak"></span></td>
                        </tr>
                        
                        <tr>
                            <td nowrap class="table-font-weight-bold" style="vertical-align: top;">Proyek</td>
                            <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                            <td><span class="name_project"></span></td>
                        </tr>
                        <tr>
                            <td nowrap class="table-font-weight-bold" style="vertical-align: top;">Nilai</td>
                            <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                            <td><span class="price"></span></td>
                        </tr>
                        <tr>
                            <td nowrap class="table-font-weight-bold" style="vertical-align: top;">Tahun</td>
                            <td class="table-font-weight-bold" style="vertical-align: top;">:</td>
                            <td><span class="year_project"></span></td>
                        </tr>
                        <tr>
                            <td nowrap class="table-font-weight-bold" style="vertical-align: top;">Vendor</td>
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
              <button type="button" onclick="closeModalContent()" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  Close
              </button>
            </div>
        </div>
      </div>
  </div>