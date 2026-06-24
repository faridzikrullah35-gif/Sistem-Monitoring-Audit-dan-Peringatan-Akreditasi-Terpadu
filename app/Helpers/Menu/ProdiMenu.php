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
                'icon' => 'list',
                'name' => 'Audit Mutu Internal',
                'subItems' => [

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