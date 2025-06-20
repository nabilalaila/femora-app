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

