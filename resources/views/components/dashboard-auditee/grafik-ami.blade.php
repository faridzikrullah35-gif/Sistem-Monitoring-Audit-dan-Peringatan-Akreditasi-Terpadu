{{-- resources/views/components/dashboard-auditee/grafik-ami.blade.php --}}
<div class="rounded-xl bg-white p-5 shadow-sm dark:bg-gray-800">
    <div class="mb-3 flex flex-wrap items-center justify-between">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Grafik Nilai AMI per Standar</h2>
        </div>
        <div class="flex gap-2">
            <button id="btnRadar" class="rounded-full bg-indigo-100 px-3 py-1 text-xs text-indigo-700 hover:bg-indigo-200 dark:bg-indigo-900/50 dark:text-indigo-300 dark:hover:bg-indigo-800">Radar</button>
            <button id="btnBar" class="rounded-full bg-gray-100 px-3 py-1 text-xs text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">Bar</button>
        </div>
    </div>
    <canvas id="amiChart" class="mt-2 max-h-72 w-full"></canvas>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('amiChart').getContext('2d');
        let currentChart = null;
        const labels = ['Standar Pendidikan', 'Penelitian', 'Pengabdian', 'Sumber Daya', 'Pengelolaan', 'Luaran'];
        const dataValues = [85, 78, 90, 70, 82, 88];

        function renderRadar() {
            if(currentChart) currentChart.destroy();
            currentChart = new Chart(ctx, {
                type: 'radar',
                data: { labels: labels, datasets: [{ label: 'Nilai AMI 2025', data: dataValues, backgroundColor: 'rgba(99,102,241,0.2)', borderColor: 'rgb(99,102,241)', pointBackgroundColor: 'rgb(79,70,229)' }] },
                options: { responsive: true, maintainAspectRatio: true, scales: { r: { beginAtZero: true, max: 100, grid: { color: '#374151' }, angleLines: { color: '#374151' }, pointLabels: { color: '#9ca3af' } } } }
            });
        }
        function renderBar() {
            if(currentChart) currentChart.destroy();
            currentChart = new Chart(ctx, {
                type: 'bar',
                data: { labels: labels, datasets: [{ label: 'Skor Standar', data: dataValues, backgroundColor: '#3b82f6', borderRadius: 8 }] },
                options: { responsive: true, maintainAspectRatio: true, scales: { y: { beginAtZero: true, max: 100, grid: { color: '#374151' }, ticks: { color: '#9ca3af' } }, x: { ticks: { color: '#9ca3af' } } } }
            });
        }
        document.getElementById('btnRadar').addEventListener('click', renderRadar);
        document.getElementById('btnBar').addEventListener('click', renderBar);
        renderRadar();
    });
</script>
@endpush