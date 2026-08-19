<!-- Statistik Pendidikan -->
<div class="bg-purple-100 rounded-xl p-6 mb-10">
    <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">📘 Statistik Pendidikan</h2>
    <canvas id="pendidikanChart" class="w-full max-h-[320px]"></canvas>
</div>


<script>
    // Pendidikan
    var residentData = @json($resident->education_group());
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
                        label: 'Jumlah',
                        data: value_pendidikan,
                        backgroundColor: ['#a78bfa', '#60a5fa', '#34d399', '#fbbf24', '#f472b6', '#fca5a5', '#c4b5fd', '#93c5fd', '#86efac', '#f9a8d4']
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