
<div>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Manajemen Anggota</h1>
        <p class="mt-1 text-sm text-gray-500">Kelola anggota organisasi mahasiswa dengan mudah</p>
        <p class="text-gray-600">Kelola anggota organisasi mahasiswa</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-6 flex justify-between items-center">
        <div></div>
        <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Tambah Anggota
        </button>
    </div>

    <div class="bg-white rounded border">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIM</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Organisasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($anggota as $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nama }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nim }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->organisasi->nama_organisasi }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="flex space-x-2">
                            <button wire:click="edit({{ $item->id }})" class="text-blue-600 hover:text-blue-800">Edit</button>
                            <button wire:click="delete({{ $item->id }})" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:text-red-800">Hapus</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="px-6 py-4">
            {{ $anggota->links() }}
        </div>
    </div>

    @if($showModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h3 class="text-lg font-medium mb-4">{{ $isEdit ? 'Edit' : 'Tambah' }} Anggota</h3>
            
            <form wire:submit.prevent="store">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" wire:model="nama" class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIM</label>
                    <input type="text" wire:model="nim" class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('nim') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Organisasi</label>
                    <select wire:model="organisasi_id" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">Pilih Organisasi</option>
                        @foreach($organisasi as $org)
                            <option value="{{ $org->id }}">{{ $org->nama_organisasi }}</option>
                        @endforeach
                    </select>
                    @error('organisasi_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" wire:click="closeModal" class="px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        {{ $isEdit ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>