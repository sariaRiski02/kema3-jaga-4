<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Desa Kema 3 - Jaga 4</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .input {
      @apply p-3 border border-purple-300 bg-white rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-purple-400 transition-all duration-200;
    }
    
    .search-highlight {
      background-color: #fef3c7;
      font-weight: bold;
    }
    
    .fade-in {
      animation: fadeIn 0.3s ease-in;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    
    .no-results {
      animation: slideDown 0.3s ease-out;
    }
    
    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card-hover {
      transition: all 0.3s ease;
    }

    .card-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

  <header class="bg-purple-700 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row justify-between items-center gap-4">
      <h1 class="text-xl sm:text-2xl font-bold text-center sm:text-left">Dashboard Desa Kema 3 – Jaga 4</h1>
      <a href="visualisasi.html" class="bg-white text-purple-700 font-semibold px-4 py-2 rounded-lg shadow hover:bg-gray-100 transition-all duration-200">
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
            <h3 class="text-sm sm:text-lg font-semibold mb-1 sm:mb-2 text-purple-700">Jumlah Penduduk</h3>
            <p class="text-2xl sm:text-4xl font-bold text-purple-900">1.234</p>
          </div>
          <div class="text-2xl sm:text-3xl">👥</div>
        </div>
      </div>
      <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md card-hover">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-sm sm:text-lg font-semibold mb-1 sm:mb-2 text-purple-700">Jumlah Keluarga</h3>
            <p class="text-2xl sm:text-4xl font-bold text-purple-900">423</p>
          </div>
          <div class="text-2xl sm:text-3xl">🏠</div>
        </div>
      </div>
      <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md card-hover">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-sm sm:text-lg font-semibold mb-1 sm:mb-2 text-purple-700">Jumlah Laki-Laki</h3>
            <p class="text-2xl sm:text-4xl font-bold text-purple-900">552</p>
          </div>
          <div class="text-2xl sm:text-3xl">🏘️</div>
        </div>
      </div>
      <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md card-hover">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-sm sm:text-lg font-semibold mb-1 sm:mb-2 text-purple-700">Jumlah Perempuan</h3>
            <p class="text-2xl sm:text-4xl font-bold text-purple-900">772</p>
          </div>
          <div class="text-2xl sm:text-3xl">🌆</div>
        </div>
      </div>
    </div>

    <!-- Statistik Mini -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 mb-8 sm:mb-10">
      <div class="bg-purple-100 p-4 sm:p-5 rounded-xl text-center card-hover">
        <div class="text-2xl sm:text-3xl mb-2">🏡</div>
        <h4 class="text-sm sm:text-lg font-semibold text-purple-800 mb-1 sm:mb-2">Rumah Milik Sendiri</h4>
        <p class="text-2xl sm:text-3xl font-bold text-purple-700">500</p>
      </div>
      <div class="bg-purple-100 p-4 sm:p-5 rounded-xl text-center card-hover">
        <div class="text-2xl sm:text-3xl mb-2">📋</div>
        <h4 class="text-sm sm:text-lg font-semibold text-purple-800 mb-1 sm:mb-2">Jumlah Lahan Terdaftar</h4>
        <p class="text-2xl sm:text-3xl font-bold text-purple-700">260</p>
      </div>
      <div class="bg-purple-100 p-4 sm:p-5 rounded-xl text-center card-hover">
        <div class="text-2xl sm:text-3xl mb-2">📐</div>
        <h4 class="text-sm sm:text-lg font-semibold text-purple-800 mb-1 sm:mb-2">Rata-rata Luas Tanah</h4>
        <p class="text-2xl sm:text-3xl font-bold text-purple-700">450 m²</p>
      </div>
    </div>

    <!-- Form Input Data -->
    <div class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12">
      <h2 class="text-xl sm:text-2xl font-bold text-purple-800 mb-4 sm:mb-6 flex items-center gap-2">
        <span>📝</span>
        <span>Tambah Data Warga</span>
      </h2>

      <form action="#" method="POST" class="space-y-6 sm:space-y-10" id="addResidentForm">
        
        <!-- Warga -->
        <div>
          <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
            <span>👤</span>
            <span>Data Warga</span>
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
            <input type="text" name="nik" placeholder="NIK" class="input" required maxlength="16">
            <input type="text" name="nama" placeholder="Nama Lengkap" class="input" required>
            <select name="jenis_kelamin" class="input" required>
              <option value="">Pilih Jenis Kelamin</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
            <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="input" required>
            <input type="date" name="tanggal_lahir" class="input" required>
            <input type="text" name="agama" placeholder="Agama" class="input">
            <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="input">
            <select name="status_perkawinan" class="input">
              <option value="">Status Perkawinan</option>
              <option value="Belum Kawin">Belum Kawin</option>
              <option value="Kawin">Kawin</option>
              <option value="Cerai Hidup">Cerai Hidup</option>
              <option value="Cerai Mati">Cerai Mati</option>
            </select>
            <input type="text" name="no_kk" placeholder="Nomor Kartu Keluarga (KK)" class="input" maxlength="16">
            <select name="status_keluarga" class="input">
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
        <div>
          <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
            <span>🏠</span>
            <span>Kepemilikan Rumah</span>
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
            <select name="status_rumah" class="input">
              <option value="">Status Rumah</option>
              <option value="milik_sendiri">Milik Sendiri</option>
              <option value="sewa">Sewa</option>
              <option value="kontrak">Kontrak</option>
              <option value="numpang">Numpang</option>
            </select>
            <select name="tipe_rumah" class="input">
              <option value="">Tipe Rumah</option>
              <option value="permanen">Permanen</option>
              <option value="semi_permanen">Semi Permanen</option>
              <option value="non_permanen">Non Permanen</option>
            </select>
          </div>
        </div>

        <!-- Kendaraan -->
        <div>
          <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
            <span>🚗</span>
            <span>Kepemilikan Kendaraan</span>
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-4">
            <input type="number" name="motor_roda2" placeholder="Motor Roda 2" class="input" min="0">
            <input type="number" name="mobil_roda4" placeholder="Mobil Roda 4" class="input" min="0">
            <input type="number" name="mobil_bus" placeholder="Mobil Bus" class="input" min="0">
          </div>
        </div>

        <!-- Usaha -->
        <div>
          <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
            <span>💼</span>
            <span>Jenis Usaha</span>
          </h3>
          <input type="text" name="jenis_usaha" placeholder="Jenis Usaha (kosongkan jika tidak ada)" class="input w-full">
        </div>

        <!-- Bahan Bakar -->
        <div>
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
        <div>
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
    <div class="bg-white p-4 sm:p-8 rounded-xl shadow-xl">
      <h2 class="text-xl sm:text-2xl font-bold text-purple-800 mb-4 sm:mb-6 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
      <span class="flex items-center gap-2">
        <span>👨‍👩‍👧‍👦</span>
        <span>Daftar Warga</span>
        <span id="totalCount" class="text-sm font-normal bg-purple-100 text-purple-700 px-2 py-1 rounded-full"></span>
      </span>
      
      <!-- Enhanced Search -->
      <div class="relative w-full lg:w-auto">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
        <div class="relative w-full sm:w-auto">
          <input 
          type="text" 
          id="searchInput" 
          placeholder="Cari NIK, Nama, atau Tempat Lahir..." 
          class="w-full lg:w-80 px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
          />
          <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
          <button 
          id="clearSearch" 
          class="absolute right-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400 hover:text-gray-600 hidden"
          title="Hapus pencarian"
          >
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6m0 12L6 6"/>
          </svg>
          </button>
        </div>
        
        <!-- Filter by Gender -->
        <select id="genderFilter" class="w-full sm:w-auto px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
          <option value="">Semua Jenis Kelamin</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
        </div>
        
        <!-- Search Results Counter -->
        <div id="searchResults" class="absolute top-full left-0 right-0 mt-1 text-sm text-gray-600 hidden z-10">
        <div class="bg-white border border-gray-200 rounded-lg px-3 py-2 shadow-sm">
          <span id="resultCount"></span>
        </div>
        </div>
      </div>
      </h2>

      <div class="overflow-x-auto">
      <table class="min-w-full border border-purple-200">
        <thead class="bg-purple-100 text-purple-800">
        <tr>
          <th class="px-3 sm:px-4 py-3 text-left border font-semibold text-sm sm:text-base">NIK</th>
          <th class="px-3 sm:px-4 py-3 text-left border font-semibold text-sm sm:text-base">Nama</th>
          <th class="px-3 sm:px-4 py-3 text-left border font-semibold text-sm sm:text-base">Jenis Kelamin</th>
          <th class="px-3 sm:px-4 py-3 text-left border font-semibold text-sm sm:text-base">Tempat, Tanggal Lahir</th>
          <th class="px-3 sm:px-4 py-3 text-center border font-semibold text-sm sm:text-base">Aksi</th>
        </tr>
        </thead>
        <tbody id="tableBody" class="text-gray-700">
        <!-- Data akan diisi oleh JavaScript -->
        </tbody>
      </table>
      
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
      
      <!-- Pagination Info -->
      <div id="pagination" class="mt-4 sm:mt-6 flex flex-col sm:flex-row justify-between items-center gap-2">
      <div class="text-sm text-gray-600">
        Menampilkan <span id="showingFrom">1</span> - <span id="showingTo">10</span> dari <span id="totalData">0</span> data
      </div>
      </div>

      <!-- Download Button -->
      <div class="mt-6 flex justify-end">
      <button
        id="downloadAllBtn"
        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg flex items-center gap-2 shadow transition-all duration-200"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
        </svg>
        Download Semua Data
      </button>
      </div>
    </div>
  </main>

  <footer class="bg-white shadow mt-8 sm:mt-12 py-4 text-center text-sm text-gray-500">
    &copy; 2025 Pemerintah Desa Kema 3 – Jaga 4. Semua hak dilindungi.
  </footer>

  <script>
    // Sample data - ganti dengan data dari database Anda
    let residentsData = [
      {
        nik: "7201010101010001",
        nama: "Rina Wahyuni",
        jenisKelamin: "Perempuan",
        tempatLahir: "Manado",
        tanggalLahir: "12 Mei 1990"
      },
      {
        nik: "7201010101010002",
        nama: "Ahmad Susanto",
        jenisKelamin: "Laki-laki",
        tempatLahir: "Jakarta",
        tanggalLahir: "15 Januari 1985"
      },
      {
        nik: "7201010101010003",
        nama: "Siti Nurhaliza",
        jenisKelamin: "Perempuan",
        tempatLahir: "Bandung",
        tanggalLahir: "22 Maret 1992"
      },
      {
        nik: "7201010101010004",
        nama: "Budi Setiawan",
        jenisKelamin: "Laki-laki",
        tempatLahir: "Surabaya",
        tanggalLahir: "8 Juli 1988"
      },
      {
        nik: "7201010101010005",
        nama: "Maya Sari",
        jenisKelamin: "Perempuan",
        tempatLahir: "Medan",
        tanggalLahir: "30 September 1995"
      },
      {
        nik: "7201010101010006",
        nama: "Rizki Pratama",
        jenisKelamin: "Laki-laki",
        tempatLahir: "Yogyakarta",
        tanggalLahir: "5 November 1987"
      }
    ];

    let filteredData = [...residentsData];

    // DOM Elements
    const searchInput = document.getElementById('searchInput');
    const clearSearchBtn = document.getElementById('clearSearch');
    const genderFilter = document.getElementById('genderFilter');
    const tableBody = document.getElementById('tableBody');
    const noResults = document.getElementById('noResults');
    const searchResults = document.getElementById('searchResults');
    const resultCount = document.getElementById('resultCount');
    const totalCount = document.getElementById('totalCount');
    const addResidentForm = document.getElementById('addResidentForm');

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
      renderTable(residentsData);
      updateTotalCount(residentsData.length);
    });

    // Form submission
    addResidentForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      const newResident = {
        nik: formData.get('nik'),
        nama: formData.get('nama'),
        jenisKelamin: formData.get('jenis_kelamin'),
        tempatLahir: formData.get('tempat_lahir'),
        tanggalLahir: new Date(formData.get('tanggal_lahir')).toLocaleDateString('id-ID', {
          day: 'numeric',
          month: 'long',
          year: 'numeric'
        })
      };

      // Validasi NIK unik
      if (residentsData.some(r => r.nik === newResident.nik)) {
        alert('NIK sudah terdaftar! Silakan gunakan NIK yang berbeda.');
        return;
      }

      // Tambah data baru
      residentsData.push(newResident);
      filterData();
      
      // Reset form
      this.reset();
      
      alert('Data berhasil ditambahkan!');
      
      // Scroll ke tabel
      document.getElementById('tableBody').scrollIntoView({ 
        behavior: 'smooth',
        block: 'start'
      });
    });

    // Search functionality
    searchInput.addEventListener('input', function() {
      const searchTerm = this.value.trim();
      
      if (searchTerm) {
        clearSearchBtn.classList.remove('hidden');
        searchResults.classList.remove('hidden');
      } else {
        clearSearchBtn.classList.add('hidden');
        searchResults.classList.add('hidden');
      }
      
      filterData();
    });

    // Clear search
    clearSearchBtn.addEventListener('click', function() {
      searchInput.value = '';
      this.classList.add('hidden');
      searchResults.classList.add('hidden');
      filterData();
    });

    // Gender filter
    genderFilter.addEventListener('change', filterData);

    function filterData() {
      const searchTerm = searchInput.value.toLowerCase().trim();
      const genderTerm = genderFilter.value;

      filteredData = residentsData.filter(resident => {
        const matchesSearch = !searchTerm || 
          resident.nik.toLowerCase().includes(searchTerm) ||
          resident.nama.toLowerCase().includes(searchTerm) ||
          resident.tempatLahir.toLowerCase().includes(searchTerm) ||
          resident.tanggalLahir.toLowerCase().includes(searchTerm);

        const matchesGender = !genderTerm || resident.jenisKelamin === genderTerm;

        return matchesSearch && matchesGender;
      });

      renderTable(filteredData, searchTerm);
      updateSearchResults(filteredData.length, searchTerm || genderTerm);
      updateTotalCount(filteredData.length);
    }

    function renderTable(data, searchTerm = '') {
      if (data.length === 0) {
        tableBody.innerHTML = '';
        noResults.classList.remove('hidden');
        return;
      }

      noResults.classList.add('hidden');
      
      tableBody.innerHTML = data.map(resident => {
        const highlightedName = highlightText(resident.nama, searchTerm);
        const highlightedNik = highlightText(resident.nik, searchTerm);
        const highlightedTempat = highlightText(resident.tempatLahir, searchTerm);
        const highlightedTanggal = highlightText(resident.tanggalLahir, searchTerm);

        return `
          <tr class="hover:bg-purple-50 transition-colors duration-150 fade-in">
            <td class="px-3 sm:px-4 py-3 border font-mono text-xs sm:text-sm">${highlightedNik}</td>
            <td class="px-3 sm:px-4 py-3 border font-medium text-sm sm:text-base">${highlightedName}</td>
            <td class="px-3 sm:px-4 py-3 border">
              <span class="inline-flex items-center px-2 sm:px-2.5 py-0.5 rounded-full text-xs font-medium ${
                resident.jenisKelamin === 'Laki-laki' 
                  ? 'bg-blue-100 text-blue-800' 
                  : 'bg-pink-100 text-pink-800'
              }">
                <span class="mr-1">${resident.jenisKelamin === 'Laki-laki' ? '👨' : '👩'}</span>
                                <span class="hidden sm:inline">${resident.jenisKelamin}</span>
              </span>
            </td>
            <td class="px-3 sm:px-4 py-3 border text-sm sm:text-base">${highlightedTempat}, ${highlightedTanggal}</td>
            <td class="px-3 sm:px-4 py-3 border text-center">
              <div class="flex justify-center gap-2">
                <!-- Tombol Lihat -->
                <button class="text-blue-600 hover:text-blue-800" title="Lihat Data">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
                  </svg>
                </button>
                <!-- Tombol Edit -->
                <button class="text-green-600 hover:text-green-800" title="Edit Data">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-4-10l4 4L11 5z" />
                  </svg>
                </button>
                <!-- Tombol Hapus -->
                <button class="text-red-600 hover:text-red-800" title="Hapus Data" onclick="deleteResident('${resident.nik}')">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </td>
          </tr>
        `;
      }).join('');
    }

    function highlightText(text, term) {
      if (!term) return text;
      const regex = new RegExp(`(${term})`, 'gi');
      return text.replace(regex, '<span class="search-highlight">$1</span>');
    }

    function updateSearchResults(count, term) {
      resultCount.textContent = term ? `${count} hasil untuk “${term}”` : '';
    }

    function updateTotalCount(count) {
      totalCount.textContent = count > 0 ? `(${count} total)` : '';
      document.getElementById('totalData').textContent = count;
      document.getElementById('showingFrom').textContent = count > 0 ? 1 : 0;
      document.getElementById('showingTo').textContent = count;
    }

    function deleteResident(nik) {
      if (confirm('Yakin ingin menghapus data ini?')) {
        residentsData = residentsData.filter(r => r.nik !== nik);
        filterData();
        alert('Data berhasil dihapus.');
      }
    }
  </script>
</body>
</html>
