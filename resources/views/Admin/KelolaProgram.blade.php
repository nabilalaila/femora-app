@extends('components.layout.app')

@section('content')
    <h1 class="text-center text-2xl font-semibold py-5">
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
                                @if ($program->harga_program == 0)
                                    Gratis
                                @else
                                    Rp {{ number_format($program->harga_program, 0, ',', '.') }}
                                @endif
                            </span>
                            <div class="flex flex-row">
                                <a href="javascript:void(0)"
                                    class="editProgramBtn text-sm text-white bg-[#e9abc1] hover:bg-[#c58299] px-5 py-2 rounded-full flex gap-2"
                                    data-program='@json($program)'>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <a href="javascript:void(0)" id="tambahProgramBtn"
        class="fixed bottom-6 right-6 bg-[#e9abc1] hover:bg-[#f4d5e0] text-white rounded-full shadow-lg px-5 py-5 text-xl z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </a>

    <x-modal name="ProgramModal" maxWidth="xl" maxHeight="md">
        <form method="POST" id="programForm" enctype="multipart/form-data" class="bg-white p-6 space-y-4 w-full">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="program_id" id="programId">

            <h2 id="modalTitle" class="text-xl font-semibold text-center">Form Tambah Program</h2>

            <div>
                <label for="nama_program" class="block">Nama Kegiatan</label>
                <input type="text" name="nama_program" id="nama_program" required class="mt-2 w-full p-2 border rounded">
            </div>

            <div>
                <label for="deskripsi_program" class="block">Deskripsi Kegiatan</label>
                <textarea name="deskripsi_program" id="deskripsi_program" required class="mt-2 w-full p-2 border rounded"></textarea>
            </div>

            <div>
                <label for="tanggal_buka" class="block">Tanggal Buka Pendaftaran</label>
                <input type="date" name="tanggal_buka" id="tanggal_buka" required class="mt-2 w-full p-2 border rounded">
                @error('tanggal_buka')
                    <p class="text-red-700 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_tutup" class="block">Tanggal Tutup Pendaftaran</label>
                <input type="date" name="tanggal_tutup" id="tanggal_tutup" required
                    class="mt-2 w-full p-2 border rounded">
                @error('tanggal_tutup')
                    <p class="text-red-700 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_pelaksanaan" class="block">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal_pelaksanaan" id="tanggal_pelaksanaan" required
                    class="mt-2 w-full p-2 border rounded">
                @error('tanggal_pelaksanaan')
                    <p class="text-red-700 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="is_online" class="block">Jenis Program</label>
                <select name="is_online" id="is_online" required class="mt-2 w-full p-2 border rounded">
                    <option value="1">Online</option>
                    <option value="0">Offline</option>
                </select>
            </div>

            <div>
                <label for="max_peserta" class="block">Maksimal Peserta</label>
                <input type="number" name="max_peserta" id="max_peserta" class="mt-2 w-full p-2 border rounded">
            </div>

            <div>
                <label for="harga_program" class="block">Biaya Pendaftaran</label>
                <input type="number" name="harga_program" id="harga_program" class="mt-2 w-full p-2 border rounded">
            </div>

            <div>
                <label for="foto_header" class="block">Foto Header</label>
                <input type="file" name="foto_header" id="foto_header" accept="image/*"
                    class="mt-2 w-full p-2 border border-black rounded">
            </div>

            <div class="flex justify-end gap-4">
                <button type="button" id="deleteProgramBtn"
                    class="px-4 py-2 border border-black text-black rounded hidden">
                    Hapus
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-[#e9abc1] text-white rounded hover:bg-[#c58299]">Simpan</button>
            </div>
        </form>
        <form method="POST" id="deleteProgramForm" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </x-modal>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.querySelector('[name="ProgramModal"]');
            const form = document.getElementById('programForm');
            const tambahBtn = document.getElementById('tambahProgramBtn');
            const title = document.getElementById('modalTitle');
            const deleteBtn = document.getElementById('deleteProgramBtn');
            const deleteForm = document.getElementById('deleteProgramForm');

            const openModal = () => window.dispatchEvent(new CustomEvent('open-modal', {
                detail: 'ProgramModal'
            }));
            const closeModal = () => window.dispatchEvent(new CustomEvent('close-modal', {
                detail: 'ProgramModal'
            }));

            document.querySelectorAll('.editProgramBtn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const program = JSON.parse(btn.dataset.program);

                    form.setAttribute('action', '{{ route('admin.program.update') }}');
                    document.getElementById('formMethod').value = 'PUT';
                    title.textContent = 'Form Edit Program';

                    document.getElementById('programId').value = program.id;
                    document.getElementById('nama_program').value = program.nama_program;
                    document.getElementById('deskripsi_program').value = program.deskripsi_program;
                    document.getElementById('tanggal_buka').value = program.tanggal_buka;
                    document.getElementById('tanggal_tutup').value = program.tanggal_tutup;
                    document.getElementById('tanggal_pelaksanaan').value = program.tanggal_pelaksanaan;
                    document.getElementById('max_peserta').value = program.max_peserta;
                    document.getElementById('is_online').value = program.is_online;
                    document.getElementById('harga_program').value = program.harga_program;

                    deleteBtn.classList.remove('hidden');
                    deleteForm.setAttribute('action', '{{ route('admin.program.destroy') }}');

                    openModal();
                });
            });

            deleteBtn.addEventListener('click', () => {
                if (confirm('Yakin ingin menghapus program ini?')) {
                    deleteForm.submit();
                }
            });

            tambahBtn.addEventListener('click', () => {
                form.reset();
                form.setAttribute('action', '{{ route('admin.program.store') }}');
                document.getElementById('formMethod').value = 'POST';
                title.textContent = 'Form Tambah Program';

                deleteBtn.classList.add('hidden');
                deleteForm.setAttribute('action', '');

                openModal();
            });
        });
    </script>
@endpush
