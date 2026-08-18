<div class="bg-purple-100 rounded-xl p-6 mb-10">
    <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">📊 Statistik Usia</h2>
    <canvas id="usiaChart" class="w-full max-h-[320px]"></canvas>
</div>

<script>
    
    // Usia
    document.addEventListener('DOMContentLoaded', function () {
        const klasifikasi_umur = window.appData?.klasifikasi_umur ?? [0, 0, 0, 0];

        const ctx = document.getElementById('usiaChart');
        if (ctx && window.Chart) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['0–12 (Anak)', '13–18 (Remaja)', '19–59 (Dewasa)', '60+ (Lansia)'],
                    datasets: [{
                        label: 'Jumlah',
                        data: klasifikasi_umur,
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