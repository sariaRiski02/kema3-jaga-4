import { render, renderPagination } from "./resident.js";


$('#searchInput').on('keyup', function(){
    let query = $(this).val();
    
    $.ajax({
        url: '/api/resident/search',
        type: 'GET',
        data: {
            q: query
        },
        success: function(response){
            render(response);
            renderPagination(response.data);
        },
        error: function(error){
            console.log(error);
        }
    });
});

$('#searchInput').on('input', function() {
    if ($(this).val().trim() !== "") {
        $('#clearSearch').removeClass('hidden');
    } else {
        $('#clearSearch').addClass('hidden');
    }
});

$('#clearSearch').on('click', function() {
    $('#searchInput').val('');
    $(this).addClass('hidden');
    $('#searchInput').trigger('keyup');
});