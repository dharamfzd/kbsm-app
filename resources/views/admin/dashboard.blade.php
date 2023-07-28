@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{ __('Dashboard') }}  -> Profile
                <p class="float-right">
                    <a href="{{ route('add.user') }}" class="">Add User</a>
                    ||
                    <a href="{{ route('send.notification') }}" class="">Send Notification</a>
                </p>
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
