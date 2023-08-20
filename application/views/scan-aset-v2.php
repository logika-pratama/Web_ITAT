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

      .feature-title {
        position: relative;
        color: rgb(255, 255, 255);
        mix-blend-mode: difference;
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
    <span class="float-end m-2 me-4">
      <h2 class="feature-title">Pindai Aset</h2>
    </span>

    <!-- <select id="pilihKamera" class="form-control pilihKamera fixed-bottom m-auto" style="width: 75%"></select> -->
    <!-- <select id="pilihKamera" class="form-control pilihKamera fixed-bottom mb-1" style="width: 100%"></select> -->
    <select id="pilihKamera" class="form-control pilihKamera fixed-bottom mb-1 col-sm-9" style="width: 75%; heigth: 25px;"></select>
    <button id="refreshKamera" class="btn btn-secondary btn-sm mb-1" style="width: 15%;  heigth: 25px; position: fixed; bottom: 0.25%; right: 5%;">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M10 11H7.101l.001-.009a4.956 4.956 0 0 1 .752-1.787a5.054 5.054 0 0 1 2.2-1.811c.302-.128.617-.226.938-.291a5.078 5.078 0 0 1 2.018 0a4.978 4.978 0 0 1 2.525 1.361l1.416-1.412a7.036 7.036 0 0 0-2.224-1.501a6.921 6.921 0 0 0-1.315-.408a7.079 7.079 0 0 0-2.819 0a6.94 6.94 0 0 0-1.316.409a7.04 7.04 0 0 0-3.08 2.534a6.978 6.978 0 0 0-1.054 2.505c-.028.135-.043.273-.063.41H2l4 4l4-4zm4 2h2.899l-.001.008a4.976 4.976 0 0 1-2.103 3.138a4.943 4.943 0 0 1-1.787.752a5.073 5.073 0 0 1-2.017 0a4.956 4.956 0 0 1-1.787-.752a5.072 5.072 0 0 1-.74-.61L7.05 16.95a7.032 7.032 0 0 0 2.225 1.5c.424.18.867.317 1.315.408a7.07 7.07 0 0 0 2.818 0a7.031 7.031 0 0 0 4.395-2.945a6.974 6.974 0 0 0 1.053-2.503c.027-.135.043-.273.063-.41H22l-4-4l-4 4z"/></svg>
    </button>

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
    const sourceSelect = $("#pilihKamera");

    $(document).on('click','#refreshKamera',function(){
        if(codeReader){
            codeReader.reset()
            initScanner();
            turnOnFlashlight();
        }
    })

    $(document).on('change','#pilihKamera',function(){
      selectedDeviceId = $(this).val();
      if(codeReader){
        codeReader.reset();
        initScanner();
        turnOnFlashlight();
      }
    })


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
