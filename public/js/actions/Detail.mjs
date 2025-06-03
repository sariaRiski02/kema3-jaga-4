
$('#tableBody').on('click', '.btn-see', function(){
    var id = $(this).data('id');
    $.ajax({
        url: '/api/resident/see/' + id,
        method: 'GET',
         success: function (response){
         see(response);
        },
    error: function (){
        Swal.fire("Gagal mengambil data", '', 'error');
    }
    
    });
})


function list_kendaraan(data){
    if (!data || data.length === 0) {
        return '-';
    }
    let html = `
        <ul class="pl-5 space-y-2">
            <li class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
                <span class="font-medium text-gray-700">Roda 2:</span>
                <span class="text-gray-900">${data['roda_2']}</span>
            </li>
            <li class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 bg-green-500 rounded-full"></span>
                <span class="font-medium text-gray-700">Roda 4:</span>
                <span class="text-gray-900">${data['roda_4']}</span>
            </li>
            <li class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 bg-yellow-500 rounded-full"></span>
                <span class="font-medium text-gray-700">Bus/Truk:</span>
                <span class="text-gray-900">${data['bus/truk']}</span>
            </li>
        </ul>
    `;
    return html;
}

function list(data) {
    if (!data || data.length === 0) {
        return '-';
    }
    let html = `<ul class="pl-5 space-y-2">`;
    data.forEach(item => {
        html += `
            <li class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 bg-green-600 rounded-full"></span>
                <span class="font-medium text-gray-700">${item.jenis_tanah}:</span>
                <span class="text-gray-900">${item.luas} m²</span>
            </li>
        `;
    });
    html += `</ul>`;
    return html;
}

function htmlScript(warga){
    
    const [tahun, bulan, tanggalHari] = warga.tanggal_lahir.split('-');
    let tanggal_lahir =  `${tanggalHari}-${bulan}-${tahun}`;

    let html = `
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200 rounded-lg">
                <tbody>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">NIK</th>
                        <td class="px-4 py-2">${warga.nik}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Nama</th>
                        <td class="px-4 py-2">${warga.nama}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Jenis Kelamin</th>
                        <td class="px-4 py-2">${warga.jenis_kelamin}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Tempat Lahir</th>
                        <td class="px-4 py-2">${warga.tempat_lahir}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Tanggal Lahir</th>
                        <td class="px-4 py-2">${tanggal_lahir}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Umur</th>
                        <td class="px-4 py-2">${warga.umur ?? '-'} tahun</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">No KK</th>
                        <td class="px-4 py-2">${warga.kk?.no_kk ?? warga.no_kk ?? '-'}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Status Keluarga</th>
                        <td class="px-4 py-2">${warga.status_keluarga ?? '-'}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Alamat</th>
                        <td class="px-4 py-2">${warga.alamat ?? '-'}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Agama</th>
                        <td class="px-4 py-2">${warga.agama ?? '-'}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Pendidikan</th>
                        <td class="px-4 py-2">${warga.pendidikan ?? '-'}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Pekerjaan</th>
                        <td class="px-4 py-2">${warga.pekerjaan ?? '-'}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Status Perkawinan</th>
                        <td class="px-4 py-2">${warga.status_perkawinan ?? '-'}</td>
                    </tr>
                    
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Kepemilikan kendaraan</th>
                        <td class="px-4 py-2">${list_kendaraan(warga.kendaraan) ?? '-'}</td>
                    </tr>

                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Kepemilikan kendaraan</th>
                        <td class="px-4 py-2">${list(warga.kepemilikan_tanah)}</td>
                    </tr>
                   
                    
                </tbody>
            </table>
            <button
                id="copyDetailBtn"
                class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition-all duration-200 flex items-center justify-center gap-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 16h8M8 12h8m-7 8h6a2 2 0 002-2V6a2 2 0 00-2-2H8a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Copy Detail
            </button>
        </div>
    `;
    return html;
}

// see Detail

function see (response){
    if(response.success && response.data){
        let warga = response.data;
        Swal.fire({
            title: 'Detail Warga',
            html: htmlScript(warga),
            icon: 'info',
            didOpen: () => {
                $('#copyDetailBtn').on('click', function() {
                    const text = 
                    `NIK: ${warga.nik}
                    Nama: ${warga.nama}
                    Jenis Kelamin: ${warga.jenis_kelamin}
                    Tempat Lahir: ${warga.tempat_lahir}
                    Tanggal Lahir: ${warga.tanggal_lahir}
                    Umur: ${warga.umur ?? '-'} tahun
                    No KK: ${warga.no_kk ?? '-'}
                    Status Keluarga: ${warga.status_keluarga ?? '-'}`;
                    navigator.clipboard.writeText(text).then(() => {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Detail berhasil di-copy!',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        });
                    });
                });
            }
        });
    } else {
        Swal.fire('Data tidak ditemukan','', 'error');
    }
}
