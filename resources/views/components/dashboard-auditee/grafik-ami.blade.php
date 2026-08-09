{{-- resources/views/components/dashboard-auditee/grafik-ami.blade.php --}}
@props([
    'labels' => [],
    'chartSeries' => [],
])

<div class="rounded-xl bg-white dark:bg-[#0f172a] p-5 shadow-sm transition-colors duration-300">
    <div class="mb-3 flex flex-wrap items-center justify-between">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Grafik Nilai AMI per Standar</h2>
        </div>
        <div class="flex gap-2">
            <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300">
                Radar
            </span>
        </div>
    </div>

    <div id="amiChart" class="w-full h-[460px]"></div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const chartDom = document.getElementById('amiChart');
    let chart;

    // -------------------- Tema & Warna --------------------
    function getThemeColors() {
        const isDark = document.documentElement.classList.contains('dark');

        return {
            textColor: isDark ? '#e5e7eb' : '#1f2937',
            axisNameColor: isDark ? '#d1d5db' : '#374151',
            axisLabelColor: isDark ? '#9ca3af' : '#6b7280',
            splitLineColor: isDark ? 'rgba(255,255,255,.18)' : 'rgba(0,0,0,.12)',
            axisLineColor: isDark ? 'rgba(255,255,255,.25)' : 'rgba(0,0,0,.20)',
            splitAreaLight: isDark ? 'rgba(255,255,255,.02)' : 'rgba(0,0,0,.02)',
            splitAreaDark: isDark ? 'rgba(255,255,255,.05)' : 'rgba(0,0,0,.05)',
            tooltipBg: isDark ? '#1f2937' : '#ffffff',
            tooltipBorder: isDark ? '#374151' : '#e5e7eb',
            tooltipText: isDark ? '#ffffff' : '#1f2937',
            legendText: isDark ? '#e5e7eb' : '#1f2937',
        };
    }

    // -------------------- Render Chart --------------------
    function renderChart() {
        if (chart) {
            chart.dispose();
        }

        chart = echarts.init(chartDom);

        const colors = getThemeColors();

        const labels = @json($labels);
        const chartSeries = @json($chartSeries);
        const colorMap = {
            'Auditor': '#4FC3F7',
            'Unit Kerja': '#FFB74D',
            'Auditee': '#EF5350',
        };
        const radarData = [];

        chartSeries.forEach(series => {

            switch (series.name) {

                case 'Auditor':
                    radarData.push({
                        value: series.data,
                        name: 'Auditor',

                        itemStyle: {
                            color: '#fff',
                            borderColor: '#4FC3F7',
                            borderWidth: 2
                        },

                        lineStyle: {
                            color: '#4FC3F7',
                            width: 3
                        },

                        areaStyle: {
                            opacity: 0.45,
                            color: '#4FC3F7'
                        },

                        label: {
                            color: '#4FC3F7'
                        }
                    });
                    break;

                case 'Unit Kerja':
                    radarData.push({
                        value: series.data,
                        name: 'Unit Kerja',

                        itemStyle: {
                            color: '#fff',
                            borderColor: '#FFB74D',
                            borderWidth: 2
                        },

                        lineStyle: {
                            color: '#FFB74D',
                            width: 3
                        },

                        areaStyle: {
                            opacity: 0.45,
                            color: '#FFB74D'
                        },

                        label: {
                            color: '#FFB74D'
                        }
                    });
                    break;

                case 'Auditee':
                    radarData.push({
                        value: series.data,
                        name: 'Auditee',

                        itemStyle: {
                            color: '#fff',
                            borderColor: '#EF5350',
                            borderWidth: 2
                        },

                        lineStyle: {
                            color: '#EF5350',
                            width: 3
                        },

                        areaStyle: {
                            opacity: 0.45,
                            color: '#EF5350'
                        },

                        label: {
                            color: '#EF5350'
                        }
                    });
                    break;
            }

        });

        chart.setOption({

            backgroundColor: 'transparent',

            color: ['#3b82f6', '#eab308', '#ef4444'],

            legend: {
                data: chartSeries.map(item => item.name),
                bottom: 0,
                icon: 'roundRect',
                itemWidth: 14,
                itemHeight: 14,
                textStyle: {
                    color: colors.legendText,
                    fontSize: 12
                }
            },

            tooltip: {
                trigger: 'item',
                backgroundColor: colors.tooltipBg,
                borderColor: colors.tooltipBorder,
                textStyle: { color: colors.tooltipText },
                formatter(params) {
                    const idx = params.dataIndex;
                    return `
                        <b>${labels[idx]}</b><br><br>
                        ${params.seriesName} :
                        <b>${params.value[idx]}</b>
                    `;
                }
            },

            radar: {
            shape: 'polygon',

            center: ['50%', '47%'],

            radius: '60%', // <-- sebelumnya 55%

            splitNumber: 4,

            axisName: {
                color: colors.axisNameColor,
                fontWeight: 'bold',
                fontSize: 12,
                formatter(value) {
                    const words = value.split(' ');
                    let lines = [];
                    let current = '';

                    words.forEach(word => {
                        if ((current + ' ' + word).trim().length > 18) {
                            lines.push(current.trim());
                            current = word;
                        } else {
                            current += ' ' + word;
                        }
                    });

                    if (current) lines.push(current.trim());

                    return lines.join('\n');
                }
            },

            axisLabel: {
                show: false
            },

            splitLine: {
                lineStyle: {
                    color: document.documentElement.classList.contains('dark')
                        ? 'rgba(255,255,255,.15)'
                        : '#d9d9d9',
                    width: 1.2
                }
            },

            splitArea: {
                show: true,
                areaStyle: {
                    color: document.documentElement.classList.contains('dark')
                        ? [
                            'rgba(255,255,255,.02)',
                            'rgba(255,255,255,.05)',
                            'rgba(255,255,255,.02)',
                            'rgba(255,255,255,.05)'
                        ]
                        : [
                            '#ffffff',
                            '#f5f5f5',
                            '#ffffff',
                            '#f5f5f5'
                        ]
                }
            },

            axisLine: {
                lineStyle: {
                    color: document.documentElement.classList.contains('dark')
                        ? 'rgba(255,255,255,.15)'
                        : '#d9d9d9'
                }
            },

            indicator: labels.map(label => ({
                name: label,
                max: 4
            }))
        },

        series: [
        {
            type: 'radar',

            symbol: 'circle',

            symbolSize: 8,

            label: {
                show: true,
                fontSize: 11,
                fontWeight: 'bold'
            },

            data: radarData

        }
        
        ]

                });

                chart.resize();
            }

            // -------------------- Inisialisasi --------------------
            renderChart();

            // -------------------- Resize --------------------
            window.addEventListener('resize', () => {
                if (chart) chart.resize();
            });

            // -------------------- Deteksi Perubahan Tema --------------------
            const observer = new MutationObserver(() => {
                renderChart();
            });

            observer.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['class']
            });

        });
</script>
@endpush