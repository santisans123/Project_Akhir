<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	{{-- <meta http-equiv="refresh" content="25"> --}}
	<title>Kolam</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/libs/jquery/dist/jquery.min.js"></script>
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
	</style>
</head>

<body>
	<div class="m-5">
		<!-- Bread crumb and right sidebar toggle -->
		<div class="page-breadcrumb">
			<div class="row align-items-center">
				<div class="col">
					<h2 class="page-title mb-3">Data kolam</h2>
				</div>
				<div class="col-auto">
					<a href="{{ route('datatambak') }}">
						<button type="button" class="btn btn-secondary">
							Kembali
						</button>
					</a>
				</div>
			</div>
			<h3 class="page-title mb-2 mt-2 " id="nama-tambak"></h3>
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

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5>
							Semua Data kolam
						</h5>
						<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal">
							Tambah kolam
						</button>
					</div>
					<div class="card-body">
						<div id="cards" class="row row-cols-1 row-cols-md-4 g-4"></div>
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
								<input type="text" class="form-control" id="nama_kolam" name="nama_kolam" autocomplete="off">
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
							<input type="hidden" value="{{ Session::get('uid') }}" name="user_id" id="user_id">
							<input type="hidden" class="form-control" value="{{ $id_hardware }}" name="id_hardware" id="id_hardware">
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
							<input type="hidden" value="{{ Session::get('uid') }}" name="user_id" id="update-user_id">
							<input type="hidden" class="form-control" value="{{ $id_hardware }}" name="id_hardware"
								id="update-id_hardware">
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
						<h5 class="modal-title">Hapus kolam</h5>
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

				// loop value and index
				$.each(value, (index, data) => {
					if (data && data.id_hardware === '{{ $id_hardware }}' && data.user_id ===
						"{{ Session::get('uid') }}") {
						console.log(data)
						htmls.push(`
							<div class="col">
								<div class="card h-100">
									<div class="card-body">
										<h5 class="card-title">${data.nama_kolam}</h5>
										<p class="card-subtitle">Panjang : ${data.panjang} meter</p>
										<p class="card-subtitle">Lebar : ${data.lebar} meter</p>
										<p class="card-subtitle">Kedalaman : ${data.kedalaman} meter</p>
										<div class="mt-4">
                                            <a class="btn btn-sm mt-1 btn-primary" href="../../dataalat/${data.id_hardware}/${data.id_kolam}" >Detail Kolam</a>
											<a
												data-bs-toggle="modal"
												data-bs-target="#update-modal"
												class="btn btn-sm btn-success mt-1 update-post"
												data-id="${index}"
											>
												Edit
											</a>
											<a
												data-bs-toggle="modal"
												data-bs-target="#delete-modal"
												class="btn btn-sm btn-danger mt-1 delete-data"
												data-id="${index}"
											>
												Hapus
											</a>
										</div>
									</div>
								</div>
							</div>
						`);
					}
					lastId = index;
				})

				document.getElementById('cards').innerHTML = htmls.join('');
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
						return el.id_hardware == '{{ $id_hardware }}';
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
					user_id: formData[5].value,
					id_hardware: formData[6].value,
				});

				// Reassign lastID value
				lastId = createId;
				$("#add-post")[0].reset();
				$("#add-modal").modal('hide');
				location.reload();
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
					$('#update-user_id').val(values.user_id);
					$('#update-id_hardware').val(values.id_hardware);
				});
			});

			// update post
			$('#update-button').on('click', function() {
				var values = $("#update-post").serializeArray();
				var postData = {
					nama_kolam: values[0].value,
					panjang: values[1].value,
					lebar: values[2].value,
					kedalaman: values[3].value,
					noted: values[4].value,
					user_id: values[5].value,
					id_hardware: values[6].value,
				};

				var updatedPost = {};
				updatedPost['/kolam/' + updateID] = postData;

				firebase.database().ref().update(updatedPost);

				$("#update-modal").modal('hide');
				$("#update-post")[0].reset();
				location.reload();
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
				location.reload();
			});
		</script>
	</div>
</body>
