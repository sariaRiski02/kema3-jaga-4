@extends('dashboard.main')

@section('content')


<!-- Fullscreen loading overlay -->
<div
  x-show="loading"
  x-cloak
  class="{{ session('status') === 'loading' ? '' : 'hidden' }} fixed inset-0 z-[9999] flex items-center justify-center bg-black/60"
  role="status"
  aria-live="polite"
>
  <div class="flex flex-col items-center gap-3 rounded-xl bg-white px-8 py-6 shadow-2xl">
    <div class="h-10 w-10 animate-spin rounded-full border-4 border-purple-200 border-t-purple-700"></div>
    <span class="font-medium text-purple-800">Memproses...</span>
  </div>
</div>

<div x-data="{ on: false, fileSelected: false, loading: false }">
  <div class="flex my-3">
    <div>
        <div class="flex items-center gap-3">
            <button 
                @click="on = !on" 
                :class="on ? 'bg-blue-600' : 'bg-red-700'"
                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-300"
            >
                <span 
                    :class="on ? 'translate-x-6' : 'translate-x-1'"
                    class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform duration-300"
                ></span>
            </button>

            <span 
                x-text="on ? 'Mode banyak' : 'Mode satuan'"
                :class="on ? 'text-blue-600' : 'text-red-700'"
                class="text-sm font-medium"
            ></span>
        </div>

        <p class="mt-1 text-xs text-gray-500" x-show="!on">
            Form Isi satu persatu
        </p>
        <p class="mt-1 text-xs text-gray-500" x-show="on">
            Form Mengisi banyak sekaligus
        </p>
    </div>

  </div>

  <!-- Form Input Data -->
  <div
  :class="on ? 'hidden' : ''"
  class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12 border-2 border-purple-200">
    <h2 class="text-xl sm:text-2xl font-bold text-purple-800 mb-4 sm:mb-6 flex items-center gap-2">
      <span>📝</span>
      <span x-text="on ? 'Tambah Data Warga dengan Banyak Sekaligus' : 'Tambah Data Warga'"></span>
    </h2>

    <form action="{{ route('store-resident') }}" method="POST" class="space-y-6 sm:space-y-10" id="addResidentForm" @submit="loading = true">
      <!-- Warga -->
      <div class="border border-purple-300 rounded-lg p-4 mb-4">
        <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
          <span>👤</span>
          <span>Data Warga</span>
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="nik" class="block text-sm font-medium text-purple-700 mb-1">NIK <span class="text-red-600">*</span> <span class="text-xs text-red-500">(Wajib)</span></label>
            <input type="text" id="nik" name="nik" value="{{ old('nik') }}" placeholder="NIK" class="input px-4 py-3 w-full" required maxlength="16" inputmode="numeric" pattern="[0-9]{16}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)">
            @error('nik') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="nama" class="block text-sm font-medium text-purple-700 mb-1">Nama Lengkap <span class="text-red-600">*</span> <span class="text-xs text-red-500">(Wajib)</span></label>
            <input type="text" id="nama" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" class="input px-4 py-3 w-full" required>
            @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="jenis_kelamin" class="block text-sm font-medium text-purple-700 mb-1">Jenis Kelamin <span class="text-red-600">*</span> <span class="text-xs text-red-500">(Wajib)</span></label>
            <select id="jenis_kelamin" name="gender" class="input px-4 py-3 w-full" required>
              <option value="">Pilih Jenis Kelamin</option>
              <option value="laki-laki" @selected(old('gender') === 'laki-laki')>Laki-laki</option>
              <option value="perempuan" @selected(old('gender') === 'perempuan')>Perempuan</option>
            </select>
            @error('gender') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="tempat_lahir" class="block text-sm font-medium text-purple-700 mb-1">Tempat Lahir  <span class="text-red-600">*</span> <span class="text-xs text-red-500">(Wajib)</span></label>
            <input type="text" id="tempat_lahir" name="place_of_birth" value="{{ old('place_of_birth') }}" placeholder="Tempat Lahir" class="input px-4 py-3 w-full" required>
            @error('place_of_birth') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="jenis_kelamin" class="block text-sm font-medium text-purple-700 mb-1">Tanggal Lahir<span class="text-red-600">*</span> <span class="text-xs text-red-500">(Wajib)</span></label>
            <input type="date" id="tanggal_lahir" name="date_of_birth" value="{{ old('date_of_birth') }}" class="input px-4 py-3 w-full" required>
            @error('date_of_birth') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="agama" class="block text-sm font-medium text-purple-700 mb-1">Agama</label>
            <select id="agama" name="religion" class="input px-4 py-3 w-full">
              <option value="">Pilih Agama</option>
              <option value="islam" @selected(old('religion') === 'islam')>Islam</option>
              <option value="kristen" @selected(old('religion') === 'kristen')>Kristen</option>
              <option value="katolik" @selected(old('religion') === 'katolik')>Katolik</option>
              <option value="hindu" @selected(old('religion') === 'hindu')>Hindu</option>
              <option value="buddha" @selected(old('religion') === 'buddha')>Buddha</option>
              <option value="konghucu" @selected(old('religion') === 'konghucu')>Konghucu</option>
              <option value="lainnya" @selected(old('religion') === 'lainnya')>Lainnya</option>
            </select>
            @error('religion') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="pekerjaan" class="block text-sm font-medium text-purple-700 mb-1">Pekerjaan</label>
            <input type="text" id="pekerjaan" name="occupation" value="{{ old('occupation') }}" placeholder="Pekerjaan" class="input px-4 py-3 w-full">
            @error('occupation') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="status_perkawinan" class="block text-sm font-medium text-purple-700 mb-1">Status Perkawinan</label>
            <select id="status_perkawinan" name="marital_status" class="input px-4 py-3 w-full">
              <option value="">Status Perkawinan</option>
              <option value="belum kawin" @selected(old('marital_status') === 'belum kawin')>Belum Kawin</option>
              <option value="kawin" @selected(old('marital_status') === 'kawin')>Kawin</option>
              <option value="cerai hidup" @selected(old('marital_status') === 'cerai hidup')>Cerai Hidup</option>
              <option value="cerai mati" @selected(old('marital_status') === 'cerai mati')>Cerai Mati</option>
            </select>
            @error('marital_status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
          <div class="md:col-span-2">
            <label for="tanggal_kematian" class="block text-sm font-medium text-purple-700 mb-1 flex items-center gap-1">
              <span>🪦</span>
              <span>Tanggal Kematian</span>
              <span class="text-xs text-gray-400 font-normal">(opsional)</span>
            </label>
            <input type="date" id="tanggal_kematian" name="date_of_death" value="{{ old('date_of_death') }}" class="input px-4 py-3 w-full" placeholder="Tanggal Kematian">
            <span class="text-xs text-gray-500 mt-1 block">Isi jika orang yang bersangkutan telah meninggal dunia.</span>
            @error('date_of_death') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="alamat" class="block text-sm font-medium text-purple-700 mb-1">Alamat</label>
            <textarea id="alamat" name="address" placeholder="Alamat Lengkap" class="input px-4 py-3 w-full" rows="2">{{ old('address') }}</textarea>
            @error('address') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="pendidikan" class="block text-sm font-medium text-purple-700 mb-1">Pendidikan</label>
            <select id="pendidikan" name="education" class="input px-4 py-3 w-full">
              <option value="">Pilih Pendidikan</option>
              <option value="tidak sekolah" @selected(old('education') === 'tidak sekolah')>Tidak Sekolah</option>
              <option value="sd" @selected(old('education') === 'sd')>SD</option>
              <option value="smp" @selected(old('education') === 'smp')>SMP</option>
              <option value="sma" @selected(old('education') === 'sma')>SMA</option>
              <option value="sd/sederajat" @selected(old('education') === 'sd/sederajat')>SD/Sederajat</option>
              <option value="sma/sederajat" @selected(old('education') === 'sma/sederajat')>SMA/Sederajat</option>
              <option value="diploma" @selected(old('education') === 'diploma')>Diploma</option>
              <option value="sarjana" @selected(old('education') === 'sarjana')>Sarjana</option>
              <option value="magister" @selected(old('education') === 'magister')>Magister</option>
              <option value="doktor" @selected(old('education') === 'doktor')>Doktor</option>
              <option value="lainnya" @selected(old('education') === 'lainnya')>Lainnya</option>
            </select>
            @error('education') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
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

  <!-- Import Excel Section -->
  <form action="{{ route('import-data') }}" method="POST" enctype="multipart/form-data" id="importForm" @submit="loading = true">
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

      <a href="{{ route('download-template') }}" id="downloadTemplateBtn" class="shrink-0 bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition-all duration-200 font-semibold flex items-center gap-2">
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

</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    if (!window.Echo) {
      console.error('Laravel Echo belum tersedia.');
      return;
    }

    window.Echo.channel('import')
      .listen('.ImportCompleted', (event) => {
        console.log('Import selesai!', event);
      });
  });
</script>
@endsection