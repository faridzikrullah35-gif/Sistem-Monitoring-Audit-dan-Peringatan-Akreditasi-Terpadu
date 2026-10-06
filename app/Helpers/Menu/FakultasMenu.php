<?php

namespace App\Helpers\Menu;

class FakultasMenu
{
    public static function get()
    {
        return [

            [
                'icon' => 'dashboard',
                'name' => 'Dashboard',
                'path' => '/fakultas/dashboard',
            ],

            [
                'icon' => 'others',
                'name' => 'Profile',
                'subItems' => [
                    [
                        'name' => 'Identitas',
                        'path' => '/fakultas/identitas-fakultas',
                    ],
                    [
                        'name' => 'Profile PD DIKTI',
                        'path' => '/fakultas/profile-pd-dikti',
                    ],
                    [
                        'name' => 'Profile SDM',
                        'path' => '/fakultas/profile-sdm',
                    ],
                    [
                        'name' => 'Pendidikan',
                        'path' => '/fakultas/pendidikan',
                    ],
                    [
                        'name' => 'Sinta',
                        'path' => '/fakultas/sinta',
                    ],
                    [
                        'name' => 'Penelitian',
                        'path' => '/fakultas/penelitian',
                    ],
                    [
                        'name' => 'Publikasi Ilmiah',
                        'path' => '/fakultas/publikasi-ilmiah',
                    ],
                    [
                        'name' => 'PKM',
                        'path' => '/fakultas/pkm',
                    ],
                    [
                        'name' => 'Inovasi',
                        'path' => '/fakultas/inovasi',
                    ],
                    [
                        'name' => 'Prestasi Akademik Mahasiswa',
                        'path' => '/fakultas/prestasi-akademik-mahasiswa',
                    ],
                    [
                        'name' => 'Sarana Prasarana',
                        'path' => '/fakultas/sarpras',
                    ],
                ],
            ],

            [
                'icon' => 'clipboard-document-check',
                'name' => 'Data Akreditasi',
                'subItems' => [
                    [
                        'name' => 'Akreditasi',
                        'path' => '/fakultas/data-akreditasi',
                    ],
                ],
            ],

            [
                'icon' => 'tables',
                'name' => 'Hasil Audit',
                'subItems' => [
                    [
                        'name' => 'Daftar Periksa',
                        'path' => '/fakultas/hasil-audit/daftar-periksa',
                    ],
                    [
                        'name' => 'PTK',
                        'path' => '/fakultas/hasil-audit/ptk',
                    ],
                    [
                        'name' => 'Observasi',
                        'path' => '/fakultas/hasil-audit/observasi',
                    ],
                    [
                        'name' => 'Terpenuhi',
                        'path' => '/fakultas/hasil-audit/terpenuhi',
                    ],
                    [
                        'name' => 'Rekapitulasi',
                        'path' => '/fakultas/hasil-audit/rekapitulasi',
                    ],
                ],
            ],

        ];
    }
}