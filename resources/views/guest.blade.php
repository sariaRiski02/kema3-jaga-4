<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Visualisasi Data Desa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gradient-to-br from-purple-50 to-purple-200 min-h-screen px-4 py-8">

  <div class="w-full max-w-6xl mx-auto bg-white rounded-3xl shadow-2xl p-8">
    <h1 class="text-4xl font-extrabold text-purple-700 mb-10 text-center drop-shadow">🌾 Visualisasi Data Kema 3 - Jaga 4 🌾</h1>

    <!-- Statistik Umum -->
    <div class="grid grid-cols-1 sm:grid-cols-1 gap-6 mb-10">
      <div class="bg-purple-100 rounded-xl p-6 text-center">
        <p class="text-5xl font-bold text-purple-800">1.234</p>
        <p class="text-purple-600 mt-2 text-lg">Penduduk</p>
      </div>
    </div>

    <!-- Statistik Gender -->
    <div class="bg-purple-200 rounded-xl p-6 mb-10">
      <h2 class="text-2xl font-semibold text-purple-900 mb-6 text-center">Statistik Gender</h2>
      <div class="flex justify-center gap-12">
        <div class="flex flex-col items-center">
          <div class="w-20 h-20 bg-purple-500 text-white text-3xl font-bold rounded-full flex items-center justify-center shadow-md">60%</div>
          <p class="mt-3 text-lg text-purple-700">Pria</p>
        </div>
        <div class="flex flex-col items-center">
          <div class="w-20 h-20 bg-purple-400 text-white text-3xl font-bold rounded-full flex items-center justify-center shadow-md">40%</div>
          <p class="mt-3 text-lg text-purple-700">Wanita</p>
        </div>
      </div>
    </div>

    <!-- Statistik Usia -->
    <div class="bg-purple-100 rounded-xl p-6 mb-10">
      <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">📊 Statistik Usia</h2>
      <canvas id="usiaChart" class="w-full max-h-[320px]"></canvas>
    </div>

    <!-- Statistik Kepadatan Penduduk -->
    <div class="bg-purple-200 rounded-xl p-6 mb-10">
        <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">🏘️ Tingkat Kepadatan Penduduk</h2>
        <div class="flex flex-col items-center">
            <div class="w-32 h-32 bg-purple-500 text-white text-2xl font-bold rounded-full flex items-center justify-center shadow-lg mb-4">
                412/km²
            </div>
            <p class="text-lg text-purple-700">Kepadatan rata-rata per kilometer persegi</p>
        </div>
    </div>

    <!-- Statistik Pendidikan -->
    <div class="bg-purple-100 rounded-xl p-6 mb-10">
      <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">📘 Statistik Pendidikan</h2>
      <canvas id="pendidikanChart" class="w-full max-h-[320px]"></canvas>
    </div>

    <!-- Statistik Pekerjaan -->
    <div class="bg-purple-100 rounded-xl p-6 mb-10">
      <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">🛠️ Statistik Pekerjaan</h2>
      <canvas id="pekerjaanChart" class="w-full max-h-[320px]"></canvas>
    </div>

    <!-- Statistik Usaha -->
    <div class="bg-purple-100 rounded-xl p-6 mb-10">
      <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">💼 Statistik Jenis Usaha</h2>
      <canvas id="usahaChart" class="w-full max-h-[320px]"></canvas>
    </div>

    <!-- Statistik Bahan Bakar -->
    <div class="bg-purple-100 rounded-xl p-6 mb-10">
      <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">🔥 Sumber Bahan Bakar</h2>
      <canvas id="bahanChart" class="w-full max-h-[320px]"></canvas>
    </div>

    <!-- Statistik Kendaraan -->
    <div class="bg-purple-100 rounded-xl p-6 mb-10">
      <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">🚗 Statistik Kendaraan</h2>
      <canvas id="kendaraanChart" class="w-full max-h-[320px]"></canvas>
    </div>

    <!-- Statistik Elektronik -->
    <div class="bg-purple-100 rounded-xl p-6 mb-10">
    <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">📺 Kepemilikan Elektronik</h2>
    <canvas id="elektronikChart" class="w-full max-h-[320px]"></canvas>
    </div>

    <!-- Statistik Ternak -->
    <div class="bg-purple-100 rounded-xl p-6 mb-10">
    <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">🐄 Kepemilikan Ternak</h2>
    <canvas id="ternakChart" class="w-full max-h-[320px]"></canvas>
    </div>

    <!-- Statistik Rumah -->
    <div class="bg-purple-100 rounded-xl p-6 mb-10">
    <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">🏠 Kepemilikan Rumah</h2>
    <canvas id="statusRumahChart" class="w-full max-h-[280px] mb-6"></canvas>
    <canvas id="tipeRumahChart" class="w-full max-h-[280px]"></canvas>
    </div>

    <!-- Statistik Tanah -->
    <div class="bg-purple-100 rounded-xl p-6 mb-10">
    <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">🌿 Kepemilikan Tanah</h2>
    <canvas id="tanahChart" class="w-full max-h-[320px] mb-4"></canvas>
    <p class="text-center text-lg text-purple-800 font-semibold">Total Luas: <span class="text-purple-600">1234 m²</span></p>
    </div>

    <!-- Peta Desa -->
    <div class="bg-purple-100 rounded-xl p-6">
      <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">🗺️ Peta Desa (Ilustrasi)</h2>
      <div class="w-full h-52 bg-gradient-to-r from-purple-300 to-purple-500 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-inner">
        [Peta Desa Placeholder]
      </div>
    </div>
  </div>

  <!-- Chart.js Scripts -->
  <script>
    new Chart(document.getElementById("usiaChart"), {
      type: "bar",
      data: {
        labels: ["0–12 (Anak)", "13–18 (Remaja)", "19–59 (Dewasa)", "60+ (Lansia)"],
        datasets: [{
          label: "Jumlah",
          data: [200, 150, 600, 100],
          backgroundColor: ["#c084fc", "#a78bfa", "#8b5cf6", "#7c3aed"]
        }]
      },
      options: { responsive: true, maintainAspectRatio: false }
    });

    new Chart(document.getElementById("pendidikanChart"), {
      type: "pie",
      data: {
        labels: ["Tidak Sekolah", "SD", "SMP", "SMA", "Sarjana"],
        datasets: [{
          data: [50, 300, 250, 150, 50],
          backgroundColor: ["#fcd34d", "#fbbf24", "#f59e0b", "#d97706", "#b45309"]
        }]
      },
      options: { responsive: true, maintainAspectRatio: false }
    });

    new Chart(document.getElementById("pekerjaanChart"), {
      type: "bar",
      data: {
        labels: ["Petani", "Nelayan", "Pedagang", "Guru", "Lainnya"],
        datasets: [{
          label: "Jumlah",
          data: [200, 120, 180, 40, 90],
          backgroundColor: ["#34d399", "#22c55e", "#10b981", "#0ea5e9", "#6366f1"]
        }]
      },
      options: { responsive: true, maintainAspectRatio: false }
    });

    new Chart(document.getElementById("usahaChart"), {
      type: "bar",
      data: {
        labels: ["Warung", "Tani", "Jasa", "Online", "Lainnya"],
        datasets: [{
          label: "Jumlah",
          data: [100, 80, 60, 30, 20],
          backgroundColor: ["#fbbf24", "#f59e0b", "#ef4444", "#8b5cf6", "#10b981"]
        }]
      },
      options: { responsive: true, maintainAspectRatio: false }
    });

    new Chart(document.getElementById("bahanChart"), {
      type: "pie",
      data: {
        labels: ["Kayu Bakar", "Gas", "Minyak Tanah"],
        datasets: [{
          data: [100, 200, 50],
          backgroundColor: ["#d97706", "#facc15", "#fb923c"]
        }]
      },
      options: { responsive: true, maintainAspectRatio: false }
    });

    new Chart(document.getElementById("kendaraanChart"), {
      type: "bar",
      data: {
        labels: ["Motor", "Mobil Roda 4", "Bus"],
        datasets: [{
          label: "Jumlah",
          data: [400, 150, 20],
          backgroundColor: ["#4ade80", "#60a5fa", "#818cf8"]
        }]
      },
      options: { responsive: true, maintainAspectRatio: false }
    });

    // Elektronik
new Chart(document.getElementById("elektronikChart"), {
  type: "bar",
  data: {
    labels: ["TV", "Kulkas", "HP", "Komputer", "Lainnya"],
    datasets: [{
      label: "Jumlah",
      data: [300, 250, 700, 100, 50],
      backgroundColor: ["#4ade80", "#60a5fa", "#f472b6", "#818cf8", "#facc15"]
    }]
  },
  options: { responsive: true, maintainAspectRatio: false }
});

// Ternak
new Chart(document.getElementById("ternakChart"), {
  type: "bar",
  data: {
    labels: ["Sapi", "Kambing", "Ayam", "Bebek"],
    datasets: [{
      label: "Jumlah",
      data: [80, 120, 300, 90],
      backgroundColor: ["#f87171", "#fb923c", "#facc15", "#34d399"]
    }]
  },
  options: { responsive: true, maintainAspectRatio: false }
});

// Rumah
new Chart(document.getElementById("statusRumahChart"), {
  type: "pie",
  data: {
    labels: ["Milik Sendiri", "Sewa", "Kontrak", "Numpang"],
    datasets: [{
      data: [500, 100, 50, 20],
      backgroundColor: ["#34d399", "#60a5fa", "#fbbf24", "#a78bfa"]
    }]
  },
  options: { responsive: true, maintainAspectRatio: false }
});
new Chart(document.getElementById("tipeRumahChart"), {
  type: "pie",
  data: {
    labels: ["Permanen", "Semi Permanen", "Non Permanen"],
    datasets: [{
      data: [400, 200, 70],
      backgroundColor: ["#8b5cf6", "#f59e0b", "#fca5a5"]
    }]
  },
  options: { responsive: true, maintainAspectRatio: false }
});

// Tanah
new Chart(document.getElementById("tanahChart"), {
  type: "bar",
  data: {
    labels: ["SHM", "Girik", "Sewa", "Lainnya"],
    datasets: [{
      label: "Jumlah",
      data: [150, 80, 40, 30],
      backgroundColor: ["#fbbf24", "#f59e0b", "#ef4444", "#10b981"]
    }]
  },
  options: { responsive: true, maintainAspectRatio: false }
});

  </script>
</body>
</html>
