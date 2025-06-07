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

function fetch(){
    $("#loading").show();
    $.ajax({
        url: '/api/resident',
        method: 'POST',
        type: 'json',
        data: {
            nik: $("#nik").val(),
            nama: $("#nama").val(),
            pendidikan: $("#pendidikan").val(),
            alamat: $("#alamat").val(),
            jenis_kelamin: $("#jenis_kelamin").val(),
            tempat_lahir: $("#tempat_lahir").val(),
            tanggal_lahir: $("#tanggal_lahir").val(),
            tanggal_kematian: $("#tanggal_kematian").val(),
            agama: $("#agama").val(),
            pekerjaan: $("#pekerjaan").val(),
            no_kk: $("#no_kk").val(),
            status_keluarga: $("#status_keluarga").val(),
            status_perkawinan: $("#status_perkawinan").val(),
            status_rumah: $("#status_rumah").val(),
            tipe_rumah: $("#tipe_rumah").val(),
            motor_roda2: $("#motor_roda2").val(),
            mobil_roda4: $("#mobil_roda4").val(),
            bus_truk: $("#bus_truk").val(),
            jenis_usaha: $("#jenis_usaha").val(),
            gas: $("#gas").is(":checked"),
            kayu_bakar: $("#kayu_bakar").is(":checked"),
            minyak_tanah: $("#minyak_tanah").is(":checked"),
            sumur: $("#sumur").is(":checked"),
            mata_air: $("#mata_air").is(":checked"),
            air_lainnya: $("#air_lainnya").is(":checked"),
        },
        success: function(res) {
            $("#loading").hide();
            if (res.success === true) {
                alert('Data berhasil disimpan');
                window.location.href = '/resident';
            } else {
                alert('Gagal menyimpan data: ' + (res.message || 'Unknown error'));
            }
        },
        error: function(xhr, status, error) {
            $("#loading").hide();
            alert('Terjadi kesalahan: ' + error);
            console.error('Error:', error);
            console.error('Status:', status);
            console.error('Response:', xhr.responseText);
        }
    })
}


$('#submit').on('click', function(e){
    e.preventDefault();
   fetch();
});


