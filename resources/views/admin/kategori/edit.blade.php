@extends('layouts.admin')

@section('container')

<h1 class="h2">Edit Kategori</h1>

<div class="col-lg-8">
    <a href="{{ route('kategori.index') }}" class="btn btn-secondary mb-3">Back</a>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ $kategori->name }}" placeholder="Nama Kategori">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Ubah kategori</button>
    </form>
</div>

@endsection