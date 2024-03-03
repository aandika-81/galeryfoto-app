<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- Menghubungkan ke file CSS -->
    <link href="{{ asset('css/build.css') }}" rel="stylesheet">
    <!-- Menghubungkan ke font -->
    <link href="https://fonts.googleapis.com/css2?family=Hurricane&display=swap" rel="stylesheet">
    <!-- Menghubungkan ke Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Menentukan gaya CSS untuk elemen -->
    <style>
        /* Gaya CSS untuk elemen body */
        body {
            font-family: '', sans-serif; /* Mengganti font */
            margin: 0;
            padding: 0;
        }

        /* Gaya CSS untuk elemen nav */
        nav {
            background-color: #5dddb4;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Gaya CSS untuk elemen gambar dalam nav */
        nav img {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        /* Efek hover untuk gambar dalam nav */
        nav img:hover {
            transform: scale(1.1);
        }

        /* Gaya CSS untuk tautan dalam nav */
        nav a {
            text-decoration: none;
            color: #333333;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: color 0.3s ease;
            margin-left: 24px;
        }

        /* Efek hover untuk tautan dalam nav */
        nav a:hover {
            color: #ff0000;
        }

        /* Gaya CSS untuk ikon dalam tautan nav */
        nav a i {
            margin-bottom: 4px;
            font-size: 24px; /* Ukuran ikon */
        }

        /* Penyesuaian margin agar teks sejajar dengan ikon dalam tautan nav */
        nav a span {
            margin-top: -4px;
        }
        .text-red-700 {
    color: red; /* Menerapkan warna merah */
}
        /* Gaya CSS untuk elemen input dengan tipe "text" */
        /* input[type="text"] {
            padding: 8px 12px;
            border-radius: 20px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
        }

        /* Efek focus untuk input dengan tipe "text" */
        /* input[type="text"]:focus {
            outline: none;
            border-color: #b74c4c;
        } */ 

        /* Gaya CSS untuk tampilan pada layar kecil (maksimum lebar 768px) */
        @media(max-width: 768px) {
            nav {
                flex-direction: column;
                padding: 12px;
            }

            nav img {
                margin-bottom: 12px;
                order: -1; /* Mengubah urutan gambar ke sebelum tautan */
            }

            nav div:last-child {
                margin-top: 12px;
            }

            nav a {
                margin: 8px 0;
                font-size: 16px;
            }

            nav a i {
                margin-bottom: 0;
            }

            /* Penyesuaian lebar input dengan tipe "text" pada layar kecil */
            /* input[type="text"] {
                width: calc(100% - 48px);
                margin-top: 12px;
            } */
        }
        
        /* Gaya CSS untuk elemen .nav-links */
        .nav-links {
            display: flex;
            align-items: center;
        }

        /* Gaya CSS untuk tautan dalam .nav-links */
        .nav-links a {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #2e2727;
            margin: 0 12px; /* Atur margin agar tautan terpisah dengan sejumlah tertentu */
        }

        /* Gaya CSS untuk ikon dalam tautan .nav-links */
        .nav-links a i {
            font-size: 24px; /* Atur ukuran ikon sesuai kebutuhan */
        }

        /* Gaya CSS untuk teks dalam tautan .nav-links */
        .nav-links a span {
            font-size: 14px; /* Atur ukuran teks sesuai kebutuhan */
        }
    </style>
</head>
<body>
    <!-- Navigasi -->
    <nav>
        <!-- Link-navigasi -->
        <div class="nav-links">
            <!-- Gambar profil dan nama pengguna -->
            <div>
                <img src="/profile/{{Auth::user()->foto_profile }}"  alt="Profil Anda">
                <div class="ml-2 flex flex-col">
                    <span class="text-xs">{{ Auth::user()->username }}</span>
                </div>
            </div>
            <!-- Tautan menu -->
            <a href="/explore">
                <i class="bi bi-house"></i>
                <span>BERANDA</span>
            </a>
            <a href="/profil">
                <i class="bi bi-person-circle"></i>
                <span>PROFIL</span>
            </a>
            <a href="/upload_foto">
                <i class="bi bi-cloud-upload"></i>
                <span>UPLOAD</span>
            </a>
            <a href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>KELUAR</span>
            </a>
        </div>
        
        <!-- Form pencarian -->
        <form action="/explore" method="get" class="flex justify-center">
            <input type="text" class="h-8 px-4 border rounded-full w-52 sm:w-auto transition duration-500 ease-in-out hover:scale-105" placeholder="Search ..." name="cari">
            <button type="submit" class="h-8 px-4 border bg-white text-black rounded-full ml-2">CARI</button>
        </form>
    </nav>
    <!-- Isi halaman -->
    @yield('content')
    <!-- Skrip JavaScript -->
    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="/../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>
<!-- Footer JavaScript -->
@stack('footerjs')
</html>
