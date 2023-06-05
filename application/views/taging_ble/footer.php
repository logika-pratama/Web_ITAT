
<script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
<script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
<script src="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?=base_url()?>assets/vendor/js/menu.js"></script>
<script src="<?=base_url()?>assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>

<script type="text/javascript">

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
})

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

                        var no = $('.ble').val();
                        $('.qrcode'+no).text(result.text);
                        $('.qrcode'+no).val(result.text);
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

function konfirmasi(){
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

    if($('.ble1').val() == '' || $('.ble2').val() == ''){
        Toast.fire({
            icon: 'error',
            title: 'Tags RFID atau BLE Belum Terisi'
        }) 
    }

    $.ajax({
      url : "<?=base_url()?>index.php/taging_ble/konfrim/",
      type: "POST",
      data:{
        ble1:$('.qrcode1').val(),
        ble2:$('.qrcode2').val(),
      },
      dataType:"JSON",
        success: function(data){
            $('.qrcode1').text('');
            $('.qrcode2').text('');
            $('.ble1').val('');
            $('.ble2').val('');
            
            Toast.fire({
                icon: 'success',
                title: 'Taging BLE dan RFID Berhasil'
            })
      },
    });
}

</script>
