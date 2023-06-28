
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
  $('.kontrak').select2();
  $.ajax({
      url : "<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/getKontrak/",
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

$(".kontrak").change(function(){
    $("#loader").show();
    $('.sipb').html('');
    id = $(this).val();
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

</script>