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
    <span>
      <button id="toggleFlashButton" class="btn btn-secondary btn-sm m-2">ON/OFF Flashlight</button>
    </span>
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
              <button type="button" onclick="closeModalContent()" class="btn btn-outline-secondary" data-bs-dismiss="modal">
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
        },500)
    });

    let selectedDeviceId = null;
    var hints = new Map();
    hints.set(ZXing.DecodeHintType.ASSUME_GS1, false)
    hints.set(ZXing.DecodeHintType.TRY_HARDER, false)
    const codeReader = new ZXing.BrowserMultiFormatReader(hints);

    function autoOnFlashlight() {
      const videoElement = document.getElementById('previewKamera');
      videoStream = videoElement.srcObject
      if (!videoStream) {
        console.log("Video stream doesn't exist")
        return;
      }
      const track = videoStream.getVideoTracks()[0];
      const capabilities = track.getCapabilities();
      if (!capabilities.torch) {
        console.log('Torch/flashlight is not supported on this device.');
        return;
      }
      isFlashOn = !isFlashOn;
      track.applyConstraints({
        advanced: [{ torch: true }]
      })
    }


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
                    // selectedDeviceId = videoInputDevices[0].deviceId
                }
                    
                codeReader
                    .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                    .then(result => {
                        $('.scan').hide();
                        codeReader.reset();

                        showData(result.text);
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

    function resetModalBody() {
      $(".list-data-history").html('');
      $(".list-data").html('');

      $('.asset_id').text('');
      $('.name_asset').text('');
      // $('.price').text('');
      $('.serial_number').text('');
      $('.year_project').text('');
      $('.ppk_user').text('');
      $('.name_project').text('');
      $('.name_vendor').text('');
    }

    function setModalBody(data) {
      const asset = data.asset
      $('.asset_id').text(asset['asset_id']);
      $('.name_asset').text(asset['name_asset']);
      // $('.price').text(formatPriceToIDR(asset['price']));
      $('.serial_number').text(asset['serial_number']);
      $('.year_project').text(asset['year_project']);
      $('.ppk_user').text(asset['ppk_user']);
      $('.name_project').text(asset['name_project']);
      $('.name_vendor').text(asset['name_vendor']);

      // Spek Tek
      const spekTek = asset.product_attribute
      for (let i in spekTek) {
          if (spekTek[i].description) {
            $('.list-data').append("<tr><td>"+ spekTek[i].name+"</td><td>"+spekTek[i].description +"</td></tr>");
          }
      }

      // History
      const history = data.history
      if (history.length > 0) {
        for (let i in history) {
          let todaydate = new Date(history[i].tanggal); 
          let dd = todaydate .getDate();
          let mm = todaydate .getMonth()+1;
          let yyyy = todaydate .getFullYear();
          if(dd<10){  dd='0'+dd } 
          if(mm<10){  mm='0'+mm } 
          let date = dd+'-'+mm+'-'+yyyy+' '+todaydate.getHours() + ':' + todaydate.getMinutes();
          $('.list-data-history').append("<tr><td>"+history[i].location_awal+"</td><td>"+history[i].location_tujuan+"</td><td>"+date+"</td></tr>");
        }
      }

    }

    function showData(rfid){
      if(rfid == null){
        rfid = event.currentTarget.dataset.id;
      }
      resetModalBody();

      $.ajax({
          url : "<?=base_url()?>index.php/scan_aset_v2/getScanAsset/",
          type: "GET",
          dataType:"JSON",
          data: {
            assetId: rfid
          },
          success: function(data){
            console.log(data);
            if (data.meta.code != 200) {
                Toast.fire({
                    icon: 'error',
                    title: data.meta.message // "Data tidak ditemukan"
                })
                $('.scan').show();
                // codeReader.reset();
                initScanner();
                turnOnFlashlight();
            } else {
                $('.scan').hide();
                $('#modalLong').modal('show');
                setModalBody(data.data);
            }  
          },
          error: function (xhr, ajaxOptions, thrownError) {
            Toast.fire({
                icon: 'error',
                title: 'Request data dari ITAM gagal lakukan scan ulang'
            })
            $('.scan').show();
            initScanner();
            turnOnFlashlight();
          }
      });
    }

    function closeModalContent(){
      $('#modalLong').modal('hide');
      $('.scan').show();
      initScanner();
      turnOnFlashlight();
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

    const toggleFlashButton = document.getElementById('toggleFlashButton');
    var videoElement = document.getElementById('previewKamera');
    var isFlashOn = false;
    var track0 = null

    function toggleFlashlight() {
      if (track0 != null) {
        isFlashOn = false
        $('.scan').hide();
        codeReader.reset();
        $('.scan').hide();
        codeReader.reset()
        track0 = null
        initScanner()
        $('.scan').show();
        return
      }
      const videoElement = document.getElementById('previewKamera');

      videoStream = videoElement.srcObject
      const track = videoStream.getVideoTracks()[0];
      if (track0 == null) {
        track0 = track
      }
      const capabilities = track.getCapabilities();
      if (!capabilities.torch) {
        isFlashOn = false;
        Toast.fire({
          icon: 'error',
          title: 'Tidak memiliki support flashlight pada kemera yang digunakan'
        })
        console.log('Torch/flashlight is not supported on this device.');
        return;
      }

      isFlashOn = true;
      track.applyConstraints({
        advanced: [{ torch: true }]
      })
      if (!isFlashOn) {
        track0 = null
      }

    }

    toggleFlashButton.addEventListener('click', toggleFlashlight);


    function turnOnFlashlight() {
      // We need to wait for video stream is active, so we need to assume that the video in active after 0s, 2.5s, 5s, 10s
      oNFlashlight();

      setTimeout(function(){
        oNFlashlight();
      }, 2500)

      setTimeout(function(){
        oNFlashlight();
      }, 5000)

      setTimeout(function(){
        oNFlashlight();
      }, 10000)
    }

    function oNFlashlight() {
      try {
        if (!isFlashOn) {
          return;
        }

        const videoElement = document.getElementById('previewKamera');
        videoStream = videoElement.srcObject
        const track = videoStream.getVideoTracks()[0];
        track0 = track
        const capabilities = track.getCapabilities();
        if (!capabilities.torch) {
          isFlashOn = false;
          Toast.fire({
            icon: 'error',
            title: 'Tidak memiliki support flashlight pada kemera yang digunakan'
          })
          console.log('Torch/flashlight is not supported on this device.');
          return;
        }

        isFlashOn = true;
        track.applyConstraints({
          advanced: [{ torch: true }]
        })
      } catch (e) {
        console.log(e)
      }
    }

  </script>
</html>
