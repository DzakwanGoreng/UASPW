<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Anggota;
use App\Models\Organisasi;

class AnggotaManagement extends Component
{
    use WithPagination;

    public $nama = '';
    public $nim = '';
    public $organisasi_id = '';
    public $anggotaId = null;
    public $isEdit = false;
    public $showModal = false;

    public function render()
    {
        $anggota = Anggota::with('organisasi')->paginate(10);
        $organisasi = Organisasi::all();

        return view('livewire.anggota-management', compact('anggota', 'organisasi'));
    }

    public function resetForm()
    {
        $this->nama = '';
        $this->nim = '';
        $this->organisasi_id = '';
        $this->anggotaId = null;
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

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:anggota,nim,' . $this->anggotaId,
            'organisasi_id' => 'required|exists:organisasi,id',
        ]);

        if ($this->isEdit) {
            $anggota = Anggota::find($this->anggotaId);
            $anggota->update([
                'nama' => $this->nama,
                'nim' => $this->nim,
                'organisasi_id' => $this->organisasi_id,
            ]);
            session()->flash('message', 'Anggota berhasil diupdate!');
        } else {
            Anggota::create([
                'nama' => $this->nama,
                'nim' => $this->nim,
                'organisasi_id' => $this->organisasi_id,
            ]);
            session()->flash('message', 'Anggota berhasil ditambahkan!');
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $anggota = Anggota::find($id);
        $this->anggotaId = $anggota->id;
        $this->nama = $anggota->nama;
        $this->nim = $anggota->nim;
        $this->organisasi_id = $anggota->organisasi_id;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function delete($id)
    {
        Anggota::find($id)->delete();
        session()->flash('message', 'Anggota berhasil dihapus!');
    }
}