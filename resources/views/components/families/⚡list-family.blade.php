<?php

use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
  use WithPagination;

    public $search = '';

    #[Computed]
    public function families(){
    return Family::with('headFamily.resident')
      ->withCount('residents')
      ->when(strlen(trim($this->search)) > 2, function ($query) {
        $search = '%' . trim($this->search) . '%';

        $query->where(function ($query) use ($search) {
          $query->where('family_number', 'like', $search)
            ->orWhereHas('headFamily.resident', function ($query) use ($search) {
              $query->where('name', 'like', $search)
                ->orWhere('nik', 'like', $search);
            });
        });
      })
      ->paginate(10);
    }

  public function updatedSearch(): void
  {
    $this->resetPage();
  }

  public function clearSearch(): void
  {
    $this->search = '';
    $this->resetPage();
  }

  public function searchFamilies(): void
  {
    $this->resetPage();
  }

  public function deleteFamily(int $familyId): void
  {
    $family = Family::findOrFail($familyId);
    $family->delete();

    if ($this->families->isEmpty() && $this->getPage() > 1) {
      $this->previousPage();
    }
  }
};
?>

<div id="cari-keluarga" class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12">

  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <h2 class="text-xl sm:text-2xl font-bold text-purple-800 flex items-center gap-2">
      <span>👨‍👩‍👧‍👦</span>
      <span>Daftar Keluarga</span>
    </h2>
    <div class="flex flex-wrap items-center gap-3">
      <a href="{{ route('dashboard.add-family') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg font-semibold flex items-center gap-2 shadow transition-all duration-200 w-fit">
        ➕ Tambah KK
      </a>
      <a href="" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold flex items-center gap-2 shadow transition-all duration-200 w-fit">
        ⬇️ Download Excel
      </a>
    </div>
  </div>

  <!-- ===== Search Bar ===== -->
  <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-4">
    <!-- Search -->
    <div class="relative flex-1">
      <input
        type="text"
        wire:model.live="search"
        id="searchKeluargaInput"
        name="search"
        placeholder="Cari No. KK, Nama Kepala Keluarga, atau Alamat..."
        class="w-full px-4 py-3 pl-12 pr-10 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md"
      />
      <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">🔍</div>
      <button
        type="button"
        wire:click="clearSearch"
        id="clearSearchKeluarga"
        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
        title="Hapus pencarian"
      >✕</button>
    </div>

    <!-- Search Button -->
    <button
      type="button"
      wire:click="searchFamilies"
      id="searchKeluargaBtn"
      class="flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-purple-700 text-white font-semibold hover:bg-purple-800 transition-all duration-200 shadow-sm"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
      </svg>
      Cari
    </button>
  </div>

  <!-- ===== Tabel Keluarga ===== -->
  <div class="w-full overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
    <table class="min-w-full text-sm">
      <thead>
        <tr class="bg-purple-50 text-purple-800 text-xs uppercase tracking-wide">
          
          <th class="px-4 py-3.5 text-center font-semibold">No.</th>
          <th class="px-4 py-3.5 text-left font-semibold">No. Kartu Keluarga</th>
          <th class="px-4 py-3.5 text-left font-semibold">Kepala Keluarga</th>
          <th class="px-4 py-3.5 text-left font-semibold">Jumlah Anggota</th>
          <th class="px-4 py-3.5 text-center font-semibold">Aksi</th>
        </tr>
      </thead>
      <tbody id="tableBodyKeluarga" class="divide-y divide-gray-100">
        @foreach ($this->families as $family)
            <tr  wire:key="family-{{ $family->id }}" class="hover:bg-purple-50/40 transition-colors duration-150">
              <td class="px-4 py-3.5 text-center font-semibold text-gray-500">
                {{ $this->families->firstItem() + $loop->index }}
              </td>
                <td class="px-4 py-3.5"><span class="inline-block font-mono text-sm font-semibold text-gray-800 bg-gray-50 rounded px-3 py-1.5 tracking-wide">
                {{ $family->family_number }}    
                </span></td>
                <td class="px-4 py-3.5">
                    <div class="font-medium text-gray-800">
                        {{ $family->headFamily?->resident?->name ?? 'Belum ada kepala keluarga' }}
                    </div>
                      <div class="text-sm text-gray-500">
                        NIK: {{ $family->headFamily?->resident?->nik ?? 'Belum tersedia' }}
                      </div>
                </td>
                
                <td class="px-4 py-3.5">
                    <span class="inline-flex items-center justify-center gap-1.5 text-sm font-semibold text-blue-700 bg-blue-50 rounded-full w-8 h-8">
                      {{ $family->residents_count }}
                    </span>
                </td>
                <td class="px-4 py-3.5">
                    <div class="flex justify-center gap-1">
                    <button class="p-2 rounded-lg text-gray-400 hover:text-purple-700 hover:bg-purple-50 transition-colors duration-150" title="Lihat Detail">👁️</button>
                    <button class="p-2 rounded-lg text-gray-400 hover:text-green-700 hover:bg-green-50 transition-colors duration-150" title="Edit Data">✏️</button>
                    <button
                      type="button"
                      x-on:click.prevent="Swal.fire({
                        title: 'Hapus keluarga?',
                        text: 'Data relasi keluarga akan ikut dihapus.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                      }).then((result) => {
                        if (result.isConfirmed) {
                          $wire.deleteFamily({{ $family->id }});
                        }
                      })"
                      class="p-2 rounded-lg text-gray-400 hover:text-red-700 hover:bg-red-50 transition-colors duration-150"
                      title="Hapus Data"
                    >🗑️</button>
                    </div>
                </td>
            </tr>    
        @endforeach
        
        
      </tbody>
    </table>
</div>
<div class="py-5">
    {{ $this->families->links() }}
</div>
  <div id="paginationKeluarga" class="flex justify-center items-center gap-2 my-6"></div>

  <!-- No Results -->
  <div id="noResultsKeluarga" class="hidden text-center py-12">
    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.409-1.194-5.64-3.013M8.343 4.343A8 8 0 1119.657 19.657 8 8 0 018.343 4.343z"/>
    </svg>
    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data keluarga yang ditemukan</h3>
    <p class="text-gray-500">Coba ubah kata kunci pencarian Anda</p>
  </div>
</div>