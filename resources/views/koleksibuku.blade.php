<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Koleksi Buku</title>
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
        <h1>Daftar Koleksi Buku</h1>

        <!-- Tambahkan alert berhasil dikembalikan -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (count($koleksii) > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($koleksii as $index => $koleksi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($koleksi->buku && $koleksi->buku->cover)
                                    <img src="{{ asset('storage/cover/' . $koleksi->buku->cover) }}" alt="Cover Buku" style="max-width: 100px;">
                                @else
                                    Buku Tidak Ditemukan
                                @endif
                            </td>
                            <td>
                                @if ($koleksi->buku)
                                    {{ $koleksi->buku->judul }}
                                @else
                                    Buku Tidak Ditemukan
                                @endif
                            </td>
                            <td>
                                @if ($koleksi->buku)
                                    {{ $koleksi->buku->penulis }}
                                @else
                                    Penulis Tidak Ditemukan
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada buku yang dikoleksi.</p>
        @endif
    </div>


</body>
</html>
