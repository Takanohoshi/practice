@include('layouts.nav')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Buku</title>

    <!-- Tambahkan link CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">

    <h1 class="mt-4">Detail Buku</h1>

    <div>
        <a href="{{ route('home') }}" class="btn btn-primary">Kembali</a>
    </div>

    <div class="mt-4">
        <div class="row justify-content-between">
            <div class="col-md-4">
                <img src="{{ asset('storage/cover/' . $buku->cover) }}" alt="{{ $buku->judul }} Cover" class="img-fluid">
            </div>
            <div class="col-md-8">
                <p class="lead">Informasi Buku:</p>
                <ul class="list-group">
                    <li class="list-group-item">Judul: {{ $buku->judul }}</li>
                    <li class="list-group-item">Penulis: {{ $buku->penulis }}</li>
                    <li class="list-group-item">Penerbit: {{ $buku->penerbit }}</li>
                    <li class="list-group-item">Kategori: 
                        @foreach($buku->kategori as $category)
                            {{ $category->name }},
                        @endforeach
                    </li> 
                    <li class="list-group-item">Tahunterbit: {{ $buku->tahunterbit }}</li>
                    <li class="list-group-item">Deskripsi: {{ $buku->deskripsi }}</li>
                </ul>
                <br>
                <!-- Tambahkan button peminjaman dengan kondisi -->
                @auth
                    @if($statusPeminjaman === 'dikembalikan')
                        <!-- Form peminjaman jika buku telah dikembalikan -->
                        <form action="{{ route('pinjam.store', ['id' => $buku->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Pinjam Buku</button>
                        </form>
                    @elseif($statusPeminjaman === 'dipinjam')
                        <!-- Menampilkan form ulasan jika buku sedang dipinjam -->
                        <form action="{{ route('ulasan.store', ['id' => $buku->id]) }}" method="post">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $buku->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="form-group mt-3">
                                <label for="ulasan">Ulasan:</label>
                                <textarea name="ulasan" id="ulasan" class="form-control" required></textarea>
                            </div>
                            <div class="form-group mt-3">
                                <label for="rating">Rating (1-5):</label>
                                <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
                            </div>
                            <input type="hidden" name="bukuID" value="{{ $buku->id }}">
                            <input type="hidden" name="userID" value="{{ auth()->id() }}">
                            <br>
                            <button type="submit" class="btn btn-primary">Submit Ulasan</button>
                        </form>
                    @endif
                @else
                    <!-- Tombol login diperlukan -->
                    <button class="btn btn-secondary mt-3" disabled>Pinjam/Ulas (Login Diperlukan)</button>
                @endauth
            </div>
        </div>
    </div>


    <div class="mt-4">
        <p class="lead">Ulasan Pengguna:</p>
        @if($ulasan->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Ulasan</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ulasan as $index => $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $review->ulasan }}</td>
                            <td>{{ $review->rating }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">Tidak ada ulasan untuk buku ini.</p>
        @endif
    </div>

    <!-- Tambahkan script JS Bootstrap jika diperlukan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

