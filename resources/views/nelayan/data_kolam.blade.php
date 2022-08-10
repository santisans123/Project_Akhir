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
                <div class="float-end">
                    <a href="{{ route('datatambak') }}">
                        <button type="button" class="btn btn-sm btn-secondary">
                            Back
                        </button>
                    </a>
                </div>
                <div class="col-5">
                    <h3 class="page-title mb-3">Data kolam</h3>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('datatambak') }}">Data Tambak</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kolam</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Bread crumb and right sidebar toggle -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Semua Data kolam
                        <div class="float-end">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal">Tambah kolam</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Kolam</th>
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
                            <input type="hidden" class="form-control" value="{{$idtambak}}" name="idtambak" id="idtambak">
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
                                <label for="update-nama_kolam" class="form-label">Nama Kolam</label>
                                <textarea class="form-control" name="nama_kolam" id="update-nama_kolam"></textarea>
                            </div>
                            <input type="hidden" class="form-control" value="{{$idtambak}}" name="idtambak" id="update-idtambak">
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
            database.ref("kolam").on('value', function(snapshot) {
                var value = snapshot.val();
                var htmls = [];
                var no = 1;
                $.each(value, function(index, value) {
                    if (value && value.idtambak === '{{$idtambak}}') {
                        console.log(index);
                        htmls.push('<tr>\
                        <td>' + no++ + '</td>\
                        <td>' + value.nama_kolam + '</td>\
                        <td><a data-bs-toggle="modal" data-bs-target="#update-modal" class="btn btn-success update-post" data-id="' + index + '">Update</a>\
                        <a class="btn btn-primary" href="../../dataalat/'+ index +'" >Detail Kolam</a>\
                        <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn btn-danger delete-data" data-id="' + index + '">Delete</a></td>\
                    </tr>');
                    }
                    lastId = index;
                });
                $('#table-list').html(htmls);
            });

            // add data
            $('#add-submit').on('click', function() {
                var formData = $('#add-post').serializeArray();
                var createId = Number(lastId) + 1;

                firebase.database().ref('kolam/' + createId).set({
                    nama_kolam: formData[0].value,
                    idtambak: formData[1].value
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
                firebase.database().ref('kolam/' + updateID).on('value', function(snapshot) {
                    var values = snapshot.val();
                    $('#update-nama_kolam').val(values.nama_kolam);
                    $('#update-idtambak').val(values.idtambak);
                });
            });

            // update post
            $('#update-button').on('click', function() {
                var values = $("#update-post").serializeArray();
                var postData = {
                    nama_kolam: values[0].value,
                    idtambak: values[1].value
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