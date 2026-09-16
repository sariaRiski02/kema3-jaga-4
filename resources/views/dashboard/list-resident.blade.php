@extends('dashboard.main')

@section('content')
<!-- ========================================== -->
<!-- LIHAT DATA WARGA -->
<!-- ========================================== -->
<div id="tabel-daftar" class="bg-white p-4 sm:p-8 rounded-xl shadow-xl mb-8 sm:mb-12">

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
  <form id="residentSearchForm" action="{{ route('dashboard.list-resident') }}" method="get">
      <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-4">
        <!-- Search -->
        <div class="relative flex-1">
          <input
            type="text"
            id="searchInput"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari NIK, Nama, Umur, atau Jenis Kelamin"
            class="w-full px-4 py-3 pl-12 pr-10 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md"
          />
          <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">🔍</div>
          <button
          type="button"
          id="clearSearch"
          class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
          title="Hapus pencarian"
        >✕</button>
      </div>
      <!-- Search Button -->
      <button
        id="searchBtn"
        type="submit"
        class="flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-purple-700 text-white font-semibold hover:bg-purple-800 transition-all duration-200 shadow-sm"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        Cari
      </button>
    </div>
    </form>




  <!-- ===== Tabel ===== -->
  <div class="w-full overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
    <div id="bulkActionBar" class="hidden items-center gap-3 bg-purple-50 border border-purple-200 rounded-lg px-4 py-2.5 mb-3">
      <span id="selectedCount" class="text-sm font-medium text-purple-800">0 dipilih</span>
      <button type="button" id="bulkDeleteBtn" class="ml-auto text-sm font-semibold text-red-700 hover:text-red-800">
        🗑️ Hapus Terpilih
      </button>
    </div>
    <table class="min-w-full text-sm">
      <thead>
        <tr class="bg-purple-50 text-purple-800 text-xs uppercase tracking-wide">
          <th class="px-4 py-3.5 text-center font-semibold w-10">
            <input type="checkbox" id="selectAll" class="w-4 h-4 rounded border-gray-300 accent-purple-700" @disabled($residents->isEmpty())>
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
      <tbody id="tableBody" class="divide-y divide-gray-100">
        {{-- Contoh baris statis, ganti dengan @foreach($warga as $w) sesuai data asli --}}
        @forelse ($residents as $resident)
          <tr class="hover:bg-purple-50/40 transition-colors duration-150">
            <td class="px-4 py-3.5 text-center">
              <input type="checkbox" class="row-checkbox w-4 h-4 rounded border-gray-300 accent-purple-700" value="{{ $resident->nik }}">
            </td>
            <td class="px-4 py-3.5 text-center">{{ $residents->firstItem() + $loop->index }}</td>
            <td class="px-4 py-3.5">
              <div class="font-medium text-gray-800"> {{ $resident->name }} </div>
            </td>
            <td class="px-4 py-3.5"><span class="inline-block font-mono text-sm font-semibold text-gray-800 bg-gray-50 rounded px-3 py-1.5 tracking-wide">
              {{ $resident->nik }}
            </span></td>
            <td class="px-4 py-3.5 text-gray-600"> {{ $resident->gender }} </td>

            <td class="px-4 py-3.5 text-gray-600"> {{ $resident->date_of_birth->format('d F Y') }} </td>

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
                <form action="{{ route('dashboard.delete-resident', $resident->nik) }}" method="POST" data-delete-resident-form data-name="{{ $resident->name }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="p-2 rounded-lg text-gray-400 hover:text-red-700 hover:bg-red-50 transition-colors duration-150" title="Hapus Data">🗑️</button>
                </form>
              </div>
            </td>
          </tr>    
        @empty
          <tr>
            <td colspan="8" class="px-4 py-12 text-center">
              <div class="text-4xl mb-3">📋</div>
              @if(request('search'))
                <h3 class="text-lg font-semibold text-gray-800">Data tidak ditemukan</h3>
                <p class="mt-1 text-gray-500">Tidak ada warga yang cocok dengan pencarian "{{ request('search') }}".</p>
                <button type="button" id="emptyClearSearch" class="mt-4 rounded-lg bg-purple-700 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-800">
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
  @if($residents->hasPages())
    <div class="pt-5">
      {{ $residents->links() }}
    </div>
  @endif
  

  <!-- No Results -->
  <div id="noResults" class="hidden text-center py-12">
    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.409-1.194-5.64-3.013M8.343 4.343A8 8 0 1119.657 19.657 8 8 0 018.343 4.343z"/>
    </svg>
    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data yang ditemukan</h3>
    <p class="text-gray-500">Coba ubah kata kunci pencarian atau filter Anda</p>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-delete-resident-form]').forEach(function (form) {
      form.addEventListener('submit', function (event) {
        event.preventDefault();

        const residentName = form.dataset.name || 'data ini';

        Swal.fire({
          title: 'Hapus data warga?',
          text: `Apakah Anda yakin ingin menghapus data warga "${residentName}"?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#dc2626',
          cancelButtonColor: '#6b7280',
          confirmButtonText: 'Ya, hapus',
          cancelButtonText: 'Batal',
          reverseButtons: true,
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
    const selectAll = document.getElementById('selectAll');
    const tableBody = document.getElementById('tableBody');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    const searchForm = document.getElementById('residentSearchForm');
    const emptyClearSearch = document.getElementById('emptyClearSearch');
    const rowCheckboxes = () => tableBody.querySelectorAll('.row-checkbox');
    const bar = document.getElementById('bulkActionBar');
    const countEl = document.getElementById('selectedCount');

    function updateBar() {
      const checkboxes = rowCheckboxes();
      const checked = tableBody.querySelectorAll('.row-checkbox:checked');
      const hasRows = checkboxes.length > 0;

      countEl.textContent = `${checked.length} dipilih`;
      bar.classList.toggle('hidden', checked.length === 0);
      bar.classList.toggle('flex', checked.length > 0);
      selectAll.checked = hasRows && checked.length === checkboxes.length;
      selectAll.indeterminate = checked.length > 0 && checked.length < checkboxes.length;
    }

    selectAll.addEventListener('change', () => {
      rowCheckboxes().forEach((checkbox) => {
        checkbox.checked = selectAll.checked;
      });
      updateBar();
    });

    tableBody.addEventListener('change', (event) => {
      if (event.target.classList.contains('row-checkbox')) updateBar();
    });

    clearSearch.addEventListener('click', () => {
      searchInput.value = '';
      searchForm.submit();
    });

    emptyClearSearch?.addEventListener('click', () => {
      searchInput.value = '';
      searchForm.submit();
    });

    bulkDeleteBtn.addEventListener('click', () => {
      const niks = [...tableBody.querySelectorAll('.row-checkbox:checked')].map((checkbox) => checkbox.value);
      if (niks.length === 0) return;
      if (!confirm(`Hapus ${niks.length} data warga? Aksi ini tidak bisa dibatalkan.`)) return;

      fetch('{{ route("dashboard.bulk-delete-resident") }}', {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json',
        },
        body: JSON.stringify({ niks }),
      })
        .then(async (response) => {
          const data = await response.json();
          if (!response.ok) throw new Error(data.message || 'Gagal menghapus data.');
          return data;
        })
        .then((data) => {
          if (data.success) location.reload();
        })
        .catch((error) => alert(error.message));
    });
  });

</script>
@endsection