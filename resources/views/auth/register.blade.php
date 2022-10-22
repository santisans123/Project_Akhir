@extends('layouts.appregis')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Register') }}</div>

        <div class="card-body">

          @if(Session::has('error'))
          <div class="alert alert-danger alert-dismissible fade show">
            {{ Session::get('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
          </div>
          @endif

          <form method="POST" action="{{ route('register') }}" id="add-post" tabindex="-1">
            @csrf

            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <input type="hidden" value="{{Session::get('uid')}}" name="user_id" id="user_id">
                <button type="submit" id="add-submit" class="btn btn-primary">
                  {{ __('Register') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
<script type="text/javascript">
  // Your web app's Firebase configuration
//  const firebaseConfig = {
//    apiKey: "{{ config('services.firebase.api_key') }}",
//    authDomain: "{{ config('services.firebase.auth_domain') }}",
//    databaseURL: "{{ config('services.firebase.database_url') }}",
//    projectId: "{{ config('services.firebase.project_id') }}",
//    storageBucket: "{{ config('services.firebase.storage_bucket') }}",
//    messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
//    appId: "{{ config('services.firebase.app_id') }}"
//  };
//
//  // Initialize Firebase
//  const app = firebase.initializeApp(firebaseConfig);
//  var database = firebase.database();
//      // add data
//      $('#add-submit').on('click', function() {
//		var formData = $('#add-post').serializeArray();
//        if($('#password').val() && $('#password').val() == $('#password-confirm').val())
//        firebase.database().ref('profile/').push({
//          password: formData[0].value,
//          name: formData[1].value,
//          email: formData[2].value
//        });
//
//  });
</script>
@endsection