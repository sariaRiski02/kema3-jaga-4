<div class="bg-gradient-to-br from-slate-50 to-slate-100 p-6 rounded-2xl shadow-lg">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-slate-800 mb-1">📍 Wilayah Jaga 4</h2>
        <p class="text-slate-600 text-sm">KEMA 3</p>
    </div>
    
    <!-- Map Container -->
    <div class="relative bg-white rounded-xl overflow-hidden shadow-md border border-slate-200">
        <div id="map" class="w-full h-96 rounded-lg"></div>
        
        <!-- Legend -->
        <div class="absolute bottom-4 right-4 bg-white p-3 rounded-lg shadow-md border border-slate-200 z-10 text-sm">
            <div class="font-semibold text-slate-700 mb-2">Keterangan</div>
            <div class="space-y-1 text-slate-600">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    <span>Pos Kepala Jaga</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-indigo-400 opacity-50 rounded"></div>
                    <span>Wilayah Jaga</span>
                </div>
            </div>
        </div>
    </div>
</div>



<script>

document.addEventListener('DOMContentLoaded', function (){


    var latitude = 1.363895; 
    var longitude = 125.074950; 

    var area = [
        [1.364303, 125.073697],
        [1.363364, 125.073794],
        [1.363099, 125.074727],
        [1.363901, 125.074979],
    ]

    const map = L.map('map').setView([latitude, longitude], 18);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);


    // Marker Kepala Jaga
   L.marker([latitude, longitude])
    .addTo(map)
    .bindPopup('Kepala Jaga 4')
    .openPopup();

    const polygon = L.polygon(area, {
        color: 'purple',
        fillColor: 'purple',
        fillOpacity: 0.4
    }).addTo(map);



});
    





</script>