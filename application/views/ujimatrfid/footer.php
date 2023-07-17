
<script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
<script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
<script src="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?=base_url()?>assets/vendor/js/menu.js"></script>
<script src="<?=base_url()?>assets/js/main.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">

$( document ).ready(function() {
  $(".scancuy").focus()
});

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

function getData(){
  scan = $("[name='scanrfid']").val();
}

$(".scancuy").change(function(){
  showData();
});

function closeMat(){
  $("[name='scanrfid']").val('');
  $(".scancuy").focus()
  $.ajax({
      url : "<?=base_url()?>index.php/scan_rfid/closeMat/",
      type: "POST",
      dataType:"JSON",
      success: function(data){
      },
  });
}

function showData(){
    rfid = $("[name='scanrfid']").val();
    console.log(rfid);
    $(".list-data-history").html('');
    $(".list-data").html('');

    $('.asset_id').text('');
    $('.name_asset').text('');
    $('.serial_number').text('');
    $('.year_project').text('');
    $('.ppk_user').text('');
    $('.name_project').text('');
    $('.name_vendor').text('');


  $.ajax({
      url : "<?=base_url()?>index.php/scan_rfid/setRFID/"+rfid,
      type: "GET",
      dataType:"JSON",
      success: function(data){
        console.log(data)
        // $('.scan').hide();
        if (!data?.data?.detail[0]?.asset_id && data?.meta?.code == 200) {
            Toast.fire({
                icon: 'error',
                // title: 'Request data dari ITAM gagal, scan ulang'
                title: data?.meta?.message
            })
            $('.scan').show();
        } else if (!data?.data?.detail[0]?.asset_id) {
            Toast.fire({
                icon: 'error',
                title: 'Permintaan data gagal, scan ulang setelah beberapa saat'
            })
            $('.scan').show();
        } else {
            $('.asset_id').text(data['data']['detail'][0]['asset_id']);
            $('.name_asset').text(data['data']['detail'][0]['name_asset']);
            $('.serial_number').text(data['data']['detail'][0]['serial_number']);
            $('.year_project').text(data['data']['detail'][0]['year_project']);
            $('.ppk_user').text(data['data']['detail'][0]['ppk_user']);
            $('.name_project').text(data['data']['detail'][0]['name_project']);
            $('.name_vendor').text(data['data']['detail'][0]['name_vendor']);

            // var i;

            for (let i = 0; i < data['data']['detail'][0]['product_attribute'].length; ++i) {
                if(data['data']['detail'][0]['product_attribute'][i]['description'] != ""){
                    $('.list-data').append("<tr><td>"+data['data']['detail'][0]['product_attribute'][i]['name']+"</td><td>"+data['data']['detail'][0]['product_attribute'][i]['description']+"</td></tr>");
                }
            }

            // console.log(data.data.move)
            for (let z = 0; z < data['data']['move'].length; ++z) {
                // console.log(data['data']['move'][z])
                var todaydate = new Date(data['data']['move'][z]['tanggal']); 
                var dd = todaydate .getDate();
                var mm = todaydate .getMonth()+1;
                var yyyy = todaydate .getFullYear();
                if(dd<10){  dd='0'+dd } 
                if(mm<10){  mm='0'+mm } 
                var date = dd+'-'+mm+'-'+yyyy+' '+todaydate.getHours() + ':' + todaydate.getMinutes();

                $('.list-data-history').append("<tr><td>"+data['data']['move'][z]['location_awal']+"</td><td>"+data['data']['move'][z]['location_tujuan']+"</td><td>"+date+"</td></tr>");
            }

            $('#modalLong').modal('show');
        }

      },
      error: function (xhr, ajaxOptions, thrownError) {
        // Tag QR asal asalan
        Toast.fire({
            icon: 'error',
            title: 'Data RFID tidak ditemukan'
        })
        // console.log(thrownError)
        // console.log(xhr)
        // console.log(ajaxOptions)
        $('.scan').show();
        // sleep(1500);
        initScanner();

      }
  });
}

</script>