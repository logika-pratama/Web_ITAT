<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>ITAT Mobile</title>
    <meta name="description" content="" />
	  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/img/favicon/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/main.css" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/fonts/boxicons.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="<?=base_url()?>assets/vendor/js/helpers.js"></script>
    <script src="<?=base_url()?>assets/js/config.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.min.css"/>
  
    <style>

        .detail-data-rfid > tr > td {
            width: 1%;
        }

      .video {
        width:100vw;
        height:100vh;
        object-fit:cover;
        z-index:-1;
        position:absolute;
      }

      .imgqrcode{   
        width:80%;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index:5;
        margin: auto;
        background-color: white;
        opacity: 0.3;
      }

      .scan
      {
        width:100%;
        height:5px;
        background-color:green;
        position:absolute;
        z-index:10;
        -moz-animation: scan 2s infinite;
        -webkit-animation: scan 2s infinite;
        animation: scan 2s infinite;
        -webkit-animation-direction: alternate-reverse;
      }

      @-webkit-keyframes scan {
        0%, 100% {
          -webkit-transform: translateY(0);
          transform: translateY(0);
        }
        100% {
          -webkit-transform: translateY(100vh);
          transform: translateY(100vh);
        }
      }

      .feature-title {
        position: relative;
        color: rgb(255, 255, 255);
        mix-blend-mode: difference;
      }

    </style>
  </head>

  <body>
    <div class="row">
        <div class="col-md-12 mt-1">
            <div class="form-group">
                <div id="texttags">
                    <input type="text" name="scanrfid" class="fokus form-control" style="width:100%;" data-role="tagsinput"/>
                </div>
            </div>    
        </div>

        <div class="col-md-12 mb-2 camp text-center visible">
        <div class="col-md-12 mt-2">
    <button id="toggleFlash" class="btn btn-primary btn-sm" style="width:100%;">Toggle Flash</button>
</div>

            <div class="p-2 m-3">
            <div class="scan"></div>
                <video id="previewKamera" style="width: 100%;"></video>
            </div>
            <br>
            <label class="form-label">Pilih Kamera</label>
            <select id="pilihKamera" class="form-control pilihKamera">
            </select>
        </div>

        <div class="col-md-12 mt-2">
            <a hre="javascript:void(0)" class="btn btn-primary btn-sm" style="color:white; width:100%;" onclick="showData(1)">Pindai Gate Scan Qrcode</a>
        </div>

        <div class="col-12">
            <div class="form-group mt-2">
                <a href="javascript:void(0)" class="btn btn-primary btn-sm text-white" style="width:100%;" onclick="getData()">Search</a>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group mt-2">
                <a href="javascript:void(0)" onclick="resetData()" class="btn btn-danger btn-sm text-white">Reset Scan</a>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group mt-2">
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="">
                <table class="table table-striped table-bordered mt-3" style="font-size:10px;" id="myTable">
                <input name="nomer" type="hidden" value="0">
                <thead style="background-color:#342a29;">
                    <tr>
                        <th style="color:white;">ID Aset</th>
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
  </body>

  
<script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
<script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
<script src="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?=base_url()?>assets/vendor/js/menu.js"></script>
<script src="<?=base_url()?>assets/js/main.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.min.js"></script>

<script type="text/javascript">
var table;

$( document ).ready(function() {
  $('.kontrak').select2();
  $.ajax({
      url : "<?=base_url()?>index.php/pindai_rfid/getKontrak/",
      type: "GET",
      dataType:"JSON",
      success: function(data){
        var i;
        for (i = 0; i < data.length; ++i) {
          $('.kontrak').append('<option value="'+data[i]['id']+'">'+data[i]['description']+'</option>');
        }       
      },
  });
});

function resetData(){
  $('#myTable').DataTable().destroy();
  $('.fokus').tagsinput('removeAll');
  $('.listtable').html('');

}

function getData(){
  scan = $("[name='scanrfid']").val();

  $('#myTable').DataTable().destroy();

  table = $('#myTable').DataTable({
        "paging":   false,
        "ordering": false,
        "processing": true,
        "ajax":{
          "url": "<?=base_url()?>index.php/pindai_rfid/scanRFID/",
          "dataType": "json",
          "type": "POST",
          "data" : {
            "scan" : scan,
          },
        },
        "columns": [
            { 
              data: "tag_number",
              'render': function(data, type, row, meta){
                  if(type === 'display'){
                    data = '<a href="javascript:void(0)" onclick="showData()" data-id="'+row.tag_number+'">' + data + '</a> ';
                  }

                  return data;
                } 
            }
        ]  
    });
    setTimeout(function(){
      $('.fokus').tagsinput('removeAll');
    });

}

function closeMat(){
  $.ajax({
      url : "<?=base_url()?>index.php/pindai_rfid/closeMat/",
      type: "POST",
      dataType:"JSON",
      success: function(data){
      },
  });
}

function showData(){
  rfid = event.currentTarget.dataset.id;
  $(".list-data").html('Menunggu Request dari ITAM');
  $(".list-data-history").html('Menunggu Request dari ITAM');
  $.ajax({
      url : "<?=base_url()?>index.php/pindai_rfid/detailRFID/"+rfid,
      type: "GET",
      dataType:"JSON",
      success: function(data){
        $(".list-data").html('');

        $('.asset_id').text(data['data'][0]['asset_id']);
        $('.name_asset').text(data['data'][0]['name_asset']);
        $('.serial_number').text(data['data'][0]['serial_number']);
        $('.year_project').text(data['data'][0]['year_project']);
        var i;
        for (i = 0; i < data['data'][0]['product_attribute'].length; ++i) {
          if(data['data'][0]['product_attribute'][i]['description'] != ""){
            $('.list-data').append("<tr><td>"+data['data'][0]['product_attribute'][i]['name']+"</td><td>"+data['data'][0]['product_attribute'][i]['description']+"</td></tr>");
          }
        }
      },
  });

  $.ajax({
      url : "<?=base_url()?>index.php/pindai_rfid/setRFID/"+rfid,
      type: "GET",
      dataType:"JSON",
      success: function(data){
      },
  });

  $.ajax({
      url : "<?=base_url()?>index.php/pindai_rfid/historyRFID/"+rfid,
      type: "GET",
      dataType:"JSON",
      success: function(data){
        $(".list-data-history").html('');
        var i;
        for (i = 0; i < data.length; ++i) {

          var todaydate = new Date(data[i]['tanggal']); 
          var dd = todaydate .getDate();
          var mm = todaydate .getMonth()+1;
          var yyyy = todaydate .getFullYear();
          if(dd<10){  dd='0'+dd } 
          if(mm<10){  mm='0'+mm } 
          var date = dd+'-'+mm+'-'+yyyy+' '+todaydate.getHours() + ':' + todaydate.getMinutes();

          $('.list-data-history').append("<tr><td>"+data[i]['location_awal']+"</td><td>"+data[i]['location_tujuan']+"</td><td>"+date+"</td></tr>");
        }
      },
  });

  $('#modalLong').modal('show');
}

setTimeout(function(){
    $(".fokus").tagsinput('focus');
},1000);



$( document ).ready(function() {
    $('.camp').hide();
});

function showData(num){
    $('.ble').val(num);
    $('.camp').show();
    var pk = $('.pilihKamera').val();
    $('.pilihKamera').val(pk).change();
}

let selectedDeviceId = null;
const codeReader = new ZXing.BrowserMultiFormatReader();
const sourceSelect = $("#pilihKamera");

$(document).on('change','#pilihKamera',function(){
    selectedDeviceId = $(this).val();
    if(codeReader){
        codeReader.reset()
        initScanner()
    }
})

// Mendapatkan elemen video
const videoElement = document.getElementById("previewKamera");

// Mendapatkan tombol toggle flash dan mode layar penuh
const toggleFlashButton = document.getElementById("toggleFlash");
const toggleFullScreenButton = document.getElementById("toggleFullScreen");

// Variabel untuk melacak status flash dan mode layar penuh
let isFlashOn = false;
let isFullScreen = false;

// Fungsi untuk mengaktifkan/menonaktifkan flash
function toggleFlash() {
    const track = videoElement.srcObject.getVideoTracks()[0];
    const capabilities = track.getCapabilities();
    
    if (!capabilities.torch) {
        alert("Flash tidak tersedia pada perangkat ini.");
        return;
    }
    
    isFlashOn = !isFlashOn;
    
    track.applyConstraints({
        advanced: [{ torch: isFlashOn }]
    });
    
    // Ubah teks tombol sesuai dengan status flash
    toggleFlashButton.textContent = isFlashOn ? "Matikan Flash" : "Hidupkan Flash";
}

// Fungsi untuk mengaktifkan/menonaktifkan mode layar penuh
function toggleFullScreen() {
    if (!document.fullscreenElement) {
        videoElement.requestFullscreen().catch(err => {
            alert(`Error attempting to enable full-screen mode: ${err.message}`);
        });
    } else {
        document.exitFullscreen();
    }
    
    // Ubah teks tombol sesuai dengan status mode layar penuh
    toggleFullScreenButton.textContent = document.fullscreenElement ? "Keluar Layar Penuh" : "Layar Penuh";
}

// Tambahkan event listener untuk tombol flash
toggleFlashButton.addEventListener("click", toggleFlash);

// Tambahkan event listener untuk tombol mode layar penuh
toggleFullScreenButton.addEventListener("click", toggleFullScreen);


function initScanner() {
    codeReader
    .listVideoInputDevices()
    .then(videoInputDevices => {
        videoInputDevices.forEach(device =>
            console.log(`${device.label}, ${device.deviceId}`)
        );

        if(videoInputDevices.length > 0){
                
            if(selectedDeviceId == null){
                if(videoInputDevices.length > 1){
                    selectedDeviceId = videoInputDevices[1].deviceId
                } else {
                    selectedDeviceId = videoInputDevices[0].deviceId
                }
            }
                
                
            if (videoInputDevices.length >= 1) {
                sourceSelect.html('');
                videoInputDevices.forEach((element) => {
                    const sourceOption = document.createElement('option')
                    sourceOption.text = element.label
                    sourceOption.value = element.deviceId
                    if(element.deviceId == selectedDeviceId){
                        sourceOption.selected = 'selected';
                    }
                    sourceSelect.append(sourceOption)
                })
            
            }

            codeReader
                .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                .then(result => {

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    
                        $('#myTable').DataTable().destroy();
                        table = $('#myTable').DataTable({
                              "paging":   false,
                              "ordering": false,
                              "processing": true,
                              "ajax":{
                                "url": "<?=base_url()?>index.php/pindai_rfid/scanQRcode/",
                                "dataType": "json",
                                "type": "POST",
                                "data" : {
                                  "scan" : result.text,
                                },
                              },
                              "columns": [
                                  { 
                                    data: "tag_number",
                                    'render': function(data, type, row, meta){
                                        if(type === 'display'){
                                          data = '<a href="javascript:void(0)" onclick="showData()" data-id="'+row.tag_number+'">' + data + '</a> ';
                                        }

                                        return data;
                                      } 
                                  }
                              ]  
                          });
                          setTimeout(function(){
                            $('.fokus').tagsinput('removeAll');
                          });
          
                        Toast.fire({
                            icon: 'success',
                            title: 'Pemindai Scan Qrcode' +result.text+ ' Berhasil' 
                        })
                        
                        $('.camp').hide();
                        if(codeReader){
                            codeReader.reset()
                        }
                })
                .catch(err => console.error(err));
                
        } else {
            alert("Camera not found!")
        }
    })
    .catch(err => console.error(err));
}


if (navigator.mediaDevices) {
    initScanner()
} else {
    alert('Cannot access camera.');
}


</script>

</html>