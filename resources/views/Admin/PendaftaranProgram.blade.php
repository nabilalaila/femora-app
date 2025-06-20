@extends('components.layout.app')

@section('content')
    <div class="mx-6 mt-10">
        <div class="border-b border-gray-200">
            <nav class="flex space-x-8" aria-label="Tabs">
                <button id="tab-belum"
                    class="tab-button border-b-2 border-pink-500 text-pink-600 font-medium text-sm py-4 px-1">
                    Belum Dikonfirmasi
                </button>
                <button id="tab-riwayat"
                    class="tab-button border-b-2 border-transparent text-gray-500 font-medium text-sm py-4 px-1 hover:text-gray-700 hover:border-gray-300">
                    Riwayat
                </button>
            </nav>
        </div>

        <div id="section-belum" class="mt-6">
            @include('Admin.DaftarBelumKonfirm', ['belumDikonfirmasi' => $belumDikonfirmasi])
        </div>

        <div id="section-riwayat" class="mt-6 hidden">
            @include('Admin.RiwayatDaftar', ['riwayat' => $riwayat])
        </div>
    </div>

    <x-modal name="ModalLihatDetail" focusable>
        <div class="p-6">
            <h2 class="text-lg font-semibold mb-4">Detail Pendaftaran</h2>

            <div class="space-y-2 text-sm">
                <p><strong>User ID:</strong> <span id="riwayat_user_id" class="font-medium"></span></p>
                <p><strong>Nama Program:</strong> <span id="riwayat_nama_program" class="font-medium"></span></p>
                <p><strong>Tanggal Daftar:</strong> <span id="riwayat_tanggal_daftar" class="font-medium"></span></p>
                <p><strong>Status Pembayaran:</strong> <span id="riwayat_status" class="font-medium"></span></p>
                <div id="riwayat_bukti_pembayaran" class="mt-2"></div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-4 py-2">
                    Tutup
                </x-secondary-button>
            </div>
        </div>
    </x-modal>

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
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabBelum = document.getElementById('tab-belum');
            const tabRiwayat = document.getElementById('tab-riwayat');
            const sectionBelum = document.getElementById('section-belum');
            const sectionRiwayat = document.getElementById('section-riwayat');

            function activateTab(activeTab, inactiveTab, showSection, hideSection) {
                activeTab.classList.add('border-pink-500', 'text-pink-600');
                activeTab.classList.remove('border-transparent', 'text-gray-500');

                inactiveTab.classList.remove('border-pink-500', 'text-pink-600');
                inactiveTab.classList.add('border-transparent', 'text-gray-500');

                showSection.classList.remove('hidden');
                hideSection.classList.add('hidden');
            }

            tabBelum.addEventListener('click', () => {
                activateTab(tabBelum, tabRiwayat, sectionBelum, sectionRiwayat);
            });

            tabRiwayat.addEventListener('click', () => {
                activateTab(tabRiwayat, tabBelum, sectionRiwayat, sectionBelum);
            });
        });

        function lihatDetailRiwayat(data) {
            document.getElementById('riwayat_user_id').innerText = data.role ?? '-';
            document.getElementById('riwayat_nama_program').innerText = data.program?.nama_program ?? '-';
            document.getElementById('riwayat_tanggal_daftar').innerText = new Date(data.created_at).toLocaleDateString(
                'id-ID');
            document.getElementById('riwayat_status').innerText = data.status_pembayaran ?? '-';

            const bukti = data.bukti_pembayaran ?
                `<img src="/storage/${data.bukti_pembayaran}" alt="Bukti Pembayaran" class="max-w-full h-48 object-contain border rounded">` :
                '<em class="text-gray-500">Tidak ada bukti</em>';

            document.getElementById('riwayat_bukti_pembayaran').innerHTML = bukti;

            window.dispatchEvent(new CustomEvent('open-modal', {
                detail: 'ModalLihatDetail'
            }));
        }


        function lihatDetail(data) {

            document.getElementById('modal_pendaftaran_id').value = data.id;
            document.getElementById('modal_user_id').innerText = data.role ?? '-';
            document.getElementById('modal_nama_program').innerText = data.program.nama_program ?? '-';
            document.getElementById('modal_tanggal_daftar').innerText = new Date(data.created_at).toLocaleDateString(
                'id-ID');

            const bukti = data.bukti_pembayaran ?
                `<img src="/storage/${data.bukti_pembayaran}" alt="Bukti Pembayaran" class="max-w-full h-48 object-contain border rounded">` :
                '<em class="text-gray-500">Tidak ada bukti</em>';

            document.getElementById('modal_bukti_pembayaran').innerHTML = bukti;

            document.getElementById('formPersetujuan').action = '{{ route('pendaftaran.update') }}';

            window.dispatchEvent(new CustomEvent('open-modal', {
                detail: 'ModalSetujui'
            }));
        }
    </script>
@endsection
