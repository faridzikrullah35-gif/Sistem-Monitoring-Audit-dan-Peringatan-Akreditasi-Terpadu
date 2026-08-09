<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akreditasi;

class EarlyWarningSystemController extends Controller
{
    public function index()
    {
        // Ambil data dengan pagination 50 per halaman
        $data = Akreditasi::paginate(50);

        return view('pages.landing.ews', compact('data'));
    }
}