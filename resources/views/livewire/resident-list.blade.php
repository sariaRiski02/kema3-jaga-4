<div class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12">

  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <h2 class="text-xl sm:text-2xl font-bold text-purple-800 flex items-center gap-2">
      <span>📋</span>
      <span>Daftar Warga</span>
    </h2>
    <div class="flex flex-wrap items-center gap-3">
      <a href="{{ route('dashboard.add-resident') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg font-semibold flex items-center gap-2 shadow transition-all duration-200 w-fit">
        ➕ Tambah Data
      </a>
      <a href="{{ route('dashboard.export-all-resident') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold flex items-center gap-2 shadow transition-all duration-200 w-fit">
        ⬇️ Download Excel
      </a>
    </div>
  </div>

  <!-- ===== Search ===== -->
  <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-4">
    <!-- Search Input -->
    <div class="relative flex-1">
      <input
        type="text"
        wire:model.live="search"
        placeholder="Cari NIK, Nama, Umur, atau Jenis Kelamin"
        class="w-full px-4 py-3 pl-12 pr-10 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md"
      />
      <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">🔍</div>
      @if($search)
        <button
          type="button"
          wire:click="clearSearch"
          class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
          title="Hapus pencarian"
        >✕</button>
      @endif
    </div>
  </div>

  <!-- ===== Bulk Action Bar ===== -->
  @if(count($selectedNiks) > 0)
    <div class="flex items-center gap-3 bg-purple-50 border border-purple-200 rounded-lg px-4 py-2.5 mb-4">
      <span class="text-sm font-medium text-purple-800">{{ count($selectedNiks) }} dipilih</span>
      <button 
        type="button"
        wire:click="$dispatch('confirmBulkDelete', { niks: {{ json_encode($selectedNiks) }}, count: {{ count($selectedNiks) }} })"
        class="ml-auto text-sm font-semibold text-red-700 hover:text-red-800 transition-colors"
      >
        🗑️ Hapus Terpilih
      </button>
    </div>
  @endif

  <!-- ===== Tabel ===== -->
  <div class="w-full overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
    <table class="min-w-full text-sm">
      <thead>
        <tr class="bg-purple-50 text-purple-800 text-xs uppercase tracking-wide">
          <th class="px-4 py-3.5 text-center font-semibold w-10">
            <input 
              type="checkbox" 
              wire:model.live="selectAll"
              class="w-4 h-4 rounded border-gray-300 accent-purple-700"
              @if($residents->isEmpty()) disabled @endif
            >
          </th>
          <th class="px-4 py-3.5 text-left font-semibold">No</th>
          <th class="px-4 py-3.5 text-left font-semibold">Nama</th>
          <th class="px-4 py-3.5 text-left font-semibold">NIK</th>
          <th class="px-4 py-3.5 text-left font-semibold">Jenis Kelamin</th>
          <th class="px-4 py-3.5 text-left font-semibold">Tanggal Lahir</th>
          <th class="px-4 py-3.5 text-left font-semibold">Umur</th>
          <th class="px-4 py-3.5 text-center font-semibold">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse ($residents as $resident)
          <tr class="hover:bg-purple-50/40 transition-colors duration-150">
            <td class="px-4 py-3.5 text-center">
              <input 
                type="checkbox"
                wire:model.live="selectedNiks"
                value="{{ $resident->nik }}"
                class="w-4 h-4 rounded border-gray-300 accent-purple-700"
              >
            </td>
            <td class="px-4 py-3.5 text-center">{{ $residents->firstItem() + $loop->index }}</td>
            <td class="px-4 py-3.5">
              <div class="font-medium text-gray-800">{{ $resident->name }}</div>
            </td>
            <td class="px-4 py-3.5">
              <span class="inline-block font-mono text-sm font-semibold text-gray-800 bg-gray-50 rounded px-3 py-1.5 tracking-wide">
                {{ $resident->nik }}
              </span>
            </td>
            <td class="px-4 py-3.5 text-gray-600">{{ $resident->gender }}</td>
            <td class="px-4 py-3.5 text-gray-600">{{ $resident->date_of_birth->format('d F Y') }}</td>
            @if($resident->date_of_death)
              <td class="px-4 py-3.5">
                <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700 ring-1 ring-red-200">
                  Sudah meninggal
                </span>
              </td>
            @else
              <td class="px-4 py-3.5">
                <span class="inline-block font-mono text-sm font-semibold text-gray-800 bg-gray-50 rounded px-3 py-1.5 tracking-wide">
                  {{ $resident->date_of_birth->age }} Tahun
                </span>
              </td>
            @endif
            <td class="px-4 py-3.5">
              <div class="flex justify-center gap-1">
                <a href="{{ route('dashboard.show-resident', $resident->nik) }}" class="p-2 rounded-lg text-gray-400 hover:text-purple-700 hover:bg-purple-50 transition-colors duration-150" title="Lihat Detail">👁️</a>
                <a href="{{ route('dashboard.edit-resident', $resident->nik) }}" class="p-2 rounded-lg text-gray-400 hover:text-green-700 hover:bg-green-50 transition-colors duration-150" title="Edit Data">✏️</a>
                <button 
                  type="button"
                  wire:click="$dispatch('confirmDeleteResident', { nik: '{{ $resident->nik }}', name: '{{ $resident->name }}' })"
                  class="p-2 rounded-lg text-gray-400 hover:text-red-700 hover:bg-red-50 transition-colors duration-150" 
                  title="Hapus Data"
                >🗑️</button>
              </div>
            </td>
          </tr>    
        @empty
          <tr>
            <td colspan="8" class="px-4 py-12 text-center">
              <div class="text-4xl mb-3">📋</div>
              @if($search)
                <h3 class="text-lg font-semibold text-gray-800">Data tidak ditemukan</h3>
                <p class="mt-1 text-gray-500">Tidak ada warga yang cocok dengan pencarian "{{ $search }}".</p>
                <button type="button" wire:click="clearSearch" class="mt-4 rounded-lg bg-purple-700 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-800">
                  Tampilkan Semua Data
                </button>
              @else
                <h3 class="text-lg font-semibold text-gray-800">Belum ada data warga</h3>
                <p class="mt-1 text-gray-500">Tambahkan data warga terlebih dahulu untuk menampilkannya di daftar.</p>
                <a href="{{ route('dashboard.add-resident') }}" class="mt-4 inline-flex rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">
                  Tambah Data Warga
                </a>
              @endif
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  @if($residents->hasPages())
    <div class="pt-5">
      {{ $residents->links() }}
    </div>
  @endif
</div>

@script
<script>
  Livewire.on('confirmDeleteResident', (data) => {
    Swal.fire({
      title: 'Hapus data warga?',
      text: `Apakah Anda yakin ingin menghapus data warga "${data[0].name}"?`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc2626',
      cancelButtonColor: '#6b7280',
      confirmButtonText: 'Ya, hapus',
      cancelButtonText: 'Batal',
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {
        Livewire.dispatch('deleteResidentAction', { nik: data[0].nik });
      }
    });
  });

  Livewire.on('confirmBulkDelete', (data) => {
    Swal.fire({
      title: 'Hapus data warga?',
      text: `Apakah Anda yakin ingin menghapus ${data[0].count} data warga? Aksi ini tidak bisa dibatalkan.`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc2626',
      cancelButtonColor: '#6b7280',
      confirmButtonText: 'Ya, hapus semua',
      cancelButtonText: 'Batal',
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {
        Livewire.dispatch('confirmBulkDeleteAction', { niks: data[0].niks });
      }
    });
  });

  Livewire.on('notify', (data) => {
    const { type, message } = data[0];
    Swal.fire({
      title: type === 'success' ? 'Berhasil!' : 'Gagal!',
      text: message,
      icon: type,
      confirmButtonColor: type === 'success' ? '#10b981' : '#ef4444',
    });
  });
</script>
@endscript
