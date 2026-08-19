<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Kema 3 - Jaga 4</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<body class="bg-gradient-to-br from-purple-50 to-purple-200 min-h-screen px-4 py-8">
  <div class="w-full max-w-6xl mx-auto bg-white rounded-3xl shadow-2xl p-8">
    <h1 class="text-4xl font-extrabold text-purple-700 mb-10 text-center drop-shadow">
    Visualisasi Data Kema 3 <br /> Jaga 4
    </h1>
    <!-- Jumlah penduduk & Jumlah Keluarga -->
    @include('guest.stat-penduduk')
    

    <!-- Map -->
    @include('guest.map')

    <!-- Statistik Gender -->
    @include('guest.stat-gender')

    <!-- Statistik Usia -->
    @include('guest.stat-usia')
    <!-- Statistik Pendidikan -->
    @include('guest.stat-pendidikan')
    <!-- Statistik Pekerjaan -->
    @include('guest.stat-pekerjaan') 
    

    <footer class="mt-8 pt-4 border-t border-purple-200 text-center text-sm text-purple-700">
      Created by <a href="https://mrizkysaria.netlify.app" target="_blank" rel="noopener noreferrer" class="text-purple-700 hover:text-purple-900 underline">Rizky Saria</a>
    </footer>

  </div>

</body>
</html>
