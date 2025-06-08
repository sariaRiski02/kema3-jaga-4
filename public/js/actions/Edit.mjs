// Modal HTML generator
function showEditModal(data, id) {
    $('#editModalManado').remove();
    const modalHtml = `
    <div id="editModalManado" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 overflow-y-auto">
      <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-2 p-6 relative max-h-[90vh] flex flex-col overflow-y-auto">
        <h2 class="text-xl font-bold text-purple-700 mb-4">Edit Data Warga</h2>
        <form id="editResidentForm" class="flex-1 flex flex-col overflow-y-auto">
          <div class="grid grid-cols-1 gap-3 pb-6">
            <input type="hidden" id="edit_id_modal" value="${id}">
            <label class="block">
              <span class="text-sm text-purple-700">NIK</span>
              <input type="text" id="edit_nik" class="input px-4 py-2 w-full" value="${data.nik || ''}" readonly>
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Nama Lengkap</span>
              <input type="text" id="edit_nama" class="input px-4 py-2 w-full" value="${data.nama || ''}">
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Jenis Kelamin</span>
              <select id="edit_jenis_kelamin" class="input px-4 py-2 w-full">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" ${data.jenis_kelamin === 'Laki-laki' ? 'selected' : ''}>Laki-laki</option>
                <option value="Perempuan" ${data.jenis_kelamin === 'Perempuan' ? 'selected' : ''}>Perempuan</option>
              </select>
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Tempat Lahir</span>
              <input type="text" id="edit_tempat_lahir" class="input px-4 py-2 w-full" value="${data.tempat_lahir || ''}">
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Tanggal Lahir</span>
              <input type="date" id="edit_tanggal_lahir" class="input px-4 py-2 w-full" value="${data.tanggal_lahir || ''}">
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Agama</span>
              <select id="edit_agama" class="input px-4 py-2 w-full">
                <option value="">Pilih Agama</option>
                <option value="Islam" ${data.agama === 'Islam' ? 'selected' : ''}>Islam</option>
                <option value="Kristen" ${data.agama === 'Kristen' ? 'selected' : ''}>Kristen</option>
                <option value="Katolik" ${data.agama === 'Katolik' ? 'selected' : ''}>Katolik</option>
                <option value="Hindu" ${data.agama === 'Hindu' ? 'selected' : ''}>Hindu</option>
                <option value="Buddha" ${data.agama === 'Buddha' ? 'selected' : ''}>Buddha</option>
                <option value="Konghucu" ${data.agama === 'Konghucu' ? 'selected' : ''}>Konghucu</option>
                <option value="Lainnya" ${data.agama === 'Lainnya' ? 'selected' : ''}>Lainnya</option>
              </select>
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Pekerjaan</span>
              <input type="text" id="edit_pekerjaan" class="input px-4 py-2 w-full" value="${data.pekerjaan || ''}">
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Status Perkawinan</span>
              <select id="edit_status_perkawinan" class="input px-4 py-2 w-full">
                <option value="">Status Perkawinan</option>
                <option value="Belum Kawin" ${data.status_perkawinan === 'Belum Kawin' ? 'selected' : ''}>Belum Kawin</option>
                <option value="Kawin" ${data.status_perkawinan === 'Kawin' ? 'selected' : ''}>Kawin</option>
                <option value="Cerai Hidup" ${data.status_perkawinan === 'Cerai Hidup' ? 'selected' : ''}>Cerai Hidup</option>
                <option value="Cerai Mati" ${data.status_perkawinan === 'Cerai Mati' ? 'selected' : ''}>Cerai Mati</option>
              </select>
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Nomor KK</span>
              <input type="text" id="edit_no_kk" class="input px-4 py-2 w-full" value="${data.kk ? data.kk.no_kk : ''}">
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Status Dalam Keluarga</span>
              <select id="edit_status_keluarga" class="input px-4 py-2 w-full">
                <option value="">Status Dalam Keluarga</option>
                <option value="Kepala Keluarga" ${data.status_keluarga === 'Kepala Keluarga' ? 'selected' : ''}>Kepala Keluarga</option>
                <option value="Istri" ${data.status_keluarga === 'Istri' ? 'selected' : ''}>Istri</option>
                <option value="Anak" ${data.status_keluarga === 'Anak' ? 'selected' : ''}>Anak</option>
                <option value="Orangtua" ${data.status_keluarga === 'Orangtua' ? 'selected' : ''}>Orangtua</option>
                <option value="Mertua" ${data.status_keluarga === 'Mertua' ? 'selected' : ''}>Mertua</option>
                <option value="Cucu" ${data.status_keluarga === 'Cucu' ? 'selected' : ''}>Cucu</option>
                <option value="Lainnya" ${data.status_keluarga === 'Lainnya' ? 'selected' : ''}>Lainnya</option>
              </select>
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Tanggal Kematian</span>
              <input type="date" id="edit_tanggal_kematian" class="input px-4 py-2 w-full" value="${data.tanggal_kematian || ''}">
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Alamat</span>
              <textarea id="edit_alamat" class="input px-4 py-2 w-full" rows="2">${data.alamat || ''}</textarea>
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Pendidikan Terakhir</span>
              <select id="edit_pendidikan" class="input px-4 py-2 w-full">
                <option value="">Pilih Pendidikan</option>
                <option value="Tidak Sekolah" ${data.pendidikan === 'Tidak Sekolah' ? 'selected' : ''}>Tidak Sekolah</option>
                <option value="SD/Sederajat" ${data.pendidikan === 'SD/Sederajat' ? 'selected' : ''}>SD/Sederajat</option>
                <option value="SMP/Sederajat" ${data.pendidikan === 'SMP/Sederajat' ? 'selected' : ''}>SMP/Sederajat</option>
                <option value="SMA/Sederajat" ${data.pendidikan === 'SMA/Sederajat' ? 'selected' : ''}>SMA/Sederajat</option>
                <option value="Diploma" ${data.pendidikan === 'Diploma' ? 'selected' : ''}>Diploma</option>
                <option value="Sarjana" ${data.pendidikan === 'Sarjana' ? 'selected' : ''}>Sarjana</option>
                <option value="Pascasarjana" ${data.pendidikan === 'Pascasarjana' ? 'selected' : ''}>Pascasarjana</option>
                <option value="Lainnya" ${data.pendidikan === 'Lainnya' ? 'selected' : ''}>Lainnya</option>
              </select>
            </label>
          </div>
          <div class="flex justify-end gap-3 mt-2 pb-2 bg-white sticky bottom-0 z-10">
            <button type="button" id="cancelEditModal" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg">Batal</button>
            <button type="submit" class="bg-purple-700 hover:bg-purple-800 text-white px-4 py-2 rounded-lg">Update</button>
          </div>
          <div id="edit-modal-errors" class="mt-3"></div>
        </form>
      </div>
    </div>
    `;
    $('body').append(modalHtml);
}

function closeEditModal() {
    $('#editModalManado').remove();
}

// Fungsi translateError harus sama dengan di input.js
function translateError(msg) {
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
        .replace('The alamat field is required.', 'Alamat musti diisi.');
}

// Tampilkan modal saat klik edit
$(document).on('click', '.btn-edit', function() {
    var id = $(this).data('id');
    $.get('/api/resident/' + id, function(res) {
        if (res.success && res.data) {
            showEditModal(res.data, id);
        }
    });
});

// Tutup modal jika klik batal
$(document).on('click', '#cancelEditModal', function() {
    closeEditModal();
});

// Submit update dari modal
$(document).on('submit', '#editResidentForm', function(e) {
    e.preventDefault();
    var id = $('#edit_id_modal').val();
    $('#edit-modal-errors').empty();

    $.ajax({
        url: '/api/resident/' + id,
        method: 'PUT',
        type: 'json',
        data: {
            nik: $('#edit_nik').val(),
            nama: $('#edit_nama').val(),
            pendidikan: $('#edit_pendidikan').val(),
            alamat: $('#edit_alamat').val(),
            jenis_kelamin: $('#edit_jenis_kelamin').val(),
            tempat_lahir: $('#edit_tempat_lahir').val(),
            tanggal_lahir: $('#edit_tanggal_lahir').val(),
            tanggal_kematian: $('#edit_tanggal_kematian').val(),
            agama: $('#edit_agama').val(),
            pekerjaan: $('#edit_pekerjaan').val(),
            no_kk: $('#edit_no_kk').val(),
            status_keluarga: $('#edit_status_keluarga').val(),
            status_perkawinan: $('#edit_status_perkawinan').val(),
        },
        success: function(res) {
            if (res.success === true) {
                closeEditModal();
                alert('Data so berhasil diupdate!');
                window.location.href = '/dashboard';
            } else {
                if (res.errors) {
                    let html = '<div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded mb-2 text-sm">';
                    $.each(res.errors, function(field, val) {
                        if (Array.isArray(val)) val = val.join('<br>');
                        html += '<div>' + translateError(val) + '</div>';
                    });
                    html += '</div>';
                    $('#edit-modal-errors').html(html);
                }
            }
        },
        error: function(xhr) {
            let html = '<div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded mb-2 text-sm">';
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(field, val) {
                    if (Array.isArray(val)) val = val.join('<br>');
                    html += '<div>' + translateError(val) + '</div>';
                });
            } else {
                html += 'Aduh, ada error.';
            }
            html += '</div>';
            $('#edit-modal-errors').html(html);
        }
    });
});
