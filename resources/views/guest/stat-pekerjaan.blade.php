@php
    $occupationGroup = $resident->occupation_group();
@endphp

<div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 mb-10 shadow-md">
    <div class="flex items-center gap-3 mb-6">
        <span class="text-3xl">🛠️</span>
        <h2 class="text-2xl font-bold text-green-900">Statistik Pekerjaan</h2>
    </div>
    
    @if ($occupationGroup->isEmpty())
        <p class="text-center text-gray-500 py-8">Data pekerjaan belum tersedia</p>
    @else
        <div class="relative w-full h-[400px]">
            <canvas id="pekerjaanChart"></canvas>
        </div>
    @endif
</div>

@if (!$occupationGroup->isEmpty())
<script>
    var occupation_group = @json($occupationGroup);
    
    document.addEventListener('DOMContentLoaded', function () {
        const lebel_pekerjaan = Object.keys(occupation_group);
        const value_pekerjaan = Object.values(occupation_group);

        const ctx = document.getElementById('pekerjaanChart');
        if (ctx && window.Chart) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: lebel_pekerjaan,
                    datasets: [{
                        label: 'Jumlah Orang',
                        data: value_pekerjaan,
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.9)',
                            'rgba(34, 197, 94, 0.9)',
                            'rgba(168, 85, 247, 0.9)',
                            'rgba(249, 115, 22, 0.9)',
                            'rgba(236, 72, 153, 0.9)',
                            'rgba(14, 165, 233, 0.9)',
                            'rgba(245, 158, 11, 0.9)',
                            'rgba(79, 70, 229, 0.9)'
                        ],
                        borderColor: 'rgba(255, 255, 255, 1)',
                        borderWidth: 3,
                        hoverBorderWidth: 5,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: { size: 13, weight: '500' },
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 13 },
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed + ' orang';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endif