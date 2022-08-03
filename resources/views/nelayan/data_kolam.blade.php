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
                            Back</button>
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
                                    <th scope="col">alamat</th>
                                    <th scope="col">luas</th>
                                    <th scope="col">Nama Kolam</th>
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
                        <h5 class="modal-title">Tambah kolam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="add-post" method="post">
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="luas" class="form-label">Luas kolam dalam hektar(ha)</label>
                                <input type="number" class="form-control" name="luas" id="luas">
                            </div>
                            <div class="mb-3">
                                <label for="namakolam" class="form-label">Jenis Pakan</label>
                                <input type="text" class="form-control" id="namakolam" name="namakolam">
                            </div>
                            <div class="mb-3">
                                <label for="gramPakan" class="form-label">Gram Pakan</label>
                                <input type="number" class="form-control" id="gramPakan" name="gramPakan">
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
                                <label for="update-alamat" class="form-label">alamat</label>
                                <textarea class="form-control" name="alamat" id="update-alamat"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="update-luas" class="form-label">luas</label>
                                <input type="number" class="form-control" name="luas" id="update-luas">
                            </div>
                            <div class="mb-3">
                                <label for="update-namakolam" class="form-label">Jenis Pakan</label>
                                <input type="text" class="form-control" name="namakolam" id="update-namakolam">
                            </div>
                            <div class="mb-3">
                                <label for="update-gramPakan" class="form-label">Gram Pakan</label>
                                <input type="number" class="form-control" name="gramPakan" id="update-gramPakan">
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
                $.each(value, function(index, value) {
                    if (value&&value.idtambak==='{{$idtambak}}') {
                        console.log(index);
                        htmls.push('<tr>\
                        <td>' + index + '</td>\
                        <td>' + value.alamat + '</td>\
                        <td>' + value.luas + '</td>\
                        <td>' + value.namakolam + '</td>\
                        <td>' + value.gramPakan + '</td>\
                        <td><a data-bs-toggle="modal" data-bs-target="#update-modal" class="btn btn-success update-post" data-id="' + index + '">Update</a>\
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
                    alamat: formData[0].value,
                    luas: formData[1].value,
                    namakolam: formData[2].value,
                    gramPakan: formData[3].value,
                    idtambak: formData[4].value
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
                    $('#update-alamat').val(values.alamat);
                    $('#update-luas').val(values.luas);
                    $('#update-namakolam').val(values.namakolam);
                    $('#update-gramPakan').val(values.gramPakan);
                    $('#update-idtambak').val(values.idtambak);
                });
            });

            // update post
            $('#update-button').on('click', function() {
                var values = $("#update-post").serializeArray();
                var postData = {
                    alamat: values[0].value,
                    luas: values[1].value,
                    namakolam: values[2].value,
                    gramPakan: values[3].value,
                    idtambak: values[4].value
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