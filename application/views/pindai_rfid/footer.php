
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