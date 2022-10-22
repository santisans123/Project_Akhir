@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
