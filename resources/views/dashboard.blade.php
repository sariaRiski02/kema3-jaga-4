<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Desa Kema 3 - Jaga 4</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('/styles/style.css') }}">
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

    <!-- Ringkasan Data -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8 sm:mb-10">
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
        <h3 class="text-sm sm:text-lg font-semibold mb-1 sm:mb-2 text-purple-700">Jumlah Penduduk Pernah Terdata</h3>
        <p class="text-2xl sm:text-4xl font-bold text-purple-900" id="totalPendudukTerdata">{{ $semua_penduduk }}</p>
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
    

    <!-- Import Excel Section -->
    <div class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12">
      <h2 class="text-xl sm:text-2xl font-bold text-purple-800 mb-4 sm:mb-6 flex items-center gap-2">
        <span>📊</span>
        <span>Import Data dari Excel</span>
      </h2>

      <!-- File Upload Area -->
      <div class="mb-6">
        <div id="fileDropZone" class="file-drop-zone border-2 border-dashed border-purple-400 rounded-lg p-8 text-center bg-purple-50 hover:bg-purple-100 transition-all duration-200">
          <div class="space-y-4">
            <div class="text-4xl">📁</div>
            <div>
              <p class="text-lg font-medium text-purple-800 mb-2">Drag & Drop file Excel di sini</p>
              <p class="text-gray-600 mb-4">atau</p>
              <input type="file" id="excelFileInput" accept=".xlsx,.xls" class="hidden">
              <button id="selectFileBtn" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-all duration-200 font-semibold">
                📂 Pilih File Excel
              </button>
            </div>
            <p class="text-sm text-gray-500">
              Format yang didukung: .xlsx, .xls (maksimal 10MB)
            </p>
          </div>
        </div>

        <!-- File Info -->
        <div id="fileInfo" class="hidden mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="text-2xl">📄</div>
              <div>
                <p class="font-medium text-blue-800" id="fileName"></p>
                <p class="text-sm text-blue-600" id="fileSize"></p>
              </div>
            </div>
            <button id="removeFileBtn" class="text-red-500 hover:text-red-700 font-medium">
              ✕ Hapus
            </button>
          </div>
        </div>

        <!-- Progress Bar -->
        <div id="uploadProgress" class="hidden mt-4">
          <div class="flex justify-between items-center mb-2">
            <span class="text-sm font-medium text-purple-700">Memproses data...</span>
            <span class="text-sm text-purple-600" id="progressText">0%</span>
          </div>
          <div class="w-full bg-purple-200 rounded-full h-2">
            <div class="progress-bar bg-purple-600 h-2 rounded-full" id="progressBar" style="width: 0%"></div>
          </div>
        </div>

        <!-- Import Button -->
        <div class="mt-4 flex gap-4">
          <button id="importBtn" class="hidden bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-all duration-200 font-semibold flex items-center gap-2">
            <span>📊</span>
            <span>Import Data</span>
          </button>
          <button id="downloadTemplateBtn" class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition-all duration-200 font-semibold flex items-center gap-2">
            <span>📋</span>
            <span>Download Template Excel</span>
          </button>
        </div>
      </div>

      <!-- Preview Data -->
      <div id="previewSection" class="hidden">
        <h3 class="text-lg font-semibold text-purple-700 mb-4 flex items-center gap-2">
          <span>👁️</span>
          <span>Preview Data Excel</span>
        </h3>
        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
              <tr id="previewHeader"></tr>
            </thead>
            <tbody id="previewBody"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Form Input Data -->
    <div class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12 border-2 border-purple-200">
      <h2 class="text-xl sm:text-2xl font-bold text-purple-800 mb-4 sm:mb-6 flex items-center gap-2">
      <span>📝</span>
      <span>Tambah Data Warga Manual</span>
      </h2>

      <form action="#" method="POST" class="space-y-6 sm:space-y-10" id="addResidentForm">
      
      <!-- Warga -->
      <div class="border border-purple-300 rounded-lg p-4 mb-4">
      <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
      <span>👤</span>
      <span>Data Warga</span>
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
      <input type="text" name="nik" placeholder="NIK" class="input px-4 py-3" required maxlength="16">
      <input type="text" name="nama" placeholder="Nama Lengkap" class="input px-4 py-3" required>
      <select name="jenis_kelamin" class="input px-4 py-3" required>
        <option value="">Pilih Jenis Kelamin</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
      <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="input px-4 py-3" required>
      <input type="date" name="tanggal_lahir" class="input px-4 py-3" required>
      <input type="text" name="agama" placeholder="Agama" class="input px-4 py-3">
      <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="input px-4 py-3">
      <select name="status_perkawinan" class="input px-4 py-3">
        <option value="">Status Perkawinan</option>
        <option value="Belum Kawin">Belum Kawin</option>
        <option value="Kawin">Kawin</option>
        <option value="Cerai Hidup">Cerai Hidup</option>
        <option value="Cerai Mati">Cerai Mati</option>
      </select>
      <input type="text" name="no_kk" placeholder="Nomor Kartu Keluarga (KK)" class="input px-4 py-3" maxlength="16">
      <select name="status_keluarga" class="input px-4 py-3">
        <option value="">Status Dalam Keluarga</option>
        <option value="Kepala Keluarga">Kepala Keluarga</option>
        <option value="Istri">Istri</option>
        <option value="Anak">Anak</option>
        <option value="Orangtua">Orangtua</option>
        <option value="Mertua">Mertua</option>
        <option value="Cucu">Cucu</option>
        <option value="Lainnya">Lainnya</option>
      </select>
      </div>
      </div>

      <!-- Rumah -->
      <div class="border border-purple-300 rounded-lg p-4 mb-4">
      <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
      <span>🏠</span>
      <span>Kepemilikan Rumah</span>
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
      <select name="status_rumah" class="input px-4 py-3">
        <option value="">Status Rumah</option>
        <option value="milik_sendiri">Milik Sendiri</option>
        <option value="sewa">Sewa</option>
        <option value="kontrak">Kontrak</option>
        <option value="numpang">Numpang</option>
      </select>
      <select name="tipe_rumah" class="input px-4 py-3">
        <option value="">Tipe Rumah</option>
        <option value="permanen">Permanen</option>
        <option value="semi_permanen">Semi Permanen</option>
        <option value="non_permanen">Non Permanen</option>
      </select>
      </div>
      </div>

      <!-- Kendaraan -->
      <div class="border border-purple-300 rounded-lg p-4 mb-4">
      <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
      <span>🚗</span>
      <span>Kepemilikan Kendaraan</span>
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-4">
      <input type="number" name="motor_roda2" placeholder="Motor Roda 2" class="input px-4 py-3" min="0">
      <input type="number" name="mobil_roda4" placeholder="Mobil Roda 4" class="input px-4 py-3" min="0">
      <input type="number" name="mobil_bus" placeholder="Mobil Bus" class="input px-4 py-3" min="0">
      </div>
      </div>

      <!-- Usaha -->
      <div class="border border-purple-300 rounded-lg p-4 mb-4">
      <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
      <span>💼</span>
      <span>Jenis Usaha</span>
      </h3>
      <input type="text" name="jenis_usaha" placeholder="Jenis Usaha (kosongkan jika tidak ada)" class="input w-full px-4 py-3">
      </div>

      <!-- Bahan Bakar -->
      <div class="border border-purple-300 rounded-lg p-4 mb-4">
      <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
      <span>⛽</span>
      <span>Penggunaan Bahan Bakar</span>
      </h3>
      <div class="flex flex-wrap gap-4 sm:gap-6">
      <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" name="gas" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
        <span>Gas</span>
      </label>
      <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" name="kayu_bakar" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
        <span>Kayu Bakar</span>
      </label>
      <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" name="minyak_tanah" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
        <span>Minyak Tanah</span>
      </label>
      </div>
      </div>

      <!-- Sumber Air -->
      <div class="border border-purple-300 rounded-lg p-4 mb-4">
      <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
      <span>💧</span>
      <span>Sumber Air</span>
      </h3>
      <div class="flex flex-wrap gap-4 sm:gap-6">
      <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" name="sumur" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
        <span>Sumur</span>
      </label>
      <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" name="mata_air" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
        <span>Mata Air</span>
      </label>
      <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" name="lainnya" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
        <span>Lainnya</span>
      </label>
      </div>
      </div>

      <!-- Submit -->
      <div class="flex gap-4">
      <button type="submit" class="bg-purple-700 text-white px-6 py-3 rounded-lg hover:bg-purple-800 transition-all duration-200 flex items-center gap-2">
      <span>💾</span>
      <span>Simpan Data</span>
      </button>
      <button type="reset" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-all duration-200">
      Reset Form
      </button>
      </div>
      </form>
    </div>

    <!-- Tabel Daftar Warga -->
    <div>
      <!-- Enhanced Search dan Filter -->
      <div class="mb-6">
      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 justify-between">
        
        <!-- Search Input -->
        <div class="relative flex-1 max-w-md">
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
          class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden transition-colors duration-200"
          title="Hapus pencarian"
          >
          ❌
          </button>
        </div>
        
        <!-- Filter Section -->
        <div class="flex items-center gap-3">
          <!-- Gender Filter -->
          <div class="relative">
          <select id="genderFilter" class="appearance-none bg-white px-4 py-3 pr-10 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer">
            <option value="">👥 Semua Jenis Kelamin</option>
            <option value="Laki-laki">👨 Laki-laki</option>
            <option value="Perempuan">👩 Perempuan</option>
          </select>
          <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
            ⬇️
          </div>
          </div>
          
          <!-- Reset Filter Button -->
          <button 
          id="resetFilters" 
          class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 flex items-center gap-2 shadow-sm hover:shadow-md"
          title="Reset semua filter"
          >
          🔄 Reset
          </button>
        </div>
      </div>
        
      <!-- Search Results Counter -->
      <div id="searchResults" class="mt-3 text-sm text-gray-600 hidden">
        <div class="bg-blue-50 border border-blue-200 rounded-lg px-4 py-2 flex items-center gap-2">
        <span>📊</span>
        <span id="resultCount"></span>
        </div>
      </div>
      </div>
      <!-- Tambahkan wrapper overflow-x-auto agar tabel bisa di-scroll horizontal -->
      <div class="overflow-x-auto">
      <table class="min-w-full border border-purple-800">
        <thead class="bg-purple-100 text-purple-800">
          <tr>
          <th class="px-3 sm:px-4 py-3 text-left border font-semibold text-sm sm:text-base">NIK</th>
          <th class="px-3 sm:px-4 py-3 text-left border font-semibold text-sm sm:text-base">Nama</th>
          <th class="px-3 sm:px-4 py-3 text-left border font-semibold text-sm sm:text-base">Jenis Kelamin</th>
          <th class="px-3 sm:px-4 py-3 text-left border font-semibold text-sm sm:text-base">Umur</th>
          <th class="px-3 sm:px-4 py-3 text-center border font-semibold text-sm sm:text-base">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody" class="rounded-2xl text-gray-700">
          <tr id="dataTable">
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
      <div id="pagination"></div>
      </div>
      <div class="flex justify-end m-5">
      <a href="" class=" bg-blue-600 hover:bg-blue-700 
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

  <footer class="bg-white shadow mt-8 sm:mt-12 py-4 text-center text-sm text-gray-500">
    &copy; created by rizky saria
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ '/js/resident.js' }}"></script>

</body>
