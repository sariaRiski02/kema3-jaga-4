<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Desa Kema 3 - Jaga 4</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('/styles/style.css') }}">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

  <header class="bg-purple-700 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row justify-between items-center gap-4">
      <h1 class="text-xl sm:text-2xl font-bold text-center sm:text-left">Dashboard Desa Kema 3 – Jaga 4</h1>
      <a href="/" class="bg-white text-purple-700 font-semibold px-4 py-2 rounded-lg shadow hover:bg-gray-100 transition-all duration-200">
        📊 Lihat Visualisasi
      </a>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
    <div class="mb-8">
      <h2 class="text-xl sm:text-2xl font-semibold text-purple-800 mb-2">Selamat datang, Admin!</h2>
      <p class="text-gray-600">Kelola data penduduk Desa Kema 3 – Jaga 4 dengan mudah</p>
    </div>

    @include('mini-statistik')

    @include('file')

    @include('input')

    <!-- Tabel Daftar Warga -->
    <div>
      <!-- Enhanced Search dan Filter -->
      <div class="mb-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 justify-between">
          <!-- Search Input -->
          <div class="relative flex-1 max-w-md mb-3">
            <input 
            type="text" 
            id="searchInput" 
            placeholder=" Cari NIK, Nama, atau Tempat Lahir..." 
            class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md"
            />
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
            🔍
            </div>
            <button 
            id="clearSearch" 
            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
            title="Hapus pencarian"
            >
            ❌
            </button>
          </div>
        </div>
        <!-- Mass delete button and selected count moved here -->
        <div id="massDeleteWrapper" class="flex justify-between items-center mb-2">
          <button id="btn-hapus-massal" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-full font-bold text-base shadow-lg transition-all duration-200 flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-red-400" disabled>
            <svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' /></svg>
            Hapus Terpilih
          </button>
          <span id="selectedCount" class="text-sm text-gray-600"></span>
        </div>
      </div>
      <!-- Tambahkan wrapper overflow-x-auto agar tabel bisa di-scroll horizontal -->
      <div class="w-full overflow-x-auto">
      <table class="min-w-full border border-purple-800 whitespace-nowrap">
      <thead class="bg-purple-100 text-purple-800">
        <tr>
        <th class="px-3 sm:px-4 py-3 text-center border font-semibold text-sm sm:text-base">No</th>
        <th class="px-3 sm:px-4 py-3 text-left border font-semibold text-sm sm:text-base">NIK</th>
        <th class="px-3 sm:px-4 py-3 text-left border font-semibold text-sm sm:text-base">Nama</th>
        <th class="px-3 sm:px-4 py-3 text-left border font-semibold text-sm sm:text-base">Jenis Kelamin</th>
        <th class="px-3 sm:px-4 py-3 text-left border font-semibold text-sm sm:text-base">Umur</th>
        <th class="px-3 sm:px-4 py-3 text-center border font-semibold text-sm sm:text-base">Aksi</th>
        </tr>
      </thead>
      <tbody id="tableBody" class="rounded-2xl text-gray-700">
        <tr id="dataTable">
        <td class="px-3 sm:px-4 py-3 border text-center">1</td>
        <td class="px-3 sm:px-4 py-3 border">7201010101010001</td>
        <td class="px-3 sm:px-4 py-3 border">Rina Wahyuni</td>
        <td class="px-3 sm:px-4 py-3 border">Perempuan</td>
        <td class="px-3 sm:px-4 py-3 border">30 tahun</td>
        <td class="px-3 sm:px-4 py-3 border text-center">
          <div class="flex justify-center gap-2">
          <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs font-medium transition-all duration-200 flex items-center gap-1 shadow-sm hover:shadow-md" title="Lihat Detail">
          👁️ Lihat
          </button>
          <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-xs font-medium transition-all duration-200 flex items-center gap-1 shadow-sm hover:shadow-md" title="Edit Data">
          ✏️ Edit
          </button>
          <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-xs font-medium transition-all duration-200 flex items-center gap-1 shadow-sm hover:shadow-md" title="Hapus Data">
          🗑️ Hapus
          </button>
          </div>
        </td>
        </tr>
      </tbody>
      </table>
      <div id="pagination" class="flex justify-center items-center gap-2 my-6">
      
      </div>
      </div>
      <div class="flex justify-end m-5">
      <a href="{{ route('download-warga') }}" class=" bg-blue-600 hover:bg-blue-700 
      text-white px-5 py-2 
      rounded-lg font-semibold flex items-center gap-2 
      shadow transition-all duration-200">
      ⬇️ Download Data Excel
      </a>
      </div>

      <!-- No Results Message -->
      <div id="noResults" class="hidden text-center py-12">
      <div class="no-results">
      <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.409-1.194-5.64-3.013M8.343 4.343A8 8 0 1119.657 19.657 8 8 0 018.343 4.343z"/>
      </svg>
      <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data yang ditemukan</h3>
      <p class="text-gray-500">Coba ubah kata kunci pencarian Anda</p>
      </div>
      </div>
    </div>
  </main>
  {{-- loading --}}

  <div id="loading" style="display:none;" class="flex items-center gap-2 text-purple-700 mt-2">
  <svg class="animate-spin h-5 w-5 text-purple-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
  </svg>
  <span>Mengirim data...</span>
</div>

<!-- Global Loading Overlay -->
<div id="globalLoading" class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50 hidden">
  <div class="flex flex-col items-center gap-4">
    <svg class="animate-spin h-12 w-12 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
    </svg>
    <span class="text-lg text-white font-semibold drop-shadow">Memproses data, mohon tunggu...</span>
  </div>
</div>

  <footer class="bg-white shadow mt-8 sm:mt-12 py-4 text-center text-sm text-gray-500">
    &copy; created by rizky saria
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <script src="{{ asset('/js/resident.js') }}" type="module"></script>
  <script src="{{ asset('/js/actions/Delete.mjs') }}" type="module"></script>
  <script src="{{ asset('/js/actions/Detail.mjs') }}" type="module"></script>
  <script src="{{ asset('/js/actions/Edit.mjs') }}" type="module"></script>
  <script src="{{ asset('/js/search.js') }}" type="module"></script>
  <script src="{{ asset('/js/input.js') }}" type="module"></script>
  <script src="{{ asset('js/file.js') }}"></script>

</body>
</html>
