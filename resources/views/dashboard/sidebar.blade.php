<!-- ========================================== -->
  <!-- SIDEBAR (putih, bersih, fixed di semua ukuran layar) -->
  <!-- ========================================== -->
  <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full bg-white border-r border-gray-200 transition-transform duration-300 flex flex-col">

    <!-- Sidebar Header -->
    <div class="h-16 px-5 flex items-center justify-between border-b border-gray-200">
      <div class="flex items-center gap-2.5">
        <div class="w-8 h-8 rounded-lg bg-purple-700 flex items-center justify-center">
          <svg class="w-4.5 h-4.5 text-white" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg>
        </div>
        <span class="font-semibold text-gray-800">Kema 3</span>
      </div>
      <button id="closeSidebarBtn" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-1.5 rounded-md transition-colors" aria-label="Tutup sidebar">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <!-- Sidebar Navigation -->
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
      <p class="px-3 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu</p>

      <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-purple-50 hover:text-purple-700' }} nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-purple-50 hover:text-purple-700 transition-colors">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
        </svg>
        Dashboard
      </a>

        <a href="{{ route('dashboard.import-resident') }}" class="{{ request()->routeIs('dashboard.import-resident') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-purple-50 hover:text-purple-700' }} nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-purple-50 hover:text-purple-700 transition-colors">
          <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v12m0 0l-4-4m4 4l4-4M4 17v1a2 2 0 002 2h12a2 2 0 002-2v-1"/>
          </svg>
          Import Data Warga
        </a>

      <a href="{{ route('dashboard.add-resident') }}" class="{{ request()->routeIs('dashboard.add-resident') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-purple-50 hover:text-purple-700' }} nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-purple-50 hover:text-purple-700 transition-colors">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Tambah Warga
      </a>
      
      <a href="{{ route('dashboard.add-family') }}" class="{{ request()->routeIs('dashboard.add-family') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-purple-50 hover:text-purple-700' }} nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-purple-50 hover:text-purple-700 transition-colors">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-6a4 4 0 100-8 4 4 0 000 8zm8-3v6m3-3h-6"/>
        </svg>
        Tambah Keluarga
      </a>

      <a href="{{ route('dashboard.list-resident') }}" class="{{ request()->routeIs('dashboard.list-resident') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-purple-50 hover:text-purple-700' }} nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-purple-50 hover:text-purple-700 transition-colors">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 1₀a2 2 0 11-4 ₀ 2 2 ₀ ₀₁4 ₀z"/>
        </svg>
        Daftar Warga
      </a>


      <a href="{{ route('dashboard.list-family') }}" class="{{ request()->routeIs('dashboard.list-family') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-purple-50 hover:text-purple-700' }} nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-purple-50 hover:text-purple-700 transition-colors">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 1₀a2 2 0 11-4 ₀ 2 2 ₀ ₀₁4 ₀z"/>
        </svg>
        Daftar Keluarga
      </a>
    </nav>

    <div class="border-t border-gray-200 p-3">
      <a href="{{ route('logout') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-red-600 transition-colors hover:bg-red-50">
        <span aria-hidden="true">↪</span>
        Keluar
      </a>
    </div>

  </aside>