var apiKey = $('meta[name="api-key"]').attr('content');

// Script untuk fitur upload Excel di file.blade.php
$(document).ready(function() {
    // Trigger file input saat klik tombol
    $('#selectFileBtn').on('click', function(e) {
        e.preventDefault();
        $('#excelFileInput').click();
    });

    // Tampilkan info file setelah dipilih
    $('#excelFileInput').on('change', function() {
        const file = this.files[0];
        if (file) {
            $('#fileName').text(file.name);
            $('#fileSize').text((file.size / 1024 / 1024).toFixed(2) + ' MB');
            $('#fileInfo').removeClass('hidden');
            $('#importBtn').removeClass('hidden');
        } else {
            $('#fileInfo').addClass('hidden');
            $('#importBtn').addClass('hidden');
        }
    });

    // Hapus file
    $('#removeFileBtn').on('click', function() {
        $('#excelFileInput').val('');
        $('#fileInfo').addClass('hidden');
        $('#importBtn').addClass('hidden');
    });

    // Import file Excel ke backend
    $('#importBtn').on('click', function(e) {
        e.preventDefault();
        const file = $('#excelFileInput')[0].files[0];
        if (!file) return;
        var formData = new FormData();
        formData.append('file', file);
        // Tampilkan loading overlay
        $('#globalLoading').removeClass('hidden').addClass('flex');
        $('#uploadProgress').removeClass('hidden');
        $('#progressBar').css('width', '0%');
        $('#progressText').text('0%');
        $.ajax({
            url: '/api/import-excel',
            headers: {'X-API-KEY' : apiKey},
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(evt) {
                    if (evt.lengthComputable) {
                        var percent = Math.round((evt.loaded / evt.total) * 100);
                        $('#progressBar').css('width', percent + '%');
                        $('#progressText').text(percent + '%');
                    }
                }, false);
                return xhr;
            },
            success: function(res) {
                $('#uploadProgress').addClass('hidden');
                $('#globalLoading').removeClass('flex').addClass('hidden');
                Swal.fire({
                    icon: 'success',
                    title: 'Import Berhasil',
                    text: res.message || 'Data warga berhasil diimport!',
                    showConfirmButton: true,
                    timer: 2000
                });
                // Bisa panggil fetchData() untuk refresh tabel
            },
            error: function(err) {
                $('#uploadProgress').addClass('hidden');
                $('#globalLoading').removeClass('flex').addClass('hidden');
                let msg = 'Gagal import!';
                if (err.responseJSON && err.responseJSON.message) {
                    msg = err.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Import Gagal',
                    text: msg,
                    showConfirmButton: true
                });
            }
        });
    });

    // Download template Excel/CSV
    $('#downloadTemplateBtn').on('click', function(e) {
        e.preventDefault();
        // Tawarkan pilihan download CSV atau XLSX
        Swal.fire({
            title: 'Pilih Format Template',
            showDenyButton: true,
            confirmButtonText: 'Excel (.xlsx)',
            denyButtonText: 'CSV (Universal)',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/api/template-warga';
            } else if (result.isDenied) {
                window.location.href = '/api/template-warga-csv';
            }
        });
    });
});
