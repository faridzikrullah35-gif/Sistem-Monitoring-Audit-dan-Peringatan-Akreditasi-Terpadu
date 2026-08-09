<?php

namespace App\Helpers\Menu;

class ProdiMenu
{
    public static function get()
    {
        return [

            [
                'icon' => 'dashboard',
                'name' => 'Dashboard',
                'path' => '/prodi/dashboard',
            ],

            [
                'icon' => 'others',
                'name' => 'Profile',
                'subItems' => [
                    ['name' => 'Identitas', 'path' => '/prodi/identitas-prodi'],
                ],
            ],

            [
                'icon' => 'clipboard-document-check',
                'name' => 'Data Akreditasi',
                'subItems' => [
                    ['name' => 'Akreditasi', 'path' => '/prodi/data-akreditasi'],
                ],
            ],

            [
                'icon' => 'list',
                'name' => 'Audit Mutu Internal',
                'subItems' => [
                    [
                        'name' => 'Penilaian Kinerja',
                        'path' => '/prodi/penilaian-kinerja'
                    ],
                    
                    [
                        'name' => 'Data Auditee',
                        'path' => '/prodi/data-auditee'
                    ],

                    [
                        'name' => 'Daftar Periksa',
                        'path' => '/prodi/daftar-periksa'
                    ],

                    [
                        'name' => 'Form PTK (Permintaan Tindakan Koreksi)',
                        'path' => '/prodi/form-ptk'
                    ],

                    [
                        'name' => 'Observasi',
                        'path' => '/prodi/observasi'
                    ],

                    [
                        'name' => 'Terpenuhi',
                        'path' => '/prodi/terpenuhi'
                    ],

                    [
                        'name' => 'Cetak Rekapitulasi AMI',
                        'path' => '/prodi/cetak-rekapitulasi-ami'
                    ],

                ],
            ],

        ];
    }
}