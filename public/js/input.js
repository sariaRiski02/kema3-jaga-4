var apiKey = $('meta[name="api-key"]').attr('content');
$("#no_kk").autocomplete({
    source: function(request, response) {
        $.ajax({
            url: "/api/no_kk",
            method: "POST",
            headers: {'X-API-KEY' : apiKey},
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

function showFieldErrors(errors) {
    // Hapus error sebelumnya
    $('.error-message-manado').remove();
    // Loop setiap error
    $.each(errors, function(field, val) {
        // Gabung jika array
        if (Array.isArray(val)) val = val.join('<br>');
        // Cari elemen input/select/textarea
        let $input = $('#' + field);
        // Jika tidak ketemu, skip
        if ($input.length === 0) return;
        // Tampilkan pesan error setelah input
        $input.after(
            '<div class="error-message-manado bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded mt-2 text-sm">' +
            translateError(val) +
            '</div>'
        );
    });
}

function clearFieldErrors() {
    $('.error-message-manado').remove();
}

function fetch(){
    clearFieldErrors();
    $("#loading").show();
    $.ajax({
        url: '/api/resident',
        method: 'POST',
        headers: {'X-API-KEY': apiKey},
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
                clearFieldErrors();
                Swal.fire({
                    icon: 'success',
                    title: 'Mantap!',
                    text: 'Data so ta simpan!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '/dashboard';
                });
                window.location.href = '/dashboard';
            } else {
                if (res.errors) {
                    showFieldErrors(res.errors);
                }
                let msg = res.message || 'Data nyanda bisa disimpan.';
                // Jika ingin tetap ada notifikasi umum, bisa pakai alert(msg);
            }
        },
        error: function(xhr, status, error) {
            $("#loading").hide();
            clearFieldErrors();
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                showFieldErrors(xhr.responseJSON.errors);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Aduh, ada error.',
                    text: xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Terjadi kesalahan saat menyimpan data.',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            }
            console.error('Error:', error);
            console.error('Status:', status);
            console.error('Response:', xhr.responseText);
        }
    })
}

// Fungsi translateError untuk mengubah pesan error ke bahasa Manado
function translateError(msg) {
    // Contoh translasi sederhana, tambahkan sesuai kebutuhan
    return msg
        .replace('The nama field is required.', 'Nama musti diisi.')
        .replace('The nik field is required.', 'NIK musti diisi.')
        .replace('The jenis kelamin field is required.', 'Pilih dulu jenis kelamin.')
        .replace('The tempat lahir field is required.', 'Tempat lahir musti diisi.')
        .replace('The tanggal lahir field is required.', 'Tanggal lahir musti diisi.')
        .replace('The tanggal kematian must be a date after tanggal lahir.', 'Tanggal kematian musti lebe dari tanggal lahir.')
        .replace('The pendidikan field is required.', 'Pendidikan musti diisi.')
        .replace('The no kk field is required.', 'Nomor KK musti diisi.')
        .replace('The status keluarga field is required.', 'Status keluarga musti diisi.')
        .replace('The agama field is required.', 'Agama musti diisi.')
        .replace('The status perkawinan field is required.', 'Status perkawinan musti diisi.')
        .replace('The nik has already been taken.', 'NIK so pernah dipake, coba cek ulang.')
        .replace('The selected jenis kelamin is invalid.', 'Jenis kelamin nyanda valid.')
        .replace('The selected pendidikan is invalid.', 'Pendidikan nyanda valid.')
        .replace('The selected status perkawinan is invalid.', 'Status perkawinan nyanda valid.')
        .replace('The selected agama is invalid.', 'Agama nyanda valid.')
        .replace('The selected status keluarga is invalid.', 'Status keluarga nyanda valid.')
        .replace('The alamat field is required.', 'Alamat musti diisi.')
        // fallback
        ;
}


$('#submit').on('click', function(e){
    e.preventDefault();
   fetch();
});

// Fungsi untuk mengisi form dengan data warga (untuk edit)
function fillForm(data) {
    $("#nik").val(data.nik).prop('readonly', true); // NIK tidak bisa diubah
    $("#nama").val(data.nama);
    $("#pendidikan").val(data.pendidikan);
    $("#alamat").val(data.alamat);
    $("#jenis_kelamin").val(data.jenis_kelamin);
    $("#tempat_lahir").val(data.tempat_lahir);
    $("#tanggal_lahir").val(data.tanggal_lahir);
    $("#tanggal_kematian").val(data.tanggal_kematian);
    $("#agama").val(data.agama);
    $("#pekerjaan").val(data.pekerjaan);
    $("#no_kk").val(data.kk ? data.kk.no_kk : '');
    $("#status_keluarga").val(data.status_keluarga);
    $("#status_perkawinan").val(data.status_perkawinan);
    // ...tambahkan jika ada field lain...
}

// Fungsi untuk update data warga
function updateResident(id) {
    clearFieldErrors();
    $("#loading").show();
    $.ajax({
        url: '/api/resident/' + id,
        method: 'PUT',
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
            // ...tambahkan jika ada field lain...
        },
        success: function(res) {
            $("#loading").hide();
            if (res.success === true) {
                clearFieldErrors();
                alert('Data so berhasil diupdate!');
                window.location.href = '/dashboard';
            } else {
                if (res.errors) {
                    showFieldErrors(res.errors);
                }
                let msg = res.message || 'Data nyanda bisa diupdate.';
            }
        },
        error: function(xhr, status, error) {
            $("#loading").hide();
            clearFieldErrors();
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                showFieldErrors(xhr.responseJSON.errors);
            } else {
                alert('Aduh, ada error.');
            }
            console.error('Error:', error);
            console.error('Status:', status);
            console.error('Response:', xhr.responseText);
        }
    })
}


