@extends('layouts.petugas')

@section('container')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

<h1 class="h2">Edit Data Buku</h1>

<div class="col-lg-8">
    <a href="{{ route('databukuu.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('databukuu.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            

            <!-- Menampilkan preview cover sebelumnya -->
            @if($buku->cover)
            <br>
                <img src="{{ asset('storage/cover/' . $buku->cover) }}" alt="Cover Image" class="img-fluid mb-2" style="max-height: 200px;">
                <p>cover sebelumnya</p>
            @endif

            <label for="cover" class="form-label">Cover Image</label>
            <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover" accept="image/*">
            @error('cover')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" required value="{{ old('judul', $buku->judul) }}" placeholder="Judul Buku">
            @error('judul')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" required value="{{ old('penulis', $buku->penulis) }}" placeholder="Penulis">
            @error('penulis')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" name="penerbit" required value="{{ old('penerbit', $buku->penerbit) }}" placeholder="Penerbit">
            @error('penerbit')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tahunterbit" class="form-label">Tahun</label>
            <input type="date" class="form-control @error('tahunterbit') is-invalid @enderror" id="tahunterbit" name="tahunterbit" required value="{{ old('tahunterbit', $buku->tahunterbit) }}" placeholder="Tahun">
            @error('tahunterbit')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori[]" multiple required>
                @foreach ($kategoris as $item)
                    <option value="{{ $item->id }}" {{ in_array($item->id, old('kategori', $buku->kategori->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
            @error('kategori')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
        $('#kategori').select2();
    });
</script>

@endsection
