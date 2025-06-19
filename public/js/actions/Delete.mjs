
import {fetchData} from '../resident.js';

var apiKey = $('meta[name="api-key"]').attr('content');
// delete resident
function deleteResident(id){
    $.ajax({
        url : `/api/resident/${id}`,
        method : 'DELETE',
        headers: {
            'X-API-KEY': apiKey
        },
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
            fetchData();
        }
        });
    
});