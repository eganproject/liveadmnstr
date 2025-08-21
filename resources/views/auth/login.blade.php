<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ config('app.name', 'COK') }}</title>
    
    <link rel="icon" type="image/x-icon" href="{{ asset('public/logo/cok.png') }}">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>


    <style>
        /* Custom styles untuk animasi dan tampilan */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Latar belakang dengan gradien animasi */
        .animated-gradient-background {
            background: linear-gradient(-45deg, #0f172a, #1e293b, #334155, #475569);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Posisikan di paling belakang */
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Animasi untuk form container */
        .form-container {
            animation: fadeInSlideUp 0.8s ease-out forwards;
        }

        @keyframes fadeInSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animasi Partikel Melayang */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            bottom: -200px; /* Mulai dari bawah */
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatUp 25s infinite linear;
        }

        .particle:nth-child(1) { width: 80px; height: 80px; left: 10%; animation-duration: 20s; }
        .particle:nth-child(2) { width: 30px; height: 30px; left: 20%; animation-duration: 15s; animation-delay: 2s; }
        .particle:nth-child(3) { width: 50px; height: 50px; left: 35%; animation-duration: 30s; animation-delay: 4s; }
        .particle:nth-child(4) { width: 100px; height: 100px; left: 50%; animation-duration: 22s; animation-delay: 1s; }
        .particle:nth-child(5) { width: 40px; height: 40px; left: 65%; animation-duration: 28s; animation-delay: 5s; }
        .particle:nth-child(6) { width: 60px; height: 60px; left: 80%; animation-duration: 18s; animation-delay: 3s; }
        .particle:nth-child(7) { width: 20px; height: 20px; left: 90%; animation-duration: 35s; }

        @keyframes floatUp {
            to {
                transform: translateY(-120vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="bg-slate-900">

    <!-- Latar Belakang Animasi Seluruh Halaman -->
    <div class="animated-gradient-background">
        <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
    </div>

    <!-- Konten Utama (Kartu Login) -->
    <div class="flex items-center justify-center min-h-screen p-4 sm:p-6 lg:p-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 w-full max-w-6xl mx-auto rounded-2xl shadow-2xl overflow-hidden">
            
            <!-- Kolom Kiri: Visual/Branding dengan efek kaca -->
            <div class="hidden lg:flex flex-col justify-center items-center p-12 text-white bg-black/20 backdrop-blur-md border-r border-white/10">
                <div class="text-center">
                    <img src="{{ asset('public/logo/cok.png') }}" alt="Logo" class="w-20 h-20 mx-auto mb-6">
                    <h1 class="text-4xl font-bold tracking-tight">Selamat Datang Kembali</h1>
                    <p class="mt-4 text-slate-300 max-w-sm">Masuk untuk mengakses sistem informasi live streaming dan kelola semua aktivitas Anda di satu tempat.</p>
                </div>
            </div>

            <!-- Kolom Kanan: Form Login dengan latar belakang solid -->
            <div class="flex flex-col justify-center p-8 sm:p-12 bg-white dark:bg-slate-800">
                <div class="form-container w-full max-w-md mx-auto">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-slate-800 dark:text-white">Sign In</h2>
                        <p class="text-slate-500 dark:text-slate-400 mt-2">Selamat beraktivitas.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Input Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Alamat Email</label>
                            <div class="mt-1 relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i data-lucide="mail" class="w-5 h-5 text-slate-400"></i>
                                </span>
                                <input id="email" name="email" type="email" autocomplete="email" required
                                       class="block w-full pl-10 pr-3 py-2.5 border border-slate-300 dark:border-slate-600 rounded-md shadow-sm placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-900 dark:text-white transition-all duration-300 @error('email') border-red-500 @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="anda@email.com">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Password</label>
                            <div class="mt-1 relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i data-lucide="lock" class="w-5 h-5 text-slate-400"></i>
                                </span>
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                       class="block w-full pl-10 pr-10 py-2.5 border border-slate-300 dark:border-slate-600 rounded-md shadow-sm placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-900 dark:text-white transition-all duration-300 @error('password') border-red-500 @enderror"
                                       placeholder="••••••••">
                                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                                    <i id="eyeIcon" data-lucide="eye" class="w-5 h-5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Opsi Remember Me -->
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 dark:border-slate-600 rounded bg-slate-100 dark:bg-slate-700">
                            <label for="remember_me" class="ml-2 block text-sm text-slate-900 dark:text-slate-300">Ingat saya</label>
                        </div>

                        <!-- Tombol Submit -->
                        <div>
                            <button type="submit"
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-slate-800 transition-transform transform hover:scale-105 duration-300">
                                Masuk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();

        // Logika untuk toggle lihat password
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            // Toggle tipe input
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Ganti ikon
            if (type === 'password') {
                eyeIcon.setAttribute('data-lucide', 'eye');
            } else {
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            }
            // Render ulang ikon yang berubah
            lucide.createIcons();
        });
    </script>
</body>
</html>
