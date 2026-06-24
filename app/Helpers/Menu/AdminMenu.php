<?php

namespace App\Helpers\Menu;

class AdminMenu
{
    public static function get()
    {
        return [

            [
                'icon' => 'dashboard',
                'name' => 'Dashboard',
                'path' => route('admin.dashboard'),
            ],

            [
                'icon' => 'task',
                'name' => 'Manajemen Audit',
                'subItems' => [
                    ['name' => 'Data Auditor', 'path' => '/admin/data-auditor'],
                    ['name' => 'Setting Tahun Akademik', 'path' => '/admin/setting-tahun-akademik'],
                    ['name' => 'Setting Kriteria', 'path' => '/admin/setting-kriteria'],
                    ['name' => 'Setting Akses Auditor', 'path' => '/admin/setting-akses-auditor'],
                    ['name' => 'Isi Matriks Penilaian', 'path' => '/admin/matriks-penilaian'],
                    ['name' => 'Daftar Pertanyaan AMI Prodi', 'path' => '/admin/pertanyaan-ami-prodi'],
                    ['name' => 'Daftar Pertanyaan AMI Unit', 'path' => '/admin/pertanyaan-ami-unit'],
                    ['name' => 'Setting Score', 'path' => '/admin/setting-score'],
                ],
            ],

            [
                'icon' => 'tables',
                'name' => 'Hasil Audit',
                'subItems' => [
                    ['name' => 'Daftar Periksa', 'path' => '/admin/hasil-audit/daftar-periksa'],
                    ['name' => 'PTK', 'path' => '/admin/hasil-audit/ptk'],
                    ['name' => 'Observasi', 'path' => '/admin/hasil-audit/observasi'],
                    ['name' => 'Terpenuhi', 'path' => '/admin/hasil-audit/terpenuhi'],
                    ['name' => 'Rekapitulasi', 'path' => '/admin/hasil-audit/rekapitulasi'],
                ],
            ],

            [
                'icon' => 'charts',
                'name' => 'Temuan & Tindak Lanjut',
                'subItems' => [
                    ['name' => 'Temuan Audit', 'path' => '/temuan'],
                    ['name' => 'Rekomendasi', 'path' => '/rekomendasi'],
                    ['name' => 'Tindak Lanjut', 'path' => '/tindak-lanjut'],
                ],
            ],
        ];
    }

    public static function getOthers()
    {
        return [

            [
                'icon' => 'others',
                'name' => 'Pengguna',
                'subItems' => [

                    [
                        'name' => 'Tambah Pengguna & Pengaturan Pengguna',
                        'path' => '/admin/others/pengguna',
                    ],

                ],
            ],

        ];
    }
}