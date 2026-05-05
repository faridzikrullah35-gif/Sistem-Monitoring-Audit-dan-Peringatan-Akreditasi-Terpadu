<div
  class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
>
  <div class="flex items-center justify-between p-5 md:p-6 pb-0 md:pb-0">
    <div>
      <h3 class="font-semibold text-gray-800 dark:text-white/90 text-title-sm">Audit Terbaru</h3>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">5 aktivitas terakhir</p>
    </div>
    <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
      Lihat Semua
    </a>
  </div>

  <div class="overflow-x-auto mt-4">
    <table class="w-full text-sm">
      <thead>
        <tr class="border-t border-gray-100 dark:border-gray-800">
          <th class="text-left px-5 md:px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
            Nama Audit
          </th>
          <th class="text-left px-3 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
            Fakultas
          </th>
          <th class="text-left px-3 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
            Status
          </th>
          <th class="text-right px-5 md:px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
            Tanggal
          </th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
        @php
            $audits = [
                ['name' => 'Audit Keuangan', 'faculty' => 'FEB', 'status' => 'progress', 'date' => '23 Apr'],
                ['name' => 'Audit IT Infrastruktur', 'faculty' => 'FT', 'status' => 'done', 'date' => '20 Apr'],
                ['name' => 'Audit SDM & Kepegawaian', 'faculty' => 'FHUKUM', 'status' => 'progress', 'date' => '18 Apr'],
                ['name' => 'Audit Sarana Prasarana', 'faculty' => 'FK', 'status' => 'pending', 'date' => '15 Apr'],
                ['name' => 'Audit Penelitian', 'faculty' => 'FISIP', 'status' => 'done', 'date' => '12 Apr'],
            ];
        @endphp
        @foreach ($audits as $audit)
            <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02] transition-colors">
                <td class="px-5 md:px-6 py-3.5 font-medium text-gray-800 dark:text-white/90 whitespace-nowrap">
                    {{ $audit['name'] }}
                </td>
                <td class="px-3 py-3.5 text-gray-500 dark:text-gray-400 whitespace-nowrap">
                    {{ $audit['faculty'] }}
                </td>
                <td class="px-3 py-3.5 whitespace-nowrap">
                    @if ($audit['status'] === 'done')
                        <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 dark:bg-green-500/15 dark:text-green-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span> Done
                        </span>
                    @elseif ($audit['status'] === 'progress')
                        <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-500/15 dark:text-blue-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-blue-500 animate-pulse"></span> On Progress
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700 dark:bg-amber-500/15 dark:text-amber-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span> Pending
                        </span>
                    @endif
                </td>
                <td class="px-5 md:px-6 py-3.5 text-right text-gray-500 dark:text-gray-400 whitespace-nowrap">
                    {{ $audit['date'] }}
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>