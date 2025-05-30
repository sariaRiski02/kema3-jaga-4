
function load(page = 1){
    $.ajax({
    url: '/api/resident?page=' + page,
    method: 'GET',
    dataType: 'json',
    success: function(response){
        if(response.success && Array.isArray(response.data)){
            $('#tableBody').empty();
           response.data.data.forEach((warga) => {
            console.lo('error');
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

           // Tampilkan tombol pagination
                let paginationHtml = '';
                if(response.data.current_page > 1){
                    paginationHtml += `<button class="btn-page" data-page="${response.data.current_page - 1}">Prev</button>`;
                }
                if(response.data.current_page < response.data.last_page){
                    paginationHtml += `<button class="btn-page" data-page="${response.data.current_page + 1}">Next</button>`;
                }
                $('#pagination').html(paginationHtml);
        }
    }, 
    error: function(xhr, status, error){
        console.error('Gagal mengambil data: ', error);
    }
    });
}

// Panggil pertama kali
load();

// Event listener tombol pagination
$(document).on('click', '.btn-page', function(){
    let page = $(this).data('page');
    load(page);
});


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


