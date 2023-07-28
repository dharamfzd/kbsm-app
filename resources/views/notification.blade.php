@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}  -> Notifications List</div>
            <div class="card-body">
                <table class="table" id="notification">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($notifications as $val)
                        <tr>
                            <td>{{  $val->id }}</td>
                            <td>{!! html_entity_decode($val->message) !!}</td>
                        </tr>
                        @empty
                        <p>No notifications</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection