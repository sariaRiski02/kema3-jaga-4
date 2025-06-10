export function fetchData(page = 1){
    let endpoint = 'api/resident';
    $.ajax({
    url: endpoint + '?page=' + page,
    method: 'GET',
    dataType: 'json',
    success: function(response){
         render(response);
         renderPagination(response.data)   
    }, 
    error: function(xhr, status, error){
        console.error('Gagal mengambil data: ', error);
    }
    });
}

function capitalizeWords(str) {
    if (!str) return '';
    return str.split(' ').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ');
}

export function render (response){
    let data = response.data.data;
    // Hitung nomor awal berdasarkan halaman dan jumlah per halaman
    const currentPage = response.data.current_page || 1;
    const perPage = response.data.per_page || data.length || 1;
    let number = (currentPage - 1) * perPage + 1;

    if(response.success && Array.isArray(data)){
        $('#tableBody').empty();
        data.forEach((warga) => {
            $('#tableBody').append(
                `<tr id="dataTable">
                    <td class="px-3 sm:px-4 py-3 border">${number++}</td>
                    <td class="px-3 sm:px-4 py-3 border">${warga.nik}</td>
                    <td class="px-3 sm:px-4 py-3 border">${warga.nama}</td>
                    <td class="px-3 sm:px-4 py-3 border">${capitalizeWords(warga.jenis_kelamin)}</td>
                    <td class="px-3 sm:px-4 py-3 border">${warga.umur} tahun</td>
                    <td class="px-3 sm:px-4 py-3 border text-center">
                    <div class="flex justify-center gap-2">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs font-medium transition-all duration-200 flex items-center gap-1 shadow-sm hover:shadow-md btn-see" title="Lihat Detail" data-id="${warga.id}">
                    👁️ Lihat
                    </button>
                    <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-xs font-medium transition-all duration-200 flex items-center gap-1 shadow-sm hover:shadow-md btn-edit" title="Edit Data" data-id="${warga.id}">
                    ✏️ Edit
                    </button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-xs font-medium transition-all duration-200 flex items-center gap-1 shadow-sm hover:shadow-md btn-delete" title="Hapus Data" data-id="${warga.id}">
                    🗑️ Hapus
                    </button>
                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-xs font-medium transition-all duration-200 flex items-center gap-1 shadow-sm hover:shadow-md btn-kk" title="Lihat Kartu Keluarga" data-nokk="${warga.kk ? warga.kk.no_kk : warga.no_kk}">
                    🏠 KK
                    </button>
                    </div>
                    </td>
                </tr>`
            )
        });
    }
}

export function renderPagination(response){
    $('#pagination').empty();
    response.links.forEach(link => {
        // Ambil label asli
        let rawLabel = link.label;

        // Bersihkan HTML entity dan ambil teks saja
        let label = rawLabel
            .replace(/&laquo;|&raquo;/g, '') // hapus entitas
            .replace('Previous', 'Prev')   // ganti teks
            .replace('Next', 'Next')       // biar konsisten

        // Kalau masih kosong (misalnya entitas saja), pakai default
        if (rawLabel.includes('&laquo;')) label = 'Prev';
        if (rawLabel.includes('&raquo;')) label = 'Next';

        // Buat tombol
        const button = $(`<button class="btn-page px-3 py-1 mx-1 rounded-lg 
                                font-medium transition-all duration-200 
                                ${link.active ? 'bg-purple-700 text-white' : 'bg-blue-500 hover:bg-blue-600 text-white'} 
                                ${!link.url ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : ''}">
                                ${label}
                        </button>`);

        // Disable tombol kalau tidak ada URL (misalnya Prev di halaman pertama)
        button.prop('disabled', link.url === null);

        // Simpan nomor halaman ke data-page
        if(link.url){
            const pageNumber = new URL(link.url).searchParams.get('page');
            button.data('page', pageNumber);
        }

        $('#pagination').append(button);
    });
}

// Event listener tombol pagination
$(document).on('click', '.btn-page', function(){
    let page = $(this).data('page');
    fetchData(page);
});

// Event listener tombol KK
$(document).on('click', '.btn-kk', function(){
    const no_kk = $(this).data('nokk');
    if(!no_kk) {
        Swal.fire('Nomor KK tidak ditemukan', '', 'error');
        return;
    }
    Swal.fire({
        title: 'Memuat Kartu Keluarga...'
    });
    $.ajax({
        url: `/api/family/${no_kk}`,
        method: 'GET',
        success: function(res){
            console.log(res);
            if(res.success && res.data && res.data.members.length > 0){
                showKKModal(res.data.no_kk, res.data.members);
            } else {
                Swal.fire('Data keluarga tidak ditemukan', '', 'error');
            }
        },
        error: function(error){
            console.log(error);
            Swal.fire('Gagal mengambil data keluarga', '', 'error');
        }
    });
});

function showKKModal(no_kk, members){
    let rows = members.map((w, idx) => `
        <tr>
            <td class="border px-2 py-1 text-center">${idx+1}</td>
            <td class="border px-2 py-1">${w.nik}</td>
            <td class="border px-2 py-1">${w.nama}</td>
            <td class="border px-2 py-1">${capitalizeWords(w.jenis_kelamin)}</td>
            <td class="border px-2 py-1">${w.tempat_lahir}</td>
            <td class="border px-2 py-1">${w.tanggal_lahir}</td>
            <td class="border px-2 py-1">${capitalizeWords(w.status_keluarga)}</td>
            <td class="border px-2 py-1">${w.pendidikan}</td>
            <td class="border px-2 py-1">${w.pekerjaan}</td>
        </tr>
    `).join('');
    const html = `
    <div class="overflow-x-auto">
      <div class="mb-4 text-center">
        <span class="text-lg font-bold tracking-widest text-gray-700">KARTU KELUARGA</span><br>
        <span class="text-base font-semibold text-gray-600">No. KK: <span class="text-purple-700">${no_kk}</span></span>
      </div>
      <table class="min-w-full border border-gray-400 rounded-lg text-xs sm:text-sm mb-2" id="kkTableCopy">
        <thead class="bg-gray-100">
          <tr>
            <th class="border px-2 py-1">No</th>
            <th class="border px-2 py-1">NIK</th>
            <th class="border px-2 py-1">Nama</th>
            <th class="border px-2 py-1">Jenis Kelamin</th>
            <th class="border px-2 py-1">Tempat Lahir</th>
            <th class="border px-2 py-1">Tanggal Lahir</th>
            <th class="border px-2 py-1">Status Keluarga</th>
            <th class="border px-2 py-1">Pendidikan</th>
            <th class="border px-2 py-1">Pekerjaan</th>
          </tr>
        </thead>
        <tbody>
          ${rows}
        </tbody>
      </table>
      <button id="copyKKBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition-all duration-200 flex items-center justify-center gap-2 mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8m-7 8h6a2 2 0 002-2V6a2 2 0 00-2-2H8a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
        Copy Seluruh Data KK
      </button>
      <div class="text-xs text-gray-500 mt-2">* Format tampilan menyerupai Kartu Keluarga Indonesia</div>
    </div>
    `;
    Swal.fire({
        title: 'Kartu Keluarga',
        html: html,
        width: '60vw',
        showCloseButton: true,
        showConfirmButton: false,
        didOpen: () => {
            $('#copyKKBtn').on('click', function() {
                // Compose text
                let text = `No. KK: ${no_kk}\n`;
                text += 'No\tNIK\tNama\tJenis Kelamin\tTempat Lahir\tTanggal Lahir\tStatus Keluarga\tPendidikan\tPekerjaan\n';
                for(let idx=0; idx<members.length; idx++) {
                    const w = members[idx];
                    text += `${idx+1}\t${w.nik}\t${w.nama}\t${capitalizeWords(w.jenis_kelamin)}\t${w.tempat_lahir}\t${w.tanggal_lahir}\t${capitalizeWords(w.status_keluarga)}\t${w.pendidikan}\t${w.pekerjaan}\n`;
                }
                navigator.clipboard.writeText(text).then(() => {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Data KK berhasil di-copy!',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true
                    });
                });
            });
        },
        customClass: {
            popup: 'rounded-xl'
        }
    });
}

// Panggil pertama kali
fetchData();


