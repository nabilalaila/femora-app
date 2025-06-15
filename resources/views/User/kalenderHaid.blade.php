@extends('components.layout.app')

@section('content')
    <div class="text-center mt-10 text-2xl font-semibold">
        Kalender Haid
    </div>
    <div class="bg-[#F9E8EE] flex flex-col m-10 p-10 rounded-2xl">
        <div class="text-center">
            <h2 class="text-lg font-semibold"> </h2>
            <p class="p-10 text-sm">
                Silahkan catat apabila ada darah atau cairan yang keluar. Catat dengan informasi yang valid dengan cara klik
                tanggal yang diinginkan
            </p>
        </div>
        <div class="bg-white py-12 px-12 shadow w-full font-poppins rounded-2xl">
            <div class="flex flex-row justify-between mb-4">
                <h2 id="monthYear" class="text-xl font-semibold"></h2>
                <div class="flex items-center gap-8">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8"
                        id="prevMonth">
                        <path fill-rule="evenodd"
                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-4.28 9.22a.75.75 0 0 0 0 1.06l3 3a.75.75 0 1 0 1.06-1.06l-1.72-1.72h5.69a.75.75 0 0 0 0-1.5h-5.69l1.72-1.72a.75.75 0 0 0-1.06-1.06l-3 3Z"
                            clip-rule="evenodd" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8"
                        id="nextMonth">
                        <path fill-rule="evenodd"
                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm4.28 10.28a.75.75 0 0 0 0-1.06l-3-3a.75.75 0 1 0-1.06 1.06l1.72 1.72H8.25a.75.75 0 0 0 0 1.5h5.69l-1.72 1.72a.75.75 0 1 0 1.06 1.06l3-3Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="grid grid-cols-7 gap-[5px] text-center font-semibold text-gray-700 mb-2">
                <div>Min</div>
                <div>Sen</div>
                <div>Sel</div>
                <div>Rab</div>
                <div>Kam</div>
                <div>Jum</div>
                <div>Sab</div>
            </div>
            <div id="calendarGrid" class="grid grid-cols-7 text-gray-800 min-h-[400px] place-items-center"></div>

            <div class="ml-5">
                <p class="mb-5 font-semibold text-left">Notes:</p>
                <div class="flex flex-row gap-[10px]">
                    <div class="flex items-center gap-x-2">
                        <svg width="40" height="40">
                            <circle r="15" cx="20" cy="20" fill="white" fill-opacity="1" stroke="#d96e94"
                                stroke-width="2" stroke-dasharray="5" />
                        </svg>
                        <p class="text-sm">Haid</p>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <svg width="40" height="40">
                            <circle r="15" cx="20" cy="20" fill="white" fill-opacity="1" stroke="#4DA8DA"
                                stroke-width="2" stroke-dasharray="5" />
                        </svg>
                        <p class="text-sm">Istihadhah</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="RecordModal" maxWidth="md">
        <div class="bg-white p-6 rounded-xl shadow-lg w-full relative">
            <h2 id="modalTitle" class="text-xl font-semibold mb-4">Catat Period</h2>
            <form id="recordForm" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="date" id="recordDateModal">
                <input type="hidden" name="record_id" id="recordId">
                <input type="hidden" name="period_id" id="periodIdField">
                <input type="hidden" name="waktu_keluar" id="recordWaktuKeluarModal">

                <p class="text-sm text-gray-600">
                    Tanggal dipilih: <span id="selectedDateDisplay" class="font-medium text-gray-900"></span>
                </p>

                <div>
                    <label for="waktu_keluar" class="block">Waktu Keluar (Jam)</label>
                    <input type="time" name="waktu_keluar" id="waktu_keluar" required
                        class="mt-2 w-full p-2 border rounded" step="60">
                </div>

                <div>
                    <input type="hidden" name="is_fullday" value="0">
                    <label for="is_fullday" class="block">Apakah keluar dalam sehari penuh? <br>(Centang jika iya)</label>
                    <input type="checkbox" name="is_fullday" id="is_fullday" value="1" class="mt-2">
                </div>

                <div>
                    <label for="warna" class="block">Warna Cairan</label>
                    <select name="warna" id="warna" required class="mt-2 p-2 border rounded w-full">
                        <option value="" disabled>Pilih warna</option>
                        <option value="merah tua">Merah Tua</option>
                        <option value="coklat">Coklat</option>
                        <option value="hitam">Hitam</option>
                        <option value="merah terang">Merah Terang</option>
                        <option value="pink">Pink</option>
                        <option value="oranye">Oranye</option>
                        <option value="abu-abu">Abu-Abu</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <button type="button" id="deleteBtn"
                        class="hidden px-4 py-2 bg-white  text-black rounded-lg hover:bg-gray-100 border border-black">
                        Hapus
                    </button>
                    <button type="submit" id="submitBtn"
                        class="px-4 py-2 bg-[#e9abc1] text-white rounded-lg hover:bg-[#c58299]">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
@endsection

@section('scripts')
    <meta name="route-store" content="{{ route('kalender.store') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        const periodDates = @json($periodDates);
    </script>

@endsection
