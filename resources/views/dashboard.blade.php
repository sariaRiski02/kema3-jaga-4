<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Desa Kema 3 - Jaga 4</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .input {
      @apply p-3 border border-purple-300 bg-white rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-purple-400;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

  <header class="bg-purple-700 text-white shadow-md">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold">Dashboard Desa Kema 3 – Jaga 4</h1>
      <a href="visualisasi.html" class="bg-white text-purple-700 font-semibold px-4 py-2 rounded shadow hover:bg-gray-100 transition">Lihat Visualisasi</a>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-6 py-10">
    <h2 class="text-xl font-semibold text-purple-800 mb-6">Selamat datang, Admin!</h2>

    <!-- Ringkasan Data -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-md">
        <h3 class="text-lg font-semibold mb-2 text-purple-700">Jumlah Penduduk</h3>
        <p class="text-4xl font-bold text-purple-900">1.234</p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-md">
        <h3 class="text-lg font-semibold mb-2 text-purple-700">Jumlah Keluarga</h3>
        <p class="text-4xl font-bold text-purple-900">423</p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-md">
        <h3 class="text-lg font-semibold mb-2 text-purple-700">Jumlah RT</h3>
        <p class="text-4xl font-bold text-purple-900">12</p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-md">
        <h3 class="text-lg font-semibold mb-2 text-purple-700">Jumlah RW</h3>
        <p class="text-4xl font-bold text-purple-900">3</p>
      </div>
    </div>

    <!-- Statistik Mini -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
      <div class="bg-purple-100 p-5 rounded-lg text-center">
        <h4 class="text-lg font-semibold text-purple-800 mb-2">Rumah Milik Sendiri</h4>
        <p class="text-3xl font-bold text-purple-700">500</p>
      </div>
      <div class="bg-purple-100 p-5 rounded-lg text-center">
        <h4 class="text-lg font-semibold text-purple-800 mb-2">Jumlah Lahan Terdaftar</h4>
        <p class="text-3xl font-bold text-purple-700">260</p>
      </div>
      <div class="bg-purple-100 p-5 rounded-lg text-center">
        <h4 class="text-lg font-semibold text-purple-800 mb-2">Rata-rata Luas Tanah</h4>
        <p class="text-3xl font-bold text-purple-700">450 m²</p>
      </div>
    </div>

    <!-- Form Input Data -->
    <div class="bg-white p-8 rounded-xl shadow-xl mt-12">
      <h2 class="text-2xl font-bold text-purple-800 mb-6">📝 Tambah Data Warga</h2>

      <form action="#" method="POST" class="space-y-10">
        
        <!-- Warga -->
        <div>
          <h3 class="text-xl font-semibold text-purple-700 mb-4">Data Warga</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="nik" placeholder="NIK" class="input" required>
            <input type="text" name="nama" placeholder="Nama Lengkap" class="input">
            <select name="jenis_kelamin" class="input">
              <option value="">Pilih Jenis Kelamin</option>
              <option value="Laki-Laki">Laki-Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
            <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="input">
            <input type="date" name="tanggal_lahir" class="input">
            <input type="text" name="agama" placeholder="Agama" class="input">
            <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="input">
            <input type="text" name="status_perkawinan" placeholder="Status Perkawinan" class="input">
            <input type="text" name="no_kk" placeholder="Nomor Kartu Keluarga (KK)" class="input">
            <select name="status_keluarga" class="input">
              <option value="">Status Dalam Keluarga</option>
              <option value="Kepala Keluarga">Kepala Keluarga</option>
              <option value="Istri">Istri</option>
              <option value="Anak">Anak</option>
              <option value="Orangtua">Orangtua</option>
            </select>
          </div>
        </div>

        <!-- Rumah -->
        <div>
          <h3 class="text-xl font-semibold text-purple-700 mb-4">Kepemilikan Rumah</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
          <h3 class="text-xl font-semibold text-purple-700 mb-4">Kepemilikan Kendaraan</h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="number" name="motor_roda2" placeholder="Motor Roda 2" class="input">
            <input type="number" name="mobil_roda4" placeholder="Mobil Roda 4" class="input">
            <input type="number" name="mobil_bus" placeholder="Mobil Bus" class="input">
          </div>
        </div>

        <!-- Usaha -->
        <div>
          <h3 class="text-xl font-semibold text-purple-700 mb-4">Jenis Usaha</h3>
          <input type="text" name="jenis_usaha" placeholder="Jenis Usaha" class="input w-full">
        </div>

        <!-- Bahan Bakar -->
        <div>
          <h3 class="text-xl font-semibold text-purple-700 mb-4">Penggunaan Bahan Bakar</h3>
          <div class="flex flex-wrap gap-4">
            <label><input type="checkbox" name="gas" class="mr-2"> Gas</label>
            <label><input type="checkbox" name="kayu_bakar" class="mr-2"> Kayu Bakar</label>
            <label><input type="checkbox" name="minyak_tanah" class="mr-2"> Minyak Tanah</label>
          </div>
        </div>

        <!-- Sumber Air -->
        <div>
          <h3 class="text-xl font-semibold text-purple-700 mb-4">Sumber Air</h3>
          <div class="flex flex-wrap gap-4">
            <label><input type="checkbox" name="sumur" class="mr-2"> Sumur</label>
            <label><input type="checkbox" name="mata_air" class="mr-2"> Mata Air</label>
            <label><input type="checkbox" name="lainnya" class="mr-2"> Lainnya</label>
          </div>
        </div>

        <!-- Submit -->
        <div>
          <button type="submit" class="bg-purple-700 text-white px-6 py-3 rounded-lg hover:bg-purple-800 transition">Simpan Data</button>
        </div>
      </form>
    </div>
  </main>

  <footer class="bg-white shadow mt-12 py-4 text-center text-sm text-gray-500">
    &copy; 2025 Pemerintah Desa Kema 3 – Jaga 4
  </footer>

</body>
</html>
