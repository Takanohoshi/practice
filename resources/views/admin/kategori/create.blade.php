@extends('layouts.admin')

@section('container')

<h1 class="h2">Tambah Kategori Baru</h1>

<div class="col-lg-8">
    <a href="{{ route('kategori.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name') }}" placeholder="Nama Kategori">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

@endsection
