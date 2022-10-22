<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kolam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Datatable -->
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

    <style>
        .modal-backdrop {
            /* bug fix - no overlay */
            display: none;
        }

        .color-red {
            color: red;
        }

        .color-green {
            color: green;
        }
    </style>
</head>

<body>
    <div class="m-5">
        <!-- Bread crumb and right sidebar toggle -->
        <div class="page-breadcrumb mb-4">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mb-3">Data Alat</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('datatambak') }}">
                        <button type="button" class="btn btn-secondary">
                            Kembali ke Dashboard
                        </button>
                    </a>
                </div>
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
        database.ref("alat").on('value', function(snapshot) {
            var value = snapshot.val();
            var htmls = [];
            var no = 1;
            $.each(value, function(index, value) {
                if (value && value.id_hardware === '{{ $id_hardware }}' && value.id_kolam ===
                    '{{ $id_kolam }}') {
                    console.log(index);
                    htmls.push('<tr>\
                                <td>' + no++ + '</td>\
                                <td>' + value.time + ', ' + value.date + ' </td>\
                                <td>' + value.ph + '</td>\
                                <td>' + value.salinitas + '</td>\
                                <td>' + value.suhu + '</td>\
                                <td>' + value.do +
                        '</td>\
                                <td><a data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn btn-danger delete-data" data-id="' +
                        index + '">Delete</a></td>\
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

        $('.change-color').each(function() {
            if (parseInt($(this).html()) < 9) {
                $(this).addClass('color-red');
            }
        });
    </script>

</body>
