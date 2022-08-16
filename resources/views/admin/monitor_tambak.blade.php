@extends('layouts.menuadmin')

@section('content')
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-5">
            <h3 class="page-title mb-3">Data Tambak</h3>
        </div>
    </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Semua Data Tambak
                <div class="float-end">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal">Tambah Tambak</button>
                </div>
            </div>
            <div class="card-body">
                <table  id="tabledata" class="table-hover table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">ID Alat</th>
                            <th scope="col">alamat</th>
                            <th scope="col">luas</th>
                            <th scope="col">Jenis Pakan</th>
                            <th scope="col">Gram Pakan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-list">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- create modal --}}
<div class="modal fade" id="add-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tambak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="add-post" method="post">
                    <div class="mb-3">
                        <label for="id_hardware" class="form-label">ID hardware</label>
                        <input class="form-control" id="id_hardware" name="id_hardware">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="luas" class="form-label">Luas Tambak dalam hektar(ha)</label>
                        <input type="number" class="form-control" name="luas" id="luas">
                    </div>
                    <div class="mb-3">
                        <label for="jenisPakan" class="form-label">Jenis Pakan</label>
                        <input type="text" class="form-control" id="jenisPakan" name="jenisPakan">
                    </div>
                    <div class="mb-3">
                        <label for="gramPakan" class="form-label">Gram Pakan</label>
                        <input type="number" class="form-control" id="gramPakan" name="gramPakan">
                    </div>
                    <input type="hidden" value="{{Session::get('uid')}}" name="userid" id="userid">
                    <button type="button" id="add-submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- update modal --}}
<div class="modal fade" id="update-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="update-post" method="post">
                    <div class="mb-3">
                        <label for="update-id_hardware" class="form-label">ID hardware</label>
                        <textarea class="form-control" name="id_hardware" id="update-id_hardware"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="update-alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="update-alamat"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="update-luas" class="form-label">luas</label>
                        <input type="number" class="form-control" name="luas" id="update-luas">
                    </div>
                    <div class="mb-3">
                        <label for="update-jenisPakan" class="form-label">Jenis Pakan</label>
                        <input type="text" class="form-control" name="jenisPakan" id="update-jenisPakan">
                    </div>
                    <div class="mb-3">
                        <label for="update-gramPakan" class="form-label">Gram Pakan</label>
                        <input type="number" class="form-control" name="gramPakan" id="update-gramPakan">
                    </div>
                    <input type="hidden" value="{{Session::get('uid')}}" name="userid" id="update-userid">
                    <button type="button" id="update-button" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- delete modal --}}
<div class="modal fade" id="delete-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="lead">Are you sure you want to delete this post?</p>
                <input name="id" id="post-id" type="hidden">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="delete-button" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
<script type="text/javascript">
    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "{{ config('services.firebase.api_key') }}",
        authDomain: "{{ config('services.firebase.auth_domain') }}",
        databaseURL: "{{ config('services.firebase.database_url') }}",
        projectId: "{{ config('services.firebase.project_id') }}",
        storageBucket: "{{ config('services.firebase.storage_bucket') }}",
        messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
        appId: "{{ config('services.firebase.app_id') }}"
    };

    // Initialize Firebase
    const app = firebase.initializeApp(firebaseConfig);

    var database = firebase.database();

    var lastId = 0;

    // get post data
    database.ref("tambak").on('value', function(snapshot) {
        var value = snapshot.val();
        var htmls = [];
        var no =1;
        $.each(value, function(index, value) {
            if (value) {
                htmls.push('<tr>\
                        <td>' + no++ + '</td>\
                        <td>' + value.id_hardware + '</td>\
                        <td>' + value.alamat + '</td>\
                        <td>' + value.luas + '</td>\
                        <td>' + value.jenisPakan + '</td>\
                        <td>' + value.gramPakan + '</td>\
                        <td><a data-bs-toggle="modal" data-bs-target="#update-modal" class="btn btn-success update-post" data-id="' + index + '">Update</a>\
                        <a class="btn btn-primary" href="datakolam/' + index +'" >Detail Tambak</a>\
                        <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn btn-danger delete-data" data-id="' + index + '">Delete</a></td>\
                    </tr>');
            }
            lastId = index;
        });
        $('#table-list').html(htmls);
        var table = $('#tabledata').DataTable({
            responsive: true,
            stateSave: true,
            "bDestroy": true
        });
        new $.fn.dataTable.FixedHeader(table);
    });

    // add data
    $('#add-submit').on('click', function() {
        var formData = $('#add-post').serializeArray();
        var createId = Number(lastId) + 1;

        firebase.database().ref('tambak/' + createId).set({
            id_hardware: formData[0].value,
            alamat: formData[1].value,
            luas: formData[2].value,
            jenisPakan: formData[3].value,
            gramPakan: formData[4].value,
            userid: formData[5].value,
        });

        // Reassign lastID value
        lastId = createId;
        $("#add-post")[0].reset();
        $("#add-modal").modal('hide');
    });

    // update modal
    var updateID = 0;
    $('body').on('click', '.update-post', function() {
        updateID = $(this).attr('data-id');
        firebase.database().ref('tambak/' + updateID).on('value', function(snapshot) {
            var values = snapshot.val();
            $('#update-alamat').val(values.id_hardware);
            $('#update-alamat').val(values.alamat);
            $('#update-luas').val(values.luas);
            $('#update-jenisPakan').val(values.jenisPakan);
            $('#update-gramPakan').val(values.gramPakan);
            $('#update-userid').val(values.userid);
        });
    });

    // update post
    $('#update-button').on('click', function() {
        var values = $("#update-post").serializeArray();
        var postData = {
            id_hardware: values[0].value,
            alamat: values[1].value,
            luas: values[2].value,
            jenisPakan: values[3].value,
            gramPakan: values[4].value,
            userid: values[5].value,
        };

        var updatedPost = {};
        updatedPost['/tambak/' + updateID] = postData;

        firebase.database().ref().update(updatedPost);

        $("#update-modal").modal('hide');
        $("#update-post")[0].reset();
    });

    // delete modal
    $("body").on('click', '.delete-data', function() {
        var id = $(this).attr('data-id');
        $('#post-id').val(id);
    });

    // delete post
    $('#delete-button').on('click', function() {
        var id = $('#post-id').val();
        firebase.database().ref('tambak/' + id).remove();

        $('#post-id').val('');
        $("#delete-modal").modal('hide');
    });
</script>
@endsection