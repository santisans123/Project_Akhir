@extends('layouts.menunelayan')

@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h3 class="page-title mb-3">Data Tambak</h3>
                <h2 id="identitas"></h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="col align-self-center">Semua Data Tambak</h4>
                        <div class="col">
                            <button type="button" class="btn btn-sm btn-primary py-2 my-2 float-end" data-bs-toggle="modal"
                                data-bs-target="#add-modal">Tambah Tambak</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Alat</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Nama Tambak</th>
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
                            <label for="namatambak" class="form-label">Nama Tambak</label>
                            <input type="text" class="form-control" name="namatambak" id="namatambak">
                        </div>
                        <input type="hidden" value="{{ Session::get('uid') }}" name="userid" id="userid">
                        <button type="button" id="add-submit" class="btn btn-primary">Tambah</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
                    <h5 class="modal-title">Edit Tambak</h5>
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
                            <label for="update-namatambak" class="form-label">Nama Tambak</label>
                            <input type="text" class="form-control" name="namatambak" id="update-namatambak">
                        </div>
                        <input type="hidden" value="{{ Session::get('uid') }}" name="userid" id="update-userid">
                        <button type="button" id="update-button" class="btn btn-primary">Ubah</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
                    <h5 class="modal-title">Hapus Tambak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="lead">Apakah anda ingin menghapus data ini?</p>
                    <input name="id" id="post-id" type="hidden">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" id="delete-button" class="btn btn-primary">Hapus</button>
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
            var no = 1;


            $.each(value, function(index, value) {
                if (value && value.userid === "{{ Session::get('uid') }}") {

                    htmls.push('<tr>\
                                <td>' + no++ + '</td>\
                                <td>' + value.id_hardware + '</td>\
                                <td>' + value.alamat + '</td>\
                                <td>' + value.namatambak + '</td>\
                                <td>\
                                    <a class="btn btn-primary mt-1" href="datakolam/' + value.id_hardware +
                        '" >Detail Kolam</a>\
                                    <a data-bs-toggle="modal" data-bs-target="#update-modal" class="btn text-white btn-success mt-1 update-post" data-id="' +
                        index +
                        '">Edit</a>\
                                    <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn text-white btn-danger mt-1 delete-data" data-id="' +
                        index + '">Hapus</a></td>\
                            </tr>');
                }
                lastId = index;
            });
            $('#table-list').html(htmls);
        });

        database.ref("profile").on('value', function(snapshot) {
            var value = snapshot.val();
            var htmls = [];
            $.each(value, function(index, value) {
                if (value && value.userid === "{{ Session::get('uid') }}") {
                    htmls.push('<div>' + value.name + '</div>');
                }
                lastId = index;
            });
            $('#identitas').html(htmls);
        });
        // $(document).ready(function() {
        // var table = $('#table-list').DataTable( {
        //     responsive: true
        // } );
        //     new $.fn.dataTable.FixedHeader( table );
        // } );

        // add data
        $('#add-submit').on('click', function() {
            var formData = $('#add-post').serializeArray();
            var createId = Number(lastId) + 1;

            firebase.database().ref('tambak/' + createId).set({
                id_hardware: formData[0].value,
                alamat: formData[1].value,
                namatambak: formData[2].value,
                userid: formData[3].value,
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
                $('#update-id_hardware').val(values.id_hardware);
                $('#update-alamat').val(values.alamat);
                $('#update-namatambak').val(values.namatambak);
                $('#update-userid').val(values.userid);
            });
        });

        // update post
        $('#update-button').on('click', function() {
            var values = $("#update-post").serializeArray();
            var postData = {
                id_hardware: values[0].value,
                alamat: values[1].value,
                namatambak: values[2].value,
                userid: values[3].value,
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
