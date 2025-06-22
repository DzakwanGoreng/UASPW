<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kepanitiaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatan')->onDelete('cascade');
            $table->foreignId('anggota_id')->constrained('anggota')->onDelete('cascade');
            $table->string('jabatan');
            $table->timestamps();
            
            $table->unique(['kegiatan_id', 'anggota_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kepanitiaan');
    }
};