@php
    $educationGroup = $resident->education_group();
@endphp

<div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-2xl p-8 mb-10 shadow-md">
    <div class="flex items-center gap-3 mb-6">
        <span class="text-3xl">📚</span>
        <h2 class="text-2xl font-bold text-amber-900">Statistik Pendidikan</h2>
    </div>
    
    @if ($educationGroup->isEmpty())
        <p class="text-center text-gray-500 py-8">Data pendidikan belum tersedia</p>
    @else
        <div class="relative w-full h-[400px]">
            <canvas id="pendidikanChart"></canvas>
        </div>
    @endif
</div>

@if (!$educationGroup->isEmpty())
<script>
    var residentData = @json($educationGroup);
    
    document.addEventListener('DOMContentLoaded', function () {
        const lebel_pendidikan = Object.keys(residentData);
        const value_pendidikan = Object.values(residentData);

        const ctx = document.getElementById('pendidikanChart');
        if (ctx && window.Chart) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: lebel_pendidikan,
                    datasets: [{
                        label: 'Jumlah Orang',
                        data: value_pendidikan,
                        backgroundColor: [
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(249, 115, 22, 0.8)',
                            'rgba(251, 191, 36, 0.8)',
                            'rgba(34, 197, 94, 0.8)',
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(79, 70, 229, 0.8)',
                            'rgba(139, 92, 246, 0.8)',
                            'rgba(236, 72, 153, 0.8)',
                            'rgba(14, 165, 233, 0.8)',
                            'rgba(245, 158, 11, 0.8)'
                        ],
                        borderColor: [
                            'rgb(239, 68, 68)',
                            'rgb(249, 115, 22)',
                            'rgb(251, 191, 36)',
                            'rgb(34, 197, 94)',
                            'rgb(59, 130, 246)',
                            'rgb(79, 70, 229)',
                            'rgb(139, 92, 246)',
                            'rgb(236, 72, 153)',
                            'rgb(14, 165, 233)',
                            'rgb(245, 158, 11)'
                        ],
                        borderWidth: 2,
                        borderRadius: 8,
                        hoverBackgroundColor: [
                            'rgba(239, 68, 68, 1)',
                            'rgba(249, 115, 22, 1)',
                            'rgba(251, 191, 36, 1)',
                            'rgba(34, 197, 94, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(79, 70, 229, 1)',
                            'rgba(139, 92, 246, 1)',
                            'rgba(236, 72, 153, 1)',
                            'rgba(14, 165, 233, 1)',
                            'rgba(245, 158, 11, 1)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 13 },
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.x + ' orang';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endif