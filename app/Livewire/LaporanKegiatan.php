<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Kegiatan;
use App\Models\Organisasi;
use App\Models\Lokasi;
use Illuminate\Support\Facades\DB;

class LaporanKegiatan extends Component
{
    public $filterOrganisasi = '';
    public $filterLokasi = '';

    public function render()
    {
        $query = Kegiatan::with(['organisasi', 'lokasi'])
                         ->withCount('kepanitiaan');
        
        if ($this->filterOrganisasi) {
            $query->where('organisasi_id', $this->filterOrganisasi);
        }
        
        if ($this->filterLokasi) {
            $query->where('lokasi_id', $this->filterLokasi);
        }
        
        $kegiatan = $query->get();
        $organisasi = Organisasi::all();
        $lokasi = Lokasi::all();

        return view('livewire.laporan-kegiatan', compact('kegiatan', 'organisasi', 'lokasi'));
    }
}