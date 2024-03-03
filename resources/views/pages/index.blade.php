<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/build.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hurricane&display=swap" rel="stylesheet">
    <style>
        /* Penyesuaian CSS */
        .bg-bgcolor2 {
            background-color: #20e1ff;
        }

        .font-hurricane {
            font-family: 'Hurricane', sans-serif;
        }

        .btn-signin {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 20px;
        }

        .btn-signin:hover {
            background-color: #45a049;
        }

        .btn-signup {
            background-color: #555555;
            border: none;
            color: white;
            padding: 10px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 20px;
        }

        .btn-signup:hover {
            background-color: #333333;
        }

        /* Penataan Foto */
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px;
        }

        .image-container {
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .image-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }

        .image-container img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    {{-- <nav class="bg-white border-gray-200 shadow-md dark:bg-gray-900">
        <div class="flex flex-wrap items-center justify-between max-w-screen-md p-4 mx-auto"> --}}

            {{-- <div class="flex gap-1">
                <a href="login.html"><button class="btn-signin">Sign In</button></a>
                <a href="register.html"><button class="btn-signup">Sign Up</button></a>
            </div> --}}
        {{-- </div>
    </nav> --}}

    <!-- Penambahan Foto -->
    <div class="flex flex-col items-center justify-center">
        <h3 class="text-3xl font-hurricane text-center text-gray-900">GALLERY YOUR MOMENTS</h3>
        <div class="flex gap-1 mt-4">
            <a href="/sign_in" class="text-center"><button class="btn-signin">Sign In</button></a>
            <a href="/sign_up" class="text-center"><button class="btn-signup">Sign Up</button></a>
        </div>
    </div>
    
    <section class="image-grid">
        <div class="image-container">
            <img src="/assets/OIP5.png" alt="">
        </div>
        <div class="image-container">
            <img src="/assets/oip8.jpg" alt="">
        </div>
        <div class="image-container">
            <img src="/assets/OIP3.jpg" alt="">
        </div>
       
    </section>

    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html> 
