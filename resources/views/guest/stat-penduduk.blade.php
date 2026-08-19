<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
    <div class="bg-purple-100 rounded-xl p-6 text-center">
    <p class="text-5xl font-bold text-purple-800">{{ $resident->count() }}</p>
    <p class="text-purple-600 mt-2 text-lg">Penduduk</p>
    </div>
    <div class="bg-purple-100 rounded-xl p-6 text-center">
    <p class="text-5xl font-bold text-purple-800">{{ $families->count() }}</p>
    <p class="text-purple-600 mt-2 text-lg">Keluarga</p>
    </div>
</div>

