<div class="bg-purple-100 rounded-xl p-6 mb-10">
    <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">🛠️ Statistik Pekerjaan</h2>
    <canvas id="pekerjaanChart" class="w-full max-h-[320px]"></canvas>
</div>



<script>
    var occupation_group = @json($resident->occupation_group());
    document.addEventListener('DOMContentLoaded', function () {

        
        const lebel_pendidikan = Object.keys(occupation_group);
        const value_pendidikan = Object.values(occupation_group);

        const ctx = document.getElementById('pekerjaanChart');
        if (ctx && window.Chart) {
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: lebel_pendidikan,
                    datasets: [{
                        label: 'Jumlah',
                        data: value_pendidikan,
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