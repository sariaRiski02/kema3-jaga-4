@extends('dashboard.main')

@section('content')


<!-- Form Input Data -->
  <div
  :class="on ? 'hidden' : ''"
  class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12 border-2 border-purple-200">
    <h2 class="text-xl sm:text-2xl font-bold text-purple-800 mb-4 sm:mb-6 flex items-center gap-2">
      <span>📝</span>
      
    </h2>

    <form action="{{ route('dashboard.store-resident') }}" method="POST" class="space-y-6 sm:space-y-10" id="addResidentForm" @submit="loading = true">
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
            <input type="text" id="tanggal_lahir" name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="dd-mm-yyyy" class="input px-4 py-3 w-full" required inputmode="numeric" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
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
            <input type="text" id="tanggal_kematian" name="date_of_death" value="{{ old('date_of_death') }}" class="input px-4 py-3 w-full" placeholder="dd-mm-yyyy" inputmode="numeric" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
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
              <option value="sd" @selected(old('education') === 'sd')>SD (sedang sekolah)</option>
              <option value="smp" @selected(old('education') === 'smp')>SMP (sedang sekolah)</option>
              <option value="sma" @selected(old('education') === 'sma')>SMA (sedang sekolah)</option>
              <option value="sd/sederajat" @selected(old('education') === 'sd/sederajat')>SD/Sederajat (sudah lulus)</option>
              <option value="smp/sederajat" @selected(old('education') === 'smp/sederajat')>SMP/Sederajat (sudah lulus)</option>
              <option value="sma/sederajat" @selected(old('education') === 'sma/sederajat')>SMA/Sederajat (sudah lulus)</option>
              <option value="diploma" @selected(old('education') === 'diploma')>Diploma</option>
              <option value="sarjana" @selected(old('education') === 'sarjana')>Sarjana</option>
              <option value="magister" @selected(old('education') === 'magister')>Magister</option>
              <option value="doktor" @selected(old('education') === 'doktor')>Doktor</option>
              <option value="lainnya" @selected(old('education') === 'lainnya')>Lainnya</option>
            </select>
            @error('education') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            <label class="mt-3 flex items-center gap-2 text-sm text-gray-600">
              <input type="checkbox" name="is_currently_studying" value="1" class="rounded border-gray-300 text-purple-700 focus:ring-purple-500" @checked(old('is_currently_studying'))>
              <span>Saat ini masih bersekolah/kuliah</span>
            </label>
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