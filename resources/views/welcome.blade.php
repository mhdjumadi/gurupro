```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description"
        content="GuruPro adalah platform digital untuk membantu guru mengelola jurnal, presensi, penilaian, jadwal, kelas, dan siswa dalam satu tempat.">

    <title>GuruPro — Platform Digital untuk Guru</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-white font-sans text-gray-950 antialiased dark:bg-gray-950 dark:text-white">

    {{-- =========================================================
        NAVBAR
    ========================================================== --}}
    <header
        x-data="{ open: false }"
        class="fixed inset-x-0 top-0 z-50 border-b border-gray-200/70 bg-white/85 backdrop-blur-xl dark:border-gray-800/70 dark:bg-gray-950/85">

        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-5 sm:px-6 lg:px-8">

            {{-- LOGO --}}
            <a href="#beranda" class="flex items-center gap-2.5">

                <div
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary-600 text-white shadow-lg shadow-primary-600/20">
                    <x-heroicon-s-academic-cap class="h-5 w-5" />
                </div>

                <span class="text-lg font-extrabold tracking-tight">
                    Guru<span class="text-primary-600 dark:text-primary-400">Pro</span>
                </span>

            </a>


            {{-- DESKTOP NAV --}}
            <nav class="hidden items-center gap-8 md:flex">

                <a href="#fitur"
                    class="text-sm font-semibold text-gray-600 transition hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400">
                    Fitur
                </a>

                <a href="#cara-kerja"
                    class="text-sm font-semibold text-gray-600 transition hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400">
                    Cara Kerja
                </a>

                <a href="#keunggulan"
                    class="text-sm font-semibold text-gray-600 transition hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400">
                    Keunggulan
                </a>

            </nav>


            {{-- DESKTOP ACTION --}}
            <div class="hidden items-center gap-4 md:flex">

                <a href="{{ url('/admin/login') }}"
                    class="text-sm font-bold text-gray-700 transition hover:text-primary-600 dark:text-gray-300 dark:hover:text-primary-400">
                    Masuk
                </a>

                <a href="#mulai"
                    class="rounded-xl bg-primary-600 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-primary-600/20 transition hover:bg-primary-700">
                    Mulai Sekarang
                </a>

            </div>


            {{-- MOBILE MENU BUTTON --}}
            <button
                type="button"
                @click="open = !open"
                class="rounded-xl p-2 text-gray-600 transition hover:bg-gray-100 md:hidden dark:text-gray-300 dark:hover:bg-gray-800">

                <x-heroicon-o-bars-3 class="h-6 w-6" />

            </button>

        </div>


        {{-- MOBILE MENU --}}
        <div
            x-show="open"
            x-transition
            class="border-t border-gray-200 bg-white px-5 py-4 md:hidden dark:border-gray-800 dark:bg-gray-950">

            <nav class="flex flex-col gap-1">

                <a
                    @click="open = false"
                    href="#fitur"
                    class="rounded-xl px-3 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-900">
                    Fitur
                </a>

                <a
                    @click="open = false"
                    href="#cara-kerja"
                    class="rounded-xl px-3 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-900">
                    Cara Kerja
                </a>

                <a
                    @click="open = false"
                    href="#keunggulan"
                    class="rounded-xl px-3 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-900">
                    Keunggulan
                </a>

                <a
                    href="{{ url('/admin/login') }}"
                    class="mt-2 rounded-xl bg-primary-600 px-4 py-3 text-center text-sm font-bold text-white">
                    Masuk ke GuruPro
                </a>

            </nav>

        </div>

    </header>


    <main>

        {{-- =====================================================
            HERO
        ====================================================== --}}
        <section
            id="beranda"
            class="relative overflow-hidden pt-32 sm:pt-40">

            {{-- BACKGROUND --}}
            <div class="pointer-events-none absolute inset-0 -z-10">

                <div
                    class="absolute left-1/2 top-0 h-[500px] w-[850px] -translate-x-1/2 rounded-full bg-primary-100/70 blur-3xl dark:bg-primary-950/30">
                </div>

                <div
                    class="absolute -right-32 top-52 h-80 w-80 rounded-full bg-primary-200/30 blur-3xl dark:bg-primary-900/20">
                </div>

            </div>


            <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

                {{-- HERO TEXT --}}
                <div class="mx-auto max-w-4xl text-center">

                    {{-- BADGE --}}
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-primary-200 bg-primary-50 px-4 py-2 text-xs font-bold text-primary-700 dark:border-primary-500/20 dark:bg-primary-500/10 dark:text-primary-300">

                        <span class="relative flex h-2 w-2">

                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-primary-500 opacity-75">
                            </span>

                            <span
                                class="relative inline-flex h-2 w-2 rounded-full bg-primary-500">
                            </span>

                        </span>

                        Platform digital untuk guru

                    </div>


                    {{-- TITLE --}}
                    <h1
                        class="mt-7 text-4xl font-black leading-[1.08] tracking-tight text-gray-950 sm:text-5xl lg:text-7xl dark:text-white">

                        Mengajar lebih fokus.
                        <br>

                        <span class="text-primary-600 dark:text-primary-400">
                            Administrasi lebih mudah.
                        </span>

                    </h1>


                    {{-- DESCRIPTION --}}
                    <p
                        class="mx-auto mt-6 max-w-2xl text-base leading-7 text-gray-600 sm:text-lg dark:text-gray-400">

                        GuruPro membantu guru mengelola jurnal, presensi,
                        penilaian, jadwal, kelas, dan data siswa
                        dalam satu platform yang sederhana.

                    </p>


                    {{-- CTA --}}
                    <div
                        class="mt-9 flex flex-col justify-center gap-3 sm:flex-row">

                        <a
                            href="{{ url('/admin/login') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-primary-600 px-6 py-3.5 text-sm font-bold text-white shadow-xl shadow-primary-600/20 transition hover:-translate-y-0.5 hover:bg-primary-700">

                            Mulai Gunakan GuruPro

                            <x-heroicon-m-arrow-right class="h-4 w-4" />

                        </a>


                        <a
                            href="#fitur"
                            class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-6 py-3.5 text-sm font-bold text-gray-700 transition hover:border-primary-200 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-primary-500/30 dark:hover:bg-gray-800">

                            Jelajahi Fitur

                        </a>

                    </div>


                    <p class="mt-4 text-xs text-gray-500 dark:text-gray-500">
                        Sederhana digunakan. Dirancang untuk kebutuhan guru.
                    </p>

                </div>


                {{-- =================================================
                    DASHBOARD PREVIEW
                ================================================== --}}
                <div class="relative mx-auto mt-16 max-w-6xl sm:mt-20">

                    <div
                        class="absolute -inset-6 rounded-[40px] bg-primary-500/10 blur-3xl">
                    </div>


                    <div
                        class="relative overflow-hidden rounded-[28px] border border-gray-200 bg-white shadow-2xl shadow-gray-900/10 dark:border-gray-800 dark:bg-gray-900">

                        {{-- BROWSER HEADER --}}
                        <div
                            class="flex h-11 items-center gap-2 border-b border-gray-200 bg-gray-50 px-4 dark:border-gray-800 dark:bg-gray-950">

                            <span class="h-2.5 w-2.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>

                            <div
                                class="mx-auto hidden w-1/2 rounded-lg bg-white px-3 py-1 text-left text-[10px] text-gray-400 ring-1 ring-gray-200 sm:block dark:bg-gray-900 dark:ring-gray-800">

                                app.gurupro.id

                            </div>

                        </div>


                        {{-- DASHBOARD --}}
                        <div
                            class="grid min-h-[420px] grid-cols-12 bg-gray-50 dark:bg-gray-950">


                            {{-- SIDEBAR --}}
                            <aside
                                class="col-span-3 hidden border-r border-gray-200 bg-white p-5 md:block dark:border-gray-800 dark:bg-gray-900">

                                <div class="mb-8 flex items-center gap-2">

                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-600 text-white">

                                        <x-heroicon-s-academic-cap class="h-4 w-4" />

                                    </div>

                                    <span class="font-extrabold">
                                        GuruPro
                                    </span>

                                </div>


                                <div class="space-y-1.5 text-xs">

                                    <div
                                        class="rounded-xl bg-primary-50 px-3 py-2.5 font-bold text-primary-700 dark:bg-primary-500/10 dark:text-primary-300">
                                        Dashboard
                                    </div>

                                    <div class="px-3 py-2.5 text-gray-500">
                                        Jurnal Guru
                                    </div>

                                    <div class="px-3 py-2.5 text-gray-500">
                                        Presensi
                                    </div>

                                    <div class="px-3 py-2.5 text-gray-500">
                                        Penilaian
                                    </div>

                                    <div class="px-3 py-2.5 text-gray-500">
                                        Jadwal
                                    </div>

                                    <div class="px-3 py-2.5 text-gray-500">
                                        Kelas & Siswa
                                    </div>

                                </div>

                            </aside>


                            {{-- DASHBOARD CONTENT --}}
                            <div class="col-span-12 p-5 sm:p-7 md:col-span-9">

                                <div class="mb-6">

                                    <p
                                        class="text-[10px] font-bold uppercase tracking-widest text-primary-600 dark:text-primary-400">
                                        Dashboard Guru
                                    </p>

                                    <h3 class="mt-1 text-xl font-black sm:text-2xl">
                                        Selamat datang, Bapak/Ibu Guru
                                    </h3>

                                    <p class="mt-1 text-xs text-gray-500">
                                        Kelola aktivitas mengajar Anda dengan lebih mudah.
                                    </p>

                                </div>


                                {{-- STATISTICS --}}
                                <div
                                    class="mb-5 grid grid-cols-2 gap-3 sm:grid-cols-4">

                                    <div
                                        class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">

                                        <x-heroicon-o-document-text
                                            class="h-5 w-5 text-primary-500" />

                                        <p class="mt-3 text-xl font-black">
                                            12
                                        </p>

                                        <p class="text-[10px] text-gray-500">
                                            Jurnal
                                        </p>

                                    </div>


                                    <div
                                        class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">

                                        <x-heroicon-o-clipboard-document-check
                                            class="h-5 w-5 text-primary-500" />

                                        <p class="mt-3 text-xl font-black">
                                            8
                                        </p>

                                        <p class="text-[10px] text-gray-500">
                                            Presensi
                                        </p>

                                    </div>


                                    <div
                                        class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">

                                        <x-heroicon-o-chart-bar
                                            class="h-5 w-5 text-primary-500" />

                                        <p class="mt-3 text-xl font-black">
                                            124
                                        </p>

                                        <p class="text-[10px] text-gray-500">
                                            Penilaian
                                        </p>

                                    </div>


                                    <div
                                        class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">

                                        <x-heroicon-o-calendar-days
                                            class="h-5 w-5 text-primary-500" />

                                        <p class="mt-3 text-xl font-black">
                                            5
                                        </p>

                                        <p class="text-[10px] text-gray-500">
                                            Jadwal
                                        </p>

                                    </div>

                                </div>


                                {{-- DASHBOARD CARDS --}}
                                <div class="grid gap-3 sm:grid-cols-2">

                                    {{-- Schedule --}}
                                    <div
                                        class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">

                                        <div class="flex items-center justify-between">

                                            <p class="text-xs font-bold">
                                                Jadwal Hari Ini
                                            </p>

                                            <x-heroicon-o-calendar-days
                                                class="h-4 w-4 text-primary-500" />

                                        </div>


                                        <div class="mt-4 space-y-2">

                                            <div
                                                class="rounded-xl bg-gray-50 p-3 dark:bg-gray-800">

                                                <p
                                                    class="text-[10px] font-bold text-primary-600 dark:text-primary-400">
                                                    07:30 — 09:00
                                                </p>

                                                <p class="mt-1 text-xs font-bold">
                                                    Informatika • VIII A
                                                </p>

                                            </div>


                                            <div
                                                class="rounded-xl bg-gray-50 p-3 dark:bg-gray-800">

                                                <p
                                                    class="text-[10px] font-bold text-primary-600 dark:text-primary-400">
                                                    09:30 — 11:00
                                                </p>

                                                <p class="mt-1 text-xs font-bold">
                                                    Informatika • IX B
                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    {{-- Activity --}}
                                    <div
                                        class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">

                                        <div class="flex items-center justify-between">

                                            <p class="text-xs font-bold">
                                                Aktivitas Terakhir
                                            </p>

                                            <x-heroicon-o-clock
                                                class="h-4 w-4 text-primary-500" />

                                        </div>


                                        <div class="mt-4 space-y-4">

                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="h-2 w-2 rounded-full bg-primary-500">
                                                </div>

                                                <div>
                                                    <p class="text-[11px] font-semibold">
                                                        Presensi VIII A
                                                    </p>

                                                    <p class="text-[10px] text-gray-500">
                                                        Hari ini
                                                    </p>
                                                </div>

                                            </div>


                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="h-2 w-2 rounded-full bg-primary-500">
                                                </div>

                                                <div>
                                                    <p class="text-[11px] font-semibold">
                                                        Jurnal pembelajaran
                                                    </p>

                                                    <p class="text-[10px] text-gray-500">
                                                        Hari ini
                                                    </p>
                                                </div>

                                            </div>


                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="h-2 w-2 rounded-full bg-primary-500">
                                                </div>

                                                <div>
                                                    <p class="text-[11px] font-semibold">
                                                        Penilaian IX B
                                                    </p>

                                                    <p class="text-[10px] text-gray-500">
                                                        Kemarin
                                                    </p>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
            FEATURES
        ====================================================== --}}
        <section id="fitur" class="py-24 sm:py-32">

            <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

                <div class="mx-auto max-w-2xl text-center">

                    <p
                        class="text-xs font-black uppercase tracking-[0.2em] text-primary-600 dark:text-primary-400">
                        Fitur GuruPro
                    </p>

                    <h2
                        class="mt-3 text-3xl font-black tracking-tight sm:text-4xl">

                        Semua aktivitas mengajar,
                        <span class="text-primary-600 dark:text-primary-400">
                            dalam satu tempat.
                        </span>

                    </h2>

                    <p
                        class="mt-5 text-sm leading-7 text-gray-600 sm:text-base dark:text-gray-400">

                        Tidak perlu berpindah-pindah aplikasi.
                        GuruPro membantu mengelola berbagai kebutuhan
                        administrasi guru dengan lebih sederhana.

                    </p>

                </div>


                <div
                    class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">


                    {{-- FEATURE --}}
                    <div
                        class="rounded-3xl border border-gray-200 bg-white p-6 transition hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-900/5 dark:border-gray-800 dark:bg-gray-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                            <x-heroicon-o-document-text class="h-6 w-6" />

                        </div>

                        <h3 class="mt-6 text-lg font-extrabold">
                            Jurnal Guru
                        </h3>

                        <p
                            class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">

                            Catat kegiatan pembelajaran dengan rapi
                            dan dokumentasikan aktivitas mengajar Anda.

                        </p>

                    </div>


                    {{-- FEATURE --}}
                    <div
                        class="rounded-3xl border border-gray-200 bg-white p-6 transition hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-900/5 dark:border-gray-800 dark:bg-gray-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                            <x-heroicon-o-clipboard-document-check class="h-6 w-6" />

                        </div>

                        <h3 class="mt-6 text-lg font-extrabold">
                            Presensi Siswa
                        </h3>

                        <p
                            class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">

                            Catat kehadiran siswa secara teratur
                            dan mudah dipantau.

                        </p>

                    </div>


                    {{-- FEATURE --}}
                    <div
                        class="rounded-3xl border border-gray-200 bg-white p-6 transition hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-900/5 dark:border-gray-800 dark:bg-gray-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                            <x-heroicon-o-chart-bar class="h-6 w-6" />

                        </div>

                        <h3 class="mt-6 text-lg font-extrabold">
                            Penilaian
                        </h3>

                        <p
                            class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">

                            Kelola nilai siswa dengan data yang
                            lebih terstruktur dan mudah dikelola.

                        </p>

                    </div>


                    {{-- FEATURE --}}
                    <div
                        class="rounded-3xl border border-gray-200 bg-white p-6 transition hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-900/5 dark:border-gray-800 dark:bg-gray-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                            <x-heroicon-o-calendar-days class="h-6 w-6" />

                        </div>

                        <h3 class="mt-6 text-lg font-extrabold">
                            Jadwal Mengajar
                        </h3>

                        <p
                            class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">

                            Ketahui jadwal, kelas, dan aktivitas
                            mengajar dalam satu tampilan.

                        </p>

                    </div>


                    {{-- FEATURE --}}
                    <div
                        class="rounded-3xl border border-gray-200 bg-white p-6 transition hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-900/5 dark:border-gray-800 dark:bg-gray-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                            <x-heroicon-o-users class="h-6 w-6" />

                        </div>

                        <h3 class="mt-6 text-lg font-extrabold">
                            Kelas & Siswa
                        </h3>

                        <p
                            class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">

                            Kelola data kelas dan siswa sebagai
                            bagian dari aktivitas pembelajaran.

                        </p>

                    </div>


                    {{-- FEATURE --}}
                    <div
                        class="rounded-3xl border border-gray-200 bg-white p-6 transition hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-900/5 dark:border-gray-800 dark:bg-gray-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                            <x-heroicon-o-presentation-chart-line class="h-6 w-6" />

                        </div>

                        <h3 class="mt-6 text-lg font-extrabold">
                            Rekap & Data
                        </h3>

                        <p
                            class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">

                            Data aktivitas mengajar tersimpan
                            lebih terstruktur dan mudah digunakan.

                        </p>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
            WORKFLOW
        ====================================================== --}}
        <section
            id="cara-kerja"
            class="overflow-hidden bg-gray-50 py-24 dark:bg-gray-900/50 sm:py-32">

            <div
                class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

                <div
                    class="grid items-center gap-14 lg:grid-cols-2 lg:gap-20">


                    {{-- TEXT --}}
                    <div>

                        <p
                            class="text-xs font-black uppercase tracking-[0.2em] text-primary-600 dark:text-primary-400">
                            Cara kerja
                        </p>

                        <h2
                            class="mt-3 text-3xl font-black tracking-tight sm:text-4xl">

                            Mengikuti aktivitas guru
                            <span class="text-primary-600 dark:text-primary-400">
                                sehari-hari.
                            </span>

                        </h2>

                        <p
                            class="mt-5 text-sm leading-7 text-gray-600 sm:text-base dark:text-gray-400">

                            GuruPro dirancang agar terasa natural.
                            Guru tidak perlu mempelajari sistem yang rumit
                            untuk mulai menggunakannya.

                        </p>


                        <div class="mt-8 space-y-6">


                            {{-- STEP --}}
                            <div class="flex gap-4">

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-primary-600 text-xs font-black text-white">
                                    01
                                </div>

                                <div>

                                    <h3 class="font-bold">
                                        Lihat jadwal
                                    </h3>

                                    <p
                                        class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">

                                        Ketahui kelas dan aktivitas
                                        mengajar yang perlu dilakukan.

                                    </p>

                                </div>

                            </div>


                            {{-- STEP --}}
                            <div class="flex gap-4">

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-primary-600 text-xs font-black text-white">
                                    02
                                </div>

                                <div>

                                    <h3 class="font-bold">
                                        Presensi & jurnal
                                    </h3>

                                    <p
                                        class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">

                                        Dokumentasikan kehadiran siswa
                                        dan kegiatan pembelajaran.

                                    </p>

                                </div>

                            </div>


                            {{-- STEP --}}
                            <div class="flex gap-4">

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-primary-600 text-xs font-black text-white">
                                    03
                                </div>

                                <div>

                                    <h3 class="font-bold">
                                        Kelola penilaian
                                    </h3>

                                    <p
                                        class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">

                                        Simpan dan kelola hasil belajar
                                        siswa secara terstruktur.

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- VISUAL --}}
                    <div class="relative">

                        <div
                            class="absolute -inset-10 rounded-full bg-primary-500/10 blur-3xl">
                        </div>


                        <div
                            class="relative rounded-[32px] border border-gray-200 bg-white p-5 shadow-2xl dark:border-gray-800 dark:bg-gray-900 sm:p-7">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p
                                        class="text-[10px] font-bold uppercase tracking-widest text-gray-400">
                                        Aktivitas Hari Ini
                                    </p>

                                    <p class="mt-1 text-xl font-black">
                                        Senin, 7 September
                                    </p>

                                </div>

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                                    <x-heroicon-o-calendar-days class="h-5 w-5" />

                                </div>

                            </div>


                            <div class="mt-7 space-y-3">


                                {{-- ITEM --}}
                                <div
                                    class="flex items-center gap-4 rounded-2xl border border-gray-100 p-4 dark:border-gray-800">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                                        <x-heroicon-o-calendar-days class="h-5 w-5" />

                                    </div>

                                    <div class="flex-1">

                                        <p class="text-xs font-bold">
                                            Jadwal
                                        </p>

                                        <p class="mt-1 text-[11px] text-gray-500">
                                            Informatika • VIII A
                                        </p>

                                    </div>

                                    <span
                                        class="text-[10px] font-bold text-primary-600">
                                        07:30
                                    </span>

                                </div>


                                {{-- ITEM --}}
                                <div
                                    class="flex items-center gap-4 rounded-2xl border border-gray-100 p-4 dark:border-gray-800">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                                        <x-heroicon-o-clipboard-document-check
                                            class="h-5 w-5" />

                                    </div>

                                    <div class="flex-1">

                                        <p class="text-xs font-bold">
                                            Presensi
                                        </p>

                                        <p class="mt-1 text-[11px] text-gray-500">
                                            VIII A • 28 siswa
                                        </p>

                                    </div>

                                    <span
                                        class="text-[10px] font-bold text-primary-600">
                                        Selesai
                                    </span>

                                </div>


                                {{-- ITEM --}}
                                <div
                                    class="flex items-center gap-4 rounded-2xl border border-gray-100 p-4 dark:border-gray-800">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                                        <x-heroicon-o-document-text
                                            class="h-5 w-5" />

                                    </div>

                                    <div class="flex-1">

                                        <p class="text-xs font-bold">
                                            Jurnal Guru
                                        </p>

                                        <p class="mt-1 text-[11px] text-gray-500">
                                            Materi pembelajaran
                                        </p>

                                    </div>

                                    <span
                                        class="text-[10px] font-bold text-primary-600">
                                        Tersimpan
                                    </span>

                                </div>


                                {{-- ITEM --}}
                                <div
                                    class="flex items-center gap-4 rounded-2xl border border-gray-100 p-4 dark:border-gray-800">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                                        <x-heroicon-o-chart-bar class="h-5 w-5" />

                                    </div>

                                    <div class="flex-1">

                                        <p class="text-xs font-bold">
                                            Penilaian
                                        </p>

                                        <p class="mt-1 text-[11px] text-gray-500">
                                            Tugas Informatika
                                        </p>

                                    </div>

                                    <span
                                        class="text-[10px] font-bold text-primary-600">
                                        Terbaru
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
            BENEFITS
        ====================================================== --}}
        <section
            id="keunggulan"
            class="py-24 sm:py-32">

            <div
                class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

                <div
                    class="grid gap-14 lg:grid-cols-2 lg:items-center">


                    {{-- TEXT --}}
                    <div>

                        <p
                            class="text-xs font-black uppercase tracking-[0.2em] text-primary-600 dark:text-primary-400">
                            Kenapa GuruPro?
                        </p>

                        <h2
                            class="mt-3 text-3xl font-black tracking-tight sm:text-4xl">

                            Bukan menambah pekerjaan.
                            <span class="text-primary-600 dark:text-primary-400">
                                Justru menyederhanakannya.
                            </span>

                        </h2>

                        <p
                            class="mt-5 max-w-xl text-sm leading-7 text-gray-600 sm:text-base dark:text-gray-400">

                            Guru memiliki banyak hal yang harus dikelola setiap hari.
                            GuruPro hadir untuk membuat administrasi tersebut
                            lebih sederhana, teratur, dan mudah diakses.

                        </p>

                    </div>


                    {{-- BENEFITS --}}
                    <div class="grid gap-4 sm:grid-cols-2">


                        <div
                            class="rounded-3xl border border-gray-200 p-6 dark:border-gray-800">

                            <x-heroicon-o-clock
                                class="h-6 w-6 text-primary-600 dark:text-primary-400" />

                            <h3 class="mt-5 font-extrabold">
                                Hemat waktu
                            </h3>

                            <p
                                class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">

                                Kurangi pekerjaan administratif
                                yang berulang.

                            </p>

                        </div>


                        <div
                            class="rounded-3xl border border-gray-200 p-6 dark:border-gray-800">

                            <x-heroicon-o-folder-open
                                class="h-6 w-6 text-primary-600 dark:text-primary-400" />

                            <h3 class="mt-5 font-extrabold">
                                Data terorganisir
                            </h3>

                            <p
                                class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">

                                Aktivitas mengajar tersimpan
                                dalam satu sistem.

                            </p>

                        </div>


                        <div
                            class="rounded-3xl border border-gray-200 p-6 dark:border-gray-800">

                            <x-heroicon-o-device-phone-mobile
                                class="h-6 w-6 text-primary-600 dark:text-primary-400" />

                            <h3 class="mt-5 font-extrabold">
                                Fleksibel
                            </h3>

                            <p
                                class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">

                                Gunakan melalui perangkat
                                yang biasa Anda gunakan.

                            </p>

                        </div>


                        <div
                            class="rounded-3xl border border-gray-200 p-6 dark:border-gray-800">

                            <x-heroicon-o-sparkles
                                class="h-6 w-6 text-primary-600 dark:text-primary-400" />

                            <h3 class="mt-5 font-extrabold">
                                Sederhana
                            </h3>

                            <p
                                class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">

                                Dibuat dengan pengalaman guru
                                sebagai prioritas.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
            CTA
        ====================================================== --}}
        <section
            id="mulai"
            class="pb-24 sm:pb-32">

            <div
                class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

                <div
                    class="relative overflow-hidden rounded-[32px] bg-primary-600 px-6 py-16 text-center shadow-2xl shadow-primary-600/20 sm:px-12">

                    {{-- DECORATION --}}
                    <div
                        class="pointer-events-none absolute -right-20 -top-32 h-80 w-80 rounded-full bg-white/10 blur-3xl">
                    </div>

                    <div
                        class="pointer-events-none absolute -bottom-32 -left-20 h-80 w-80 rounded-full bg-white/10 blur-3xl">
                    </div>


                    <div class="relative mx-auto max-w-2xl">

                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-white ring-1 ring-white/20">

                            <x-heroicon-s-academic-cap class="h-7 w-7" />

                        </div>


                        <h2
                            class="mt-6 text-3xl font-black tracking-tight text-white sm:text-4xl">

                            Siap mengajar dengan lebih teratur?

                        </h2>


                        <p
                            class="mx-auto mt-4 max-w-xl text-sm leading-7 text-primary-100 sm:text-base">

                            Mulai kelola aktivitas mengajar Anda dengan GuruPro.
                            Sederhana untuk digunakan, dirancang untuk kebutuhan guru.

                        </p>


                        <a
                            href="{{ url('/admin/login') }}"
                            class="mt-8 inline-flex items-center gap-2 rounded-2xl bg-white px-6 py-3.5 text-sm font-black text-primary-700 shadow-xl transition hover:-translate-y-0.5 hover:bg-gray-50">

                            Masuk ke GuruPro

                            <x-heroicon-m-arrow-right class="h-4 w-4" />

                        </a>

                    </div>

                </div>

            </div>

        </section>

    </main>


    {{-- =========================================================
        FOOTER
    ========================================================== --}}
    <footer class="border-t border-gray-200 dark:border-gray-800">

        <div
            class="mx-auto flex max-w-7xl flex-col gap-5 px-5 py-8 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">


            {{-- BRAND --}}
            <div class="flex items-center gap-2.5">

                <div
                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-600 text-white">

                    <x-heroicon-s-academic-cap class="h-4 w-4" />

                </div>

                <div>

                    <p class="text-sm font-extrabold">
                        Guru<span class="text-primary-600 dark:text-primary-400">
                            Pro
                        </span>
                    </p>

                    <p class="text-[11px] text-gray-500">
                        Platform digital untuk guru
                    </p>

                </div>

            </div>


            {{-- COPYRIGHT --}}
            <p class="text-xs text-gray-500">
                © {{ date('Y') }} GuruPro. Dibuat untuk membantu guru.
            </p>

        </div>

    </footer>


</body>
</html>