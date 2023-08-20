<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>ITAT Mobile</title>
    <meta name="description" content="" />
	  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/img/favicon/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css"/>
  </head>

  <body>
  <section>
	</section>
    <div class="row">
      <div class="col-md-12">
        <h4 style="text-align:center;">Dashboard Uji Mat</h4>
      </div>
      <div class="col-md-6 col-xl-6">
        <table>
          <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td><?=date('d-m-Y')?></td>
          </tr>
          <tr>
            <td>PPK</td>
            <td>:</td>
            <td><span class="nama_ppk"></span></td>
          </tr>
          <tr>
            <td>Proyek</td>
            <td>:</td>
            <td><span class="description"></span></td>
          </tr>          
        </table>
      </div>
      <div class="col-md-6 col-xl-6">
        <table>
            <tr>
              <td>No Kontrak</td>
              <td>:</td>
              <td><span class="name"></span></td>
            </tr>
            <tr>
              <td>Tahun</td>
              <td>:</td>
              <td><span class="t_apbn"></span></td>
            </tr>
        </table>
      </div>
      <div class="col-md-12 col-xl-12">
          <div class="table-data"></div>
      </div>
    </div>
    <script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
    <script>
      setInterval(function () {
        $.ajax({
          url : '<?=base_url('index.php/dashboard_ujimat/getStatus')?>',
          type: "GET",
          dataType: "json",
        success: function(data){
          rasponse = $.parseJSON(data['response']);
            $('.nama_ppk').text(rasponse['nama_ppk']);
            $('.description').text(rasponse['description']);
            $('.name').text(rasponse['name']);
            $('.t_apbn').text(rasponse['t_apbn']);
            
            if(data['status_ujimat'] == 0){
              $.ajax({
                url : '<?=base_url('index.php/dashboard_ujimat/getUjimat')?>',
                type: "GET",
              success: function(data){
                $('.table-data').html(data);
              },
              error: function (xhr, status, error){}
              });
            }
        },
        error: function (xhr, status, error){}
        });
        },1000);
    </script>
  </body>
</html>
