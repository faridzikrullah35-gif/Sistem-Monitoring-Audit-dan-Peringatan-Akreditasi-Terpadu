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
                'icon' => 'others',
                'name' => 'Profile',
                'subItems' => [
                    ['name' => 'Identitas', 'path' => '/auditor/identitas-prodi'],
                    ['name' => 'Profile PD DIKTI', 'path' => '/auditor/profile-pd-dikti'],
                    ['name' => 'Profile SDM', 'path' => '/auditor/profile-sdm'],
                    ['name' => 'Pendidikan', 'path' => '/auditor/pendidikan'],
                    ['name' => 'Sinta', 'path' => '/auditor/sinta'],
                    ['name' => 'Penelitian', 'path' => '/auditor/penelitian'],
                    ['name' => 'Publikasi Ilmiah', 'path' => '/auditor/publikasi-ilmiah'],
                    ['name' => 'PKM', 'path' => '/auditor/pkm'],
                    ['name' => 'Inovasi', 'path' => '/auditor/inovasi'],
                    ['name' => 'Prestasi Akademik Mahasiswa', 'path' => '/auditor/prestasi-akademik-mahasiswa'],
                    ['name' => 'Sarana Prasarana', 'path' => '/auditor/sarpras'],
                ],
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