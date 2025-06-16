@extends('components.layout.app')

@section('content')
    <h1 class="text-2xl font-semibold text-center mt-6 mb-4 py-5">Riwayat Program</h1>

    <div class="overflow-x-auto mx-6">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden text-center">
            <thead class="bg-white text-gray-700 text-md border-b">
                <tr>
                    <th class="px-6 py-3">Tanggal Pendaftaran</th>
                    <th class="px-6 py-3">Nama Program</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @forelse ($riwayat as $item)
                    <tr class="border-b hover:bg-[#F2F2F2] transition">
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                        <td class="px-6 py-4">{{ $item->program->nama_program }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 rounded-full text-white text-xs
                                @if ($item->status_pembayaran == 'sudah dikonfirmasi') bg-[#36AE7C]
                                @elseif ($item->status_pembayaran == 'belum dikonfirmasi') bg-[#F9D923]
                                @else bg-[#EB5353] @endif">
                                {{ $item->status_pembayaran }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center">
                                @php
                                    $detail = [
                                        'program' => [
                                            'nama_program' => $item->program->nama_program,
                                            'tanggal_pelaksanaan' => $item->program->tanggal_pelaksanaan,
                                        ],
                                        'created_at' => $item->created_at,
                                        'status' => $item->status_pembayaran,
                                        'bukti_pembayaran' => $item->bukti_pembayaran,
                                        'info_peserta' => $item->info_peserta,
                                    ];
                                @endphp

                                <button onclick='lihatDetail(@json($detail))'
                                    class="bg-[#e9abc1] hover:bg-[#c58299] text-white text-sm px-4 py-1.5 rounded-full flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    Lihat
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-gray-500">Belum ada pendaftaran program</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-modal name="DetailPendaftaran" id="detailPendaftaranModal" maxHeight="lg">
        <h2 class="text-xl font-semibold text-center mb-4 text-[#e9abc1]">Detail Pendaftaran</h2>

        <div class="space-y-3 text-sm text-gray-700">
            <div>
                <label class="font-medium">Nama Program:</label>
                <div id="modal_nama_program" class="text-base font-semibold"></div>
            </div>
            <div>
                <label class="font-medium">Tanggal Pelaksanaan:</label>
                <div id="modal_tanggal_pelaksanaan"></div>
            </div>
            <div>
                <label class="font-medium">Tanggal Daftar:</label>
                <div id="modal_tanggal_daftar"></div>
            </div>
            <div>
                <label class="font-medium">Status Konfirmasi:</label>
                <div id="modal_status"></div>
            </div>

            <div id="info_peserta_section" style="display: none;">
                <label class="font-medium">Info Peserta:</label>
                <div id="modal_info_peserta" class="text-sm"></div>
            </div>

            <div>
                <label class="font-medium">Bukti Pembayaran:</label>
                <img id="modal_bukti" class="w-full max-w-sm mt-2 rounded shadow" alt="Bukti Pembayaran">
            </div>
        </div>
    </x-modal>
@endsection

@section('scripts')
    <script>
        function lihatDetail(data) {
            document.getElementById('modal_nama_program').innerText = data.program.nama_program;
            document.getElementById('modal_tanggal_pelaksanaan').innerText = new Date(data.program.tanggal_pelaksanaan)
                .toLocaleDateString('id-ID');
            document.getElementById('modal_tanggal_daftar').innerText = new Date(data.created_at).toLocaleDateString(
                'id-ID');
            document.getElementById('modal_status').innerText = data.status;

            const bukti = document.getElementById('modal_bukti');
            if (data.bukti_pembayaran) {
                bukti.src = `/storage/${data.bukti_pembayaran}`;
                bukti.style.display = 'block';
            } else {
                bukti.style.display = 'none';
            }

            const infoPesertaSection = document.getElementById('info_peserta_section');
            const infoPesertaText = document.getElementById('modal_info_peserta');
            if (data.status === 'sudah dikonfirmasi') {
                infoPesertaSection.style.display = 'block';
                infoPesertaText.innerText = data.info_peserta ?? '-';
            } else {
                infoPesertaSection.style.display = 'none';
                infoPesertaText.innerText = '';
            }

            window.dispatchEvent(new CustomEvent('open-modal', {
                detail: 'DetailPendaftaran'
            }));
        }
    </script>
@endsection
