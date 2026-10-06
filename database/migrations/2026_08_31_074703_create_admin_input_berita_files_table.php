<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_input_berita_files', function (Blueprint $table) {
            $table->id();

            $table->foreignId('admin_input_berita_id')
                ->constrained('admin_input_berita')
                ->cascadeOnDelete();

            $table->foreignId('users_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('nama_file');
            $table->string('file');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_input_berita_files');
    }
};