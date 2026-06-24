<?php

namespace App\Helpers\Menu;

class AuditorMenu
{
    public static function get()
    {
        return [

            [
                'icon' => 'dashboard',
                'name' => 'Dashboard',
                'path' => '/auditor/dashboard',
            ],

            [
                'icon' => 'list',
                'name' => 'Audit Mutu Internal',
                'subItems' => [
                    ['name' => 'Isi Data Auditee', 'path' => '/auditor/isi-data-auditee'],
                    ['name' => 'Form Daftar Periksa', 'path' => '/auditor/form-daftar-periksa'],
                    ['name' => 'Form PTK (Permintaan Tindakan Koreksi)', 'path' => '/auditor/form-ptk-permintaan-tindakan-koreksi'],
                    ['name' => 'Form Observasi', 'path' => '/auditor/form-observasi'],
                    ['name' => 'Form Terpenuhi', 'path' => '/auditor/form-terpenuhi'],
                    ['name' => 'Cetak Rekapitulasi AMI', 'path' => '/auditor/cetak-rekapitulasi-ami'],
                ],
            ],

        ];
    }
}