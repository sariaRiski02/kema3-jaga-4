$('#tableBody').on('click', '.btn-see', function(){
    var id = $(this).data('id');
    $.ajax({
        url: '/api/resident/' + id,
        method: 'GET',
         success: function (response){
         see(response);
        },
    error: function (){
        Swal.fire("Gagal mengambil data", '', 'error');
    }
    
    });
})

function htmlScript(warga){
    const [tahun, bulan, tanggalHari] = warga.tanggal_lahir.split('-');
    let tanggal_lahir =  `${tanggalHari}-${bulan}-${tahun}`;

    // Cek apakah ada tanggal kematian
    let isMeninggal = !!warga.tanggal_kematian;
    let notifMeninggal = '';
    if (isMeninggal) {
        notifMeninggal = `
            <div class="mb-4 p-3 rounded bg-red-100 border border-red-400 text-red-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 5.636l-1.414-1.414A9 9 0 105.636 18.364l1.414 1.414A9 9 0 1018.364 5.636z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 9v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V9" />
                </svg>
                <span>
                    Orang ini sudah <b>meninggal dunia</b> pada tanggal <b>${warga.tanggal_kematian}</b>.
                </span>
            </div>
        `;
    }

    let html = `
        <div class="overflow-x-auto">
            ${notifMeninggal}
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
                        `Status Perkawinan: ${warga.status_perkawinan ?? '-'}`
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
