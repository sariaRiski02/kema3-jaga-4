@extends('dashboard.main')
@section('content')



  <!-- Import Excel Section -->
  <form action="{{ route('dashboard.store-import-resident') }}" method="POST" enctype="multipart/form-data" id="importForm" @submit="loading = true">
    @csrf
    <div 
    :class="on ? '' : 'hidden'"
    class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12">

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

        <a href="{{ route('dashboard.download-template') }}" id="downloadTemplateBtn" class="shrink-0 bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition-all duration-200 font-semibold flex items-center gap-2">
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
              <input type="file" id="excelFileInput" x-ref="excelFileInput" accept=".xlsx,.xls,.csv" class="hidden" name="file" required @change="fileSelected = $event.target.files.length > 0">
              <button type="button" id="selectFileBtn" @click="$refs.excelFileInput.click()" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-all duration-200 font-semibold">
                📂 Pilih File Excel
              </button>
            </div>
            <p class="text-sm text-gray-500">
              Format yang didukung: .xlsx, .xls, .csv (maksimal 10MB)
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
        <!-- Import Button -->
        <div class="mt-4">
          <button type="submit" id="importBtn" x-show="fileSelected" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-all duration-200 font-semibold flex items-center gap-2">
            <span>📊</span>
            <span>Import Data</span>
          </button>
        </div>
      </div>

      <!-- Preview Data -->
      <div id="previewSection" class="">
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
  </form>
@endsection