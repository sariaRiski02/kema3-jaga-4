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
                <option value="Laki-laki" ${data.jenis_kelamin === 'laki-laki' ? 'selected' : ''}>Laki-laki</option>
                <option value="Perempuan" ${data.jenis_kelamin === 'perempuan' ? 'selected' : ''}>Perempuan</option>
              </select>
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Tempat Lahir</span>
              <input type="text" id="edit_tempat_lahir" class="input px-4 py-2 w-full" value="${data.tempat_lahir || ''}">
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Tanggal Lahir</span>
              <input type="date" id="edit_tanggal_lahir" class="input px-4 py-2 w-full" value="${toInputDate(data.tanggal_lahir)}">
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Agama</span>
              <select id="edit_agama" class="input px-4 py-2 w-full">
                <option value="">Pilih Agama</option>
                <option value="Islam" ${data.agama === 'islam' ? 'selected' : ''}>Islam</option>
                <option value="Kristen" ${data.agama === 'kristen' ? 'selected' : ''}>Kristen</option>
                <option value="Katolik" ${data.agama === 'katolik' ? 'selected' : ''}>Katolik</option>
                <option value="Hindu" ${data.agama === 'hindu' ? 'selected' : ''}>Hindu</option>
                <option value="Buddha" ${data.agama === 'buddha' ? 'selected' : ''}>Buddha</option>
                <option value="Konghucu" ${data.agama === 'konghucu' ? 'selected' : ''}>Konghucu</option>
                <option value="Lainnya" ${data.agama === 'lainnya' ? 'selected' : ''}>Lainnya</option>
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
                <option value="Belum Kawin" ${data.status_perkawinan === 'belum kawin' ? 'selected' : ''}>Belum Kawin</option>
                <option value="Kawin" ${data.status_perkawinan === 'kawin' ? 'selected' : ''}>Kawin</option>
                <option value="Cerai Hidup" ${data.status_perkawinan === 'cerai hidup' ? 'selected' : ''}>Cerai Hidup</option>
                <option value="Cerai Mati" ${data.status_perkawinan === 'cerai mati' ? 'selected' : ''}>Cerai Mati</option>
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
                <option value="Kepala Keluarga" ${data.status_keluarga === 'kepala keluarga' ? 'selected' : ''}>Kepala Keluarga</option>
                <option value="Istri" ${data.status_keluarga === 'istri' ? 'selected' : ''}>Istri</option>
                <option value="Anak" ${data.status_keluarga === 'anak' ? 'selected' : ''}>Anak</option>
                <option value="Orangtua" ${data.status_keluarga === 'orangtua' ? 'selected' : ''}>Orangtua</option>
                <option value="Mertua" ${data.status_keluarga === 'mertua' ? 'selected' : ''}>Mertua</option>
                <option value="Cucu" ${data.status_keluarga === 'cucu' ? 'selected' : ''}>Cucu</option>
                <option value="Lainnya" ${data.status_keluarga === 'lainnya' ? 'selected' : ''}>Lainnya</option>
              </select>
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Tanggal Kematian</span>
              <input type="date" id="edit_tanggal_kematian" class="input px-4 py-2 w-full" value="${toInputDate(data.tanggal_kematian)}">
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Alamat</span>
              <textarea id="edit_alamat" class="input px-4 py-2 w-full" rows="2">${data.alamat || ''}</textarea>
            </label>
            <label class="block">
              <span class="text-sm text-purple-700">Pendidikan Terakhir</span>
              <select id="edit_pendidikan" class="input px-4 py-2 w-full">
                <option value="">Pilih Pendidikan</option>
                <option value="tidak sekolah" ${data.pendidikan === 'tidak sekolah' ? 'selected' : ''}>tidak sekolah</option>
                <option value="sd/sederajat" ${data.pendidikan === 'sd/sederajat' ? 'selected' : ''}>sd/sederajat</option>
                <option value="smp/sederajat" ${data.pendidikan === 'smp/sederajat' ? 'selected' : ''}>smp/sederajat</option>
                <option value="sma/sederajat" ${data.pendidikan === 'sma/sederajat' ? 'selected' : ''}>sma/sederajat</option>
                <option value="diploma" ${data.pendidikan === 'diploma' ? 'selected' : ''}>diploma</option>
                <option value="sarjana" ${data.pendidikan === 'sarjana' ? 'selected' : ''}>sarjana</option>
                <option value="pascasarjana" ${data.pendidikan === 'pascasarjana' ? 'selected' : ''}>pascasarjana</option>
                <option value="lainnya" ${data.pendidikan === 'lainnya' ? 'selected' : ''}>lainnya</option>
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
                Swal.fire({
                  icon: 'success',
                  title: 'Mantap!',
                  text: 'Tu Data so ta update.',
                  timer: 1800,
                  showConfirmButton: false
                });
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

            console.log(xhr.responseJSON);
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

function toInputDate(val) {
    if (!val) return '';
    // Jika sudah format YYYY-MM-DD, return langsung
    if (/^\d{4}-\d{2}-\d{2}$/.test(val)) return val;
    // Jika format d/m/Y, ubah ke Y-m-d
    const match = val.match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
    if (match) return `${match[3]}-${match[2]}-${match[1]}`;
    return '';
}
