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
      <input type="text" id="no_kk" name="no_kk" placeholder="Nomor Kartu Keluarga (KK)" class="input px-4 py-3" maxlength="16">
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