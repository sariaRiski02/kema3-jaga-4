<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <title>Dashboard Desa Kema 3 - Jaga 4</title>
  @livewireStyles

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- SweetAlert2 (dipertahankan untuk UI feedback) -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen font-sans">

  @include('dashboard.sidebar')

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

  @livewireScripts
</body>
</html>