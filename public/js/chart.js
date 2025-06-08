// Data variables dari window.appData
const klasifikasi_umur = window.appData.klasifikasi_umur;
const lebel_pendidikan = window.appData.lebel_pendidikan;
const value_pendidikan = window.appData.value_pendidikan;
const lebel_pekerjaan = window.appData.lebel_pekerjaan;
const value_pekerjaan = window.appData.value_pekerjaan;

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

// Pendidikan
new Chart(document.getElementById("pendidikanChart"), {
    type: "pie",
    data: {
        labels: lebel_pendidikan,
        datasets: [{
            data: value_pendidikan,
            backgroundColor: ["#fcd34d", "#fbbf24", "#f59e0b", "#d97706", "#b45309", "#a3e635"]
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

// Pekerjaan
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

