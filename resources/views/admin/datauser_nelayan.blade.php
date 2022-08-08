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
                    <a class="nav-link" href="{{ route('register') }}"><button type="button" class="btn btn-sm btn-primary">Add User</button></a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody id="table-list">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- {{-- create modal --}}
<div class="modal fade" id="add-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tambak</h5>
                <button type="button" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <form id="add-post" method="post">
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="notlp" class="form-label">notlp</label>
                        <input type="number" class="form-control" name="notlp" id="notlp">
                    </div>
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
                        <label for="update-notlp" class="form-label">notlp</label>
                        <input type="number" class="form-control" name="notlp" id="update-notlp">
                    </div>
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

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="delete-button" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div> -->
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

    // const functions = require('firebase-functions');
    // const admin = require('firebase-admin');

    // admin.initializeApp();

    // const auth = admin.auth();

    // const getAllUsers = (req, res) => {
    //     const maxResults = 1; // optional arg.

    //     auth.listUsers(maxResults).then((userRecords) => {
    //         userRecords.users.forEach((user) => console.log(user.toJSON()));
    //         res.end('Retrieved users list successfully.');
    //     }).catch((error) => console.log(error));
    // };

    // module.exports = {
    //     api: functions.https.onRequest(getAllUsers),
    // };

    // Initialize Firebase
    const app = firebase.initializeApp(firebaseConfig);

    var database = firebase.database();
    // var databaseauth = firebase.auth();

    var lastId = 0;

    // function ListAllUsers(nextPageToken) {
    //     // List Batch Of Users, 1000 At A Time.
    //     Admin.auth().listUsers(1000, NextPageToken)
    //         .then(function(listUsersResult) {
    //             ListUsersResult.users.forEach(function(userRecord) {
    //                 Console.log('user', UserRecord.toJSON());
    //             })
    //             If(listUsersResult.pageToken) 
    //                 // List Next Batch Of Users.
    //                 ListAllUsers(listUsersResult.pageToken);

    //         })
    //         .catch(function(error) {
    //             Console.log('Error Listing Users:', Error);
    //         });
    // }
    // // Start Listing Users From The Beginning, 1000 At A Time.
    // ListAllUsers();

    // get post data
    database.ref("profile").on('value', function(snapshot) {
        var value = snapshot.val();
        var htmls = [];
        var no = 1;
        $.each(value, function(index, value) {
            if (value) {
                htmls.push('<tr>\
                        <td>' + no++ + '</td>\
                        <td>' + value.name + '</td>\
                        <td>' + value.email + '</td>\
                        <td><a data-bs-toggle="modal" data-bs-target="#update-modal" class="btn btn-success update-post" data-id="' + index + '">Update</a>\
                        <a class="btn btn-primary" href="datakolam" >+ Kolam</a>\
                        <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn btn-danger delete-data" data-id="' + index + '">Delete</a></td>\
                    </tr>');
            }
            lastId = index;
        });
        $('#table-list').html(htmls);
    });

    // // update modal
    // var updateID = 0;
    // $('body').on('click', '.update-post', function() {
    //     updateID = $(this).attr('data-id');
    //     firebase.database().ref('profile/' + updateID).on('value', function(snapshot) {
    //         var values = snapshot.val();
    //         $('#update-alamat').val(values.alamat);
    //         $('#update-notlp').val(values.notlp);
    //     });
    // });

    // // update post
    // $('#update-button').on('click', function() {
    //     var values = $("#update-post").serializeArray();
    //     var postData = {
    //         alamat: values[0].value,
    //         notlp: values[1].value,
    //     };

    //     var updatedPost = {};
    //     updatedPost['/profile/' + updateID] = postData;

    //     firebase.database().ref().update(updatedPost);

    //     $("#update-modal").modal('hide');
    //     $("#update-post")[0].reset();
    // });

    // // delete modal
    // $("body").on('click', '.delete-data', function() {
    //     var id = $(this).attr('data-id');
    //     $('#post-id').val(id);
    // });

    // // delete post
    // $('#delete-button').on('click', function() {
    //     var id = $('#post-id').val();
    //     firebase.database().ref('profile/' + id).remove();

    //     $('#post-id').val('');
    //     $("#delete-modal").modal('hide');
    // });
</script>
@endsection