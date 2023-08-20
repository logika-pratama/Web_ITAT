
<div class="row">
    <div class="col-md-12">
        <h5 class="card-header m-0"><?=$title?></h5>
    </div>
    <div class="col-md-12">
        <button onclick="addItem()" type="button"class="btn btn-primary" style="width:100%;">
            Tambah
        </button>
    </div>
    <div class="col-md-12 mt-1">
        <div class="">
            <table class="table table-striped table-bordered mt-3" style="font-size:10px;" id="myTable">
            <thead style="background-color:#342a29;">
                <tr>
                    <th style="color:white;">Nama</th>
                    <th style="color:white;">Username</th>
                    <th style="color:white;">Aksi</th>
                </tr>
            </thead>
            <tbody class="listtable">
                <?php foreach($users as $u){ ?>
                <tr>
                    <td><?=$u['name']?></td>
                    <td><?=$u['username']?></td>
                    <td>
                        <a href="javascript:void(0)" onclick="deleteItem('<?=$u['id_user']?>')" class="btn btn-danger btn-sm">Delete</a>
                        <a href="javascript:void(0)" data-id="<?=$u['id_user']?>" data-nama="<?=$u['name']?>" data-username="<?=$u['username']?>" data-password="<?=$u['password']?>" onclick="editItem('<?=$u['id_user']?>')" class="btn btn-info btn-sm">Edit</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLong" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
    <div class="modal-content ">
        <div class="modal-header">
            <h5 class="modal-title" id="modalLongTitle">Form Akun</h5>
        </div>
        <form id="myform" method="POST" action="<?=base_url('index.php/users/tambah')?>">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input name="nama" class="form-control">
                        <input name="id_user" type="hidden" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input name="password" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button"class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
            </button>
            <button type="submit" class="btn btn-success">
                Save
            </button>
        </div>
        </form>
    </div>
    </div>
</div>
