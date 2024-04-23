@extends('layouts.admin')

@section('container')
    <div class="container">
        <h1>Data Kategori</h1>
        @if (session()->has('success'))
        <div class="alert alert-success col-lg-12" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="search" style="text-align: left; display: inline-block;">
            <input type="text" placeholder="Search...">
            <button type="submit">Search</button>
        </div>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary" style="float: right;">Create Kategori</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Aksi</th> 
                </tr>
            </thead>
            <tbody>
                {{-- Melakukan perulangan data kategori --}}
                @foreach($kategoris as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->name }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning" onclick="return confirm('Apakah Anda yakin ingin mengedit data ini?')">Edit</a> 
                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        {{-- {{ $kategoris->links() }} --}}
    </div>
        <!-- Skrip untuk menangani fungsi pencarian -->
        <script>
            // Tambahkan event listener pada tombol pencarian
            document.querySelector('button[type="submit"]').addEventListener('click', function() {
                var searchValue = document.querySelector('input[type="text"]').value.toLowerCase();
                var rows = document.querySelectorAll('tbody tr');

                // Melakukan perulangan pada setiap baris dalam tabel
                rows.forEach(function(row) {
                    var found = false;
                    // Melakukan perulangan pada setiap sel dalam baris
                    row.querySelectorAll('td').forEach(function(cell) {
                        var cellText = cell.textContent.toLowerCase();
                        // Memeriksa apakah konten sel mengandung nilai pencarian
                        if (cellText.includes(searchValue)) {
                            found = true;
                        }
                    });

                    // Menampilkan atau menyembunyikan baris berdasarkan hasil pencarian
                    if (found) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        </script>
@endsection
