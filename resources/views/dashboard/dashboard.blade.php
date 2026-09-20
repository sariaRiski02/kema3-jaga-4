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
    @foreach ([
      ['title' => 'Kelompok Umur', 'items' => $stats['age_groups']],
      ['title' => 'Agama', 'items' => $stats['religions']],
      ['title' => 'Status Perkawinan', 'items' => $stats['marital_status']],
      ['title' => 'Pekerjaan', 'items' => $stats['occupations']],
    ] as $section)
      <section class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sm:p-6">
        <div class="flex items-center justify-between gap-3 mb-5">
          <h3 class="text-lg font-bold text-gray-900">{{ $section['title'] }}</h3>
          <span class="h-2 w-2 rounded-full bg-purple-500"></span>
        </div>
        <div class="space-y-3">
          @forelse ($section['items'] as $label => $count)
            <div class="flex items-center justify-between gap-4 text-sm border-b border-gray-100 last:border-0 pb-3 last:pb-0">
              <span class="text-gray-600 truncate">{{ $label }}</span>
              <span class="min-w-8 rounded-lg bg-purple-50 px-2 py-1 text-center font-bold text-purple-700">{{ $count }}</span>
            </div>
          @empty
            <p class="text-sm text-gray-400">Belum ada data.</p>
          @endforelse
        </div>
      </section>
    @endforeach

    <section class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sm:p-6">
      <div class="flex items-center justify-between gap-3 mb-5">
        <h3 class="text-lg font-bold text-gray-900">Pendidikan</h3>
        <span class="h-2 w-2 rounded-full bg-green-500"></span>
      </div>

      <h4 class="text-xs font-bold uppercase tracking-wide text-blue-700 mb-3">Sedang bersekolah</h4>
      <div class="space-y-3 mb-6">
        @foreach ($stats['education']['sedang_sekolah'] as $label => $count)
          <div class="flex items-center justify-between gap-4 text-sm border-b border-gray-100 last:border-0 pb-3 last:pb-0">
            <span class="text-gray-600">{{ $label }}</span>
            <span class="min-w-8 rounded-lg bg-blue-50 px-2 py-1 text-center font-bold text-blue-700">{{ $count }}</span>
          </div>
        @endforeach
      </div>

      <h4 class="text-xs font-bold uppercase tracking-wide text-green-700 mb-3">Sudah lulus</h4>
      <div class="space-y-3">
        @forelse ($stats['education']['sudah_lulus'] as $label => $count)
          <div class="flex items-center justify-between gap-4 text-sm border-b border-gray-100 last:border-0 pb-3 last:pb-0">
            <span class="text-gray-600 truncate">{{ $label }}</span>
            <span class="min-w-8 rounded-lg bg-green-50 px-2 py-1 text-center font-bold text-green-700">{{ $count }}</span>
          </div>
        @empty
          <p class="text-sm text-gray-400">Belum ada data pendidikan yang sudah lulus.</p>
        @endforelse
      </div>
    </section>
  </div>
@endsection
