@extends('layouts.navlog')

@section('container')
<div class="container col-xl-10 col-xxl-8">
    <div class="row align-items-center py-5">
        <div class="col-lg-10 mx-auto col-lg-5 form-container">
            <h2 class="text-center mb-4">Register</h2>

            @if (session()->has('registerError'))
                <div class="alert alert-danger col-lg-10 mx-auto col-lg-5" role="alert">
                    {{ session('registerError') }}
                </div>
            @endif

            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <form action="/regquest" method="POST" class="p-4 p-md-5" autocomplete="off">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="namalengkap" name="namalengkap" placeholder="Nama lengkap" autofocus required>
                    <label for="namalengkap">Nama Lengkap</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                    <label for="alamat">Alamat</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
            </form>
        </div>
    </div>
</div>
@endsection
