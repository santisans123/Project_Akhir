<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Position</th>
                <th scope="col">Office</th>
                <th scope="col">E-mail</th>
            </tr>
        </thead>
        <tbody id="table-list">

        </tbody>
    </table>
</body>
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
            if (value) {

                htmls.push('<tr>\
                        <td>' + no++ + '</td>\
                        <td>' + value.id_hardware + '</td>\
                        <td>' + value.alamat + '</td>\
                        <td>' + value.namatambak + '</td>\
                        <td><a data-bs-toggle="modal" data-bs-target="#update-modal" class="btn btn-success mt-1 update-post" data-id="' + index + '">Update</a>\
                        <a class="btn btn-primary mt-1" href="datakolam/' + value.id_hardware + '" >+ Kolam</a>\
                        <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn btn-danger mt-1 delete-data" data-id="' + index + '">Delete</a></td>\
                    </tr>');
            }
            lastId = index;
        });
        $('#table-list').html(htmls);
       $(document).ready(function() {
                    $('#example').DataTable({
                        responsive: {
                            details: {
                                display: $.fn.dataTable.Responsive.display.modal({
                                    header: function(row) {
                                        var data = row.data();
                                        return 'Details for ' + data[0] + ' ' + data[1];
                                    }
                                }),
                                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                                    tableClass: 'table'
                                })
                            }
                        }
                    });
                });
    });
</script>

</html>