@extends('components.layout.app')

@section('content')
    <h1 class="text-center text-2xl font-semibold py-7">
        Daftar Program
    </h1>
    <div class="flex justify-center mt-10 px-10">
        <div class="grid grid-cols-1 justify-center md:grid-cols-2 lg:grid-cols-4 md:justify-center gap-6 ">
            @foreach ($programs as $program)
                <div
                    class="max-w-sm bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img class="w-full h-48 object-cover" src="{{ $program->foto_header }}" alt="{{ $program->nama_program }}">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $program->nama_program }}</h2>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ \Illuminate\Support\Str::limit($program->deskripsi_program, 80) }}</p>
                        <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                            <span><strong>Tanggal:</strong>
                                {{ \Carbon\Carbon::parse($program->tanggal_pelaksanaan)->format('d M Y') }}</span>
                            <span class="text-xs px-2 py-1 bg-pink-100 text-black rounded-full">
                                {{ $program->is_online ? 'Online' : 'Offline' }}
                            </span>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-lg font-bold text-[#e9abc1]">
                                {{ $program->harga_display }}
                            </span>
                            <div class="flex flex-row">
                                <a href="javascript:void(0)"
                                    class="text-sm text-white bg-[#e9abc1] hover:bg-[#c58299] px-5 py-2 rounded-full flex gap-2"
                                    data-program='@json($program)' onclick="bukaDetailProgram(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    Lihat
                                </a>
                                {{-- <a href="javascript:void(0)"
                                    class="text-sm text-white bg-[#e9abc1] hover:bg-[#c58299] px-5 py-2 rounded-full flex gap-2"
                                    data-program='@json($program)' onclick="bukaModalDaftar(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    Daftar
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <x-modal name="ModalDetailProgram" id="modalDetailProgram" maxWidth="md" maxHeight="lg">
        <h2 class="text-xl font-semibold mb-4 text-center text-[#e9abc1]">Detail Program</h2>

        <div class="mb-4">
            <img id="foto_program" class="w-full h-48 object-cover rounded-lg" src="" alt="Foto Program">
        </div>

        <div class="mb-3 flex flex-col gap-3">
            <label class="block font-medium">Nama</label>
            <input type="text" id="nama_program" class="w-full border rounded p-2" disabled>
        </div>

        <div class="mb-3 flex flex-col gap-3">
            <label class="block font-medium">Tanggal Pelaksanaan</label>
            <input type="text" id="tanggal_program" class="w-full border rounded p-2" disabled>
        </div>

        <div class="mb-3 flex flex-col gap-3">
            <label class="block font-medium">Tanggal Buka</label>
            <input type="text" id="tanggal_buka" class="w-full border rounded p-2" disabled>
        </div>

        <div class="mb-3 flex flex-col gap-3">
            <label class="block font-medium">Tanggal Tutup</label>
            <input type="text" id="tanggal_tutup" class="w-full border rounded p-2" disabled>
        </div>

        <div class="mb-3 flex flex-col gap-3">
            <label class="block font-medium">Biaya Pendaftaran</label>
            <input type="text" id="harga_program" class="w-full border rounded p-2" disabled>
        </div>

        <div class="mb-3 flex flex-col gap-3">
            <label class="block font-medium">Informasi Lengkap</label>
            <textarea id="deskripsi_program" class="w-full border rounded p-2" disabled></textarea>
        </div>

        <div class="text-center">
            <button id="btnBukaModalDaftar" class="w-full bg-[#e9abc1] hover:bg-[#c58299] text-white py-2 px-4 rounded">
                Daftar
            </button>
        </div>
    </x-modal>

    <x-modal name="ModalUploadBukti" id="modalUploadBukti" maxWidth="md">
        <h2 class="text-xl font-semibold mb-4 text-center text-[#e9abc1]">Upload Bukti Pembayaran</h2>
        <form action="{{ route('pengguna.program.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="program_id" id="program_id_hidden">

            <div class="mb-4 flex flex-col gap-3">
                <label class="block text-sm font-medium">Upload Bukti (jpg/png/pdf)</label>
                <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf"
                    class="w-full border border-gray-500 rounded p-2" required>
                <p class="text-xs"><strong>Transfer ke Nomor Rekening 2245456465315 (BCA)</strong> <br>Bukti transfer akan dikonfirmasi oleh admin sebelum anda benar benar terdaftar. Pastikan
                    anda mengirimkan bukti yang akurat</p>
            </div>

            <button type="submit" class="w-full bg-[#e9abc1] hover:bg-[#c58299] text-white py-2 rounded-md transition">
                Konfirmasi Pendaftaran
            </button>
        </form>
    </x-modal>
@endsection

@section('scripts')
    <script>
        let currentProgramId = null;

        function bukaDetailProgram(el) {
            const data = JSON.parse(el.getAttribute('data-program'));

            currentProgramId = data.id;

            document.getElementById('nama_program').value = data.nama_program;
            document.getElementById('tanggal_program').value = formatTanggal(data.tanggal_pelaksanaan);
            document.getElementById('tanggal_buka').value = formatTanggal(data.tanggal_buka_pendaftaran);
            document.getElementById('tanggal_tutup').value = formatTanggal(data.tanggal_tutup_pendaftaran);
            document.getElementById('harga_program').value = data.harga_display;
            document.getElementById('deskripsi_program').value = data.deskripsi_program;
            document.getElementById('foto_program').src = data.foto_header;

            window.dispatchEvent(new CustomEvent('open-modal', {
                detail: 'ModalDetailProgram'
            }));
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('btnBukaModalDaftar').addEventListener('click', function() {
                document.getElementById('program_id_hidden').value = currentProgramId;
                window.dispatchEvent(new CustomEvent('close-modal', {
                    detail: 'ModalDetailProgram'
                }));
                window.dispatchEvent(new CustomEvent('open-modal', {
                    detail: 'ModalUploadBukti'
                }));
            });
        });

        function formatTanggal(tgl) {
            const tanggal = new Date(tgl);
            return tanggal.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }
    </script>
@endsection
