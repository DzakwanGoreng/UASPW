
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Kegiatan</h1>
        <p class="text-gray-600">Kelola kegiatan organisasi mahasiswa</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-6 bg-white p-4 rounded border">
        <div class="flex flex-wrap gap-4 items-center justify-between">
            <div class="flex gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Filter Organisasi</label>
                    <select wire:model.live="filterOrganisasi" class="border border-gray-300 rounded px-3 py-2">
                        <option value="">Semua Organisasi</option>
                        @foreach($organisasi as $org)
                            <option value="{{ $org->id }}">{{ $org->nama_organisasi }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Filter Lokasi</label>
                    <select wire:model.live="filterLokasi" class="border border-gray-300 rounded px-3 py-2">
                        <option value="">Semua Lokasi</option>
                        @foreach($lokasi as $lok)
                            <option value="{{ $lok->id }}">{{ $lok->nama_lokasi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Tambah Kegiatan
            </button>
        </div>
    </div>

    <div class="bg-white rounded border">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kegiatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Organisasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Panitia</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($kegiatan as $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nama }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->tgl_pelaksanaan->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->organisasi->nama_organisasi }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->lokasi->nama_lokasi }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->kepanitiaan->count() }} orang</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="flex space-x-2">
                            <button wire:click="edit({{ $item->id }})" class="text-blue-600 hover:text-blue-800">Edit</button>
                            <button wire:click="openPanitiaModal({{ $item->id }})" class="text-green-600 hover:text-green-800">Panitia</button>
                            <button wire:click="delete({{ $item->id }})" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:text-red-800">Hapus</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="px-6 py-4">
            {{ $kegiatan->links() }}
        </div>
    </div>

    @if($showModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h3 class="text-lg font-medium mb-4">{{ $isEdit ? 'Edit' : 'Tambah' }} Kegiatan</h3>
            
            <form wire:submit.prevent="store">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kegiatan</label>
                    <input type="text" wire:model="nama" class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pelaksanaan</label>
                    <input type="date" wire:model="tgl_pelaksanaan" class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('tgl_pelaksanaan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <select wire:model="lokasi_id" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">Pilih Lokasi</option>
                        @foreach($lokasi as $lok)
                            <option value="{{ $lok->id }}">{{ $lok->nama_lokasi }}</option>
                        @endforeach
                    </select>
                    @error('lokasi_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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

    @if($showPanitiaModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-2xl">
            <h3 class="text-lg font-medium mb-4">Manajemen Panitia</h3>
            
            <form wire:submit.prevent="addPanitia" class="mb-6 p-4 bg-gray-50 rounded">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Anggota</label>
                        <select wire:model="selectedAnggotaId" class="w-full border border-gray-300 rounded px-3 py-2">
                            <option value="">Pilih Anggota</option>
                            @foreach($anggota as $ang)
                                <option value="{{ $ang->id }}">{{ $ang->nama }} ({{ $ang->nim }})</option>
                            @endforeach
                        </select>
                        @error('selectedAnggotaId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                        <input type="text" wire:model="jabatan" class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('jabatan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Tambah Panitia
                    </button>
                </div>
            </form>
            
            <div class="mb-4">
                <h4 class="font-medium mb-2">Daftar Panitia</h4>
                <div class="max-h-60 overflow-y-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Nama</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">NIM</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Jabatan</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($kepanitiaan as $panitia)
                            <tr>
                                <td class="px-4 py-2 text-sm">{{ $panitia->anggota->nama }}</td>
                                <td class="px-4 py-2 text-sm">{{ $panitia->anggota->nim }}</td>
                                <td class="px-4 py-2 text-sm">{{ $panitia->jabatan }}</td>
                                <td class="px-4 py-2 text-sm">
                                    <button wire:click="removePanitia({{ $panitia->id }})" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:text-red-800">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end">
                <button wire:click="closePanitiaModal" class="px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-gray-50">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    @endif
</div>