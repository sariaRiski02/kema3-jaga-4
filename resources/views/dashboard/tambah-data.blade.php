@extends('dashboard.main')

@section('content')
<!-- Import Excel Section -->
<div class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12">

  <!-- Header: judul + deskripsi di kiri, tombol template di kanan -->
  <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
    <div>
      <h2 class="text-xl sm:text-2xl font-bold text-purple-800 flex items-center gap-2">
        <span>📊</span>
        <span>Import Data dari Excel</span>
      </h2>
      <p class="text-sm text-gray-500 mt-2 max-w-xl">
        Unggah data warga dalam jumlah banyak sekaligus. Pastikan susunan kolom pada file Excel mengikuti template di samping.
      </p>
    </div>

    <a href="" id="downloadTemplateBtn" class="shrink-0 bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition-all duration-200 font-semibold flex items-center gap-2">
      <span>📋</span>
      <span>Download Template Excel</span>
    </a>
  </div>

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
    <div class="mt-4">
      <button id="importBtn" class="hidden bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-all duration-200 font-semibold flex items-center gap-2">
        <span>📊</span>
        <span>Import Data</span>
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

  <!-- Error Message -->
  <div id="error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-base font-medium"></div>

  <form action="#" method="POST" class="space-y-6 sm:space-y-10" id="addResidentForm">
    <input type="hidden" id="edit_id" name="edit_id" value="">
    <!-- Warga -->
    <div class="border border-purple-300 rounded-lg p-4 mb-4">
      <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
        <span>👤</span>
        <span>Data Warga</span>
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="nik" class="block text-sm font-medium text-purple-700 mb-1">NIK</label>
          <input type="text" id="nik" placeholder="NIK" class="input px-4 py-3 w-full" required maxlength="16">
        </div>
        <div>
          <label for="nama" class="block text-sm font-medium text-purple-700 mb-1">Nama Lengkap</label>
          <input type="text" id="nama" placeholder="Nama Lengkap" class="input px-4 py-3 w-full" required>
        </div>
        <div>
          <label for="jenis_kelamin" class="block text-sm font-medium text-purple-700 mb-1">Jenis Kelamin</label>
          <select id="jenis_kelamin" class="input px-4 py-3 w-full" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div>
          <label for="tempat_lahir" class="block text-sm font-medium text-purple-700 mb-1">Tempat Lahir</label>
          <input type="text" id="tempat_lahir" placeholder="Tempat Lahir" class="input px-4 py-3 w-full" required>
        </div>
        <div>
          <label for="tanggal_lahir" class="block text-sm font-medium text-purple-700 mb-1">Tanggal Lahir</label>
          <input type="date" id="tanggal_lahir" class="input px-4 py-3 w-full" required>
        </div>
        <div>
          <label for="agama" class="block text-sm font-medium text-purple-700 mb-1">Agama</label>
          <select id="agama" class="input px-4 py-3 w-full" required>
            <option value="">Pilih Agama</option>
            <option value="islam">Islam</option>
            <option value="kristen">Kristen</option>
            <option value="katolik">Katolik</option>
            <option value="hindu">Hindu</option>
            <option value="buddha">Buddha</option>
            <option value="konghucu">Konghucu</option>
            <option value="lainnya">Lainnya</option>
          </select>
        </div>
        <div>
          <label for="pekerjaan" class="block text-sm font-medium text-purple-700 mb-1">Pekerjaan</label>
          <input type="text" id="pekerjaan" placeholder="Pekerjaan" class="input px-4 py-3 w-full">
        </div>
        <div>
          <label for="status_perkawinan" class="block text-sm font-medium text-purple-700 mb-1">Status Perkawinan</label>
          <select id="status_perkawinan" class="input px-4 py-3 w-full">
            <option value="">Status Perkawinan</option>
            <option value="Belum Kawin">Belum Kawin</option>
            <option value="Kawin">Kawin</option>
            <option value="Cerai Hidup">Cerai Hidup</option>
            <option value="Cerai Mati">Cerai Mati</option>
          </select>
        </div>
        <div>
          <label for="no_kk" class="block text-sm font-medium text-purple-700 mb-1">Nomor Kartu Keluarga (KK)</label>
          <input type="text" id="no_kk" placeholder="Nomor Kartu Keluarga (KK)" class="input px-4 py-3 w-full" maxlength="16">
        </div>
        <div>
          <label for="status_keluarga" class="block text-sm font-medium text-purple-700 mb-1">Status Dalam Keluarga</label>
          <select id="status_keluarga" class="input px-4 py-3 w-full">
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
        <div class="md:col-span-2">
          <label for="tanggal_kematian" class="block text-sm font-medium text-purple-700 mb-1 flex items-center gap-1">
            <span>🪦</span>
            <span>Tanggal Kematian</span>
            <span class="text-xs text-gray-400 font-normal">(opsional)</span>
          </label>
          <input type="date" id="tanggal_kematian" class="input px-4 py-3 w-full" placeholder="Tanggal Kematian">
          <span class="text-xs text-gray-500 mt-1 block">Isi jika orang yang bersangkutan telah meninggal dunia.</span>
        </div>
        <div>
          <label for="alamat" class="block text-sm font-medium text-purple-700 mb-1">Alamat</label>
          <textarea id="alamat" placeholder="Alamat Lengkap" class="input px-4 py-3 w-full" rows="2" required></textarea>
        </div>
        <div>
          <label for="pendidikan" class="block text-sm font-medium text-purple-700 mb-1">Pendidikan Terakhir</label>
          <select id="pendidikan" class="input px-4 py-3 w-full" required>
            <option value="">Pilih Pendidikan</option>
            <option value="Tidak Sekolah">Tidak Sekolah</option>
            <option value="SD/Sederajat">SD/Sederajat</option>
            <option value="SMA/Sederajat">SMA/Sederajat</option>
            <option value="Diploma">Diploma</option>
            <option value="Sarjana">Sarjana</option>
            <option value="Pascasarjana">Pascasarjana</option>
            <option value="Lainnya">Lainnya</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Submit -->
    <div class="flex gap-4">
      <button type="submit" id="submit" class="bg-purple-700 text-white px-6 py-3 rounded-lg hover:bg-purple-800 transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2">
        <span>💾</span>
        <span id="submit-label">Simpan Data</span>
      </button>
      <button type="reset" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-all duration-200 shadow-md hover:shadow-lg">
        Reset Form
      </button>
    </div>
  </form>
</div>
@endsection