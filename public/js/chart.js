// Data variables dari window.appData
const klasifikasi_umur = window.appData.klasifikasi_umur;
const lebel_pendidikan = window.appData.lebel_pendidikan;
const value_pendidikan = window.appData.value_pendidikan;
const lebel_pekerjaan = window.appData.lebel_pekerjaan;
const value_pekerjaan = window.appData.value_pekerjaan;
const lebel_usaha = window.appData.lebel_usaha;
const value_usaha = window.appData.value_usaha;
const lebel_bahan_bakar = window.appData.lebel_bahan_bakar;
const value_bahan_bakar = window.appData.value_bahan_bakar;
const lebel_kendaraan = window.appData.lebel_kendaraan;
const value_kendaraan = window.appData.value_kendaraan;
const lebel_elektronik = window.appData.lebel_elektronik;
const value_elektronik = window.appData.value_elektronik;
const lebel_ternak = window.appData.lebel_ternak;
const value_ternak = window.appData.value_ternak;
const lebel_rumah = window.appData.lebel_rumah;
const value_rumah = window.appData.value_rumah;
const lebel_tipe_rumah = window.appData.lebel_tipe_rumah;
const value_tipe_rumah = window.appData.value_tipe_rumah;
const lebel_tanah = window.appData.lebel_tanah;
const value_tanah = window.appData.value_tanah;

// Usia
new Chart(document.getElementById("usiaChart"), {
    type: "bar",
    data: {
        labels: ["0–12 (Anak)", "13–18 (Remaja)", "19–59 (Dewasa)", "60+ (Lansia)"],
        datasets: [{
            label: "Jumlah",
            data: klasifikasi_umur,
            backgroundColor: ["#c084fc", "#a78bfa", "#8b5cf6", "#7c3aed"]
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

new Chart(document.getElementById("pendidikanChart"), {
    type: "pie",
    data: {
        labels: lebel_pendidikan,
        datasets: [{
            data: value_pendidikan,
            backgroundColor: ["#fcd34d", "#fbbf24", "#f59e0b", "#d97706", "#b45309"]
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

new Chart(document.getElementById("pekerjaanChart"), {
    type: "bar",
    data: {
        labels: lebel_pekerjaan,
        datasets: [{
            label: "Jumlah",
            data: value_pekerjaan,
            backgroundColor: ["#34d399", "#22c55e", "#10b981", "#0ea5e9", "#6366f1"]
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

new Chart(document.getElementById("usahaChart"), {
    type: "bar",
    data: {
        labels: lebel_usaha,
        datasets: [{
            label: "Jumlah",
            data: value_usaha,
            backgroundColor: ["#fbbf24", "#f59e0b", "#ef4444", "#8b5cf6", "#10b981"]
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

new Chart(document.getElementById("bahanChart"), {
    type: "pie",
    data: {
        labels: lebel_bahan_bakar,
        datasets: [{
            data: value_bahan_bakar,
            backgroundColor: ["#d97706", "#facc15", "#fb923c", "#a3e635", "#38bdf8"]
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

new Chart(document.getElementById("kendaraanChart"), {
    type: "bar",
    data: {
        labels: lebel_kendaraan,
        datasets: [{
            label: "Jumlah",
            data: value_kendaraan,
            backgroundColor: ["#4ade80", "#60a5fa", "#818cf8"]
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

// Elektronik
new Chart(document.getElementById("elektronikChart"), {
    type: "bar",
    data: {
        labels: lebel_elektronik,
        datasets: [{
            label: "Jumlah",
            data: value_elektronik,
            backgroundColor: ["#4ade80", "#60a5fa", "#f472b6", "#818cf8", "#facc15"]
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

// Ternak
new Chart(document.getElementById("ternakChart"), {
    type: "bar",
    data: {
        labels: lebel_ternak,
        datasets: [{
            label: "Jumlah",
            data: value_ternak,
            backgroundColor: ["#f87171", "#fb923c", "#facc15", "#34d399"]
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

// Rumah
new Chart(document.getElementById("statusRumahChart"), {
    type: "pie",
    data: {
        labels: lebel_rumah,
        datasets: [{
            data: value_rumah,
            backgroundColor: ["#34d399", "#60a5fa", "#fbbf24", "#a78bfa"]
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

new Chart(document.getElementById("tipeRumahChart"), {
    type: "pie",
    data: {
        labels: lebel_tipe_rumah,
        datasets: [{
            data: value_tipe_rumah,
            backgroundColor: ["#8b5cf6", "#f59e0b", "#fca5a5"]
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

// Tanah
new Chart(document.getElementById("tanahChart"), {
    type: "bar",
    data: {
        labels: lebel_tanah,
        datasets: [{
            label: "Jumlah",
            data: value_tanah,
            backgroundColor: ["#fbbf24", "#f59e0b", "#ef4444", "#10b981"]
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

