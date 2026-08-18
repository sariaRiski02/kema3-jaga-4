@extends('dashboard.main')

@section('content')
<!-- ========================================== -->
<!-- LIHAT DATA WARGA -->
<!-- ========================================== -->
<div id="tabel-daftar" class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12">

  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <h2 class="text-xl sm:text-2xl font-bold text-purple-800 flex items-center gap-2">
      <span>📋</span>
      <span>Daftar Warga</span>
    </h2>
    <a href="{{ route('download-warga') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold flex items-center gap-2 shadow transition-all duration-200 w-fit">
      ⬇️ Download Excel
    </a>
  </div>

  <!-- ===== Search + Filter Toggle ===== -->
  <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-4">
    <!-- Search -->
    <div class="relative flex-1">
      <input
        type="text"
        id="searchInput"
        placeholder="Cari NIK, Nama, atau Tempat Lahir..."
        class="w-full px-4 py-3 pl-12 pr-10 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md"
      />
      <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">🔍</div>
      <button
        id="clearSearch"
        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
        title="Hapus pencarian"
      >✕</button>
    </div>

    <!-- Search Button -->
    <button
      id="searchBtn"
      class="flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-purple-700 text-white font-semibold hover:bg-purple-800 transition-all duration-200 shadow-sm"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
      </svg>
      Cari
    </button>
  </div>

  <!-- ===== Filter Panel (collapsible) ===== -->
  <div id="filterPanel" class="hidden mb-6 p-4 sm:p-5 bg-purple-50 border border-purple-200 rounded-xl">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

      <!-- Jenis Kelamin -->
      <div>
        <label for="filterJenisKelamin" class="block text-xs font-semibold text-purple-700 mb-1 uppercase tracking-wide">Jenis Kelamin</label>
        <select id="filterJenisKelamin" class="filter-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
          <option value="">Semua</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>

      <!-- Tanggal Lahir (Dari) -->
      <div>
        <label for="filterTanggalLahirDari" class="block text-xs font-semibold text-purple-700 mb-1 uppercase tracking-wide">Tanggal Lahir Dari</label>
        <input type="date" id="filterTanggalLahirDari" class="filter-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
      </div>

      <!-- Tanggal Lahir (Sampai) -->
      <div>
        <label for="filterTanggalLahirSampai" class="block text-xs font-semibold text-purple-700 mb-1 uppercase tracking-wide">Tanggal Lahir Sampai</label>
        <input type="date" id="filterTanggalLahirSampai" class="filter-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
      </div>

      <!-- Agama -->
      <div>
        <label for="filterAgama" class="block text-xs font-semibold text-purple-700 mb-1 uppercase tracking-wide">Agama</label>
        <select id="filterAgama" class="filter-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
          <option value="">Semua</option>
          <option value="islam">Islam</option>
          <option value="kristen">Kristen</option>
          <option value="katolik">Katolik</option>
          <option value="hindu">Hindu</option>
          <option value="buddha">Buddha</option>
          <option value="konghucu">Konghucu</option>
          <option value="lainnya">Lainnya</option>
        </select>
      </div>

      <!-- Status Perkawinan -->
      <div>
        <label for="filterStatusPerkawinan" class="block text-xs font-semibold text-purple-700 mb-1 uppercase tracking-wide">Status Perkawinan</label>
        <select id="filterStatusPerkawinan" class="filter-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
          <option value="">Semua</option>
          <option value="Belum Kawin">Belum Kawin</option>
          <option value="Kawin">Kawin</option>
          <option value="Cerai Hidup">Cerai Hidup</option>
          <option value="Cerai Mati">Cerai Mati</option>
        </select>
      </div>

      <!-- Status Dalam Keluarga -->
      <div>
        <label for="filterStatusKeluarga" class="block text-xs font-semibold text-purple-700 mb-1 uppercase tracking-wide">Status Keluarga</label>
        <select id="filterStatusKeluarga" class="filter-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
          <option value="">Semua</option>
          <option value="Kepala Keluarga">Kepala Keluarga</option>
          <option value="Istri">Istri</option>
          <option value="Anak">Anak</option>
          <option value="Orangtua">Orangtua</option>
          <option value="Mertua">Mertua</option>
          <option value="Cucu">Cucu</option>
          <option value="Lainnya">Lainnya</option>
        </select>
      </div>

      <!-- Pendidikan -->
      <div>
        <label for="filterPendidikan" class="block text-xs font-semibold text-purple-700 mb-1 uppercase tracking-wide">Pendidikan</label>
        <select id="filterPendidikan" class="filter-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
          <option value="">Semua</option>
          <option value="Tidak Sekolah">Tidak Sekolah</option>
          <option value="SD/Sederajat">SD/Sederajat</option>
          <option value="SMP/Sederajat">SMP/Sederajat</option>
          <option value="SMA/Sederajat">SMA/Sederajat</option>
          <option value="Diploma">Diploma</option>
          <option value="Sarjana">Sarjana</option>
          <option value="Pascasarjana">Pascasarjana</option>
          <option value="Lainnya">Lainnya</option>
        </select>
      </div>
    </div>

    <!-- Filter Actions -->
    <div class="flex justify-end gap-3 mt-4 pt-4 border-t border-purple-200">
      <button id="resetFilterBtn" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-100 transition-colors duration-200">
        Reset Filter
      </button>
      <button id="applyFilterBtn" class="px-5 py-2 rounded-lg text-sm font-semibold bg-purple-700 text-white hover:bg-purple-800 shadow-md transition-colors duration-200">
        Terapkan Filter
      </button>
    </div>
  </div>

  <!-- Active Filter Chips (diisi via JS ketika filter diterapkan) -->
  <div id="activeFilterChips" class="hidden flex flex-wrap gap-2 mb-4"></div>

  <!-- Mass Delete -->
  <div id="massDeleteWrapper" class="flex justify-between items-center mb-3">
    <button id="btn-hapus-massal" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-full font-bold text-sm shadow-lg transition-all duration-200 flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-red-400" disabled>
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
      Hapus Terpilih
    </button>
    <span id="selectedCount" class="text-sm text-gray-600"></span>
  </div>

  <!-- ===== Tabel ===== -->
  <div class="w-full overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
    <table class="min-w-full text-sm">
      <thead>
        <tr class="bg-purple-50 text-purple-800 text-xs uppercase tracking-wide">
          <th class="px-4 py-3.5 text-center font-semibold w-10">
            <input type="checkbox" id="selectAll" class="w-4 h-4 rounded border-gray-300 accent-purple-700">
          </th>
          <th class="px-4 py-3.5 text-left font-semibold">Nama</th>
          <th class="px-4 py-3.5 text-left font-semibold">NIK</th>
          <th class="px-4 py-3.5 text-left font-semibold">Jenis Kelamin</th>
          <th class="px-4 py-3.5 text-left font-semibold">Tanggal Lahir</th>
          <th class="px-4 py-3.5 text-left font-semibold">Status Perkawinan</th>
          <th class="px-4 py-3.5 text-center font-semibold">Aksi</th>
        </tr>
      </thead>
      <tbody id="tableBody" class="divide-y divide-gray-100">
        {{-- Contoh baris statis, ganti dengan @foreach($warga as $w) sesuai data asli --}}
        <tr
          class="hover:bg-purple-50/40 transition-colors duration-150"
          data-jenis-kelamin="Perempuan"
          data-status="aktif"
          data-agama="kristen"
          data-status-perkawinan="Kawin"
          data-status-keluarga="Istri"
          data-pendidikan="Sarjana"
          data-umur="30"
        >
          <td class="px-4 py-3.5 text-center">
            <input type="checkbox" class="row-checkbox w-4 h-4 rounded border-gray-300 accent-purple-700">
          </td>
          <td class="px-4 py-3.5">
            <div class="font-medium text-gray-800">Rina Wahyuni</div>
            <div class="text-xs text-gray-400">Manado</div>
          </td>
          <td class="px-4 py-3.5"><span class="inline-block font-mono text-sm font-semibold text-gray-800 bg-gray-50 rounded px-3 py-1.5 tracking-wide">7201010101010001</span></td>
          <td class="px-4 py-3.5 text-gray-600">Perempuan</td>
          <td class="px-4 py-3.5 text-gray-600">01 Januari 1994</td>
          <td class="px-4 py-3.5">
            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-blue-700">
              <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
              Kawin
            </span>
          </td>
          <td class="px-4 py-3.5">
            <div class="flex justify-center gap-1">
              <button class="p-2 rounded-lg text-gray-400 hover:text-purple-700 hover:bg-purple-50 transition-colors duration-150" title="Lihat Detail">👁️</button>
              <button class="p-2 rounded-lg text-gray-400 hover:text-green-700 hover:bg-green-50 transition-colors duration-150" title="Edit Data">✏️</button>
              <button class="p-2 rounded-lg text-gray-400 hover:text-red-700 hover:bg-red-50 transition-colors duration-150" title="Hapus Data">🗑️</button>
            </div>
          </td>
        </tr>
        <tr
          class="hover:bg-purple-50/40 transition-colors duration-150"
          data-jenis-kelamin="Laki-laki"
          data-status="aktif"
          data-agama="islam"
          data-status-perkawinan="Belum Kawin"
          data-status-keluarga="Anak"
          data-pendidikan="SMA/Sederajat"
          data-umur="27"
        >
          <td class="px-4 py-3.5 text-center">
            <input type="checkbox" class="row-checkbox w-4 h-4 rounded border-gray-300 accent-purple-700">
          </td>
          <td class="px-4 py-3.5">
            <div class="font-medium text-gray-800">Bayu Saputra</div>
            <div class="text-xs text-gray-400">Kema</div>
          </td>
          <td class="px-4 py-3.5"><span class="inline-block font-mono text-sm font-semibold text-gray-800 bg-gray-50 rounded px-3 py-1.5 tracking-wide">7201010203040002</span></td>
          <td class="px-4 py-3.5 text-gray-600">Laki-laki</td>
          <td class="px-4 py-3.5 text-gray-600">03 Februari 1997</td>
          <td class="px-4 py-3.5">
            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-yellow-700">
              <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
              Belum Kawin
            </span>
          </td>
          <td class="px-4 py-3.5">
            <div class="flex justify-center gap-1">
              <button class="p-2 rounded-lg text-gray-400 hover:text-purple-700 hover:bg-purple-50 transition-colors duration-150" title="Lihat Detail">👁️</button>
              <button class="p-2 rounded-lg text-gray-400 hover:text-green-700 hover:bg-green-50 transition-colors duration-150" title="Edit Data">✏️</button>
              <button class="p-2 rounded-lg text-gray-400 hover:text-red-700 hover:bg-red-50 transition-colors duration-150" title="Hapus Data">🗑️</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="pagination" class="flex justify-center items-center gap-2 my-6"></div>

  <!-- No Results -->
  <div id="noResults" class="hidden text-center py-12">
    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.409-1.194-5.64-3.013M8.343 4.343A8 8 0 1119.657 19.657 8 8 0 018.343 4.343z"/>
    </svg>
    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data yang ditemukan</h3>
    <p class="text-gray-500">Coba ubah kata kunci pencarian atau filter Anda</p>
  </div>
</div>

<!-- ========================================== -->
<!-- CARI KELUARGA -->
<!-- ========================================== -->
<div id="cari-keluarga" class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12">

  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <h2 class="text-xl sm:text-2xl font-bold text-purple-800 flex items-center gap-2">
      <span>👨‍👩‍👧‍👦</span>
      <span>Cari Keluarga</span>
    </h2>
    <a href="{{ route('download-warga') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold flex items-center gap-2 shadow transition-all duration-200 w-fit">
      ⬇️ Download Excel
    </a>
  </div>

  <!-- ===== Search Bar ===== -->
  <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-4">
    <!-- Search -->
    <div class="relative flex-1">
      <input
        type="text"
        id="searchKeluargaInput"
        placeholder="Cari No. KK, Nama Kepala Keluarga, atau Alamat..."
        class="w-full px-4 py-3 pl-12 pr-10 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md"
      />
      <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">🔍</div>
      <button
        id="clearSearchKeluarga"
        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
        title="Hapus pencarian"
      >✕</button>
    </div>

    <!-- Search Button -->
    <button
      id="searchKeluargaBtn"
      class="flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-purple-700 text-white font-semibold hover:bg-purple-800 transition-all duration-200 shadow-sm"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
      </svg>
      Cari
    </button>
  </div>

  <!-- ===== Tabel Keluarga ===== -->
  <div class="w-full overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
    <table class="min-w-full text-sm">
      <thead>
        <tr class="bg-purple-50 text-purple-800 text-xs uppercase tracking-wide">
          <th class="px-4 py-3.5 text-center font-semibold w-10">
            <input type="checkbox" id="selectAllKeluarga" class="w-4 h-4 rounded border-gray-300 accent-purple-700">
          </th>
          <th class="px-4 py-3.5 text-left font-semibold">No. Kartu Keluarga</th>
          <th class="px-4 py-3.5 text-left font-semibold">Kepala Keluarga</th>
          <th class="px-4 py-3.5 text-left font-semibold">Alamat</th>
          <th class="px-4 py-3.5 text-left font-semibold">Jumlah Anggota</th>
          <th class="px-4 py-3.5 text-center font-semibold">Aksi</th>
        </tr>
      </thead>
      <tbody id="tableBodyKeluarga" class="divide-y divide-gray-100">
        <tr class="hover:bg-purple-50/40 transition-colors duration-150">
          <td class="px-4 py-3.5 text-center">
            <input type="checkbox" class="row-checkbox-keluarga w-4 h-4 rounded border-gray-300 accent-purple-700">
          </td>
          <td class="px-4 py-3.5"><span class="inline-block font-mono text-sm font-semibold text-gray-800 bg-gray-50 rounded px-3 py-1.5 tracking-wide">7201010101010001</span></td>
          <td class="px-4 py-3.5">
            <div class="font-medium text-gray-800">Rina Wahyuni</div>
          </td>
          <td class="px-4 py-3.5 text-gray-600">Jl. Merdeka No. 10, Kema</td>
          <td class="px-4 py-3.5">
            <span class="inline-flex items-center justify-center gap-1.5 text-sm font-semibold text-blue-700 bg-blue-50 rounded-full w-8 h-8">4</span>
          </td>
          <td class="px-4 py-3.5">
            <div class="flex justify-center gap-1">
              <button class="p-2 rounded-lg text-gray-400 hover:text-purple-700 hover:bg-purple-50 transition-colors duration-150" title="Lihat Detail">👁️</button>
              <button class="p-2 rounded-lg text-gray-400 hover:text-green-700 hover:bg-green-50 transition-colors duration-150" title="Edit Data">✏️</button>
              <button class="p-2 rounded-lg text-gray-400 hover:text-red-700 hover:bg-red-50 transition-colors duration-150" title="Hapus Data">🗑️</button>
            </div>
          </td>
        </tr>
        <tr class="hover:bg-purple-50/40 transition-colors duration-150">
          <td class="px-4 py-3.5 text-center">
            <input type="checkbox" class="row-checkbox-keluarga w-4 h-4 rounded border-gray-300 accent-purple-700">
          </td>
          <td class="px-4 py-3.5"><span class="inline-block font-mono text-sm font-semibold text-gray-800 bg-gray-50 rounded px-3 py-1.5 tracking-wide">7201010203040002</span></td>
          <td class="px-4 py-3.5">
            <div class="font-medium text-gray-800">Bayu Saputra</div>
          </td>
          <td class="px-4 py-3.5 text-gray-600">Jl. Ahmad Yani No. 25, Kema</td>
          <td class="px-4 py-3.5">
            <span class="inline-flex items-center justify-center gap-1.5 text-sm font-semibold text-blue-700 bg-blue-50 rounded-full w-8 h-8">3</span>
          </td>
          <td class="px-4 py-3.5">
            <div class="flex justify-center gap-1">
              <button class="p-2 rounded-lg text-gray-400 hover:text-purple-700 hover:bg-purple-50 transition-colors duration-150" title="Lihat Detail">👁️</button>
              <button class="p-2 rounded-lg text-gray-400 hover:text-green-700 hover:bg-green-50 transition-colors duration-150" title="Edit Data">✏️</button>
              <button class="p-2 rounded-lg text-gray-400 hover:text-red-700 hover:bg-red-50 transition-colors duration-150" title="Hapus Data">🗑️</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="paginationKeluarga" class="flex justify-center items-center gap-2 my-6"></div>

  <!-- No Results -->
  <div id="noResultsKeluarga" class="hidden text-center py-12">
    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.409-1.194-5.64-3.013M8.343 4.343A8 8 0 1119.657 19.657 8 8 0 018.343 4.343z"/>
    </svg>
    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data keluarga yang ditemukan</h3>
    <p class="text-gray-500">Coba ubah kata kunci pencarian Anda</p>
  </div>
</div>
@endsection