@extends('layouts.admin')

@section('container')
    
<h1 class="h2">Edit User</h1>

<div class="col-lg-8">
    <a href="{{ route('datauser.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('datauser.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required autofocus value="{{ old('username', $user->username) }}" placeholder="Username">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="change_password" class="form-label">Ubah password</label>
            <input type="checkbox" id="change_password" name="change_password">
        </div>
        
        <div class="mb-3" id="password_fields" style="display: none;">
            <label for="password" class="form-label">Password baru</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autofocus placeholder="New Password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="namalengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('namalengkap') is-invalid @enderror" id="namalengkap" name="namalengkap" required autofocus value="{{ old('namalengkap', $user->namalengkap) }}" placeholder="Nama Lengkap">
            @error('namalengkap')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required autofocus value="{{ old('alamat', $user->alamat) }}" placeholder="Alamat">
            @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <select name="level" id="level" class="form-select">
                <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="petugas" {{ $user->level == 'petugas' ? 'selected' : '' }}>Petugas</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    document.getElementById('change_password').addEventListener('change', function() {
        var passwordFields = document.getElementById('password_fields');
        if (this.checked) {
            passwordFields.style.display = 'block';
        } else {
            passwordFields.style.display = 'none';
        }
    });
</script>
@endsection
