@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{ __('Dashboard') }}  -> Profile
                <a class="float-right" href="{{ route('notification') }}" class="">Get Notification</a>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Name
                    <span class="badge">{{ auth()->user()->name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Email
                    <span class="badge">{{ auth()->user()->email }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
