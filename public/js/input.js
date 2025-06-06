$(function() {
    $("#no_kk").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "/api/no_kk",
                method: "POST",
                data: { term: request.term },
                success: function(res) {
                    if (res.data) {
                        response(res.data);
                    } else {
                        response([]);
                    }
                },
                error: function() {
                    response([]);
                }
            });
        },
        minLength: 2
    });
});
