@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{ __('Dashboard') }}  -> Send Notification
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('send.notification') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="message" class="col-md-4 col-form-label text-md-end">{{ __('Message') }}</label>
                        <div class="col-md-6">
                            <input id="message" type="text" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" placeholder="Enter Message" autocomplete="message" autofocus>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>                    
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
