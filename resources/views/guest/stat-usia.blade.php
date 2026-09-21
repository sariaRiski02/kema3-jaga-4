@php
    $ageClasification = $resident->age_clasification();
@endphp

<div class="bg-purple-100 rounded-xl p-6 mb-10">
    <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">📊 Statistik Usia</h2>
    @if ($ageClasification)
        <p class="text-center text-gray-500 py-8">Data usia belum tersedia</p>
    @else
        <canvas id="usiaChart" class="w-full max-h-[320px]"></canvas>
    @endif
</div>

@if (!empty($ageClasification))
<script>
    var age_clasification = @json($ageClasification);
    // Usia
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
                    labels: ['0–12 (Anak)', '13–17 (Remaja)', '18–59 (Dewasa)', '60+ (Lansia)'],
                    datasets: [{
                        label: 'Jumlah',
                        data: ages,
                        backgroundColor: ['#a78bfa', '#f9a8d4', '#60a5fa', '#34d399']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
    });
</script>
@endif