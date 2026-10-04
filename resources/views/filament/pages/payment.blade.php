<x-filament-panels::page>

    @if ($subscription)

        <div class="w-full space-y-6">

            {{-- HEADER --}}
            <div
                class="relative overflow-hidden rounded-2xl border border-primary-100 bg-linear-to-br from-primary-50 via-white to-white p-6 shadow-sm dark:border-primary-500/10 dark:from-primary-950/50 dark:via-gray-900 dark:to-gray-900">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">
                            <x-heroicon-o-credit-card class="h-6 w-6" />
                        </div>

                        <div>
                            <h1 class="text-xl font-bold text-gray-950 dark:text-white">
                                Pembayaran Langganan
                            </h1>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Selesaikan pembayaran untuk mengaktifkan langganan GuruPro.
                            </p>
                        </div>

                    </div>

                    <div class="shrink-0">
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700 dark:bg-amber-500/10 dark:text-amber-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                            Menunggu Pembayaran
                        </span>
                    </div>

                </div>
            </div>


            {{-- STATUS --}}
            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 dark:border-amber-500/20 dark:bg-amber-950/20">
                <div class="flex items-start gap-3">

                    <x-heroicon-o-clock class="mt-0.5 h-5 w-5 shrink-0 text-amber-600 dark:text-amber-400" />

                    <div>
                        <p class="font-semibold text-amber-800 dark:text-amber-300">
                            Menunggu Pembayaran
                        </p>

                        <p class="mt-1 text-sm leading-6 text-amber-700 dark:text-amber-400">
                            Silakan transfer sesuai nominal yang tertera di bawah.
                            Setelah transfer, kirimkan bukti pembayaran melalui WhatsApp
                            untuk proses verifikasi.
                        </p>
                    </div>

                </div>
            </div>


            {{-- GRID UTAMA --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                {{-- DETAIL LANGGANAN --}}
                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-white/10 dark:bg-gray-900">

                    <div class="border-b border-gray-100 px-6 py-5 dark:border-white/10">
                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-50 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">
                                <x-heroicon-o-document-text class="h-5 w-5" />
                            </div>

                            <div>
                                <h2 class="font-semibold text-gray-950 dark:text-white">
                                    Detail Langganan
                                </h2>

                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Informasi pesanan Anda
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="space-y-5 px-6 py-6">

                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Paket
                            </span>

                            <span class="font-semibold text-gray-950 dark:text-white">
                                {{ $subscription->package?->name ?? '-' }}
                            </span>
                        </div>


                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Periode
                            </span>

                            <span class="font-semibold text-gray-950 dark:text-white">
                                1 Bulan
                            </span>
                        </div>


                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Status
                            </span>

                            <span
                                class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700 dark:bg-amber-500/10 dark:text-amber-400">
                                Menunggu Pembayaran
                            </span>
                        </div>


                        <div class="border-t border-gray-100 pt-5 dark:border-white/10">

                            <div class="flex items-end justify-between gap-4">

                                <span class="font-semibold text-gray-950 dark:text-white">
                                    Total Pembayaran
                                </span>

                                <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">
                                    Rp {{ number_format($subscription->price, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- REKENING --}}
                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-white/10 dark:bg-gray-900">

                    <div class="border-b border-gray-100 px-6 py-5 dark:border-white/10">
                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-50 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">
                                <x-heroicon-o-building-library class="h-5 w-5" />
                            </div>

                            <div>
                                <h2 class="font-semibold text-gray-950 dark:text-white">
                                    Rekening Pembayaran
                                </h2>

                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Transfer sesuai nominal tagihan
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="px-6 py-6">

                        <div class="rounded-xl bg-gray-50 p-5 dark:bg-white/5">

                            <div>
                                <p class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Bank
                                </p>

                                <p class="mt-1 text-lg font-bold text-gray-950 dark:text-white">
                                    BANK BCA
                                </p>
                            </div>


                            <div class="mt-5">
                                <p class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Nomor Rekening
                                </p>

                                <p class="mt-1 text-2xl font-bold tracking-wider text-gray-950 dark:text-white">
                                    1234567890
                                </p>
                            </div>


                            <div class="mt-5">
                                <p class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Atas Nama
                                </p>

                                <p class="mt-1 font-semibold text-gray-950 dark:text-white">
                                    NAMA PEMILIK REKENING
                                </p>
                            </div>

                        </div>


                        <div
                            class="mt-5 flex items-start gap-3 rounded-xl border border-primary-200 bg-primary-50 p-4 dark:border-primary-500/20 dark:bg-primary-500/10">
                            <x-heroicon-o-information-circle
                                class="mt-0.5 h-5 w-5 shrink-0 text-primary-600 dark:text-primary-400" />

                            <p class="text-sm leading-6 text-primary-800 dark:text-primary-300">
                                Pastikan nomor rekening dan nama penerima sudah benar
                                sebelum melakukan transfer.
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            {{-- KONFIRMASI PEMBAYARAN --}}
            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-white/10 dark:bg-gray-900">

                <div class="p-6">

                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-start gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400">
                                <x-heroicon-o-chat-bubble-left-right class="h-5 w-5" />
                            </div>

                            <div>
                                <h2 class="font-semibold text-gray-950 dark:text-white">
                                    Sudah Melakukan Transfer?
                                </h2>

                                <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500 dark:text-gray-400">
                                    Kirimkan bukti transfer kepada admin melalui WhatsApp
                                    agar pembayaran dapat segera diverifikasi.
                                </p>
                            </div>

                        </div>


                        <a href="{{ $this->getWhatsappUrl() }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-green-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-green-700">
                            <x-heroicon-o-chat-bubble-left-right class="h-5 w-5" />

                            Konfirmasi via WhatsApp
                        </a>

                    </div>

                </div>

            </div>


            {{-- CATATAN --}}
            <div class="text-center">
                <p class="text-xs leading-5 text-gray-400 dark:text-gray-500">
                    Langganan akan aktif setelah pembayaran diverifikasi oleh admin.
                </p>
            </div>

        </div>

    @endif

</x-filament-panels::page>