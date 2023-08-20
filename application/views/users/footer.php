
<script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
<script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
<script src="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?=base_url()?>assets/vendor/js/menu.js"></script>
<script src="<?=base_url()?>assets/js/main.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
let table = new DataTable('#myTable', {
  "paging":   false,
  "ordering": false,
  "info":     false
});

function addItem(){
  $('#modalLong').modal('show');
  $('#myform')[0].reset();
}

function deleteItem(id){
  Swal.fire({
    title: 'Apa kamu yakin?',
    text: "Ingin menghapus data ini!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Hapus ini!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "<?=base_url('index.php/users/hapus/')?>"+id;
    }
  });
}
function editItem(){
  id = event.currentTarget.dataset.id;
  username = event.currentTarget.dataset.username;
  nama = event.currentTarget.dataset.nama;
  password = event.currentTarget.dataset.password;

  $('[name="id_user"]').val(id);
  $('[name="email"]').val(username);
  $('[name="nama"]').val(nama);
  $('[name="password"]').val(password);
  $('#modalLong').modal('show');
}
</script>
