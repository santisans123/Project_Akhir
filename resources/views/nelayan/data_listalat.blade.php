@extends('layouts.menunelayan')

@section('content')


    <body>
        <div class="m-2">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <h3 class="page-title mb-3">Data Alat</h3>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tabledata" class="table-hover table table-striped table-bordered nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Waktu dan tanggal</th>
                                        <th scope="col">Ph</th>
                                        <th scope="col">Salinitas</th>
                                        <th scope="col">Suhu</th>
                                        <th scope="col">DO</th>
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

                // database.ref("tambak").on('value', function(snapshot) {
                //     var value = snapshot.val();
                //     $userid=value.user_id;
                //     $idhardware=value.id_hardware;
                // });

                // get post data
                database.ref("alat").on('value', function(snapshot) {
                    var value = snapshot.val();
                    var htmls = [];
                    var no = 1;
                    $.each(value, function(index, value) {
                        if (value && value.id_hardware) {
                            database.ref("kolam").on('value', function(snapshot) {
                                var values = snapshot.val();
                                $.each(values, function(index, val) {
                                    let hardware = value.id_hardware.split(".")
                                    let hardwareId = hardware[0]
                                    if (val.id_hardware.split(".")[0] == hardwareId && val
                                        .user_id == "{{ Session::get('uid') }}") {
                                        console.log(value)
                                        htmls.push(`<tr>
                                            <td>${no++}</td>
                                            <td>${value.time} , ${value.date}</td>
                                            <td>${value.ph}</td>
                                            <td>${value.salinitas}</td>
                                            <td>${value.suhu}</td>
                                            <td>${value.do}</td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn btn-danger delete-data" data-id="${index}">Delete</a>
                                            </td>
                                        </tr>`);
                                    }
                                    lastId = index;
                                });
                                
                                console.log(htmls)
                                 $('#table-list').html(htmls)
                                // var table = $('#tabledata').DataTable({
                                //     responsive: true,
                                //     stateSave: true,
                                //     "bDestroy": true
                                // });
                                // new $.fn.dataTable.FixedHeader(table);
                            })

                        }

                    });
                    


                });



                // delete modal
                $("body").on('click', '.delete-data', function() {
                    var id = $(this).attr('data-id');
                    $('#post-id').val(id);
                });

                // delete post
                $('#delete-button').on('click', function() {
                    var id = $('#post-id').val();
                    firebase.database().ref('alat/' + id).remove();

                    $('#post-id').val('');
                    $("#delete-modal").modal('hide');
                    location.reload();
                });
                database.ref("profile").on('value', function(snapshot) {
                    var value = snapshot.val();
                    var htmls = [];
                    $.each(value, function(index, value) {
                        if (value && value.user_id === "{{ Session::get('uid') }}") {
                            htmls.push('' + value.name + '');
                        }
                    });
                    $('#nama-user').html(htmls);
                });
                database.ref("profile").on('value', function(snapshot) {
                    var value = snapshot.val();
                    var htmls = [];
                    $.each(value, function(index, value) {
                        if (value && value.user_id === "{{ Session::get('uid') }}") {
                            htmls.push('' + value.email + '');
                        }
                    });
                    $('#email-user').html(htmls);
                });
            </script>
        @endsection

