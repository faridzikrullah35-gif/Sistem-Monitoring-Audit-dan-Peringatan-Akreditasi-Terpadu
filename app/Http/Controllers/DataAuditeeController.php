<?php

namespace App\Http\Controllers;

use App\Models\Auditiee;
use App\Models\TahunAkademik;

class DataAuditeeController extends Controller
{
    public function index()
    {
        $auditees = Auditiee::with('tahunAkademik')->latest()->get();

        $tahunAkademiks = TahunAkademik::all();

        return view('pages.data-auditee', compact(
            'auditees',
            'tahunAkademiks'
        ));
    }
}