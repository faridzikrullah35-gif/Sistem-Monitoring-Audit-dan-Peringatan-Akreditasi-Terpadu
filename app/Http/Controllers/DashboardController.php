<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('pages.dashboard.dashboard', [
            'title' => 'Dashboard Admin | SIMANTAP'
        ]);
    }
    
    public function auditor()
    {
        $user = auth()->user();

        $modelClass = $user->auditor_type === 'PRODI'
            ? \App\Models\PertanyaanAmiProdi::class
            : \App\Models\PertanyaanAmiUnit::class;

        $pertanyaan = $modelClass::latest()->get();

        return view('pages.dashboard-auditor.dashboard-auditor', [
            'title' => 'Dashboard Auditor | SIMANTAP',
            'pertanyaan' => $pertanyaan,
        ]);
    }

    public function prodi()
    {
        return view('pages.dashboard-auditee.dashboard-auditee', [
            'title' => 'Dashboard Prodi | SIMANTAP'
        ]);
    }
}
