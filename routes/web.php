<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Livewire\KegiatanManagement;
use App\Livewire\AnggotaManagement;
use App\Livewire\LaporanKegiatan;

Route::get('/', function () {
    return redirect()->route('kegiatan');
});

Route::get('/kegiatan', KegiatanManagement::class)->name('kegiatan');
Route::get('/anggota', AnggotaManagement::class)->name('anggota');
Route::get('/laporan', LaporanKegiatan::class)->name('laporan');