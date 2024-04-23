@extends('layouts.petugas')

@section('container')
    <div class="container">
        <h1>Data Buku</h1>
        @if (session()->has('success'))
        <div class="alert alert-success col-lg-12" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="search" style="text-align: left; display: inline-block;">
            <input type="text" placeholder="Search...">
            <button type="submit">Search</button>
        </div>
        <a href="{{ route('databukuu.create') }}" class="btn btn-primary" style="float: right;">Tambah Buku</a> 
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th> 
                </tr>
            </thead>
            <tbody>
                {{-- Melakukan perulangan data buku --}}
                @foreach($bukus as $buku)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset('storage/cover/' . $buku->cover) }}" alt="Cover Buku" style="max-width: 100px;"></td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>{{ $buku->tahunterbit }}</td>
                    <td>
                        @foreach ($buku->kategori as $category)
                            {{ $category->name }},
                        @endforeach
                    </td>
                    <td>{{ $buku->deskripsi }}</td>
                    <td>
                        <a href="{{ route('databukuu.edit', $buku->id) }}" class="btn btn-warning" onclick="return confirm('Apakah Anda yakin ingin mengedit buku ini?')">Edit</a>
                        <form action="{{ route('databukuu.destroy', $buku->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
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
         {{ $bukus->links() }}
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
