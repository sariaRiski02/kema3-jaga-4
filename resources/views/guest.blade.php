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
    <!-- Jumlah penduduk & Jumlah Keluarga -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
      <div class="bg-purple-100 rounded-xl p-6 text-center">
        <p class="text-5xl font-bold text-purple-800">{{ $penduduk }}</p>
        <p class="text-purple-600 mt-2 text-lg">Penduduk</p>
      </div>
      <div class="bg-purple-100 rounded-xl p-6 text-center">
        <p class="text-5xl font-bold text-purple-800">{{ $kk }}</p>
        <p class="text-purple-600 mt-2 text-lg">Keluarga</p>
      </div>
    </div>

    <!-- Statistik Gender -->
    <div class="bg-purple-200 rounded-xl p-6 mb-10">
      <h2 class="text-2xl font-semibold text-purple-900 mb-6 text-center">Jenis Kelamin</h2>
      <div class="flex flex-col md:flex-row justify-center gap-8 md:gap-12">
        <div class="flex flex-col items-center mb-6 md:mb-0">
          <div class="w-32 h-32 md:w-40 md:h-40 bg-purple-500 text-white text-2xl md:text-3xl font-bold rounded-full flex items-center justify-center shadow-md">
            {{ round($laki_laki/$penduduk * 100,2) }}%
          </div>
          <p class="mt-3 text-lg text-purple-700">Pria</p>
          <p class="text-purple-600 text-base">{{ $laki_laki }} orang</p>
        </div>
        <div class="flex flex-col items-center">
          <div class="w-32 h-32 md:w-40 md:h-40 bg-purple-400 text-white text-2xl md:text-3xl font-bold rounded-full flex items-center justify-center shadow-md">
            {{ round($perempuan/$penduduk * 100,2)  }}%
          </div>
          <p class="mt-3 text-lg text-purple-700">Wanita</p>
          <p class="text-purple-600 text-base">{{ $perempuan }} orang</p>
        </div>
      </div>
    </div>

    <!-- Statistik Usia -->
    <div class="bg-purple-100 rounded-xl p-6 mb-10">
      <h2 class="text-2xl font-semibold text-purple-900 mb-4 text-center">📊 Statistik Usia</h2>
      <canvas id="usiaChart" class="w-full max-h-[320px]"></canvas>
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
  </div>

  <!-- Chart.js Scripts -->
  <script>
      window.appData = {
        penduduk: @json($penduduk),
        kk: @json($kk),
        klasifikasi_umur: @json($klasifikasi_umur),
        laki_laki: @json($laki_laki),
        perempuan: @json($perempuan),
        lebel_pekerjaan: @json($lebel_pekerjaan),
        value_pekerjaan: @json($value_pekerjaan),
        lebel_pendidikan: @json($lebel_pendidikan),
        value_pendidikan: @json($value_pendidikan),
      };
  </script>
  <script src="{{ asset('js/chart.js') }}"></script>
</body>
</html>
