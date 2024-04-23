<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- css link -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <style>
        /* Reset some default styles */
body, h1, h2, h3, p {
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
}

.logo {
    text-decoration: none;
    color: #333;
    font-size: 24px;
    font-weight: bold;
}

.navbar {
    display: flex;
}

.nav-link {
    text-decoration: none;
    color: #333;
    margin-right: 20px;
    font-weight: bold;
    transition: color 0.3s ease-in-out;
}

.nav-link:hover {
    color: #3591dc;
}

.icons {
    display: flex;
    align-items: center;
}

.icons i {
    margin-right: 10px;
    font-size: 18px;
    cursor: pointer;
}

#bars {
    display: none;
    font-size: 24px;
    cursor: pointer;
}

/* Media query for responsiveness */
@media (max-width: 768px) {
    .navbar {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 70px;
        left: 0;
        width: 100%;
        background-color: #fff;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        z-index: 1;
    }

    .navbar.active {
        display: flex;
    }

    .nav-link {
        margin: 10px 0;
    }

    #bars {
        display: block;
    }
}

main {
    margin-top: 20px;
}

.footer {
    background-color: #f8f9fa;
    text-align: center;
    margin-top: 20px;
    padding: 10px 0;
}

    </style>

</head>
<body>
    <div class="container">
        <header>
            <a href="#" class="logo">Perpustakaan : Admin Login</a>
            <nav class="navbar">
                <a href="/" class="nav-link {{ Request::is('home') ? 'active' : '' }}">Beranda</a>
                <a href="/pinjam" class="nav-link {{ Request::is('pinjam') ? 'active' : '' }}">Peminjaman</a>
                <a href="/koleksibuku" class="nav-link {{ Request::is('koleksibuku') ? 'active' : '' }}">Koleksi</a>
                <a href="/regmin" class="nav-link {{ Request::is('regmin') ? 'active' : '' }}">Register Admin</a>
            </nav>
            <div class="icons">
                <i class="fas fa-bars" id="bars"></i>
                @auth
                    <a href="/logout" class="fas fa-sign-out-alt" id="logout"></a>
                @else
                    <a href="/login" class="fas fa-user" id="login"></a>
                @endauth
            </div>
        </header>

        <main class="mt-4">
            <div class="container-fluid">
                
                {{-- Container --}}
                @yield('container')
                
            </div>
        </main>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        let menu = document.querySelector("#bars");
        let navbar = document.querySelector(".navbar");
        
        menu.onclick = () => {
            menu.classList.toggle('fa-time');
            navbar.classList.toggle('active');
        }
    </script>
</body>
</html>
