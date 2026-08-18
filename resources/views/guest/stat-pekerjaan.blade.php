<div class="bg-purple-100 rounded-xl p-6 mb-10">
    <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">🛠️ Statistik Pekerjaan</h2>
    <canvas id="pekerjaanChart" class="w-full max-h-[320px]"></canvas>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lebel_pekerjaan = window.appData?.lebel_pekerjaan ?? [];
        const value_pekerjaan = window.appData?.value_pekerjaan ?? [];

        const ctx = document.getElementById('pekerjaanChart');
        if (ctx && window.Chart) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: lebel_pekerjaan,
                    datasets: [{
                        label: 'Jumlah',
                        data: value_pekerjaan,
                        backgroundColor: ['#a78bfa', '#34d399', '#fbbf24', '#60a5fa', '#f472b6', '#fca5a5']
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