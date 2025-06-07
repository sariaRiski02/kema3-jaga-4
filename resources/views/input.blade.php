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
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Katolik">Katolik</option>
            <option value="Hindu">Hindu</option>
            <option value="Buddha">Buddha</option>
            <option value="Konghucu">Konghucu</option>
            <option value="Lainnya">Lainnya</option>
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
            <option value="SMP/Sederajat">SMP/Sederajat</option>
            <option value="SMA/Sederajat">SMA/Sederajat</option>
            <option value="Diploma">Diploma</option>
            <option value="Sarjana">Sarjana</option>
            <option value="Pascasarjana">Pascasarjana</option>
            <option value="Lainnya">Lainnya</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Rumah -->
    <div class="border border-purple-300 rounded-lg p-4 mb-4">
      <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
        <span>🏠</span>
        <span>Kepemilikan Rumah</span>
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="status_rumah" class="block text-sm font-medium text-purple-700 mb-1">Status Rumah</label>
          <select id="status_rumah" class="input px-4 py-3 w-full">
            <option value="">Status Rumah</option>
            <option value="milik_sendiri">Milik Sendiri</option>
            <option value="sewa">Sewa</option>
            <option value="kontrak">Kontrak</option>
            <option value="numpang">Numpang</option>
          </select>
        </div>
        <div>
          <label for="tipe_rumah" class="block text-sm font-medium text-purple-700 mb-1">Tipe Rumah</label>
          <select id="tipe_rumah" class="input px-4 py-3 w-full">
            <option value="">Tipe Rumah</option>
            <option value="permanen">Permanen</option>
            <option value="semi_permanen">Semi Permanen</option>
            <option value="non_permanen">Non Permanen</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Kendaraan -->
    <div class="border border-purple-300 rounded-lg p-4 mb-4">
      <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
        <span>🚗</span>
        <span>Kepemilikan Kendaraan</span>
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label for="motor_roda2" class="block text-sm font-medium text-purple-700 mb-1">Motor Roda 2</label>
          <input type="number" id="motor_roda2" placeholder="Motor Roda 2" class="input px-4 py-3 w-full" min="0">
        </div>
        <div>
          <label for="mobil_roda4" class="block text-sm font-medium text-purple-700 mb-1">Mobil Roda 4</label>
          <input type="number" id="mobil_roda4" placeholder="Mobil Roda 4" class="input px-4 py-3 w-full" min="0">
        </div>
        <div>
          <label for="bus_truk" class="block text-sm font-medium text-purple-700 mb-1">Bus/Truk</label>
          <input type="number" id="bus_truk" placeholder="Bus/Truk" class="input px-4 py-3 w-full" min="0">
        </div>
      </div>
    </div>

    <!-- Usaha -->
    <div class="border border-purple-300 rounded-lg p-4 mb-4">
      <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
        <span>💼</span>
        <span>Jenis Usaha</span>
      </h3>
      <div>
        <label for="jenis_usaha" class="block text-sm font-medium text-purple-700 mb-1">Jenis Usaha</label>
        <input type="text" id="jenis_usaha" placeholder="Jenis Usaha (kosongkan jika tidak ada)" class="input w-full px-4 py-3">
      </div>
    </div>

    <!-- Bahan Bakar -->
    <div class="border border-purple-300 rounded-lg p-4 mb-4">
      <h3 class="text-lg sm:text-xl font-semibold text-purple-700 mb-3 sm:mb-4 flex items-center gap-2">
        <span>⛽</span>
        <span>Penggunaan Bahan Bakar</span>
      </h3>
      <div class="flex flex-wrap gap-4 sm:gap-6">
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" id="gas" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
          <span>Gas</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" id="kayu_bakar" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
          <span>Kayu Bakar</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" id="minyak_tanah" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
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
          <input type="checkbox" id="sumur" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
          <span>Sumur</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" id="mata_air" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
          <span>Mata Air</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" id="air_lainnya" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
          <span>Lainnya</span>
        </label>
      </div>
    </div>

    <!-- Submit -->
    <div class="flex gap-4">
      <button type="submit" id="submit" class="bg-purple-700 text-white px-6 py-3 rounded-lg hover:bg-purple-800 transition-all duration-200 flex items-center gap-2">
        <span>💾</span>
        <span>Simpan Data</span>
      </button>
      <button type="reset" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-all duration-200">
        Reset Form
      </button>
    </div>
  </form>
</div>