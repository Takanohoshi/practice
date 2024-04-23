<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman Buku</title>
    <style>
        /* Style untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ddd;
        }

        th, td {
            border: 1px solid #ddd; /* Tambahkan border ke setiap sel */
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Style untuk tombol kembali */
        .btn-kembali {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
        }

        .btn-kembali:hover {
            background-color: #45a049;
        }

        /* Style untuk tombol kembali yang dinonaktifkan */
        .btn-kembali[disabled] {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

    @include('layouts.nav')

    <div style="margin-top: 50px;">
        <h1>Daftar Peminjaman Buku</h1>

        <!-- Tambahkan alert berhasil dikembalikan -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (count($peminjamans) > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Nama Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjamans as $index => $peminjaman)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($peminjaman->buku && $peminjaman->buku->cover)
                                    <img src="{{ asset('storage/cover/' . $peminjaman->buku->cover) }}" alt="Cover Buku" style="max-width: 100px;">
                                @else
                                    Buku Tidak Ditemukan
                                @endif
                            </td>
                            <td>
                                @if ($peminjaman->buku)
                                    {{ $peminjaman->buku->judul }}
                                @else
                                    Buku Tidak Ditemukan
                                @endif
                            </td>
                            <td>{{ $peminjaman->tanggal_pinjam }}</td>
                            <td>{{ $peminjaman->tanggal_kembali }}</td>
                            <td>{{ $peminjaman->status }}</td>
                            <td>
                                @if ($peminjaman->status != 'dikembalikan')
                                <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="post" onsubmit="return confirmKembalikan()">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-kembali">Kembalikan</button>
                                    <input type="hidden" name="status" value="dikembalikan">
                                </form>
                            @else
                                    <span style="color: gray;">Sudah Dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada buku yang dipinjam.</p>
        @endif
    </div>
    

    <script>
        function confirmKembalikan() {
            return confirm('Anda yakin ingin mengembalikan buku ini?');
        }
    </script>

</body>
</html>
