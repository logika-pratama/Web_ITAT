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
    <style>

      video {
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

    </style>
  </head>
  <body>
  <div class="half-black">
    <img src="<?=base_url('assets/img/qrcode.png')?>" class="imgqrcode"/>
    <div class="scan"></div>

    <video id="previewKamera" class="video"></video>
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
                      <td>PPK</td>
                      <td> : <span class="ppk_user"></span></td>
                  </tr>
                  <tr>
                      <td>Proyek</td>
                      <td> : <span class="name_project"></span></td>
                  </tr>
                  <tr>
                      <td>Nilai Proyek</td>
                      <td> : <span class="price"></span></td>
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
  <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
  <script>
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
    
    
    $( document ).ready(function() {
      setTimeout(function(){
          initScanner();
        },1000)
    });

    let selectedDeviceId = null;
    var hints = new Map();
    hints.set(ZXing.DecodeHintType.ASSUME_GS1, false)
    hints.set(ZXing.DecodeHintType.TRY_HARDER, false)
    const codeReader = new ZXing.BrowserMultiFormatReader(hints);
    const sourceSelect = $("#pilihKamera");

    $(document).on('change','#pilihKamera',function(){
        selectedDeviceId = $(this).val();
        if(codeReader){
            codeReader.reset()
            initScanner();
        }
    })

    
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
                // f35bf484feac18e2f9421957fcfd60e67a21fd32a88551baf200e6cbf9c853f8
                // selectedDeviceId
                codeReader
                    .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                    .then(result => {
                            showData(result.text);
                            setTimeout(function(){
                              initScanner()
                              if(codeReader){
                                  codeReader.reset()
                              }
                            },1000)
                            
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

    function showData(rfid){
      if(rfid == null){
        rfid = event.currentTarget.dataset.id;
      }
    
        $(".list-data-history").html('');
        $(".list-data").html('');

        $('.asset_id').text('');
        $('.name_asset').text('');
        $('.price').text('');
        $('.serial_number').text('');
        $('.year_project').text('');
        $('.ppk_user').text('');
        $('.name_project').text('');


      $.ajax({
          url : "<?=base_url()?>index.php/scan_rfid/setRFID/"+rfid,
          type: "GET",
          dataType:"JSON",
          success: function(data){
            $('.scan').hide();
            
            if(data['data']['detail'][0]['asset_id'] != null){
                $('#modalLong').modal('show');
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Request data dari ITAM gagal lakukan scan ulang'
                })
            }

            $('.asset_id').text(data['data']['detail'][0]['asset_id']);
            $('.name_asset').text(data['data']['detail'][0]['name_asset']);
            $('.price').text(formatPriceToIDR(data['data']['detail'][0]['price']));
            $('.serial_number').text(data['data']['detail'][0]['serial_number']);
            $('.year_project').text(data['data']['detail'][0]['year_project']);
            $('.ppk_user').text(data['data']['detail'][0]['ppk_user']);
            $('.name_project').text(data['data']['detail'][0]['name_project']);

            var i;

            for (i = 0; i < data['data']['detail'][0]['product_attribute'].length; ++i) {
                if(data['data']['detail'][0]['product_attribute'][i]['description'] != ""){
                    $('.list-data').append("<tr><td>"+data['data']['detail'][0]['product_attribute'][i]['name']+"</td><td>"+data['data']['detail'][0]['product_attribute'][i]['description']+"</td></tr>");
                }
            }

            var z;
            for (z = 0; data['data']['move'].length; ++z) {
                var todaydate = new Date(data['data']['move'][z]['tanggal']); 
                var dd = todaydate .getDate();
                var mm = todaydate .getMonth()+1;
                var yyyy = todaydate .getFullYear();
                if(dd<10){  dd='0'+dd } 
                if(mm<10){  mm='0'+mm } 
                var date = dd+'-'+mm+'-'+yyyy+' '+todaydate.getHours() + ':' + todaydate.getMinutes();

                $('.list-data-history').append("<tr><td>"+data['data']['move'][z]['location_awal']+"</td><td>"+data['data']['move'][z]['location_tujuan']+"</td><td>"+date+"</td></tr>");
            }

          },
          error: function (xhr, ajaxOptions, thrownError) {
            Toast.fire({
                icon: 'error',
                title: 'Request data dari ITAM gagal lakukan scan ulang'
            })
          }
      });
      initScanner();

    }

    function closeMat(){
      $('.scan').show();
      $.ajax({
          url : "<?=base_url()?>index.php/pindai_rfid/closeMat/",
          type: "POST",
          dataType:"JSON",
          success: function(data){
            initScanner();

          },
      });
    }

    function formatPriceToIDR(value) {
      if (!value) return value;
      let valueStr = String(value);
      if (valueStr.length <= 3) return 'Rp'+valueStr
      let startPos = valueStr.length % 3;
      let result = valueStr.slice(0, startPos) + '.' + valueStr.slice(startPos).match(/\d{3}/g).join('.');
      if (result[0] == '.') {
          result = result.substr(1)
      }
      return 'Rp'+result;
  }

  </script>
</html>
