@extends('dashboard.main')

@section('content')

<div class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12 border-2 border-purple-200">
  <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <p class="text-sm font-medium text-purple-700">Data Warga</p>
      <h1 class="text-xl sm:text-2xl font-bold text-purple-800">Ubah Data Warga</h1>
    </div>
    <a href="{{ route('dashboard.show-resident', $resident->nik) }}" class="inline-flex items-center justify-center rounded-lg border border-purple-200 bg-purple-50 px-4 py-2 text-sm font-semibold text-purple-700 transition hover:bg-purple-100">
      Lihat Detail
    </a>
  </div>

  <form action="{{ route('dashboard.update-resident', $resident->nik) }}" method="POST" class="space-y-6 sm:space-y-10" id="updateResidentForm" x-data="{
    editing: {
      nik: {{ $errors->has('nik') ? 'true' : 'false' }},
      name: {{ $errors->has('name') ? 'true' : 'false' }},
      gender: {{ $errors->has('gender') ? 'true' : 'false' }},
      place_of_birth: {{ $errors->has('place_of_birth') ? 'true' : 'false' }},
      date_of_birth: {{ $errors->has('date_of_birth') ? 'true' : 'false' }},
      religion: {{ $errors->has('religion') ? 'true' : 'false' }},
      occupation: {{ $errors->has('occupation') ? 'true' : 'false' }},
      marital_status: {{ $errors->has('marital_status') ? 'true' : 'false' }},
      date_of_death: {{ $errors->has('date_of_death') ? 'true' : 'false' }},
      address: {{ $errors->has('address') ? 'true' : 'false' }},
      education: {{ $errors->has('education') ? 'true' : 'false' }}
    }
  }" @submit="loading = true">
    @csrf
    @method('PUT')

    <div class="border border-purple-300 rounded-lg p-4 mb-4">
      <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
        <span>👤</span>
        <span>Data Warga</span>
      </h3>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-3">
          <div class="mb-2 flex items-center justify-between gap-2">
            <label class="block text-sm font-medium text-purple-700">NIK <span class="text-red-600">*</span></label>
            <button type="button" @click="editing.nik = !editing.nik" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white text-purple-700 shadow-sm ring-1 ring-purple-200 transition hover:bg-purple-100" aria-label="Edit NIK">
              <span x-text="editing.nik ? '✖️' : '✏️'">✏️</span>
            </button>
          </div>

          <div x-show="!editing.nik" x-transition class="min-h-[48px] rounded-lg border border-dashed border-purple-200 bg-white px-3 py-2 text-sm text-gray-700">
            {{ old('nik', $resident->nik) ?: 'Belum diisi' }}
          </div>

          <div x-show="editing.nik" x-transition class="mt-2">
            <input type="text" id="nik" name="nik" value="{{ old('nik', $resident->nik) }}" placeholder="NIK" class="input px-4 py-3 w-full" required maxlength="16" inputmode="numeric" pattern="[0-9]{16}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)">
            @error('nik') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-3">
          <div class="mb-2 flex items-center justify-between gap-2">
            <label class="block text-sm font-medium text-purple-700">Nama Lengkap <span class="text-red-600">*</span></label>
            <button type="button" @click="editing.name = !editing.name" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white text-purple-700 shadow-sm ring-1 ring-purple-200 transition hover:bg-purple-100" aria-label="Edit Nama Lengkap">
              <span x-text="editing.name ? '✖️' : '✏️'">✏️</span>
            </button>
          </div>

          <div x-show="!editing.name" x-transition class="min-h-[48px] rounded-lg border border-dashed border-purple-200 bg-white px-3 py-2 text-sm text-gray-700">
            {{ old('name', $resident->name) ?: 'Belum diisi' }}
          </div>

          <div x-show="editing.name" x-transition class="mt-2">
            <input type="text" id="nama" name="name" value="{{ old('name', $resident->name) }}" placeholder="Nama Lengkap" class="input px-4 py-3 w-full" required>
            @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-3">
          <div class="mb-2 flex items-center justify-between gap-2">
            <label class="block text-sm font-medium text-purple-700">Jenis Kelamin <span class="text-red-600">*</span></label>
            <button type="button" @click="editing.gender = !editing.gender" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white text-purple-700 shadow-sm ring-1 ring-purple-200 transition hover:bg-purple-100" aria-label="Edit Jenis Kelamin">
              <span x-text="editing.gender ? '✖️' : '✏️'">✏️</span>
            </button>
          </div>

          <div x-show="!editing.gender" x-transition class="min-h-[48px] rounded-lg border border-dashed border-purple-200 bg-white px-3 py-2 text-sm text-gray-700">
            {{ old('gender', $resident->gender) ?: 'Belum diisi' }}
          </div>

          <div x-show="editing.gender" x-transition class="mt-2">
            <select id="jenis_kelamin" name="gender" class="input px-4 py-3 w-full" required>
              <option value="">Pilih Jenis Kelamin</option>
              <option value="laki-laki" @selected(old('gender', $resident->gender) === 'laki-laki')>Laki-laki</option>
              <option value="perempuan" @selected(old('gender', $resident->gender) === 'perempuan')>Perempuan</option>
            </select>
            @error('gender') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-3">
          <div class="mb-2 flex items-center justify-between gap-2">
            <label class="block text-sm font-medium text-purple-700">Tempat Lahir <span class="text-red-600">*</span></label>
            <button type="button" @click="editing.place_of_birth = !editing.place_of_birth" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white text-purple-700 shadow-sm ring-1 ring-purple-200 transition hover:bg-purple-100" aria-label="Edit Tempat Lahir">
              <span x-text="editing.place_of_birth ? '✖️' : '✏️'">✏️</span>
            </button>
          </div>

          <div x-show="!editing.place_of_birth" x-transition class="min-h-[48px] rounded-lg border border-dashed border-purple-200 bg-white px-3 py-2 text-sm text-gray-700">
            {{ old('place_of_birth', $resident->place_of_birth) ?: 'Belum diisi' }}
          </div>

          <div x-show="editing.place_of_birth" x-transition class="mt-2">
            <input type="text" id="tempat_lahir" name="place_of_birth" value="{{ old('place_of_birth', $resident->place_of_birth) }}" placeholder="Tempat Lahir" class="input px-4 py-3 w-full" required>
            @error('place_of_birth') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-3">
          <div class="mb-2 flex items-center justify-between gap-2">
            <label class="block text-sm font-medium text-purple-700">Tanggal Lahir <span class="text-red-600">*</span></label>
            <button type="button" @click="editing.date_of_birth = !editing.date_of_birth" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white text-purple-700 shadow-sm ring-1 ring-purple-200 transition hover:bg-purple-100" aria-label="Edit Tanggal Lahir">
              <span x-text="editing.date_of_birth ? '✖️' : '✏️'">✏️</span>
            </button>
          </div>

          <div x-show="!editing.date_of_birth" x-transition class="min-h-[48px] rounded-lg border border-dashed border-purple-200 bg-white px-3 py-2 text-sm text-gray-700">
            {{ old('date_of_birth', $resident->date_of_birth?->format('d-m-Y')) ?: 'Belum diisi' }}
          </div>

          <div x-show="editing.date_of_birth" x-transition class="mt-2">
            <input type="text" id="tanggal_lahir" name="date_of_birth" value="{{ old('date_of_birth', $resident->date_of_birth?->format('d-m-Y')) }}" placeholder="dd-mm-yyyy" class="input px-4 py-3 w-full" required inputmode="numeric" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
            @error('date_of_birth') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-3">
          <div class="mb-2 flex items-center justify-between gap-2">
            <label class="block text-sm font-medium text-purple-700">Agama</label>
            <button type="button" @click="editing.religion = !editing.religion" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white text-purple-700 shadow-sm ring-1 ring-purple-200 transition hover:bg-purple-100" aria-label="Edit Agama">
              <span x-text="editing.religion ? '✖️' : '✏️'">✏️</span>
            </button>
          </div>

          <div x-show="!editing.religion" x-transition class="min-h-[48px] rounded-lg border border-dashed border-purple-200 bg-white px-3 py-2 text-sm text-gray-700">
            {{ old('religion', $resident->religion) ?: 'Belum diisi' }}
          </div>

          <div x-show="editing.religion" x-transition class="mt-2">
            <select id="agama" name="religion" class="input px-4 py-3 w-full">
              <option value="">Pilih Agama</option>
              <option value="islam" @selected(old('religion', $resident->religion) === 'islam')>Islam</option>
              <option value="kristen" @selected(old('religion', $resident->religion) === 'kristen')>Kristen</option>
              <option value="katolik" @selected(old('religion', $resident->religion) === 'katolik')>Katolik</option>
              <option value="hindu" @selected(old('religion', $resident->religion) === 'hindu')>Hindu</option>
              <option value="buddha" @selected(old('religion', $resident->religion) === 'buddha')>Buddha</option>
              <option value="konghucu" @selected(old('religion', $resident->religion) === 'konghucu')>Konghucu</option>
              <option value="lainnya" @selected(old('religion', $resident->religion) === 'lainnya')>Lainnya</option>
            </select>
            @error('religion') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-3">
          <div class="mb-2 flex items-center justify-between gap-2">
            <label class="block text-sm font-medium text-purple-700">Pekerjaan</label>
            <button type="button" @click="editing.occupation = !editing.occupation" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white text-purple-700 shadow-sm ring-1 ring-purple-200 transition hover:bg-purple-100" aria-label="Edit Pekerjaan">
              <span x-text="editing.occupation ? '✖️' : '✏️'">✏️</span>
            </button>
          </div>

          <div x-show="!editing.occupation" x-transition class="min-h-[48px] rounded-lg border border-dashed border-purple-200 bg-white px-3 py-2 text-sm text-gray-700">
            {{ old('occupation', $resident->occupation) ?: 'Belum diisi' }}
          </div>

          <div x-show="editing.occupation" x-transition class="mt-2">
            <input type="text" id="pekerjaan" name="occupation" value="{{ old('occupation', $resident->occupation) }}" placeholder="Pekerjaan" class="input px-4 py-3 w-full">
            @error('occupation') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-3">
          <div class="mb-2 flex items-center justify-between gap-2">
            <label class="block text-sm font-medium text-purple-700">Status Perkawinan</label>
            <button type="button" @click="editing.marital_status = !editing.marital_status" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white text-purple-700 shadow-sm ring-1 ring-purple-200 transition hover:bg-purple-100" aria-label="Edit Status Perkawinan">
              <span x-text="editing.marital_status ? '✖️' : '✏️'">✏️</span>
            </button>
          </div>

          <div x-show="!editing.marital_status" x-transition class="min-h-[48px] rounded-lg border border-dashed border-purple-200 bg-white px-3 py-2 text-sm text-gray-700">
            {{ old('marital_status', $resident->marital_status) ?: 'Belum diisi' }}
          </div>

          <div x-show="editing.marital_status" x-transition class="mt-2">
            <select id="status_perkawinan" name="marital_status" class="input px-4 py-3 w-full">
              <option value="">Status Perkawinan</option>
              <option value="belum kawin" @selected(old('marital_status', $resident->marital_status) === 'belum kawin')>Belum Kawin</option>
              <option value="kawin" @selected(old('marital_status', $resident->marital_status) === 'kawin')>Kawin</option>
              <option value="cerai hidup" @selected(old('marital_status', $resident->marital_status) === 'cerai hidup')>Cerai Hidup</option>
              <option value="cerai mati" @selected(old('marital_status', $resident->marital_status) === 'cerai mati')>Cerai Mati</option>
            </select>
            @error('marital_status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="md:col-span-2 rounded-xl border border-purple-100 bg-purple-50/40 p-3">
          <div class="mb-2 flex items-center justify-between gap-2">
            <label class="block text-sm font-medium text-purple-700">Tanggal Kematian</label>
            <button type="button" @click="editing.date_of_death = !editing.date_of_death" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white text-purple-700 shadow-sm ring-1 ring-purple-200 transition hover:bg-purple-100" aria-label="Edit Tanggal Kematian">
              <span x-text="editing.date_of_death ? '✖️' : '✏️'">✏️</span>
            </button>
          </div>

          <div x-show="!editing.date_of_death" x-transition class="min-h-[48px] rounded-lg border border-dashed border-purple-200 bg-white px-3 py-2 text-sm text-gray-700">
            {{ old('date_of_death', $resident->date_of_death?->format('d-m-Y')) ?: 'Belum diisi' }}
          </div>

          <div x-show="editing.date_of_death" x-transition class="mt-2">
            <input type="text" id="tanggal_kematian" name="date_of_death" value="{{ old('date_of_death', $resident->date_of_death?->format('d-m-Y')) }}" class="input px-4 py-3 w-full" placeholder="dd-mm-yyyy" inputmode="numeric" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
            <span class="text-xs text-gray-500 mt-1 block">Isi jika orang yang bersangkutan telah meninggal dunia.</span>
            @error('date_of_death') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-3">
          <div class="mb-2 flex items-center justify-between gap-2">
            <label class="block text-sm font-medium text-purple-700">Alamat</label>
            <button type="button" @click="editing.address = !editing.address" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white text-purple-700 shadow-sm ring-1 ring-purple-200 transition hover:bg-purple-100" aria-label="Edit Alamat">
              <span x-text="editing.address ? '✖️' : '✏️'">✏️</span>
            </button>
          </div>

          <div x-show="!editing.address" x-transition class="min-h-[48px] rounded-lg border border-dashed border-purple-200 bg-white px-3 py-2 text-sm text-gray-700 whitespace-pre-line">
            {{ old('address', $resident->address) ?: 'Belum diisi' }}
          </div>

          <div x-show="editing.address" x-transition class="mt-2">
            <textarea id="alamat" name="address" placeholder="Alamat Lengkap" class="input px-4 py-3 w-full" rows="2">{{ old('address', $resident->address) }}</textarea>
            @error('address') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-3">
          <div class="mb-2 flex items-center justify-between gap-2">
            <label class="block text-sm font-medium text-purple-700">Pendidikan</label>
            <button type="button" @click="editing.education = !editing.education" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white text-purple-700 shadow-sm ring-1 ring-purple-200 transition hover:bg-purple-100" aria-label="Edit Pendidikan">
              <span x-text="editing.education ? '✖️' : '✏️'">✏️</span>
            </button>
          </div>

          <div x-show="!editing.education" x-transition class="min-h-[48px] rounded-lg border border-dashed border-purple-200 bg-white px-3 py-2 text-sm text-gray-700">
            {{ old('education', $resident->education) ?: 'Belum diisi' }}
          </div>

          <div x-show="editing.education" x-transition class="mt-2">
            <select id="pendidikan" name="education" class="input px-4 py-3 w-full">
              <option value="">Pilih Pendidikan</option>
              <option value="tidak sekolah" @selected(old('education', $resident->education) === 'tidak sekolah')>Tidak Sekolah</option>
              <option value="sd" @selected(old('education', $resident->education) === 'sd')>SD (sedang sekolah)</option>
              <option value="smp" @selected(old('education', $resident->education) === 'smp')>SMP (sedang sekolah)</option>
              <option value="sma" @selected(old('education', $resident->education) === 'sma')>SMA (sedang sekolah)</option>
              <option value="sd/sederajat" @selected(old('education', $resident->education) === 'sd/sederajat')>SD/Sederajat (sudah lulus)</option>
              <option value="smp/sederajat" @selected(old('education', $resident->education) === 'smp/sederajat')>SMP/Sederajat (sudah lulus)</option>
              <option value="sma/sederajat" @selected(old('education', $resident->education) === 'sma/sederajat')>SMA/Sederajat (sudah lulus)</option>
              <option value="diploma" @selected(old('education', $resident->education) === 'diploma')>Diploma</option>
              <option value="sarjana" @selected(old('education', $resident->education) === 'sarjana')>Sarjana</option>
              <option value="magister" @selected(old('education', $resident->education) === 'magister')>Magister</option>
              <option value="doktor" @selected(old('education', $resident->education) === 'doktor')>Doktor</option>
              <option value="lainnya" @selected(old('education', $resident->education) === 'lainnya')>Lainnya</option>
            </select>
            @error('education') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            <label class="mt-3 flex items-center gap-2 text-sm text-gray-600">
              <input type="checkbox" name="is_currently_studying" value="1" class="rounded border-gray-300 text-purple-700 focus:ring-purple-500" @checked(old('is_currently_studying', $resident->is_currently_studying))>
              <span>Saat ini masih bersekolah/kuliah</span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-wrap gap-4">
      <button type="submit" id="submit" class="bg-purple-700 text-white px-6 py-3 rounded-lg hover:bg-purple-800 transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2">
        <span>💾</span>
        <span id="submit-label">Simpan Perubahan</span>
      </button>
      <a href="{{ route('dashboard.show-resident', $resident->nik) }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-all duration-200 shadow-md hover:shadow-lg inline-flex items-center justify-center">
        Batal
      </a>
    </div>
  </form>
</div>

@endsection