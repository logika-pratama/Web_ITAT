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
    setTimeout(function(){
      initScanner();
    },1000)
    let selectedDeviceId = null;
    const codeReader = new ZXing.BrowserMultiFormatReader();
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
      $(".list-data").html('Menunggu Request dari ITAM');
      $(".list-data-history").html('Menunggu Request dari ITAM');
      $.ajax({
          url : "<?=base_url()?>index.php/scan_rfid/detailRFID/"+rfid,
          type: "GET",
          dataType:"JSON",
          success: function(data){
              $('.scan').hide();
              $('#modalLong').modal('show');
              $(".list-data").html('');
                $('.asset_id').text(data['data'][0]['asset_id']);
              $('.name_asset').text(data['data'][0]['name_asset']);
              $('.serial_number').text(data['data'][0]['serial_number']);
              $('.year_project').text(data['data'][0]['year_project']);
              $('.ppk_user').text(data['data'][0]['ppk_user']);
              $('.name_project').text(data['data'][0]['name_project']);
              var i;
              for (i = 0; i < data['data'][0]['product_attribute'].length; ++i) {
                if(data['data'][0]['product_attribute'][i]['description'] != ""){
                  $('.list-data').append("<tr><td>"+data['data'][0]['product_attribute'][i]['name']+"</td><td>"+data['data'][0]['product_attribute'][i]['description']+"</td></tr>");
                }
              }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            Toast.fire({
                icon: 'error',
                title: 'Data '+rfid+' tidak ditemukan'
            })
          }
      });

      $.ajax({
          url : "<?=base_url()?>index.php/scan_rfid/setRFID/"+rfid,
          type: "GET",
          dataType:"JSON",
          success: function(data){
          },
      });

      $.ajax({
          url : "<?=base_url()?>index.php/scan_rfid/historyRFID/"+rfid,
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
    }

    function closeMat(){
      $('.scan').show();
      $.ajax({
          url : "<?=base_url()?>index.php/pindai_rfid/closeMat/",
          type: "POST",
          dataType:"JSON",
          success: function(data){
          },
      });
    }
  </script>
</html>
