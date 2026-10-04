{{-- resources/views/landing.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GuruPro — Platform Digital untuk Guru</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                    colors: {
                        primary: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        }
                    }
                }
            }
        }
    </script>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Inter, ui-sans-serif, system-ui, sans-serif;
        }

        .hero-grid {
            background-image:
                linear-gradient(to right, rgba(148, 163, 184, .07) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(148, 163, 184, .07) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        .hero-glow {
            background:
                radial-gradient(
                    circle at center,
                    rgba(16, 185, 129, .14),
                    transparent 65%
                );
        }
    </style>
</head>

<body class="bg-white text-slate-800 antialiased">

    {{-- =========================================================
        NAVBAR
    ========================================================== --}}
    <header x-data="{ open: false }" class="fixed inset-x-0 top-0 z-50">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mt-4 rounded-2xl border border-slate-200/80 bg-white/90 px-4 shadow-sm backdrop-blur-xl">

                <div class="flex h-16 items-center justify-between">

                    {{-- LOGO --}}
                    <a href="#" class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-600 text-white shadow-lg shadow-primary-600/20">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />

                            </svg>

                        </div>

                        <div>

                            <div class="text-lg font-bold tracking-tight text-slate-900">
                                Guru<span class="text-primary-600">Pro</span>
                            </div>

                            <div class="hidden text-[10px] font-medium uppercase tracking-widest text-slate-400 sm:block">
                                Teacher Platform
                            </div>

                        </div>

                    </a>


                    {{-- DESKTOP NAV --}}
                    <nav class="hidden items-center gap-8 md:flex">

                        <a href="#fitur"
                            class="text-sm font-medium text-slate-600 transition hover:text-primary-600">
                            Fitur
                        </a>

                        <a href="#cara-kerja"
                            class="text-sm font-medium text-slate-600 transition hover:text-primary-600">
                            Cara Kerja
                        </a>

                        <a href="#keunggulan"
                            class="text-sm font-medium text-slate-600 transition hover:text-primary-600">
                            Keunggulan
                        </a>

                    </nav>


                    {{-- DESKTOP CTA --}}
                    <div class="hidden items-center gap-3 md:flex">

                        <a href="{{ url('/admin/login') }}"
                            class="rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                            Masuk
                        </a>

                        <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20mencoba%20GuruPro%20secara%20gratis.%20Saya%20ingin%20mendapatkan%20informasi%20lebih%20lanjut."
                target="_blank" rel="noopener noreferrer"
                            class="rounded-xl bg-primary-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary-600/20 transition hover:bg-primary-700 hover:shadow-primary-600/30">
                            Daftar Gratis
                        </a>

                    </div>


                    {{-- MOBILE BUTTON --}}
                    <button
                        @click="open = !open"
                        class="rounded-xl p-2 text-slate-600 hover:bg-slate-100 md:hidden">

                        <svg x-show="!open"
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />

                        </svg>

                        <svg x-show="open"
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />

                        </svg>

                    </button>

                </div>


                {{-- MOBILE MENU --}}
                <div
                    x-show="open"
                    class="border-t border-slate-100 py-4 md:hidden">

                    <div class="flex flex-col gap-1">

                        <a @click="open = false"
                            href="#fitur"
                            class="rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50">
                            Fitur
                        </a>

                        <a @click="open = false"
                            href="#cara-kerja"
                            class="rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50">
                            Cara Kerja
                        </a>

                        <a @click="open = false"
                            href="#keunggulan"
                            class="rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50">
                            Keunggulan
                        </a>


                        <div class="mt-2 flex gap-2 border-t border-slate-100 pt-3">

                            <a href="{{ url('/admin/login') }}"
                                class="flex-1 rounded-xl border border-slate-200 px-4 py-3 text-center text-sm font-semibold text-slate-700">
                                Masuk
                            </a>

                            <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20mencoba%20GuruPro%20secara%20gratis.%20Saya%20ingin%20mendapatkan%20informasi%20lebih%20lanjut."
                target="_blank" rel="noopener noreferrer"
                                class="flex-1 rounded-xl bg-primary-600 px-4 py-3 text-center text-sm font-semibold text-white">
                                Daftar Gratis
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </header>


    {{-- =========================================================
        HERO
    ========================================================== --}}
    <section class="relative overflow-hidden pt-36 sm:pt-40">

        {{-- Background --}}
        <div class="absolute inset-0 hero-grid"></div>

        <div class="hero-glow absolute left-1/2 top-20 h-[600px] w-[900px] -translate-x-1/2"></div>


        <div class="relative mx-auto max-w-7xl px-4 pb-20 sm:px-6 lg:px-8 lg:pb-28">

            <div class="mx-auto max-w-4xl text-center">


                {{-- BADGE --}}
                <div
                    class="mb-7 inline-flex items-center gap-2 rounded-full border border-primary-100 bg-primary-50 px-4 py-2 text-sm font-medium text-primary-700">

                    <span class="flex h-2 w-2 rounded-full bg-primary-500"></span>

                    Platform digital untuk guru

                </div>


                {{-- HEADING --}}
                <h1
                    class="text-4xl font-extrabold leading-[1.1] tracking-tight text-slate-900 sm:text-5xl lg:text-7xl">

                    Mengajar lebih fokus.

                    <br>

                    <span class="text-primary-600">
                        Administrasi lebih mudah.
                    </span>

                </h1>


                {{-- DESCRIPTION --}}
                <p class="mx-auto mt-7 max-w-xl text-base leading-8 text-slate-500 sm:text-lg">

                    Satu tempat untuk membantu guru
                    mengelola kegiatan mengajar tanpa ribet.

                </p>


                {{-- CTA --}}
                <div class="mt-9">

                    <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20mencoba%20GuruPro%20secara%20gratis.%20Saya%20ingin%20mendapatkan%20informasi%20lebih%20lanjut."
                target="_blank" rel="noopener noreferrer"
                        class="group inline-flex items-center justify-center gap-2 rounded-2xl bg-primary-600 px-8 py-4 text-sm font-semibold text-white shadow-xl shadow-primary-600/20 transition hover:-translate-y-0.5 hover:bg-primary-700">

                        Daftar Gratis Sekarang

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 transition group-hover:translate-x-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />

                        </svg>

                    </a>

                </div>

            </div>


            {{-- =================================================
                DASHBOARD MOCKUP
            ================================================== --}}
            <div class="relative mx-auto mt-16 max-w-6xl">

                <div class="absolute -inset-4 rounded-[2rem] bg-primary-100/50 blur-3xl"></div>

                <div
                    class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl shadow-slate-900/10">


                    {{-- Browser Bar --}}
                    <div class="flex h-11 items-center gap-2 border-b border-slate-100 bg-slate-50 px-4">

                        <div class="h-2.5 w-2.5 rounded-full bg-slate-300"></div>
                        <div class="h-2.5 w-2.5 rounded-full bg-slate-300"></div>
                        <div class="h-2.5 w-2.5 rounded-full bg-slate-300"></div>

                        <div
                            class="mx-auto hidden h-6 max-w-md flex-1 rounded-lg bg-white px-4 text-[10px] leading-6 text-slate-400 shadow-sm sm:block">

                            app.gurupro.id/dashboard

                        </div>

                    </div>


                    <div class="flex min-h-[440px]">


                        {{-- SIDEBAR --}}
                        <aside class="hidden w-52 shrink-0 border-r border-slate-100 bg-white p-4 sm:block">

                            <div class="mb-7 flex items-center gap-2">

                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-600 text-white">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />

                                    </svg>

                                </div>

                                <span class="font-bold text-slate-800">
                                    Guru<span class="text-primary-600">Pro</span>
                                </span>

                            </div>


                            <div class="space-y-1">

                                <div class="rounded-xl bg-primary-50 px-3 py-2.5 text-xs font-semibold text-primary-600">
                                    Dashboard Guru
                                </div>

                                <div class="rounded-xl px-3 py-2.5 text-xs text-slate-500">
                                    Kelas & Siswa
                                </div>

                                <div class="rounded-xl px-3 py-2.5 text-xs text-slate-500">
                                    Jadwal Mengajar
                                </div>

                                <div class="rounded-xl px-3 py-2.5 text-xs text-slate-500">
                                    Jurnal Mengajar
                                </div>

                            </div>

                        </aside>


                        {{-- MAIN DASHBOARD --}}
                        <div class="flex-1 bg-slate-50/70 p-5 sm:p-7">


                            {{-- Header --}}
                            <div class="mb-6 flex items-center justify-between">

                                <div>

                                    <p class="text-[10px] font-medium uppercase tracking-wider text-slate-400">
                                        Dashboard
                                    </p>

                                    <h3 class="mt-1 text-lg font-bold text-slate-800">
                                        Selamat datang, Bapak/Ibu Guru 👋
                                    </h3>

                                </div>


                                <div
                                    class="hidden h-9 w-9 items-center justify-center rounded-full bg-primary-100 text-xs font-bold text-primary-600 sm:flex">
                                    GP
                                </div>

                            </div>


                            {{-- Stats --}}
                            <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">


                                {{-- Students --}}
                                <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">

                                    <div
                                        class="mb-3 flex h-8 w-8 items-center justify-center rounded-lg bg-primary-50 text-primary-600">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />

                                        </svg>

                                    </div>

                                    <p class="text-2xl font-bold text-slate-800">
                                        128
                                    </p>

                                    <p class="mt-1 text-[11px] text-slate-400">
                                        Total Siswa
                                    </p>

                                </div>


                                {{-- Attendance --}}
                                <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">

                                    <div
                                        class="mb-3 flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.052-.382-3.016z" />

                                        </svg>

                                    </div>

                                    <p class="text-2xl font-bold text-slate-800">
                                        96%
                                    </p>

                                    <p class="mt-1 text-[11px] text-slate-400">
                                        Kehadiran
                                    </p>

                                </div>


                                {{-- Schedule --}}
                                <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">

                                    <div
                                        class="mb-3 flex h-8 w-8 items-center justify-center rounded-lg bg-sky-50 text-sky-600">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />

                                        </svg>

                                    </div>

                                    <p class="text-2xl font-bold text-slate-800">
                                        4
                                    </p>

                                    <p class="mt-1 text-[11px] text-slate-400">
                                        Jadwal Hari Ini
                                    </p>

                                </div>


                                {{-- Assessment --}}
                                <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">

                                    <div
                                        class="mb-3 flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-amber-600">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12l2 2 4-4M7.835 4.697a3.5 3.5 0 005.33 0 3.5 3.5 0 015.11 2.308 3.5 3.5 0 002.308 5.11 3.5 3.5 0 010 5.33 3.5 3.5 0 00-2.308 5.11 3.5 3.5 0 01-5.11 2.308 3.5 3.5 0 00-5.33 0 3.5 3.5 0 01-5.11-2.308 3.5 3.5 0 00-2.308-5.11 3.5 3.5 0 010-5.33A3.5 3.5 0 004.697 7.835a3.5 3.5 0 013.138-3.138z" />

                                        </svg>

                                    </div>

                                    <p class="text-2xl font-bold text-slate-800">
                                        82%
                                    </p>

                                    <p class="mt-1 text-[11px] text-slate-400">
                                        Penilaian
                                    </p>

                                </div>

                            </div>


                            {{-- Bottom --}}
                            <div class="mt-5 grid gap-5 lg:grid-cols-3">


                                {{-- Schedule --}}
                                <div
                                    class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm lg:col-span-2">

                                    <div class="mb-5 flex items-center justify-between">

                                        <div>

                                            <h4 class="font-bold text-slate-800">
                                                Jadwal Mengajar
                                            </h4>

                                            <p class="mt-1 text-xs text-slate-400">
                                                Senin, 7 September 2026
                                            </p>

                                        </div>

                                        <span
                                            class="rounded-lg bg-primary-50 px-2.5 py-1 text-[10px] font-semibold text-primary-600">
                                            Hari ini
                                        </span>

                                    </div>


                                    <div class="space-y-3">


                                        <div class="flex items-center gap-4 rounded-xl bg-slate-50 p-3">

                                            <div class="w-12 text-center">

                                                <p class="text-xs font-bold text-slate-700">
                                                    07:00
                                                </p>

                                                <p class="text-[9px] text-slate-400">
                                                    -
                                                </p>

                                                <p class="text-xs font-bold text-slate-700">
                                                    08:30
                                                </p>

                                            </div>

                                            <div class="h-10 w-1 rounded-full bg-primary-500"></div>

                                            <div>

                                                <p class="text-sm font-semibold text-slate-800">
                                                    Informatika
                                                </p>

                                                <p class="mt-0.5 text-[10px] text-slate-400">
                                                    Kelas VII A · Ruang 03
                                                </p>

                                            </div>

                                        </div>


                                        <div class="flex items-center gap-4 rounded-xl bg-slate-50 p-3">

                                            <div class="w-12 text-center">

                                                <p class="text-xs font-bold text-slate-700">
                                                    09:00
                                                </p>

                                                <p class="text-[9px] text-slate-400">
                                                    -
                                                </p>

                                                <p class="text-xs font-bold text-slate-700">
                                                    10:30
                                                </p>

                                            </div>

                                            <div class="h-10 w-1 rounded-full bg-sky-500"></div>

                                            <div>

                                                <p class="text-sm font-semibold text-slate-800">
                                                    Informatika
                                                </p>

                                                <p class="mt-0.5 text-[10px] text-slate-400">
                                                    Kelas VIII B · Lab Komputer
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </div>


                                {{-- Activity --}}
                                <!-- Jurnal Terbaru -->
                                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <h3 class="font-semibold text-gray-900">Jurnal Terbaru</h3>
                                            <p class="text-xs text-gray-400 mt-1">
                                                Riwayat pembelajaran Anda
                                            </p>
                                        </div>
                                    
                                        <span class="text-xs text-primary-600 font-medium">
                                            Lihat Semua
                                        </span>
                                    </div>
                                
                                    <div class="space-y-3">
                                        @foreach ([
    [
        'subject' => 'Informatika',
        'class' => 'VII A',
        'date' => '21 Sep 2026',
        'description' => 'Pengenalan algoritma dan logika dasar'
    ],
    [
        'subject' => 'Informatika',
        'class' => 'VIII B',
        'date' => '20 Sep 2026',
        'description' => 'Membuat program sederhana menggunakan Python'
    ],
    [
        'subject' => 'Teknologi Informasi',
        'class' => 'IX A',
        'date' => '19 Sep 2026',
        'description' => 'Pengenalan jaringan komputer'
    ],
] as $journal)
                                            <div class="flex gap-3 p-3 rounded-lg bg-gray-50">
                                                <div class="w-9 h-9 rounded-lg bg-primary-100 flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332-.477-4.5 1.253" />
                                                    </svg>
                                                </div>

                                                <div class="min-w-0 flex-1">
                                                    <div class="flex items-center justify-between gap-2">
                                                        <p class="text-sm font-medium text-gray-900 truncate">
                                                            {{ $journal['subject'] }}
                                                        </p>
                                                        <span class="text-[10px] text-gray-400 whitespace-nowrap">
                                                            {{ $journal['date'] }}
                                                        </span>
                                                    </div>

                                                    <p class="text-xs text-gray-500 mt-0.5">
                                                        Kelas {{ $journal['class'] }}
                                                    </p>

                                                    <p class="text-xs text-gray-400 mt-1 truncate">
                                                        {{ $journal['description'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        FITUR
    ========================================================== --}}
    <section id="fitur" class="bg-slate-50 py-24 sm:py-28">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


            <div class="mx-auto max-w-2xl text-center">

                <span class="text-sm font-bold text-primary-600">
                    GURUPRO
                </span>

                <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                    Yang Anda butuhkan,
                    <span class="text-primary-600">ada di sini.</span>
                </h2>

                <p class="mt-4 text-base leading-7 text-slate-500">
                    Kelola kegiatan mengajar dalam satu tempat yang sederhana.
                </p>

            </div>


            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">


                {{-- Jurnal --}}
                <div
                    class="group rounded-3xl border border-slate-200/80 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 transition group-hover:bg-primary-600 group-hover:text-white">

                        <svg class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />

                        </svg>

                    </div>

                    <h3 class="mt-6 text-lg font-bold text-slate-800">
                        Jurnal Guru
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Catat kegiatan pembelajaran dengan lebih cepat dan rapi.
                    </p>

                </div>


                {{-- Presensi --}}
                <div
                    class="group rounded-3xl border border-slate-200/80 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 transition group-hover:bg-emerald-600 group-hover:text-white">

                        <svg class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.052-.382-3.016z" />

                        </svg>

                    </div>

                    <h3 class="mt-6 text-lg font-bold text-slate-800">
                        Presensi
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Kelola kehadiran siswa tanpa harus repot dengan catatan terpisah.
                    </p>

                </div>


                {{-- Penilaian --}}
                <div
                    class="group rounded-3xl border border-slate-200/80 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 transition group-hover:bg-amber-500 group-hover:text-white">

                        <svg class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z" />

                        </svg>

                    </div>

                    <h3 class="mt-6 text-lg font-bold text-slate-800">
                        Penilaian
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Simpan dan kelola nilai siswa dengan lebih terorganisir.
                    </p>

                </div>


                {{-- Jadwal --}}
                <div
                    class="group rounded-3xl border border-slate-200/80 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-600 transition group-hover:bg-sky-600 group-hover:text-white">

                        <svg class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />

                        </svg>

                    </div>

                    <h3 class="mt-6 text-lg font-bold text-slate-800">
                        Jadwal Mengajar
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Ketahui jadwal dan kelas yang harus Anda tangani setiap hari.
                    </p>

                </div>


                {{-- Kelas --}}
                <div
                    class="group rounded-3xl border border-slate-200/80 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 transition group-hover:bg-violet-600 group-hover:text-white">

                        <svg class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />

                        </svg>

                    </div>

                    <h3 class="mt-6 text-lg font-bold text-slate-800">
                        Kelas & Siswa
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Kelola kelas dan data siswa dalam satu tempat.
                    </p>

                </div>


                {{-- Rekap --}}
                <div
                    class="group rounded-3xl border border-slate-200/80 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-600 transition group-hover:bg-rose-600 group-hover:text-white">

                        <svg class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 17v-1a3 3 0 013-3h0a3 3 0 013 3v1m-6 0h6m-9 4h12a2 2 0 002-2V5a2 2 0 00-2-2H6a2 2 0 00-2 2v14a2 2 0 002 2z" />

                        </svg>

                    </div>

                    <h3 class="mt-6 text-lg font-bold text-slate-800">
                        Rekap & Data
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Semua data tersimpan rapi dan mudah ditemukan kembali.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        CARA KERJA
    ========================================================== --}}
    <section id="cara-kerja" class="bg-white py-24 sm:py-28">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">

                <span class="text-sm font-bold text-primary-600">
                    CARA KERJA
                </span>

                <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                    Mulai dalam beberapa langkah.
                </h2>

                <p class="mt-4 text-base leading-7 text-slate-500">
                    Tidak perlu sistem yang rumit untuk mengelola administrasi mengajar.
                </p>

            </div>


            <div class="mx-auto mt-14 grid max-w-5xl gap-8 md:grid-cols-3">


                {{-- Step 1 --}}
                <div class="relative text-center">

                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-600 text-lg font-bold text-white shadow-lg shadow-primary-600/20">
                        01
                    </div>

                    <h3 class="mt-5 font-bold text-slate-800">
                        Daftar
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Buat akun GuruPro dan siapkan profil Anda.
                    </p>

                </div>


                {{-- Step 2 --}}
                <div class="relative text-center">

                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-100 text-lg font-bold text-primary-600">
                        02
                    </div>

                    <h3 class="mt-5 font-bold text-slate-800">
                        Kelola
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Masukkan kelas, siswa, jadwal, dan kegiatan mengajar.
                    </p>

                </div>


                {{-- Step 3 --}}
                <div class="relative text-center">

                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-100 text-lg font-bold text-primary-600">
                        03
                    </div>

                    <h3 class="mt-5 font-bold text-slate-800">
                        Selesai
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Kelola administrasi Anda dari satu dashboard.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        KEUNGGULAN
    ========================================================== --}}
    <section id="keunggulan" class="bg-slate-50 py-24 sm:py-28">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">

                <span class="text-sm font-bold text-primary-600">
                    GURUPRO
                </span>

                <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                    Dibuat untuk keseharian guru.
                </h2>

            </div>


            <div class="mt-14 grid gap-5 md:grid-cols-3">


                <div class="rounded-3xl bg-white p-8 shadow-sm">

                    <div class="text-3xl">
                        ⚡
                    </div>

                    <h3 class="mt-5 text-lg font-bold text-slate-800">
                        Lebih praktis
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Kebutuhan administrasi tersedia dalam satu dashboard.
                    </p>

                </div>


                <div class="rounded-3xl bg-white p-8 shadow-sm">

                    <div class="text-3xl">
                        📋
                    </div>

                    <h3 class="mt-5 text-lg font-bold text-slate-800">
                        Lebih terorganisir
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Data kelas, siswa, jurnal, presensi, dan penilaian tersimpan rapi.
                    </p>

                </div>


                <div class="rounded-3xl bg-white p-8 shadow-sm">

                    <div class="text-3xl">
                        🌱
                    </div>

                    <h3 class="mt-5 text-lg font-bold text-slate-800">
                        Terus berkembang
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        GuruPro terus dikembangkan mengikuti kebutuhan guru.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        CTA
    ========================================================== --}}
    <section class="relative overflow-hidden bg-primary-700 py-20 sm:py-24">

        <div class="absolute -right-32 -top-32 h-96 w-96 rounded-full bg-white/10"></div>

        <div class="absolute -bottom-40 -left-20 h-96 w-96 rounded-full bg-white/10"></div>


        <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6">

            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                Siap mengajar lebih fokus?
            </h2>

            <p class="mx-auto mt-5 max-w-xl text-sm leading-7 text-primary-100 sm:text-base">
                Coba GuruPro dan rasakan cara yang lebih sederhana untuk mengelola administrasi mengajar.
            </p>


            <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20mencoba%20GuruPro%20secara%20gratis.%20Saya%20ingin%20mendapatkan%20informasi%20lebih%20lanjut."
                target="_blank" rel="noopener noreferrer"
                class="mt-8 inline-flex items-center gap-2 rounded-2xl bg-white px-7 py-3.5 text-sm font-bold text-primary-700 shadow-xl transition hover:-translate-y-0.5 hover:bg-primary-50">
            
                Daftar Gratis Sekarang
            
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            
                </svg>
            </a>

        </div>

    </section>


    {{-- =========================================================
        FOOTER
    ========================================================== --}}
    <footer class="border-t border-slate-100 bg-white">

        <div
            class="mx-auto flex max-w-7xl flex-col gap-5 px-4 py-8 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">


            <div class="flex items-center gap-3">

                <div
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary-600 text-white">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />

                    </svg>

                </div>


                <div>

                    <p class="text-sm font-bold text-slate-800">
                        Guru<span class="text-primary-600">Pro</span>
                    </p>

                    <p class="text-xs text-slate-400">
                        Platform digital untuk guru
                    </p>

                </div>

            </div>


            <p class="text-xs text-slate-400">
                © {{ date('Y') }} GuruPro. Semua hak dilindungi.
            </p>

        </div>

    </footer>

</body>

</html>