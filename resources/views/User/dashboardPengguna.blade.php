@extends('components.layout.app')

@section('content')
    <x-modal name="istiqrarModal" maxWidth="md">
        <div class="relative p-6">
            <h2 class="text-xl font-semibold mb-4">Catatan Haid</h2>
            <p class="text-sm mb-3">Untuk menunjang prediksi yang lebih maksimal, kami membutuhkan data mengenai siklus
                haidmu.</p>
            <form action="{{ route('istiqrar.store') }}" method="POST" class="space-y-4 mt-5">
                @csrf
                <div>
                    <label class="block text-gray-700 mb-2">Tanggal mulai haid:</label>
                    <input type="date" name="tanggal_mulai" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Rata-rata lama haid (hari):</label>
                    <input type="number" name="durasi" min="1" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Jarak antar haid (siklus):</label>
                    <input type="number" name="siklus" min="1" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="flex justify-end gap-3 mt-4">
                    <input type="hidden" name="lupa" id="lupaField" value="false">
                    <button type="button" onclick="submitAsLupa()"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                        Saya Lupa
                    </button>
                    <button type="submit" class="px-4 py-2 bg-[#e9abc1] text-white rounded-lg hover:bg-[#c58299]">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

    <div>
        @if (Auth::user()->is_mustaqirrah == 'belum isi')
            <div class="mt-20 lg:mt-5 text-center bg-[#e9abc1] mx-10 py-3">
                Kamu belum mencatat siklus haidmu, <a href="#"
                    onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'istiqrarModal' }))"><strong
                        class="underline">Catat
                        sekarang!</strong></a>
            </div>
        @endif
        <div class="ml-100">
            <div class="mt-10 lg:mt-5">
                <div class="mx-10 py-10 bg-[#F9E8EE] rounded-xl text-center text-xl">
                    <strong>Hai, {{ Auth::user()->name }}!</strong>
                    <p class="text-base mt-2 px-32 leading-relaxed">
                        Selamat datang di <strong>Femora</strong> 🌸
                    </p>
                </div>
            </div>
            <div class="mt-10 mx-10 flex flex-col bg-[#F9E8EE] rounded-xl px-10 py-10">
                <div class="flex flex-row justify-between w-full py-2">
                    <h3 class="text-xl"><strong>Status Periode Hari Ini</strong></h3>
                    <p id="tanggal-sekarang" class="text-base"></p>
                </div>
                <div class="mt-5 mb-10"> {{-- tambahin perkondisian kalau belum isi dan sudah isi hari ini  --}}
                    <p class="text-gray-600 text-base">❗Hari ini kamu belum mencatat data haid❗</p>
                </div>
                <div class="flex flex-col md:items-center justify-center md:flex-row gap-16 items-stretch">
                    <div>
                        <div class="bg-white pt-12 px-12 shadow max-w-md w-full font-poppins rounded-2xl">
                            <div class="flex flex-row justify-between">
                                <h2 id="monthYear" class="text-xl font-semibold"></h2>
                                <div class="flex items-center gap-4 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-8" id="prevMonth">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-4.28 9.22a.75.75 0 0 0 0 1.06l3 3a.75.75 0 1 0 1.06-1.06l-1.72-1.72h5.69a.75.75 0 0 0 0-1.5h-5.69l1.72-1.72a.75.75 0 0 0-1.06-1.06l-3 3Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-8" id="nextMonth">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm4.28 10.28a.75.75 0 0 0 0-1.06l-3-3a.75.75 0 1 0-1.06 1.06l1.72 1.72H8.25a.75.75 0 0 0 0 1.5h5.69l-1.72 1.72a.75.75 0 1 0 1.06 1.06l3-3Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="grid grid-cols-7 gap-2 text-center font-semibold text-gray-700 mb-2">
                                <div>Min</div>
                                <div>Sen</div>
                                <div>Sel</div>
                                <div>Rab</div>
                                <div>Kam</div>
                                <div>Jum</div>
                                <div>Sab</div>
                            </div>
                            <div id="calendarGrid" class="grid grid-cols-7 gap-2 text-center text-gray-800"></div>
                        </div>
                    </div>

                    <div
                        class="bg-white py-8 px-10 shadow max-w-md w-full font-poppins rounded-2xl flex flex-col items-center justify-center text-center h-[25rem]">
                        <h3 class="text-base font-semibold mb-4">Gejala Anda Hari Ini</h3>
                        <a href="{{ route('kalender.index') }}"
                            class="text-sm text-gray-500 flex flex-col items-center justify-center gap-4 border border-gray-300 rounded-xl p-6 w-full h-full">
                            Yuk mulai catat siklusmu
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="size-8">
                                <path fill-rule="evenodd"
                                    d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        const periodDates = @json($periodDates ?? []);

        function openModal() {
            const modal = document.getElementById('istiqrarModal');
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('istiqrarModal');
            modal.classList.add('hidden');
        }
        window.addEventListener('load', function() {
            @if (!Auth::user()->is_mustaqirrah)
                openModal();
            @endif
        });
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('istiqrarModal');
            if (event.target === modal) {
                closeModal();
            }
        });

        function submitAsLupa() {
            document.getElementById('lupaField').value = 'true';
            document.querySelector('#istiqrarModal form').submit();
        }

        function closeModal() {
            document.getElementById('istiqrarModal').classList.add('hidden');
        }
    </script>
@endsection
