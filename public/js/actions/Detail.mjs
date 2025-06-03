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



function list_tanah(data) {
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


function list_elektronik(data){
    if (!data || data.length === 0) {
        return '-';
    }
    console.log(data);
    let html = `<ul class="pl-5 space-y-2">`;
    data.forEach(item => {
        html += `
            <li class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 bg-green-600 rounded-full"></span>
                <span class="font-medium text-gray-700">${item.jenis_elektronik}:</span>
                <span class="text-gray-900">${item.jumlah}</span>
            </li>
        `;
    });
    html += `</ul>`;
    return html;
}


function list_ternak(data){
    if (!data || data.length === 0) {
        return '-';
    }
    console.log(data);
    let html = `<ul class="pl-5 space-y-2">`;
    data.forEach(item => {
        html += `
            <li class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 bg-green-600 rounded-full"></span>
                <span class="font-medium text-gray-700">${item.jenis_ternak}:</span>
                <span class="text-gray-900">${item.jumlah}</span>
            </li>
        `;
    });
    html += `</ul>`;
    return html;
}

function list_air(data){
    if (!data || data.length === 0) {
        return '-';
    }

    let html = `<ul class="pl-5 space-y-2">`;
    if(data.sumur){
        html+=`<li class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
                <span class="font-medium text-gray-700">Roda 2:</span>
                <span class="text-gray-900">${data.sumur ? 'sumur' : ''}</span>
            </li>`;
    }
    if(data.pdam){
        html+= `
            <li class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
                <span class="font-medium text-gray-700">Roda 2:</span>
                <span class="text-gray-900">${data.pdam ? 'PDAM' : ''}</span>
            </li>`;
    }
    if(data.mata_air){
        html+= `
            <li class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
                <span class="font-medium text-gray-700">Roda 2:</span>
                <span class="text-gray-900">${data.mata_air ? 'Mata air' : ''}</span>
            </li>`;
    }
    if(data.lainnya){
        html+= `
            <li class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
                <span class="font-medium text-gray-700">Roda 2:</span>
                <span class="text-gray-900">${data.lainnya ? 'Lainnya' : ''}</span>
            </li>`;
    }

    html+=`</ul>`;
    return html;
}

function list_bahan_bakar(data) {
    console.log(data);
    if (!data) {
        return '-';
    }
    const sources = [
        { key: 'minyak_tanah', label: 'Minyak Tanah', color: 'bg-yellow-600' },
        { key: 'kayu_bakar', label: 'Kayu Bakar', color: 'bg-green-700' },
        { key: 'gas', label: 'Gas', color: 'bg-blue-600' },
        { key: 'solar', label: 'Solar', color: 'bg-gray-600' },
        { key: 'lainnya', label: 'Lainnya', color: 'bg-purple-600' }
    ];
    let html = `<ul class="pl-5 space-y-2">`;
    let found = false;
    sources.forEach(source => {
        if (data[source.key]) {
            found = true;
            html += `
                <li class="flex items-center gap-2">
                    <span class="inline-block w-3 h-3 ${source.color} rounded-full"></span>
                    <span class="font-medium text-gray-700">${source.label}</span>
                </li>
            `;
        }
    });
    html += `</ul>`;
    return found ? html : '-';
}


function list_usaha(data) {
    if (!data || data.length === 0) {
        return '-';
    }
    let html = `<ul class="pl-5 space-y-2">`;
    data.forEach(item => {
        html += `
            <li class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 bg-indigo-600 rounded-full"></span>
                <span class="font-medium text-gray-700">${item.jenis_usaha}:</span>
                <span class="text-gray-900">${item.jumlah}</span>
            </li>
        `;
    });
    html += `</ul>`;
    return html;
}

function list_wc(data) {
    
    if (!data || typeof data !== 'object') {
        return '-';
    }
    // Only show "Ikut LPM" if ikut_lpm is present
    let html = `<ul class="pl-5 space-y-2">`;
    if ('ikut_lpm' in data) {
        html += `
            <li class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 ${data.ikut_lpm ? 'bg-green-700' : 'bg-red-700'} rounded-full"></span>
                <span class="font-medium text-gray-700">Ikut LPM</span>
                <span class="text-gray-900">${data.ikut_lpm ? 'Ya' : 'Tidak'}</span>
            </li>
        `;
    }
    html += `</ul>`;
    // If no known property, just show "-"
    return html === `<ul class="pl-5 space-y-2"></ul>` ? '-' : html;
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
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Kepemilikan tanah</th>
                        <td class="px-4 py-2">${list_tanah(warga.kepemilikan_tanah)}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Kepemilikan elektronik</th>
                        <td class="px-4 py-2">${list_elektronik(warga.kepemilikan_elektronik)}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Kepemilikan ternak</th>
                        <td class="px-4 py-2">${list_ternak(warga.kepemilikan_ternak)}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Penggunaan air</th>
                        <td class="px-4 py-2">${list_air(warga.penggunaan_air)}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Penggunaan bahan bakar</th>
                        <td class="px-4 py-2">${list_bahan_bakar(warga.penggunaan_bahan_bakar)}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">Usaha</th>
                        <td class="px-4 py-2">${list_usaha(warga.usaha)}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 font-semibold">WC</th>
                        <td class="px-4 py-2">${list_wc(warga.wc_kamar_mandi)}</td>
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
                    // Compose all detail text
                    const detailText = [
                        `NIK: ${warga.nik}`,
                        `Nama: ${warga.nama}`,
                        `Jenis Kelamin: ${warga.jenis_kelamin}`,
                        `Tempat Lahir: ${warga.tempat_lahir}`,
                        `Tanggal Lahir: ${warga.tanggal_lahir}`,
                        `Umur: ${warga.umur ?? '-'} tahun`,
                        `No KK: ${warga.kk?.no_kk ?? warga.no_kk ?? '-'}`,
                        `Status Keluarga: ${warga.status_keluarga ?? '-'}`,
                        `Alamat: ${warga.alamat ?? '-'}`,
                        `Agama: ${warga.agama ?? '-'}`,
                        `Pendidikan: ${warga.pendidikan ?? '-'}`,
                        `Pekerjaan: ${warga.pekerjaan ?? '-'}`,
                        `Status Perkawinan: ${warga.status_perkawinan ?? '-'}`,
                        '',
                        'Kepemilikan kendaraan:',
                        formatKendaraan(warga.kendaraan),
                        '',
                        'Kepemilikan tanah:',
                        formatTanah(warga.kepemilikan_tanah),
                        '',
                        'Kepemilikan elektronik:',
                        formatElektronik(warga.kepemilikan_elektronik),
                        '',
                        'Kepemilikan ternak:',
                        formatTernak(warga.kepemilikan_ternak),
                        '',
                        'Penggunaan air:',
                        formatAir(warga.penggunaan_air),
                        '',
                        'Penggunaan bahan bakar:',
                        formatBahanBakar(warga.penggunaan_bahan_bakar),
                        '',
                        'Usaha:',
                        formatUsaha(warga.usaha),
                        '',
                        'WC:',
                        formatWC(warga.wc_kamar_mandi)
                    ].join('\n');
                    navigator.clipboard.writeText(detailText).then(() => {
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

// Helper functions to format data as plain text for clipboard
function formatKendaraan(data) {
    if (!data) return '-';
    return [
        `  Roda 2: ${data['roda_2'] ?? '-'}`,
        `  Roda 4: ${data['roda_4'] ?? '-'}`,
        `  Bus/Truk: ${data['bus/truk'] ?? '-'}`
    ].join('\n');
}

function formatTanah(data) {
    if (!data || data.length === 0) return '-';
    return data.map(item => `  ${item.jenis_tanah}: ${item.luas} m²`).join('\n');
}

function formatElektronik(data) {
    if (!data || data.length === 0) return '-';
    return data.map(item => `  ${item.jenis_elektronik}: ${item.jumlah}`).join('\n');
}

function formatTernak(data) {
    if (!data || data.length === 0) return '-';
    return data.map(item => `  ${item.jenis_ternak}: ${item.jumlah}`).join('\n');
}

function formatAir(data) {
    if (!data) return '-';
    let arr = [];
    if (data.sumur) arr.push('  Sumur');
    if (data.pdam) arr.push('  PDAM');
    if (data.mata_air) arr.push('  Mata air');
    if (data.lainnya) arr.push('  Lainnya');
    return arr.length ? arr.join('\n') : '-';
}

function formatBahanBakar(data) {
    if (!data) return '-';
    const sources = [
        { key: 'minyak_tanah', label: 'Minyak Tanah' },
        { key: 'kayu_bakar', label: 'Kayu Bakar' },
        { key: 'gas', label: 'Gas' },
        { key: 'solar', label: 'Solar' },
        { key: 'lainnya', label: 'Lainnya' }
    ];
    let arr = [];
    sources.forEach(source => {
        if (data[source.key]) arr.push(`  ${source.label}`);
    });
    return arr.length ? arr.join('\n') : '-';
}

function formatUsaha(data) {
    if (!data || data.length === 0) return '-';
    return data.map(item => `  ${item.jenis_usaha}: ${item.jumlah}`).join('\n');
}

function formatWC(data) {
    if (!data || typeof data !== 'object') return '-';
    if ('ikut_lpm' in data) {
        return `  Ikut LPM: ${data.ikut_lpm ? 'Ya' : 'Tidak'}`;
    }
    return '-';
}
