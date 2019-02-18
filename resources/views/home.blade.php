@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">My Profile</div>

                <div class="card-body">

                    Name: {{ Auth::user()->name }} <br>
                    Email: {{ Auth::user()->email }} <br>
                    Password: ******** <br>
                    <a href="{{ route('editprofile') }}" class="btn btn-primary btn-sm">Edit</a>
                </div>
            </div>
        </div>
</div>
@endsection
