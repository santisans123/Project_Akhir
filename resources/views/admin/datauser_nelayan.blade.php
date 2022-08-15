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
                <div class="row">
                    <h4 class="col align-self-center">Semua Data User</h4>
                    <div class="col">
                        <a class="nav-link" href="{{route('register') }}" ><button type="button" class="btn btn-primary py-2 my-2 float-end">Tambah user</button></a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <table id="tabledata" class="table-hover table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-list">

                    </ tbody >
                </table>
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
    var database =  firebase . database ();
    // var databaseauth = firebase.auth();
    var lastId =  0 ;    
    // get profile data
    database.ref("profile").on('value', function(snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function(index, value) {
            if (value) {
                htmls.push('<tr>\
                        <td>' + index + '</td>\
                        <td>' + value.name + '</td>\
                        <td>' + value.email + '</td>\
                        <td>' + value.password + '</td>\
                        <td><a data-bs-toggle="modal" data-bs-target="#update-modal" class="btn text-white btn-success update-post" data-id="' + index + '">Edit</a>\
                        <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn text-white btn-danger delete-data" data-id="' + index + '">Hapus</a></td>\
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
    
    // delete post
    $('#delete-button').on('click', function() {
        var id =  $ ( ' #post-id ' ). choice ();
        firebase.database().ref('profile/' + id).remove();
        $('#post-id').val('');
        $("#delete-modal").modal('hide');
    });
</script>
@endsection