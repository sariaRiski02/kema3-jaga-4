
function fetchData(page = 1){
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

function render (response){
    let data = response.data.data;
    if(response.success && Array.isArray(data)){
        $('#tableBody').empty();
        data.forEach((warga) => {
            $('#tableBody').append(
                `<tr id="dataTable">
                    <td class="px-3 sm:px-4 py-3 border">${warga.nik}</td>
                    <td class="px-3 sm:px-4 py-3 border">${warga.nama}</td>
                    <td class="px-3 sm:px-4 py-3 border">${warga.jenis_kelamin}</td>
                    <td class="px-3 sm:px-4 py-3 border">${warga.umur} tahun</td>
                    <td class="px-3 sm:px-4 py-3 border text-center">
                    <div class="flex justify-center gap-2">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs font-medium transition-all duration-200 flex items-center gap-1 shadow-sm hover:shadow-md" title="Lihat Detail">
                    👁️ Lihat
                    </button>
                    <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-xs font-medium transition-all duration-200 flex items-center gap-1 shadow-sm hover:shadow-md" title="Edit Data">
                    ✏️ Edit
                    </button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-xs font-medium transition-all duration-200 flex items-center gap-1 shadow-sm hover:shadow-md btn-delete" title="Hapus Data" data-id="${warga.id}">
                    🗑️ Hapus
                    </button>
                    </div>
                    </td>
                </tr>`
            )
        });
    }
}


function renderPagination(response){
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


// Panggil pertama kali
fetchData();

// delete resident
function deleteResident(id){
    $.ajax({
        url : `/api/resident/${id}`,
        method : 'DELETE',
        success: function(response){
            Swal.fire("Mantap tu data so tahapus 👍");
        },
        error: function(error){
            Swal.fire({
                title: "✋ Tunggu sohib Ada yg salah!",
                text: "Nimbole mo hapus, nanti ulang jo Eee..",
                icon: "error"
            });
        }
    

    })
}


// Event listener tombol hapus (setelah data di-append)
$('#tableBody').on('click', '.btn-delete', function() {
    var id = $(this).data('id');
    Swal.fire({
        title: "🗑️ Butul Mo hapus ni data?",
        text: "⚠️ Ni data Mo ilang permanen, coba lia ulang",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "👍 Iyo, Hapus jo!",
        cancelButtonText: "🙅‍♂️ Sudah jo ndak jadi"
        }).then((result) => {
        if(result.isConfirmed){
            deleteResident(id);
            load();
        }
        });
    
});


