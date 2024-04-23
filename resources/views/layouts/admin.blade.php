<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        body {
            background-color: white;
        }
        .active {
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }
    </style>

</head>
<body>
    <div class="container">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light mt-4">
                <div class="container-fluid">
                    <h1 class="display-5">{{ Auth::user()->level === 'petugas' ? 'Petugas' : 'Admin' }}</h1>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            @if(Auth::user()->level === 'petugas')
                                <li class="nav-item">
                                    <a href="/dashboard/databuku" class="nav-link {{ Request::is('dashboard/databuku*') ? 'active' : '' }}">Buku</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/laporan" class="nav-link {{ Request::is('dashboard/laporan*') ? 'active' : '' }}">Laporan</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="/admindash" class="nav-link {{ Request::is('admindash') ? 'active' : '' }}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/datauser" class="nav-link {{ Request::is('dashboard/datauser*') ? 'active' : '' }}">Data User</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/kategori" class="nav-link {{ Request::is('dashboard/kategori*') ? 'active' : '' }}">Kategori</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/databuku" class="nav-link {{ Request::is('dashboard/databuku*') ? 'active' : '' }}">Data Buku</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/laporan" class="nav-link {{ Request::is('dashboard/laporan*') ? 'active' : '' }}">Laporan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/logout" class="nav-link {{ Request::is('logout') ? 'active' : '' }}" onclick="return confirm('Apakah anda yakin untuk logout?')">Logout</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="mt-4">
            <div class="container-fluid">
                {{-- Container --}}
                @yield('container')
            </div>
        </main>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
    </div>
</body>
</html>