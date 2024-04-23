@extends('layouts.admin')

@section('container')
    <div class="container">
        <h1>Data User</h1>
        @if (session()->has('success'))
        <div class="alert alert-success col-lg-12" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="search" style="text-align: left; display: inline-block;">
            <input type="text" placeholder="Search...">
            <button type="submit">Search</button>
        </div>
        <a href="{{ route('datauser.create') }}" class="btn btn-primary" style="float: right;">Create User</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Namalengkap</th>
                    <th>Alamat</th>
                    <th>Level</th>
                    <th>Aksi</th> 
                </tr>
            </thead>
            <tbody>
                {{-- Melakukan perulangan data pengguna --}}
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->namalengkap }}</td>
                    <td>{{ $user->alamat }}</td>
                    <td>{{ $user->level }}</td>
                    <td>
                        <a href="{{ route('datauser.edit', $user->id) }}" class="btn btn-warning" onclick="return confirm('Apakah Anda yakin ingin mengedit user ini?')">Edit</a>
                        <form action="{{ route('datauser.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
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
        {{ $users->links() }}
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
