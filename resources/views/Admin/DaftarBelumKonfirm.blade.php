    <table class="min-w-full text-center bg-white rounded-lg overflow-hidden mt-10">
        <thead class="bg-white text-gray-700 text-md border-b">
            <tr>
                <th class="px-6 py-3">User Id</th>
                <th class="px-6 py-3">Tanggal Pendaftaran</th>
                <th class="px-6 py-3">Nama Program</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm text-gray-700">
            @forelse ($belumDikonfirmasi as $item)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-6 py-4">{{ $item->role }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                    <td class="px-6 py-4">{{ $item->program->nama_program }}</td>
                    <td class="px-6 py-4">
                        @php
                            $status = strtolower($item->status_pembayaran);
                        @endphp

                        @if ($status === 'sudah dikonfirmasi' || $status === 'disetujui' || $status === 'diterima')
                            <span class="px-3 py-1 rounded-full text-white bg-green-500 text-xs">
                                {{ $item->status_pembayaran }}
                            </span>
                        @elseif ($status === 'belum dikonfirmasi' || $status === 'menunggu')
                            <span class="px-3 py-1 rounded-full text-white bg-yellow-400 text-xs">
                                {{ $item->status_pembayaran }}
                            </span>
                        @elseif ($status === 'ditolak')
                            <span class="px-3 py-1 rounded-full text-white bg-red-500 text-xs">
                                {{ $item->status_pembayaran }}
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-white bg-gray-400 text-xs">
                                {{ $item->status_pembayaran }}
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <button onclick='lihatDetail(@json($item))'
                            class="bg-[#e9abc1] hover:bg-[#d594ab] text-white text-xs px-3 py-1 rounded-xl ">
                            Setujui
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-gray-500">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <x-modal name="ModalSetujui" id="modalSetujui">
        <h2 class="text-lg font-semibold text-center mb-4">Detail Pendaftaran</h2>
        <form id="formPersetujuan" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-3 text-sm text-gray-700">
                <input type="hidden" id="form_action_url" value="{{ route('pendaftaran.update') }}">
                <input type="hidden" name="id" id="modal_pendaftaran_id">
                <div>
                    <label class="font-medium">User ID:</label>
                    <div id="modal_user_id"></div>
                </div>
                <div>
                    <label class="font-medium">Nama Program:</label>
                    <div id="modal_nama_program"></div>
                </div>
                <div>
                    <label class="font-medium">Tanggal Daftar:</label>
                    <div id="modal_tanggal_daftar"></div>
                </div>
                <div>
                    <label class="font-medium">Bukti Pembayaran</label>
                    <div id="modal_bukti_pembayaran"></div>
                </div>
            </div>


            <div class="flex justify-end gap-2 mt-6">
                <button type="submit" name="action" value="setujui"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    Setujui
                </button>
                <button type="submit" name="action" value="tolak"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Tolak
                </button>
            </div>
        </form>
    </x-modal>
