<div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-2xl p-8 mb-10 shadow-md">
    <div class="flex items-center gap-3 mb-6">
        <span class="text-3xl">👥</span>
        <h2 class="text-2xl font-bold text-pink-900">Jenis Kelamin</h2>
    </div>
    
    <div class="flex flex-col items-center">
        <!-- Chart -->
        <div class="relative w-full max-w-[350px] h-[300px] mb-6">
            <canvas id="genderChart"></canvas>
        </div>
        
        <!-- Info Badge -->
        <div class="flex gap-8 flex-wrap justify-center">
            <div class="text-center">
                <p class="text-sm text-pink-700 font-medium">👨 Pria</p>
                <p class="text-3xl font-bold text-blue-600">{{ $resident->getGender('laki-laki')->count() }}</p>
                <p class="text-xs text-pink-600 mt-1">{{ $resident->getGenderPercentage('laki-laki') }}%</p>
            </div>
            <div class="text-center">
                <p class="text-sm text-pink-700 font-medium">👩 Wanita</p>
                <p class="text-3xl font-bold text-pink-600">{{ $resident->getGender('perempuan')->count() }}</p>
                <p class="text-xs text-pink-600 mt-1">{{ $resident->getGenderPercentage('perempuan') }}%</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const maleCount = {{ $resident->getGender('laki-laki')->count() }};
        const femaleCount = {{ $resident->getGender('perempuan')->count() }};
        
        const ctx = document.getElementById('genderChart');
        if (ctx && window.Chart) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['👨 Pria', '👩 Wanita'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [maleCount, femaleCount],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.9)',
                            'rgba(236, 72, 153, 0.9)'
                        ],
                        borderColor: [
                            'rgb(59, 130, 246)',
                            'rgb(236, 72, 153)'
                        ],
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