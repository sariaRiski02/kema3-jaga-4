@extends('dashboard.main')

@section('content')
  <div class="relative overflow-hidden rounded-2xl bg-linear-to-br from-purple-800 via-purple-700 to-indigo-700 px-5 py-6 sm:px-8 sm:py-8 mb-8 text-white shadow-lg">
    <div class="relative z-10 max-w-2xl">
      <p class="text-sm font-semibold uppercase tracking-[0.18em] text-purple-200">Ringkasan Jaga 4</p>
      <h2 class="text-2xl lg:text-3xl font-bold mt-2 mb-2">Baku Dapa Ulang! 👋</h2>
      <div class="flex flex-col sm:flex-row sm:items-center gap-3 mt-4">
        <p class="text-sm sm:text-base text-purple-100">Pantau data warga dan keluarga dari satu tempat.</p>
        <a href="{{ route('dashboard.export') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-white/15 px-4 py-2 text-sm font-semibold text-white ring-1 ring-white/25 transition hover:bg-white/25">
          <span>↓</span>
          <span>Unduh Ringkasan</span>
        </a>
      </div>
    </div>
    <div class="absolute -right-12 -top-16 h-48 w-48 rounded-full border-24 border-white/10"></div>
    <div class="absolute -bottom-24 right-24 h-44 w-44 rounded-full border-18 border-white/10"></div>
  </div>

  <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5 mb-6">
    @foreach ([
      ['label' => 'Penduduk Aktif', 'value' => $stats['total_active'], 'icon' => '👥', 'tone' => 'purple'],
      ['label' => 'Total Keluarga', 'value' => $stats['total_families'], 'icon' => '🏠', 'tone' => 'indigo'],
      ['label' => 'Laki-laki', 'value' => $stats['male'], 'icon' => '👦', 'tone' => 'sky'],
      ['label' => 'Perempuan', 'value' => $stats['female'], 'icon' => '👧', 'tone' => 'pink'],
    ] as $card)
      <div class="group bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm hover:-translate-y-0.5 hover:shadow-md transition-all">
        <div class="flex items-center justify-between gap-3">
          <div>
            <h3 class="text-xs sm:text-sm font-semibold uppercase tracking-wide text-gray-500">{{ $card['label'] }}</h3>
            <p class="text-2xl sm:text-4xl font-bold text-gray-900 mt-2">{{ $card['value'] }}</p>
          </div>
          <div class="h-10 w-10 sm:h-12 sm:w-12 rounded-xl bg-{{ $card['tone'] }}-50 flex items-center justify-center text-xl sm:text-2xl group-hover:scale-105 transition-transform">{{ $card['icon'] }}</div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5 mb-8">
    @foreach ([
      ['label' => 'Masih Hidup', 'value' => $stats['alive'], 'color' => 'green'],
      ['label' => 'Meninggal', 'value' => $stats['deceased'], 'color' => 'gray'],
      ['label' => 'Belum Terhubung Keluarga', 'value' => $stats['without_family'], 'color' => 'amber'],
      ['label' => 'Seluruh Riwayat Data', 'value' => $stats['total_recorded'], 'color' => 'blue'],
    ] as $card)
      <div class="bg-white border-l-4 border-{{ $card['color'] }}-400 p-4 rounded-xl shadow-sm">
        <p class="text-xs sm:text-sm font-semibold text-gray-500">{{ $card['label'] }}</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $card['value'] }}</p>
      </div>
    @endforeach
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Kelompok Umur -->
    <section class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl border border-blue-200 shadow-md p-5 sm:p-6">
      <div class="flex items-center justify-between gap-3 mb-6">
        <div>
          <h3 class="text-lg font-bold text-blue-900">👶 Kelompok Umur</h3>
          <p class="text-xs text-blue-700 mt-1">Distribusi populasi berdasarkan usia</p>
        </div>
        <span class="text-2xl">📊</span>
      </div>
      <div class="space-y-4">
        @forelse ($stats['age_groups'] as $label => $count)
          @php
            $totalCount = $stats['age_groups']->sum();
            $percentage = $totalCount > 0 ? ($count / $totalCount) * 100 : 0;
            $colorBg = match($label) {
              'Anak-anak (0-12 tahun)' => '#3b82f6',
              'Remaja (13-17 tahun)' => '#22c55e',
              'Dewasa (18-59 tahun)' => '#a855f7',
              'Lansia (60+ tahun)' => '#f97316',
              default => '#9ca3af'
            };
          @endphp
          <div>
            <div class="flex items-center justify-between gap-2 mb-2">
              <span class="text-sm font-semibold text-blue-900">{{ $label }}</span>
              <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-white text-sm font-bold text-blue-700">
                {{ $count }} <span class="text-xs text-gray-500">{{ number_format($percentage, 1) }}%</span>
              </span>
            </div>
            <div class="h-3 bg-white rounded-full overflow-hidden shadow-sm">
              <div class="h-full rounded-full transition-all duration-500" style="width: {{ $percentage }}%; background-color: {{ $colorBg }};"></div>
            </div>
          </div>
        @empty
          <p class="text-sm text-blue-600">Belum ada data kelompok umur.</p>
        @endforelse
      </div>
    </section>

    <!-- Agama -->
    <section class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-2xl border border-amber-200 shadow-md p-5 sm:p-6">
      <div class="flex items-center justify-between gap-3 mb-6">
        <div>
          <h3 class="text-lg font-bold text-amber-900">🙏 Agama</h3>
          <p class="text-xs text-amber-700 mt-1">Keragaman agama di wilayah</p>
        </div>
        <span class="text-2xl">⛪</span>
      </div>
      <div class="space-y-3">
        @forelse ($stats['religions'] as $label => $count)
          <div class="flex items-center justify-between gap-4 p-3 bg-white rounded-xl shadow-sm hover:shadow-md transition">
            <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
            <span class="inline-flex items-center justify-center min-w-10 h-10 rounded-lg bg-amber-100 font-bold text-amber-700">{{ $count }}</span>
          </div>
        @empty
          <p class="text-sm text-amber-600">Belum ada data agama.</p>
        @endforelse
      </div>
    </section>

    <!-- Status Perkawinan -->
    <section class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-2xl border border-pink-200 shadow-md p-5 sm:p-6">
      <div class="flex items-center justify-between gap-3 mb-6">
        <div>
          <h3 class="text-lg font-bold text-pink-900">💍 Status Perkawinan</h3>
          <p class="text-xs text-pink-700 mt-1">Komposisi status perkawinan</p>
        </div>
        <span class="text-2xl">👰</span>
      </div>
      <div class="space-y-3">
        @forelse ($stats['marital_status'] as $label => $count)
          <div class="flex items-center justify-between gap-4 p-3 bg-white rounded-xl shadow-sm hover:shadow-md transition">
            <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
            <span class="inline-flex items-center justify-center min-w-10 h-10 rounded-lg bg-pink-100 font-bold text-pink-700">{{ $count }}</span>
          </div>
        @empty
          <p class="text-sm text-pink-600">Belum ada data status perkawinan.</p>
        @endforelse
      </div>
    </section>

    <!-- Pekerjaan -->
    <section class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl border border-green-200 shadow-md p-5 sm:p-6">
      <div class="flex items-center justify-between gap-3 mb-6">
        <div>
          <h3 class="text-lg font-bold text-green-900">🛠️ Pekerjaan</h3>
          <p class="text-xs text-green-700 mt-1">Jenis pekerjaan penduduk</p>
        </div>
        <span class="text-2xl">💼</span>
      </div>
      <div class="space-y-3">
        @forelse ($stats['occupations'] as $label => $count)
          <div class="flex items-center justify-between gap-4 p-3 bg-white rounded-xl shadow-sm hover:shadow-md transition">
            <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
            <span class="inline-flex items-center justify-center min-w-10 h-10 rounded-lg bg-green-100 font-bold text-green-700">{{ $count }}</span>
          </div>
        @empty
          <p class="text-sm text-green-600">Belum ada data pekerjaan.</p>
        @endforelse
      </div>
    </section>

    <!-- Pendidikan -->
    <section class="lg:col-span-2 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl border border-indigo-200 shadow-md p-5 sm:p-6">
      <div class="flex items-center justify-between gap-3 mb-6">
        <div>
          <h3 class="text-lg font-bold text-indigo-900">📚 Pendidikan</h3>
          <p class="text-xs text-indigo-700 mt-1">Tingkat pendidikan penduduk</p>
        </div>
        <span class="text-2xl">🎓</span>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Sedang Bersekolah -->
        <div>
          <h4 class="text-sm font-bold uppercase tracking-wide text-blue-700 mb-4 flex items-center gap-2">
            <span class="inline-block w-2 h-2 rounded-full bg-blue-500"></span>
            Sedang bersekolah
          </h4>
          <div class="space-y-3">
            @forelse ($stats['education']['sedang_sekolah'] as $label => $count)
              <div class="flex items-center justify-between gap-3 p-2 bg-white rounded-lg hover:shadow-sm transition">
                <span class="text-sm text-gray-700">{{ $label }}</span>
                <span class="inline-flex items-center justify-center min-w-8 h-8 rounded-lg bg-blue-100 text-xs font-bold text-blue-700">{{ $count }}</span>
              </div>
            @empty
              <p class="text-sm text-blue-600">Belum ada data.</p>
            @endforelse
          </div>
        </div>

        <!-- Sudah Lulus -->
        <div>
          <h4 class="text-sm font-bold uppercase tracking-wide text-green-700 mb-4 flex items-center gap-2">
            <span class="inline-block w-2 h-2 rounded-full bg-green-500"></span>
            Sudah lulus
          </h4>
          <div class="space-y-3">
            @forelse ($stats['education']['sudah_lulus'] as $label => $count)
              <div class="flex items-center justify-between gap-3 p-2 bg-white rounded-lg hover:shadow-sm transition">
                <span class="text-sm text-gray-700">{{ $label }}</span>
                <span class="inline-flex items-center justify-center min-w-8 h-8 rounded-lg bg-green-100 text-xs font-bold text-green-700">{{ $count }}</span>
              </div>
            @empty
              <p class="text-sm text-green-600">Belum ada data.</p>
            @endforelse
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
