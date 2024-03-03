<!-- resources/views/profile/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <!-- Tambahkan informasi profil lainnya sesuai kebutuhan -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
