<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FakultasSarpras extends Model
{
    use HasFactory;

    protected $table = 'fakultas_sarpras';

    protected $fillable = [
        'users_id',
        'kode',
        'nama_sarpras',
        'status',
        'jumlah',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
    ];

    /**
     * Relasi ke User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Accessor: URL file.
     */
    public function getFileUrlAttribute(): ?string
    {
        if (!$this->file_path) {
            return null;
        }

        // Pastikan file benar-benar ada
        if (!Storage::disk('public')->exists($this->file_path)) {
            return null;
        }

        return Storage::disk('public')->url($this->file_path);
    }

    /**
     * Accessor: cek apakah file berupa gambar.
     */
    public function getIsImageAttribute(): bool
    {
        if (!$this->file_type) {
            return false;
        }

        return str_starts_with($this->file_type, 'image/');
    }

    /**
     * Accessor: ukuran file terformat.
     *
     * Contoh:
     * 1024       = 1 KB
     * 1048576    = 1 MB
     */
    public function getFormattedFileSizeAttribute(): ?string
    {
        if (!$this->file_size) {
            return null;
        }

        $bytes = (int) $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $i = 0;

        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}