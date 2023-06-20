
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

$( document ).ready(function() {
  $('.kontrak').select2();
  $.ajax({
      url : "<?=base_url()?>index.php/scan_rfid/getKontrak/",
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
  $('#tags-input').tagsinput('removeAll');

}

$(".kontrak").change(function(){
  $(".fokus").tagsinput('focus');
});

function getData(){
  scan = $("[name='scanrfid']").val();
  kontrak = $('.kontrak').val();

  $('#myTable').DataTable().destroy();

  table = $('#myTable').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "processing": true,
        "ajax":{
          "url": "<?=base_url()?>index.php/scan_rfid/scanRFID/",
          "dataType": "json",
          "type": "POST",
          "data" : {
            "scan" : scan,
            "kontrak" : kontrak
          },
        },
        "columns": [
            { 
              data: "assets_id",
              'render': function(data, type, row, meta){
                  if(type === 'display'){
                    data = '<a href="javascript:void(0)" onclick="showData()" data-id="'+row.assets_id+'">' + data + '</a> ';
                  }

                  return data;
                } 
            },
            { 
              data: "name_asset",
              'render': function(data, type, row, meta){
                  if(type === 'display'){
                    data = '<a href="javascript:void(0)" onclick="showData()" data-id="'+row.assets_id+'">' + data + '</a> ';
                  }

                  return data;
                } 
            },
            {
               data: "location_asset",
               'render': function(data, type, row, meta){
                  if(type === 'display'){
                    data = '<a href="javascript:void(0)" onclick="showData()" data-id="'+row.assets_id+'">' + data + '</a> ';
                  }

                  return data;
                } 
            },
        ]  
    });

    setTimeout(
      function(){
        $('.total-item').text('Total : '+table.rows().count());
    }, 2000);
  
    $('.fokus').blur();
    $('#tags-input').tagsinput('removeAll');

}

function closeMat(){
  $.ajax({
      url : "<?=base_url()?>index.php/scan_rfid/closeMat/",
      type: "POST",
      dataType:"JSON",
      success: function(data){
      },
  });
}

function showData(){
  rfid = event.currentTarget.dataset.id;
  $(".list-data").html('loading..');
  $(".list-data-history").html('loading..');
  $.ajax({
      url : "<?=base_url()?>index.php/scan_rfid/detailRFID/"+rfid,
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

  $('#modalLong').modal('show');
}

setTimeout(function(){
    $(".fokus").tagsinput('focus');
},1000);

