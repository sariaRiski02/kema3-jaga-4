@extends('dashboard.main')
@section('content')



  <!-- Import Excel Section -->
  <form action="{{ route('dashboard.store-import-resident') }}" method="POST" enctype="multipart/form-data" id="importForm" x-data="{ fileSelected: false, loading: false }" @submit="loading = true">
    @csrf
    <div 
    :class="on ? '' : 'hidden'"
    class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12">

      @if (session('import-summary'))
        @php($summary = session('import-summary'))
        <div class="mb-6 rounded-xl border border-blue-200 bg-blue-50 p-4 text-sm text-blue-900">
          <p class="font-semibold">Import selesai</p>
          <p>{{ $summary['imported'] }} data berhasil disimpan dan {{ $summary['failed'] }} data dilewati.</p>
          @if ($summary['failed'] > 0)
            <ul class="mt-2 list-disc space-y-1 pl-5">
              @foreach ($summary['errors'] as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif
        </div>
      @endif

      <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
        <div>
          <h2 class="text-xl sm:text-2xl font-bold text-purple-800 flex items-center gap-2">
            <span>📊</span>
            <span>Import Data dari Excel</span>
          </h2>
          <p class="text-sm text-gray-500 mt-2 max-w-xl">
            Unggah data warga dalam jumlah banyak sekaligus. Pastikan susunan kolom pada file Excel mengikuti template di bawah ini.
          </p>
        </div>

        <a href="{{ route('dashboard.download-template') }}" id="downloadTemplateBtn" class="shrink-0 bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition-all duration-200 font-semibold flex items-center gap-2">
          <span>📋</span>
          <span>Download Template Import</span>
        </a>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="rounded-xl border border-red-200 bg-red-50 p-4">
          <h3 class="font-bold text-red-700 mb-3">Kolom wajib</h3>
          <ul class="space-y-2 text-sm text-red-800">
            <li>• nik</li>
            <li>• nama</li>
            <li>• jenis_kelamin</li>
            <li>• tempat_lahir</li>
            <li>• tanggal_lahir</li>
          </ul>
        </div>

        <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">
          <h3 class="font-bold text-amber-700 mb-3">Kolom tambahan (opsional)</h3>
          <ul class="space-y-2 text-sm text-amber-800">
            <li>• tanggal_kematian</li>
            <li>• alamat</li>
            <li>• status_dikeluarga</li>
            <li>• pekerjaan</li>
            <li>• agama</li>
            <li>• status_perkawinan</li>
            <li>• pendidikan</li>
            <li>• sedang_bersekolah</li>
            <li>• no_kk</li>
          </ul>
        </div>
      </div>

      <div class="mb-8 overflow-x-auto rounded-xl border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700">
          <thead class="bg-gray-100 text-gray-700">
            <tr>
              <th class="px-4 py-3 font-semibold">Urutan kolom</th>
              <th class="px-4 py-3 font-semibold">Nama kolom</th>
              <th class="px-4 py-3 font-semibold">Status</th>
              <th class="px-4 py-3 font-semibold">Cara mengisi</th>
              <th class="px-4 py-3 font-semibold">Contoh</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <tr><td class="px-4 py-2">1</td><td class="px-4 py-2 font-medium">nik</td><td class="px-4 py-2 text-red-600 font-medium">Wajib</td><td class="px-4 py-2">16 digit angka, jangan gunakan tanda baca.</td><td class="px-4 py-2 whitespace-nowrap">1234567890123456</td></tr>
            <tr><td class="px-4 py-2">2</td><td class="px-4 py-2 font-medium">nama</td><td class="px-4 py-2 text-red-600 font-medium">Wajib</td><td class="px-4 py-2">Nama lengkap warga.</td><td class="px-4 py-2">Budi Santoso</td></tr>
            <tr><td class="px-4 py-2">3</td><td class="px-4 py-2 font-medium">jenis_kelamin</td><td class="px-4 py-2 text-red-600 font-medium">Wajib</td><td class="px-4 py-2">Isi laki-laki atau perempuan. Huruf besar-kecil tidak berpengaruh.</td><td class="px-4 py-2">Laki-laki</td></tr>
            <tr><td class="px-4 py-2">4</td><td class="px-4 py-2 font-medium">tempat_lahir</td><td class="px-4 py-2 text-red-600 font-medium">Wajib</td><td class="px-4 py-2">Nama kota atau tempat lahir.</td><td class="px-4 py-2">Bandung</td></tr>
            <tr><td class="px-4 py-2">5</td><td class="px-4 py-2 font-medium">tanggal_lahir</td><td class="px-4 py-2 text-red-600 font-medium">Wajib</td><td class="px-4 py-2">Gunakan format hari-bulan-tahun.</td><td class="px-4 py-2 whitespace-nowrap">12-05-1990</td></tr>
            <tr><td class="px-4 py-2">6</td><td class="px-4 py-2 font-medium">tanggal_kematian</td><td class="px-4 py-2 text-amber-700 font-medium">Opsional</td><td class="px-4 py-2">Kosongkan jika masih hidup. Gunakan format hari-bulan-tahun.</td><td class="px-4 py-2 whitespace-nowrap">12-05-2020</td></tr>
            <tr><td class="px-4 py-2">7</td><td class="px-4 py-2 font-medium">alamat</td><td class="px-4 py-2 text-amber-700 font-medium">Opsional</td><td class="px-4 py-2">Alamat tempat tinggal warga.</td><td class="px-4 py-2">Jl. Merdeka No. 1</td></tr>
            <tr><td class="px-4 py-2">8</td><td class="px-4 py-2 font-medium">status_dikeluarga</td><td class="px-4 py-2 text-amber-700 font-medium">Opsional</td><td class="px-4 py-2">Hubungan dalam keluarga.</td><td class="px-4 py-2">kepala keluarga / anak / istri</td></tr>
            <tr><td class="px-4 py-2">9</td><td class="px-4 py-2 font-medium">pekerjaan</td><td class="px-4 py-2 text-amber-700 font-medium">Opsional</td><td class="px-4 py-2">Pekerjaan warga dalam bentuk teks.</td><td class="px-4 py-2">PNS</td></tr>
            <tr><td class="px-4 py-2">10</td><td class="px-4 py-2 font-medium">agama</td><td class="px-4 py-2 text-amber-700 font-medium">Opsional</td><td class="px-4 py-2">Islam, Kristen, Katolik, Hindu, Buddha, Konghucu, atau lainnya.</td><td class="px-4 py-2">Islam</td></tr>
            <tr><td class="px-4 py-2">11</td><td class="px-4 py-2 font-medium">status_perkawinan</td><td class="px-4 py-2 text-amber-700 font-medium">Opsional</td><td class="px-4 py-2">Belum kawin, kawin, cerai hidup, atau cerai mati.</td><td class="px-4 py-2">Kawin</td></tr>
            <tr><td class="px-4 py-2">12</td><td class="px-4 py-2 font-medium">pendidikan</td><td class="px-4 py-2 text-amber-700 font-medium">Opsional</td><td class="px-4 py-2">Pendidikan terakhir, misalnya SMA/Sederajat, Sarjana, Magister, atau Doktor.</td><td class="px-4 py-2">Sarjana</td></tr>
            <tr><td class="px-4 py-2">13</td><td class="px-4 py-2 font-medium">sedang_bersekolah</td><td class="px-4 py-2 text-amber-700 font-medium">Opsional</td><td class="px-4 py-2">Isi ya jika saat ini masih sekolah atau kuliah. Isi tidak jika sudah tidak bersekolah.</td><td class="px-4 py-2">ya / tidak</td></tr>
            <tr><td class="px-4 py-2">14</td><td class="px-4 py-2 font-medium">no_kk</td><td class="px-4 py-2 text-amber-700 font-medium">Opsional</td><td class="px-4 py-2">16 digit angka. Atur kolom Excel sebagai teks agar angka 0 di depan tidak hilang.</td><td class="px-4 py-2 whitespace-nowrap">1234567890123456</td></tr>
          </tbody>
        </table>
      </div>

      <div class="mb-6 rounded-xl border border-blue-200 bg-blue-50 p-4 text-sm text-blue-800">
        <strong>Catatan pengisian:</strong> Nama kolom harus sama persis dengan template. Gunakan kolom <strong>sedang_bersekolah</strong> dengan nilai ya/tidak untuk menandai apakah warga masih sekolah atau kuliah, termasuk pada pendidikan Sarjana, Magister, dan Doktor. Kolom tambahan boleh dihapus atau dikosongkan; jika diisi, nilainya akan disimpan. Tanggal dapat ditulis dengan format <strong>dd-mm-yyyy</strong>, contohnya <strong>12-05-1990</strong>.
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
              Format yang didukung: .xlsx, .xls, .csv (maksimal 50MB)
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

      
    </div>
  </form>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const form = document.getElementById('importForm');
      const dropZone = document.getElementById('fileDropZone');
      const fileInput = document.getElementById('excelFileInput');
      const selectButton = document.getElementById('selectFileBtn');
      const fileInfo = document.getElementById('fileInfo');
      const fileName = document.getElementById('fileName');
      const fileSize = document.getElementById('fileSize');
      const removeButton = document.getElementById('removeFileBtn');
      const allowedExtensions = ['xlsx', 'xls', 'csv'];
      const maxFileSize = 50 * 1024 * 1024;

      if (!form || !dropZone || !fileInput) return;

      const setSelectedState = (selected) => {
        form._x_dataStack?.[0] && (form._x_dataStack[0].fileSelected = selected);
      };

      const clearFile = () => {
        fileInput.value = '';
        fileInfo.classList.add('hidden');
        fileName.textContent = '';
        fileSize.textContent = '';
        setSelectedState(false);
      };

      const formatSize = (bytes) => {
        if (bytes < 1024 * 1024) return `${Math.ceil(bytes / 1024)} KB`;
        return `${(bytes / (1024 * 1024)).toFixed(2)} MB`;
      };

      const showFile = (file) => {
        if (!file) return;

        const extension = file.name.split('.').pop().toLowerCase();
        if (!allowedExtensions.includes(extension)) {
          alert('File harus berformat .xlsx, .xls, atau .csv.');
          clearFile();
          return;
        }

        if (file.size > maxFileSize) {
          alert('Ukuran file maksimal 50MB.');
          clearFile();
          return;
        }

        fileName.textContent = file.name;
        fileSize.textContent = formatSize(file.size);
        fileInfo.classList.remove('hidden');
        setSelectedState(true);
      };

      selectButton?.addEventListener('click', () => fileInput.click());
      fileInput.addEventListener('change', () => showFile(fileInput.files[0]));
      removeButton?.addEventListener('click', clearFile);

      ['dragenter', 'dragover'].forEach((eventName) => {
        dropZone.addEventListener(eventName, (event) => {
          event.preventDefault();
          dropZone.classList.add('border-purple-700', 'bg-purple-100');
        });
      });

      ['dragleave', 'drop'].forEach((eventName) => {
        dropZone.addEventListener(eventName, (event) => {
          event.preventDefault();
          dropZone.classList.remove('border-purple-700', 'bg-purple-100');
        });
      });

      dropZone.addEventListener('drop', (event) => {
        const file = event.dataTransfer.files[0];
        if (!file) return;

        const transfer = new DataTransfer();
        transfer.items.add(file);
        fileInput.files = transfer.files;
        showFile(file);
      });
    });
  </script>
@endsection