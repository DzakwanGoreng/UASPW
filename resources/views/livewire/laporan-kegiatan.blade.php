
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Laporan Kegiatan</h1>
        <p class="text-gray-600">Daftar kegiatan beserta jumlah anggota panitia</p>
    </div>

    <div class="mb-6 bg-white p-4 rounded border">
        <div class="flex gap-4 items-center">
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
    </div>

    <div class="bg-white rounded border">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium">Daftar Kegiatan</h3>
        </div>
        
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kegiatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Organisasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Panitia</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($kegiatan as $index => $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $item->nama }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->tgl_pelaksanaan->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->organisasi->nama_organisasi }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->lokasi->nama_lokasi }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $item->kepanitiaan_count }} orang
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                        Tidak ada data kegiatan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($kegiatan->count() > 0)
        <div class="px-6 py-4 border-t bg-gray-50">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">
                    Total: {{ $kegiatan->count() }} kegiatan
                </span>
                <span class="text-sm text-gray-600">
                    Total Panitia: {{ $kegiatan->sum('kepanitiaan_count') }} orang
                </span>
            </div>
        </div>
        @endif
    </div>
</div>