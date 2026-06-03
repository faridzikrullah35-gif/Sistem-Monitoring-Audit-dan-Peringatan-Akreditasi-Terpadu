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
                'icon' => 'charts',
                'name' => 'Hasil Audit',
                'subItems' => [
                    ['name' => 'Input Nilai', 'path' => '/hasil/input'],
                    ['name' => 'Hasil per Unit', 'path' => '/hasil/unit'],
                    ['name' => 'Rekap Nilai', 'path' => '/hasil/rekap'],
                ],
            ],

            [
                'icon' => 'pages',
                'name' => 'Temuan & Tindak Lanjut',
                'subItems' => [
                    ['name' => 'Temuan Audit', 'path' => '/temuan'],
                    ['name' => 'Rekomendasi', 'path' => '/rekomendasi'],
                    ['name' => 'Tindak Lanjut', 'path' => '/tindak-lanjut'],
                ],
            ],

            [
                'icon' => 'tables',
                'name' => 'Laporan',
                'subItems' => [
                    ['name' => 'Laporan Audit', 'path' => '/laporan'],
                    ['name' => 'Export PDF', 'path' => '/laporan/pdf'],
                    ['name' => 'Export Excel', 'path' => '/laporan/excel'],
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