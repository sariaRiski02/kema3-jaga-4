@php
    $ageClasification = $resident->age_clasification();
    $ageTotal = array_sum($ageClasification);
@endphp

<div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 mb-10 shadow-md">
    <div class="flex items-center gap-3 mb-6">
        <span class="text-3xl">👶</span>
        <h2 class="text-2xl font-bold text-blue-900">Statistik Usia</h2>
    </div>
    
    @if ($ageTotal == 0)
        <p class="text-center text-gray-500 py-8">Data usia belum tersedia</p>
    @else
        <div class="relative w-full h-[400px]">
            <canvas id="usiaChart"></canvas>
        </div>
    @endif
</div>

@if ($ageTotal > 0)
<script>
    var age_clasification = @json($ageClasification);
    
    document.addEventListener('DOMContentLoaded', function () {
        var ages = [
            age_clasification['0-12'] ?? 0,
            age_clasification['13-17'] ?? 0,
            age_clasification['18-59'] ?? 0,
            age_clasification['60+'] ?? 0
        ];
        
        const ctx = document.getElementById('usiaChart');
        if (ctx && window.Chart) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['👶 Anak\n(0–12)', '🧒 Remaja\n(13–17)', '👨 Dewasa\n(18–59)', '👴 Lansia\n(60+)'],
                    datasets: [{
                        label: 'Jumlah Orang',
                        data: ages,
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(34, 197, 94, 0.8)', 
                            'rgba(168, 85, 247, 0.8)',
                            'rgba(249, 115, 22, 0.8)'
                        ],
                        borderColor: [
                            'rgb(59, 130, 246)',
                            'rgb(34, 197, 94)',
                            'rgb(168, 85, 247)',
                            'rgb(249, 115, 22)'
                        ],
                        borderWidth: 2,
                        borderRadius: 8,
                        hoverBackgroundColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(34, 197, 94, 1)',
                            'rgba(168, 85, 247, 1)',
                            'rgba(249, 115, 22, 1)'
                        ]
                    }]
                },
                options: {
                    indexAxis: 'x',
                    responsive: true,
                    maintainAspectRatio: false,
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
                                    return context.parsed.y + ' orang';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
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