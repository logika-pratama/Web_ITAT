
<script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
<script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
<script src="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?=base_url()?>assets/vendor/js/menu.js"></script>
<script src="<?=base_url()?>assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>

<script type="text/javascript">

let selectedDeviceId = null;
const codeReader = new ZXing.BrowserMultiFormatReader();
const sourceSelect = $("#pilihKamera");

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
})

function initScanner() {
    codeReader
    .listVideoInputDevices()
    .then(videoInputDevices => {
        // videoInputDevices.forEach(device =>
        //     console.log(`${device.label}, ${device.deviceId}`)
        // );

        if (videoInputDevices.length > 0) {

            // Access first access for initial
            if(selectedDeviceId == null){
                selectedDeviceId = videoInputDevices[0].deviceId
            }
            
            // Show camera option 
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

            // Read QRCode and display text result
            codeReader
                .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                .then(result => {

                    let kontrakId = $('.kontrak').find(":selected").val();
                    if (kontrakId == -1) {
                        Toast.fire({
                            icon: 'error',
                            title: "Kontrak wajib dipilih"
                        })
                    } else {
                        console.log("==========================");
                        console.log(result);
                        // getUjiMaterial();
                        $('.content').text(result.text)

                    }
                    
                    $('.camp').hide();
                    if(codeReader){
                        codeReader.reset();
                    }

                })
                .catch(err => {
                    if (err.message == 'Could not start video source') {
                        let deviceName = $('#pilihKamera').find(":selected").text();
                        console.error(err, `Cannot access ${deviceName}`);
                        alert(`Cannot access ${deviceName}`);
                    }
                });
                
        } else {
            alert("Camera not found!")
        }
    })
    .catch(err => console.error(err));
}

function setKontrak() {
    $.ajax({
        url : "<?=base_url()?>index.php/ujimat_scanqr/getKontrak/",
        type: "GET",
        dataType:"JSON",
        success: function(data){
            console.log(data)
            var i;
            for (i = 0; i < data.length; ++i) {
                console.log(data[i])
                $('.kontrak').append('<option value="'+data[i]['id']+'">'+data[i]['description']+'</option>');
            }       
        }
    });
}

function getUjiMaterial() {

}

$(document).ready(function() {
    $('.camp').show();
    setKontrak();
});

$(document).on('change','#pilihKamera',function(){
    selectedDeviceId = $(this).val();
    if(codeReader){
        codeReader.reset();
        initScanner();
    }
})

$(document).on('click','#resetScan',function(){
    if(codeReader){
        codeReader.reset();
        $(".kontrak").val("-1").change(); // set nilai kontrak ke "Pilih Kontrak" 
        $('.camp').show();
        initScanner();
        $('.content').text('');
    }
})

$(document).on('change','.kontrak',function(){
    if(codeReader){
        $('.camp').show();
        codeReader.reset();
        initScanner();
        $('.content').text('');
    }
})

if (navigator.mediaDevices) {
    initScanner();
} else {
    alert('Cannot access camera.');
}


</script>
