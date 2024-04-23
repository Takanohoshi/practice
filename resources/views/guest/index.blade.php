<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <!-- CSS Anda -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 2em;
            text-align: center;
        }

        .books-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .book {
            width: 250px;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            text-decoration: none; /* Menonaktifkan underline */
            color: inherit; /* Menyesuaikan warna teks */
        }

        .book:hover {
            transform: scale(1.05);
        }

        .book img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .book h3 {
            font-size: 1.2em;
            margin-top: 10px;
            text-align: center;
        }

        .book p {
            font-size: 1em;
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    @include('layouts.nav')

    <div class="container">
        <h1>Daftar Buku</h1>

        <!-- Input untuk pencarian -->
        <input type="text" id="searchInput" onkeyup="cariBuku()" placeholder="Cari...">

        <div class="books-container" id="booksContainer">
            <!-- Daftar Buku akan muncul di sini -->
            @foreach($buku as $buku)
                <a href="{{ route('detail', ['id' => $buku->id]) }}" class="book" data-judul="{{ $buku->judul }}" data-pengarang="{{ $buku->pengarang }}" data-tahun="{{ $buku->tahun_terbit }}" data-kategori="{{ implode(',', $buku->kategori->pluck('name')->toArray()) }}">
                    <img src="{{ asset('storage/cover/' . $buku->cover) }}" alt="{{ $buku->judul }} Cover">
                    <h3>{{ $buku->judul }}</h3>
                    <p>{{ $buku->pengarang }}</p>
                    <p>{{ $buku->tahun_terbit }}</p>
                    <p>
                        @foreach ($buku->kategori as $category)
                            {{ $category->name }},
                        @endforeach
                    </p>
                </a>
            @endforeach
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Fungsi untuk melakukan pencarian
        function cariBuku() {
            var input, filter, container, book, title, author, year, category, i;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            container = document.getElementById('booksContainer');
            book = container.getElementsByClassName('book');

            // Melakukan iterasi pada daftar buku dan menyembunyikan yang tidak sesuai
            for (i = 0; i < book.length; i++) {
                title = book[i].getAttribute('data-judul').toUpperCase();
                author = book[i].getAttribute('data-pengarang').toUpperCase();
                year = book[i].getAttribute('data-tahun').toUpperCase();
                category = book[i].getAttribute('data-kategori').toUpperCase();
                
                if (title.indexOf(filter) > -1 || author.indexOf(filter) > -1 || year.indexOf(filter) > -1 || category.indexOf(filter) > -1) {
                    book[i].style.display = "";
                } else {
                    book[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
