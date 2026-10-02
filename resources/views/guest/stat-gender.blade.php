<div class="bg-purple-200 rounded-xl p-6 mb-10">
    <h2 class="text-2xl font-semibold text-purple-900 mb-6 text-center">Jenis Kelamin</h2>
    <div class="flex flex-col md:flex-row justify-center gap-8 md:gap-12">
    <div class="flex flex-col items-center mb-6 md:mb-0">
        <div class="w-32 h-32 md:w-40 md:h-40 bg-purple-500 text-white text-2xl md:text-3xl font-bold rounded-full flex items-center justify-center shadow-md">
        {{ $resident->getGenderPercentage('laki-laki') }}%
        </div>
        <p class="mt-3 text-lg text-purple-700">Pria</p>
        <p class="text-purple-600 text-base">{{ $resident->getGender('laki-laki')->count() }} orang</p>
    </div>
    <div class="flex flex-col items-center">
        <div class="w-32 h-32 md:w-40 md:h-40 bg-purple-400 text-white text-2xl md:text-3xl font-bold rounded-full flex items-center justify-center shadow-md">
        {{ $resident->getGenderPercentage('perempuan') }}%
        </div>
        <p class="mt-3 text-lg text-purple-700">Wanita</p>
        <p class="text-purple-600 text-base">{{ $resident->getGender('perempuan')->count() }} orang</p>
    </div>
    </div>
</div>