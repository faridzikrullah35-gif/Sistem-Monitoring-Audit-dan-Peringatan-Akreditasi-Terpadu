<?php

namespace App\Helpers\Menu;

use Illuminate\Support\Facades\Auth;

class ProdiMenu
{
    public static function get()
    {
        $user = Auth::user();

        $isLpm = $user && $user->role === 'unit_kerja' && $user->isAdminAccess();

        $canAccessProdiData = $user && ($user->role === 'prodi' || $isLpm);

        $profileSubItems = [
            ['name' => 'Identitas', 'path' => '/prodi/identitas-prodi'],
        ];

        if ($canAccessProdiData) {
            $profileSubItems[] = [
                'name' => 'Profile PD DIKTI',
                'path' => '/prodi/profile-pd-dikti',
            ];
        }

        $profileSubItems[] = [
            'name' => 'Profile SDM',
            'path' => '/prodi/profile-sdm',
        ];

        if ($canAccessProdiData) {
            $profileSubItems[] = [
                'name' => 'Pendidikan',
                'path' => '/prodi/pendidikan',
            ];
        
            $profileSubItems[] = [
                'name' => 'Sinta',
                'path' => '/prodi/sinta',
            ];

            $profileSubItems[] = [
                'name' => 'Penelitian',
                'path' => '/prodi/penelitian',
            ];

            $profileSubItems[] = [
                'name' => 'Publikasi Ilmiah',
                'path' => '/prodi/publikasi-ilmiah',
            ];

            $profileSubItems[] = [
                'name' => 'PKM',
                'path' => '/prodi/pkm',
            ];

            $profileSubItems[] = [
                'name' => 'Inovasi',
                'path' => '/prodi/inovasi',
            ];

            $profileSubItems[] = [
                'name' => 'Prestasi Akademik Mahasiswa',
                'path' => '/prodi/prestasi-akademik-mahasiswa',
            ];
        }

        $profileSubItems[] = [
            'name' => 'Sarana Prasarana',
            'path' => '/prodi/sarpras',
        ];

        $menu = [
            ['icon' => 'dashboard', 'name' => 'Dashboard', 'path' => '/prodi/dashboard'],
            ['icon' => 'others', 'name' => 'Profile', 'subItems' => $profileSubItems],
            [
                'icon' => 'list',
                'name' => 'Audit Mutu Internal',
                'subItems' => [
                    ['name' => 'Penilaian Kinerja', 'path' => '/prodi/penilaian-kinerja'],
                    ['name' => 'Data Auditee', 'path' => '/prodi/data-auditee'],
                    ['name' => 'Daftar Periksa', 'path' => '/prodi/daftar-periksa'],
                    ['name' => 'Form PTK (Permintaan Tindakan Koreksi)', 'path' => '/prodi/form-ptk'],
                    ['name' => 'Observasi', 'path' => '/prodi/observasi'],
                    ['name' => 'Terpenuhi', 'path' => '/prodi/terpenuhi'],
                    ['name' => 'Cetak Rekapitulasi AMI', 'path' => '/prodi/cetak-rekapitulasi-ami'],
                ],
            ],
        ];

        if ($canAccessProdiData) {
            array_splice($menu, 2, 0, [
                [
                    'icon' => 'clipboard-document-check',
                    'name' => 'Data Akreditasi',
                    'subItems' => [
                        ['name' => 'Akreditasi', 'path' => '/prodi/data-akreditasi'],
                    ],
                ],
            ]);
        }

        return $menu;
    }
}