<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kolam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="m-5">
        <!-- Bread crumb and right sidebar toggle -->
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="row d-flex">
                    <h3 class="col page-title mb-3">Data kolam</h3>
                    <a href="{{ route('datatambak') }}" class="col-auto">
                        <button type="button" class="btn btn-secondary" >
                            Kembali
                        </button>
                    </a>
                </div>
                
            </div>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('datatambak') }}" style="text-decoration: none">Data Tambak</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kolam</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Bread crumb and right sidebar toggle -->
        <h4 class="page-title my-4" id="nama-tambak"></h4>
        <h3 id="nama_user"></h3>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h5 class="col align-self-center">Semua Data Kolam</h5>
                            <div class="col">
                            <button type="button" class="btn btn-primary py-2 my-2 float-end " data-bs-toggle="modal" data-bs-target="#add-modal">Tambah kolam</button>
                        </div>
                    </div>
                        
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Kolam</th>
                                    <th scope="col">Panjang</th>
                                    <th scope="col">Lebar</th>
                                    <th scope="col">Kedalaman</th>
                                    <th scope="col">Noted</th>
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
                        <h5 class="modal-title">Tambah kolam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="add-post" method="post">
                            <div class="mb-3">
                                <label for="nama_kolam" class="form-label">Nama Kolam</label>
                                <input type="text" class="form-control" id="nama_kolam" name="nama_kolam">
                            </div>
                            <div class="mb-3">
                                <label for="panjang" class="form-label">Panjang</label>
                                <input type="number" class="form-control" id="panjang" name="panjang">
                            </div>
                            <div class="mb-3">
                                <label for="lebar" class="form-label">Lebar</label>
                                <input type="number" class="form-control" id="lebar" name="lebar">
                            </div>
                            <div class="mb-3">
                                <label for="kedalaman" class="form-label">Kedalaman</label>
                                <input type="number" class="form-control" id="kedalaman" name="kedalaman">
                            </div>
                            <div class="mb-3">
                                <label for="noted" class="form-label">Catatan</label>
                                <textarea class="form-control" name="noted" id="noted"></textarea>
                            </div>
                            <input type="hidden" class="form-control" value="{{$id_hardware}}" name="id_hardware" id="id_hardware">
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
                        <h5 class="modal-title">Edit Kolam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update-post" method="post">
                            <div class="mb-3">
                                <label for="update-nama_kolam" class="form-label">Nama Kolam</label>
                                <textarea class="form-control" name="nama_kolam" id="update-nama_kolam"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="update-panjang" class="form-label">Panjang</label>
                                <input type="text" class="form-control" id="update-panjang" name="update-panjang">
                            </div>
                            <div class="mb-3">
                                <label for="update-lebar" class="form-label">Lebar</label>
                                <input type="text" class="form-control" id="update-lebar" name="update-lebar">
                            </div>
                            <div class="mb-3">
                                <label for="update-kedalaman" class="form-label">Kedalaman</label>
                                <input type="text" class="form-control" id="update-kedalaman" name="update-kedalaman">
                            </div>
                            <div class="mb-3">
                                <label for="update-noted" class="form-label">Catatan</label>
                                <textarea class="form-control" name="update-noted" id="update-noted"></textarea>
                            </div>
                            <input type="hidden" class="form-control" value="{{$id_hardware}}" name="id_hardware" id="update-id_hardware">
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
                        <h5 class="modal-title">Hapus Kolam</h5>
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
            database.ref("kolam").on('value', function(snapshot) {
                var value = snapshot.val();
                var htmls = [];
                var no = 1;
                $.each(value, function(index, value) {
                    if (value && value.id_hardware === '{{$id_hardware}}') {
                        htmls.push('<tr>\
                        <td>' + no++ + '</td>\
                        <td>' + value.nama_kolam + '</td>\
                        <td>' + value.panjang + '</td>\
                        <td>' + value.lebar + '</td>\
                        <td>' + value.kedalaman + '</td>\
                        <td>' + value.noted + '</td>\
                        <td>\
                            <a class="btn btn-primary mt-1" href="../../dataalat/' + value.id_hardware + '/' + value.id_kolam + '" >Detail Kolam</a>\
                            <a data-bs-toggle="modal" data-bs-target="#update-modal" class="btn btn-success mt-1 update-post" data-id="' + index + '">Edit</a>\
                        <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn btn-danger mt-1 delete-data" data-id="' + index + '">Hapus</a></td>\
                    </tr>');
                    }
                    lastId = index;
                });
                $('#table-list').html(htmls);
            });
            // post nama Tambak
            database.ref("tambak").on('value', function(snapshot) {
                var value = snapshot.val();
                var htmls = [];
                $.each(value, function(index, value) {
                    if (value && value.id_hardware === '{{$id_hardware}}') {
                        htmls.push('' + value.namatambak + ' (' + value.id_hardware + ')');
                    }
                });
                $('#nama-tambak').html(htmls);
            });
            database.ref("profile").on('value', function(snapshot) {
                var value = snapshot.val();
                var htmls = [];
                $.each(value, function(index, value) {
                    if (value && value.userid === '{{ Session::get('uid') }}') {
                        htmls.push('' + value.name + ')');
                    }
                });
                $('#nama_user').html(htmls);
            });
            // add data
            $('#add-submit').on('click', function() {
                var formData = $('#add-post').serializeArray();
                var createId = Number(lastId) + 1;
                var id_kolam = 1;

                // Get Latest ID KOLAM
                database.ref("kolam").on('value', function(snapshot) {
                    var value = snapshot?.val();

                    // Filter data by ID TAMBAK
                    var filteredData = value.filter(function(el) {
                        return el.id_hardware == '{{$id_hardware}}';
                    });

                    // Assign ID KOLAM
                    var latestFilteredData = Object.values(filteredData).pop();
                    latestFilteredData?.id_kolam == null ? id_kolam : id_kolam = latestFilteredData.id_kolam + 1;
                });

                firebase.database().ref('kolam/' + createId).set({
                    id_kolam: id_kolam,
                    nama_kolam: formData[0].value,
                    panjang: formData[1].value,
                    lebar: formData[2].value,
                    kedalaman: formData[3].value,
                    noted: formData[4].value,
                    id_hardware: formData[5].value,
                    // id_kolam: 
                });
                // firebase.database().ref('kolam').once('value', function(snapshot) {
                //     var id_kolam = snapshot.numChildren();
                // })

                // Reassign lastID value
                lastId = createId;
                $("#add-post")[0].reset();
                $("#add-modal").modal('hide');
            });

            // update modal
            var updateID = 0;
            $('body').on('click', '.update-post', function() {
                updateID = $(this).attr('data-id');
                firebase.database().ref('kolam/' + updateID).on('value', function(snapshot) {
                    var values = snapshot.val();
                    $('#update-nama_kolam').val(values.nama_kolam);
                    $('#update-panjang').val(values.panjang);
                    $('#update-lebar').val(values.lebar);
                    $('#update-kedalaman').val(values.kedalaman);
                    $('#update-noted').val(values.noted);
                    $('#update-id_hardware').val(values.id_hardware);
                });
            });

            // update post
            $('#update-button').on('click', function() {
                var values = $("#update-post").serializeArray();
                var postData = {
                    nama_kolam: values[0].value,
                    id_hardware: values[1].value
                };

                var updatedPost = {};
                updatedPost['/kolam/' + updateID] = postData;

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
                firebase.database().ref('kolam/' + id).remove();

                $('#post-id').val('');
                $("#delete-modal").modal('hide');
            });
        </script>
    </div>
</body>