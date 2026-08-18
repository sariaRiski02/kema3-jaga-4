@extends('dashboard.main')


@section('content')

  <!-- Welcome Section -->
    <div id="dashboard" class="mb-8">
      <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-2">Baku Dapa Ulang! 👋</h2>
      <p class="text-gray-600">Kelola data penduduk Desa Kema 3 – Jaga 4 dengan mudah, cepat, dan aman.</p>
    </div>

<!-- Ringkasan Data -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8 sm:mb-10">
      <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md card-hover">
      <div class="flex items-center justify-between">
        <div>
        <h3 class="text-sm sm:text-lg font-semibold mb-1 sm:mb-2 text-purple-700">Jumlah Penduduk Aktif</h3>
        <p class="text-2xl sm:text-4xl font-bold text-purple-900" id="totalPendudukAktif">{{ $penduduk_aktif }}</p>
        </div>
        <div class="text-2xl sm:text-3xl">👥</div>
      </div>
      </div>
      <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md card-hover">
      <div class="flex items-center justify-between">
        <div>
        <h3 class="text-sm sm:text-lg font-semibold mb-1 sm:mb-2 text-purple-700">Total Terdata</h3>
        <p class="text-2xl sm:text-4xl font-bold text-purple-900" id="totalPendudukTerdata">{{ $semua_penduduk }}</p>
        <p class="text-xs text-gray-400 mt-1">Seluruh warga yang pernah tercatat</p>
        </div>
        <div class="text-2xl sm:text-3xl">📋</div>
      </div>
      </div>
      <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md card-hover">
      <div class="flex items-center justify-between">
        <div>
        <h3 class="text-sm sm:text-lg font-semibold mb-1 sm:mb-2 text-purple-700">Jumlah Laki-Laki</h3>
        <p class="text-2xl sm:text-4xl font-bold text-purple-900" id="totalLakiLaki">{{ $laki_laki }}</p>
        </div>
        <div class="text-2xl sm:text-3xl">👦</div>
      </div>
      </div>
      <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md card-hover">
      <div class="flex items-center justify-between">
        <div>
        <h3 class="text-sm sm:text-lg font-semibold mb-1 sm:mb-2 text-purple-700">Jumlah Perempuan</h3>
        <p class="text-2xl sm:text-4xl font-bold text-purple-900" id="totalPerempuan">{{ $perempuan }}</p>
        </div>
        <div class="text-2xl sm:text-3xl">👧</div>
      </div>
      </div>
    </div>

    <!-- Statistik Mini -->
    <div class="bg-purple-100 p-4 sm:p-5 rounded-xl text-center card-hover">
      <div class="text-2xl sm:text-3xl mb-2">🏠</div>
      <h4 class="text-sm sm:text-lg font-semibold text-purple-800 mb-1 sm:mb-2">Jumlah Keluarga</h4>
      <p class="text-2xl sm:text-3xl font-bold text-purple-700" id="totalKeluarga">{{ $keluarga }}</p>      
    </div>

@endsection


