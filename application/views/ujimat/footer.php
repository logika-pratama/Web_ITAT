
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

<script type="text/javascript">
var table;
var BASEURL = 'https://aset.divtik.polri.go.id/api_itam/api/';
$( document ).ready(function() {
  table = $('#myTable').DataTable(
    {
      "paging":   false,
      "ordering": false,
      "processing": true,
    }
  );
  $('.kontrak').select2();
  $('.sipb').select2();
  $.ajax({
      url : "<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/getKontrak/",
      type: "GET",
      dataType:"JSON",
      success: function(data){
        var i;
        rss = JSON.stringify(data);
        $('.kontrak-data').val(rss);
        for (i = 0; i < data.length; ++i) {
         
          $('.kontrak').append('<option value="'+data[i]['id']+'">'+data[i]['description']+'</option>');
        }       
      },
  });
});

$(".kontrak").change(function(){
    $("#loader").show();
    $('.sipb').html('');
    id = $(this).val();

    $.ajax({
      url : "<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/addKontrak/"+id,
      type: "POST",
      data:{ rss:$('.kontrak-data').val()},
    success: function(data){
     
    },
    error: function (xhr, status, error){}
    });

    $.ajax({
      url : BASEURL+'sipb?id_kontrak='+id,
      type: "GET",
      headers: {
        "apikey": "$pbkdf2-sha512$6000$GMP4/39PSak1ZsyZs1aqVQ$a60XBBB.7SIq0rjWhdoR8vc27x526lcHngEN./Ou2kO2mJaHKww7abLzqvRRZZfaAu/3IXlxq5hOi71F2rStYA"
      },
    success: function(data){
      $("#loader").hide();
      $('.sipb').append('<option value="">-- Pilih SIPB --</option>');
      var i;
      for (i = 0; i < data.data.length; ++i) {
        $('.sipb').append('<option value="'+data.data[i]['id']+'">['+data.data[i]['name']+'] '+data.data[i]['description']+'</option>');
      }
    },
    error: function (xhr, status, error){}
    });
});

$(".sipb").change(function(){
  $('#myTable').DataTable().destroy();
    $("#loader").show();
    id = $(this).val();
    $('.belum').html('');
    $('.sudah').html('');
    $.ajax({
      url : BASEURL+'label/get_read?sipb_id='+id,
      type: "GET",
      headers: {
        "apikey": "$pbkdf2-sha512$6000$GMP4/39PSak1ZsyZs1aqVQ$a60XBBB.7SIq0rjWhdoR8vc27x526lcHngEN./Ou2kO2mJaHKww7abLzqvRRZZfaAu/3IXlxq5hOi71F2rStYA"
      },
    success: function(data){
      for (i = 0; i < data.data['belum'].length; ++i) {
        rfid = data.data['belum'][i]['no_code'].toString();
        $('.listtable').append('<tr><td><input type="checkbox" onclick="addItem()" data-id="'+rfid+'" class="check '+rfid+'" name="getId[]" value="'+data.data['belum'][i]['no_code']+'"></td><td onclick="showData()" data-id="'+rfid+'">'+data.data['belum'][i]['no_code']+'</td><td>'+data.data['belum'][i]['nama_aset']+'</td></tr>');
      }
      for (i = 0; i < data.data['sudah'].length; ++i) {
        rfid = data.data['sudah'][i]['no_code'];
        $('.listtable').append('<tr><td><input type="checkbox" onclick="addItem()" data-id="'+rfid+'" class="check '+rfid+'" name="getId[]" value="'+data.data['sudah'][i]['no_code']+'"></td><td onclick="showData()" data-id="'+rfid+'">'+data.data['sudah'][i]['no_code']+'</td><td>'+data.data['sudah'][i]['nama_aset']+'</td></tr>');
      }
      
      setTimeout(function(){
        $('#myTable').DataTable({
          "paging":   false,
          "ordering": false,
          "processing": true,
        });
      },500);

      $("#loader").hide();
    },
    error: function (xhr, status, error){}
    });
});
  
$("#checkAll").click(function() {
    status = $(this).is(":checked");
    if (status == 'true') {
      $('.check').prop('checked', true);
    } else {
      $('.check').prop('checked', false);
    }
});

function ujimat(){
  $('#modal-ujimat').modal('show');
}


$( document ).ready(function() {
    $('.camp').hide();
});

function scanQrcode(num){
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
                        $('.dataTables_filter input').val(result.text);

                        $('.'+result.text).prop('checked', true);
                        
                        setTimeout(function(){
                          $('.dataTables_filter input').focus();
                          showData(result.text);
                          addItem(result.text);
                        },500);

                        
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

function showData(rfid){
  if(rfid == null){
    rfid = event.currentTarget.dataset.id;
  }
  $(".list-data").html('Menunggu Request dari ITAM');
  $(".list-data-history").html('Menunggu Request dari ITAM');
  $('#modalLong').modal('show');
  $.ajax({
      url : "<?=base_url()?>index.php/scan_rfid/detailRFID/"+rfid,
      type: "GET",
      dataType:"JSON",
      success: function(data){
        $(".list-data").html('');

        $('.asset_id').text(data['data'][0]['asset_id']);
        $('.name_asset').text(data['data'][0]['name_asset']);
        $('.price').text(data['data'][0]['price']);
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

function addItem(rfid){
  if(rfid == null){
    rfid = event.currentTarget.dataset.id;
  }
  status = $('.'+rfid).is(":checked");
    if (status == 'true') {
      url = "<?=base_url()?>index.php/ujimat/addItem/"+rfid+"/1";
    } else {
      url = "<?=base_url()?>index.php/ujimat/addItem/"+rfid+"/0";
    }
    
    $.ajax({
      url : url,
      type: "GET",
      dataType:"JSON",
      success: function(data){
      },
    });

}

</script>