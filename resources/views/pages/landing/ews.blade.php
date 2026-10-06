{{-- resources/views/pages/landing/ews.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Early Warning System - SIMANTAP</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #0F4C81;
            --secondary: #2563EB;
            --bg: #F8FAFC;
            --text: #1E293B;
            --text-light: #64748B;
            --white: #ffffff;
            --shadow: 0 10px 40px rgba(15, 76, 129, 0.08);
            --radius: 16px;
            --transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            line-height: 1.7;
            overflow-x: hidden;
        }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
        .section-padding { padding: 80px 0; }
        .section-title {
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 12px;
        }
        .section-title span { color: var(--primary); }
        .text-center { text-align: center; }

        .table-wrapper {
            overflow-x: auto;
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 0 0 10px 0;
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            min-width: 1600px; /* lebih lebar karena banyak kolom */
        }
        thead {
            background: var(--primary);
            color: var(--white);
        }
        th {
            padding: 12px 8px;
            text-align: left;
            font-weight: 600;
            white-space: nowrap;
        }
        td {
            padding: 10px 8px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }
        tr:hover td {
            background: #f1f5f9;
        }
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 600;
        }
        .badge-aktif { background: #dcfce7; color: #166534; }
        .badge-perhatian { background: #fef9c3; color: #854d0e; }
        .badge-kritis { background: #fee2e2; color: #991b1b; }
        .badge-default { background: #e2e8f0; color: #475569; }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary);
            color: var(--white);
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-size: 14px;
            margin-top: 20px;
        }
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(15,76,129,0.3);
        }
        .section-label {
            display: inline-block;
            font-size: 13px;
            font-weight: 600;
            color: #dc2626;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }
        @media (max-width: 768px) {
            .section-title { font-size: 24px; }
            .section-padding { padding: 40px 0; }
        }
        /* Warna peringkat */
        .peringkat-a { background: #dcfce7; color: #166534; }
        .peringkat-b { background: #fef9c3; color: #854d0e; }
        .peringkat-c { background: #fee2e2; color: #991b1b; }
        .peringkat-unggul { background: #dbeafe; color: #1e40af; }

        /* Pagination styling */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        .pagination-wrapper ul {
            display: flex;
            list-style: none;
            gap: 6px;
            flex-wrap: wrap;
        }
        .pagination-wrapper ul li a,
        .pagination-wrapper ul li span {
            display: inline-block;
            padding: 8px 14px;
            background: var(--white);
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: var(--text);
            font-size: 14px;
            transition: var(--transition);
        }
        .pagination-wrapper ul li a:hover {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }
        .pagination-wrapper ul li.active span {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }
        .pagination-wrapper ul li.disabled span {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .pagination-info {
            text-align: center;
            margin-top: 12px;
            font-size: 14px;
            color: var(--text-light);
        }
    </style>
</head>
<body>

    @include('components.landing.navbar')

    <section class="section-padding" style="background: linear-gradient(135deg, #fef2f2, #ffffff);">
        <div class="container">
            <div class="text-center">
                <span class="section-label"><i class="fas fa-exclamation-triangle"></i> Early Warning System</span>
                <h1 class="section-title">Early Warning System Status Akreditasi</h1>
                <p style="color: var(--text-light); max-width: 700px; margin: 0 auto 20px;">
                    Pantau status akreditasi & tanggal kadaluarsa setiap program studi secara real-time.
                </p>
                <a href="{{ route('landing') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenjang</th>
                            <th>UPPS</th>
                            <th>PS</th>
                            <th>SK Akreditasi</th>
                            <th>Tahun SK</th>
                            <th>Peringkat</th>
                            <th>Tgl. Kadaluarsa</th>
                            <th>Status Kadaluarsa</th>
                            <th>Sisa Kadaluarsa</th>
                            <th>Akreditasi Nasional</th>
                            <th>Akreditasi Internasional</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                            <tr>
                                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->program }}</td>
                                <td>
                                    {{ $item->unit ?? '-' }}
                                </td>
                                <td>
                                    {{ $item->sub_unit ?? '-' }}
                                </td>
                                <td>{{ $item->nomor_sk }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_sk)->translatedFormat('d F Y') }}</td>
                                <td>
                                    @php
                                        $peringkatClass = 'badge-default';
                                        $peringkatLower = strtolower($item->peringkat_akreditasi);
                                        if ($peringkatLower == 'a') $peringkatClass = 'peringkat-a';
                                        elseif ($peringkatLower == 'b') $peringkatClass = 'peringkat-b';
                                        elseif ($peringkatLower == 'c') $peringkatClass = 'peringkat-c';
                                        elseif ($peringkatLower == 'unggul') $peringkatClass = 'peringkat-unggul';
                                    @endphp
                                    <span class="badge {{ $peringkatClass }}">{{ $item->peringkat_akreditasi }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_kadaluarsa)->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $status = $item->status_daluwarsa;

                                        $statusClass = match ($status) {
                                            'Kadaluarsa' => 'badge-kritis',
                                            'Segera' => 'badge-perhatian',
                                            default => 'badge-aktif',
                                        };
                                    @endphp

                                    <span class="badge {{ $statusClass }}">
                                        {{ $status }}
                                    </span>
                                </td>
                                <td>{{ $item->sisa_kadaluarsa_format }}</td>
                                <td>{{ $item->akreditasi_nasional }}</td>
                                <td>{{ $item->akreditasi_internasional ?: '-' }}</td>
                                <td>{{ $item->keterangan ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="19" style="text-align: center; padding: 30px; color: var(--text-light);">
                                    <i class="fas fa-database" style="font-size: 24px; display: block; margin-bottom: 8px;"></i>
                                    Belum ada data akreditasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if($data->total() > 0)
                <div class="pagination-wrapper">
                    {{ $data->links() }}
                </div>
                <div class="pagination-info">
                    Menampilkan {{ $data->firstItem() ?? 0 }} – {{ $data->lastItem() ?? 0 }} dari total {{ $data->total() }} data
                </div>
            @else
                <div class="pagination-info" style="margin-top:20px;">
                    Total data: 0
                </div>
            @endif

        </div>
    </section>

    @include('components.landing.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 30) navbar.classList.add('scrolled');
                else navbar.classList.remove('scrolled');
            });
        });
    </script>
</body>
</html>