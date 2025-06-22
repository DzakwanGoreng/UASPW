<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kegiatan;
use App\Models\Organisasi;
use App\Models\Lokasi;
use App\Models\Anggota;
use App\Models\Kepanitiaan;

class KegiatanManagement extends Component
{
    use WithPagination;

    public $nama = '';
    public $tgl_pelaksanaan = '';
    public $organisasi_id = '';
    public $lokasi_id = '';
    public $kegiatanId = null;
    public $isEdit = false;
    public $showModal = false;
    public $showPanitiaModal = false;
    public $selectedKegiatanId = null;
    public $selectedAnggotaId = '';
    public $jabatan = '';
    
    // Filter
    public $filterOrganisasi = '';
    public $filterLokasi = '';

    public function render()
    {
        $query = Kegiatan::with(['organisasi', 'lokasi', 'kepanitiaan.anggota']);
        
        if ($this->filterOrganisasi) {
            $query->where('organisasi_id', $this->filterOrganisasi);
        }
        
        if ($this->filterLokasi) {
            $query->where('lokasi_id', $this->filterLokasi);
        }
        
        $kegiatan = $query->paginate(10);
        $organisasi = Organisasi::all();
        $lokasi = Lokasi::all();
        $anggota = $this->selectedKegiatanId ? 
            Anggota::where('organisasi_id', Kegiatan::find($this->selectedKegiatanId)?->organisasi_id)->get() : 
            collect();
        $kepanitiaan = $this->selectedKegiatanId ? 
            Kepanitiaan::with('anggota')->where('kegiatan_id', $this->selectedKegiatanId)->get() : 
            collect();

        return view('livewire.kegiatan-management', compact('kegiatan', 'organisasi', 'lokasi', 'anggota', 'kepanitiaan'));
    }

    public function resetForm()
    {
        $this->nama = '';
        $this->tgl_pelaksanaan = '';
        $this->organisasi_id = '';
        $this->lokasi_id = '';
        $this->kegiatanId = null;
        $this->isEdit = false;
        $this->showModal = false;
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function openPanitiaModal($kegiatanId)
    {
        $this->selectedKegiatanId = $kegiatanId;
        $this->showPanitiaModal = true;
    }

    public function closePanitiaModal()
    {
        $this->showPanitiaModal = false;
        $this->selectedKegiatanId = null;
        $this->selectedAnggotaId = '';
        $this->jabatan = '';
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'tgl_pelaksanaan' => 'required|date',
            'organisasi_id' => 'required|exists:organisasi,id',
            'lokasi_id' => 'required|exists:lokasi,id',
        ]);

        if ($this->isEdit) {
            $kegiatan = Kegiatan::find($this->kegiatanId);
            $kegiatan->update([
                'nama' => $this->nama,
                'tgl_pelaksanaan' => $this->tgl_pelaksanaan,
                'organisasi_id' => $this->organisasi_id,
                'lokasi_id' => $this->lokasi_id,
            ]);
            session()->flash('message', 'Kegiatan berhasil diupdate!');
        } else {
            Kegiatan::create([
                'nama' => $this->nama,
                'tgl_pelaksanaan' => $this->tgl_pelaksanaan,
                'organisasi_id' => $this->organisasi_id,
                'lokasi_id' => $this->lokasi_id,
            ]);
            session()->flash('message', 'Kegiatan berhasil ditambahkan!');
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::find($id);
        $this->kegiatanId = $kegiatan->id;
        $this->nama = $kegiatan->nama;
        $this->tgl_pelaksanaan = $kegiatan->tgl_pelaksanaan->format('Y-m-d');
        $this->organisasi_id = $kegiatan->organisasi_id;
        $this->lokasi_id = $kegiatan->lokasi_id;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function delete($id)
    {
        Kegiatan::find($id)->delete();
        session()->flash('message', 'Kegiatan berhasil dihapus!');
    }

    public function addPanitia()
    {
        $this->validate([
            'selectedAnggotaId' => 'required|exists:anggota,id',
            'jabatan' => 'required|string|max:255',
        ]);

        // Check if anggota already exists in this kegiatan
        $exists = Kepanitiaan::where('kegiatan_id', $this->selectedKegiatanId)
                             ->where('anggota_id', $this->selectedAnggotaId)
                             ->exists();

        if ($exists) {
            session()->flash('error', 'Anggota sudah terdaftar dalam kegiatan ini!');
            return;
        }

        Kepanitiaan::create([
            'kegiatan_id' => $this->selectedKegiatanId,
            'anggota_id' => $this->selectedAnggotaId,
            'jabatan' => $this->jabatan,
        ]);

        $this->selectedAnggotaId = '';
        $this->jabatan = '';
        session()->flash('message', 'Panitia berhasil ditambahkan!');
    }

    public function removePanitia($kepanitiaan_id)
    {
        Kepanitiaan::find($kepanitiaan_id)->delete();
        session()->flash('message', 'Panitia berhasil dihapus!');
    }
}