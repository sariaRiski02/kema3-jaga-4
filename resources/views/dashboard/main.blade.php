<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>Dashboard Desa Kema 3 - Jaga 4</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- SweetAlert2 (dipertahankan untuk UI feedback) -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen font-sans">

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

      <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-purple-50 hover:text-purple-700' }} nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-purple-50 hover:text-purple-700 transition-colors">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
        </svg>
        Dashboard
      </a>

      <a href="{{ route('add-resident') }}" class="{{ request()->is('add-resident') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-purple-50 hover:text-purple-700' }} nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-purple-50 hover:text-purple-700 transition-colors">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Tambah Data
      </a>

      <a href="{{ route('list-resident') }}" class="{{ request()->is('list-resident') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-purple-50 hover:text-purple-700' }} nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-purple-50 hover:text-purple-700 transition-colors">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        Lihat Data
      </a>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-3 border-t border-gray-200 space-y-1.5">
      <a href="/visualisasi" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-purple-50 hover:text-purple-700 transition-colors">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
        Visualisasi
      </a>
      <a href="/logout" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
        Keluar
      </a>
    </div>
  </aside>

  <!-- Overlay (semua ukuran layar) -->
  <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-30 hidden" role="presentation"></div>

  <!-- ========================================== -->
  <!-- MAIN CONTENT WRAPPER -->
  <!-- ========================================== -->
  <div id="mainWrapper" class="flex flex-col min-h-screen w-full">

    <!-- Top Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-20">
      <div class="px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center gap-4">
        <div class="flex items-center gap-3">
          <!-- Toggle Button: aktif di semua lebar layar -->
          <button id="toggleSidebarBtn" class="text-gray-600 hover:text-purple-700 hover:bg-purple-50 p-2 rounded-lg transition-colors" aria-label="Buka/tutup sidebar">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
          <h1 class="text-lg lg:text-xl font-bold text-gray-800">
            Dashboard Desa Kema 3 – Jaga 4
          </h1>
        </div>

        <!-- Desktop Actions -->
        <div class="hidden lg:flex gap-2">
          <a href="/visualisasi" class="bg-purple-50 text-purple-700 hover:bg-purple-100 font-medium text-sm px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Visualisasi
          </a>
          <a href="/logout" class="bg-red-50 text-red-700 hover:bg-red-100 font-medium text-sm px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Keluar
          </a>
        </div>
      </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">

      @yield('content')

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-5 text-center text-sm text-gray-500 w-full mt-auto">
      <p>&copy; 2026 Created by <a href="https://mrizkysaria.netlify.app" class="font-semibold text-purple-700">Rizky Saria</a></p>
    </footer>

  </div> <!-- End Main Content Wrapper -->

  <!-- Global Loading Overlay -->
  <div id="globalLoading" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center gap-3">
      <svg class="animate-spin h-10 w-10 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
      </svg>
      <span class="text-sm text-purple-800 font-semibold">Memproses data, mohon tunggu...</span>
    </div>
  </div>

  <!-- ========================================== -->
  <!-- SIDEBAR TOGGLE SCRIPT -->
  <!-- Sidebar fixed & bisa dibuka/ditutup di semua lebar layar -->
  <!-- ========================================== -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebarOverlay');
      const toggleBtn = document.getElementById('toggleSidebarBtn');
      const closeBtn = document.getElementById('closeSidebarBtn');
      const navLinks = document.querySelectorAll('.nav-link');

      const openSidebar = () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      };

      const closeSidebar = () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
      };

      const toggleSidebar = () => {
        const isClosed = sidebar.classList.contains('-translate-x-full');
        isClosed ? openSidebar() : closeSidebar();
      };

      toggleBtn?.addEventListener('click', toggleSidebar);
      closeBtn?.addEventListener('click', closeSidebar);
      overlay?.addEventListener('click', closeSidebar);

      navLinks.forEach(link => {
        link.addEventListener('click', closeSidebar);
      });

      // Tutup sidebar dengan tombol Escape
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeSidebar();
      });
    });
  </script>

</body>
</html>