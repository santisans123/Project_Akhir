@extends('layouts.menunelayan')

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="d-flex justify-content-between align-items-center">
				<h5>
					Semua Data Tambak
				</h5>
				<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal"
					id="btn-show-add-modal">Tambah Tambak</button>
			</div>

			<div class="card-body">
				<div id="cards" class="row row-cols-1 row-cols-md-4 g-4"></div>
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
							<label for="id_hardware" class="form-label">ID hardware ( Sesuaikan Alat )</label>
							<input class="form-control" id="id_hardware" name="id_hardware" autocomplete="off">
							<small id="warning-text-id-hardware" style="color: red; visibility: hidden">ID Hardware sudah
								terdaftar!</small>
						</div>
						<div class="mb-3">
							<label for="alamat" class="form-label">Alamat</label>
							<textarea class="form-control" id="alamat" name="alamat"></textarea>
						</div>
						<div class="mb-3">
							<label for="namatambak" class="form-label">Nama Tambak</label>
							<input type="text" class="form-control" name="namatambak" id="namatambak">
						</div>

						<input type="hidden" value="{{ Session::get('uid') }}" name="user_id" id="user_id">
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

						<input type="hidden" value="{{ Session::get('uid') }}" name="user_id" id="update-user_id">
						<button type="button" id="update-button" class="btn btn-primary">Ubah</button>
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
					<h5 class="modal-title">Hapus Tambak</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">

					<p class="lead">Apakah anda ingin mengahapus data ini?</p>

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
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"
		integrity="sha256-+8RZJua0aEWg+QVVKg4LEzEEm/8RFez5Tb4JBNiV5xA=" crossorigin="anonymous"></script>
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
				if (value && value.user_id === "{{ Session::get('uid') }}") {
					console.log(value)
					htmls.push(`<div class="col">
								<div class="card h-100">
									<div class="card-body" style="padding: 2em;">
										<h5 class="card-title mb-4" style="font-weight: bold;">${value.id_hardware}</h5>
										<p class="card-subtitle" style="color:black; font-weight:600 ">Alamat : ${value.alamat} meter</p>
										<p class="card-subtitle"style="color:black; font-weight:600 ">Nama Tambak: ${value.namatambak} meter</p>
										<p class="card-subtitle" style="color:black; font-weight:600 ">Kedalaman : ${value.kedalaman} meter</p>
										<div class="mt-4">
                                            <a class="btn btn-sm mt-1 btn-primary" href="datakolam/${value.id_hardware}" >Detail Kolam</a>
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
							</div>`);
				}
				lastId = index;
			});
			document.getElementById('cards').innerHTML = htmls.join('');
		});

		let isClickedBtnShowModal = false;
		let elderHardware = [];

		$('#btn-show-add-modal').on('click', function() {
			database.ref("tambak").on('value', function(snapshot) {
				var value = snapshot.val();
				var htmls = [];
				var no = 1;

				Object.values(value).filter(val => {
					!isClickedBtnShowModal ? elderHardware.push(val.id_hardware) : "";
				})
				isClickedBtnShowModal = true;
			});
		})

		$('#id_hardware').on('keyup', function() {
			let inputIdHardware = $('#id_hardware').val();
			const warnnigText = $('#warning-text-id-hardware');
			const btnSubmit = $('#add-submit');
			if (inputIdHardware !== '') {
				console.log("ELDER: " + elderHardware);
				elderHardware.forEach(elder => {
					console.log("data: " + elder)
					if (elder.toLowerCase() == inputIdHardware.toLowerCase()) {
						console.log("id: " + inputIdHardware)
						console.log("return: " + elder.toLowerCase().includes(inputIdHardware
							.toLowerCase()));
						warnnigText.css('visibility', 'visible');
						btnSubmit.prop('disabled', true);
						throw BreakException
					} else {
						warnnigText.css('visibility', 'hidden');
						btnSubmit.prop('disabled', false);
					}
				})
			}
		})

		// add data
		$('#add-submit').on('click', function() {
			var formData = $('#add-post').serializeArray();
			var createId = Number(lastId) + 1;

			firebase.database().ref('tambak/' + createId).set({
				id_hardware: formData[0].value,
				alamat: formData[1].value,
				namatambak: formData[2].value,

				user_id: formData[3].value,

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
			firebase.database().ref('tambak/' + updateID).on('value', function(snapshot) {
				var values = snapshot.val();
				$('#update-id_hardware').val(values.id_hardware);
				$('#update-alamat').val(values.alamat);
				$('#update-namatambak').val(values.namatambak);

				$('#update-user_id').val(values.user_id);

			});
		});

		// update post
		$('#update-button').on('click', function() {
			var values = $("#update-post").serializeArray();
			var postData = {
				id_hardware: values[0].value,
				alamat: values[1].value,
				namatambak: values[2].value,

				user_id: values[3].value,

			};

			var updatedPost = {};
			updatedPost['/tambak/' + updateID] = postData;

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

			let idHardware = "";
			let filteredKolam = [];
			let filteredAlat = [];

			database.ref('tambak/' + id).on('value', (snapshot) => {
				idHardware = snapshot.val().id_hardware;
			})

			database.ref().child("kolam").orderByChild("id_hardware").equalTo(idHardware).once('value',
				snapshot => {
					const updates = {};
					snapshot.forEach(child => updates[child.key] = null);
					database.ref("kolam").update(updates);
				});

			// database.ref().child("alat").orderByChild("id_hardware").equalTo(idHardware).once('value', snapshot => {
			//     const updates = {};
			//     snapshot.forEach(child => updates[child.key] = null);
			//     database.ref("alat").update(updates);
			// });


			firebase.database().ref('tambak/' + id).remove();

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
			console.log(htmls)
			$('#email-user').html(htmls);

		});

		database.ref("tambak").on('value', function(snapshot) {
			let values = snapshot.val();
			const graphView = document.getElementById('graph-view');

			$.each(values, function(index, value) {
				if (value && value.user_id === "{{ Session::get('uid') }}") {
					let idHardware = value.id_hardware;

					// create graph wrapper node with unique id for each tambak
					let graphWrapper = document.createElement('div');
					graphWrapper.setAttribute('id', idHardware);

					database.ref("alat").on('value', function(snapshot) {
						let values = snapshot.val();

						$.each(values, function(value) {
							if (value && value.id_hardware === idHardware) {
								// get all date if id_hardware is equal
								let date = value.date;

								// create array for date
								let dateArray = [];
								dateArray.push(date);

								// create graph wrapper node with unique id for each alat property
								let suhu = document.createElement('canvas').setAttribute('id',
									'suhu-' + idHardware);
								let salinitas = document.createElement('canvas').setAttribute(
									'id', 'salinitas-' + idHardware);
								let ph = document.createElement('canvas').setAttribute('id',
									'ph-' + idHardware);
								let Do = document.createElement('canvas').setAttribute('id',
									'do-' + idHardware);

								// create graph for each alat property
								new Chart(suhu, {
									type: 'line',
									data: {
										labels: [],
										datasets: [{
											label: 'Suhu',
											data: [],
											backgroundColor: 'rgba(255, 99, 132, 0.2)',
											borderColor: 'rgba(255, 99, 132, 1)',
											borderWidth: 1
										}]
									},
									options: {
										scales: {}
									}
								});

								new Chart(salinitas, {
									type: 'line',
									data: {
										labels: [],
										datasets: [{
											label: 'Salinitas',
											data: [],
											backgroundColor: 'rgba(255, 99, 132, 0.2)',
											borderColor: 'rgba(255, 99, 132, 1)',
											borderWidth: 1
										}]
									},
									options: {
										scales: {}
									}
								});

								new Chart(ph, {
									type: 'line',
									data: {
										labels: [],
										datasets: [{
											label: 'pH',
											data: [],
											backgroundColor: 'rgba(255, 99, 132, 0.2)',
											borderColor: 'rgba(255, 99, 132, 1)',
											borderWidth: 1
										}]
									},
									options: {
										scales: {}
									}
								});

								new Chart(Do, {
									type: 'line',
									data: {
										labels: [],
										datasets: [{
											label: 'DO',
											data: [],
											backgroundColor: 'rgba(255, 99, 132, 0.2)',
											borderColor: 'rgba(255, 99, 132, 1)',
											borderWidth: 1
										}]
									},
									options: {
										scales: {}
									}
								});

								// append graph wrapper node to graph view
								graphWrapper.appendChild(suhu);
								graphWrapper.appendChild(salinitas);
								graphWrapper.appendChild(ph);
								graphWrapper.appendChild(Do);
							}
						});
					});

					document.getElementById('graph-view').appendChild(graphWrapper);
				}
			});
		});
	</script>
@endsection
