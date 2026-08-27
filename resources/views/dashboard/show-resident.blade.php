@extends('dashboard.main')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-medium text-purple-700">Data Warga / Detail</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">Profil Warga</h2>
            <p class="mt-1 text-sm text-gray-500">Ringkasan informasi kependudukan warga.</p>
        </div>
        <a href="{{ route('list-resident') }}" class="inline-flex w-fit items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-purple-300 hover:text-purple-700">
            <span aria-hidden="true">←</span>
            Kembali ke Daftar
        </a>
    </div>

    <section class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-purple-100 text-xl font-bold text-purple-700">
                        {{ $resident->initial }}
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h3 class="text-xl font-bold text-gray-900"> {{ $resident->name }} </h3>
                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Masih terdaftar di jaga ini</span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">NIK {{ $resident->nik }} </p>
                </div>
            </div>
            <p class="text-sm text-gray-500">Usia <span class="font-bold text-gray-900"> {{ $resident->age->years }} Tahun </span></p>
        </div>
    </section>

    <div class="grid gap-6 lg:grid-cols-2">
        <section class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">
            <div class="mb-5 flex items-center gap-3">
                <div class="rounded-lg bg-purple-100 p-2 text-purple-700" aria-hidden="true">●</div>
                <div>
                    <h3 class="font-bold text-gray-900">Informasi Pribadi</h3>
                    <p class="text-xs text-gray-500">Identitas dasar Warga</p>
                </div>
            </div>
            <dl class="divide-y divide-gray-100">
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Nama lengkap</dt>
                    <dd class="text-right font-semibold text-gray-900"> {{ $resident->name }} </dd>
                </div>
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Umur</dt>
                    <dd class="text-right font-semibold text-gray-900"> 
                        {{ $resident->age->years }} Tahun 
                        {{ $resident->age->months }} Bulan
                        {{ $resident->age->days }} Hari
                    </dd>
                </div>
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Jenis kelamin</dt>
                    <dd class="text-right font-semibold text-gray-900"> {{ $resident->gender }} </dd>
                </div>
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Tempat, tanggal lahir</dt>
                    <dd class="text-right font-semibold text-gray-900">{{ $resident->place_of_birth }}, {{ $resident->date_of_birth->translatedFormat('d F Y') }}</dd>
                </div>
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Agama</dt>
                    <dd class="text-right font-semibold text-gray-900">{{$resident->religion}}</dd>
                </div>
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Status perkawinan</dt>
                    <dd class="text-right font-semibold text-gray-900"> {{ $resident->marital_status }} </dd>
                </div>
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Pendidikan terakhir</dt>
                    <dd class="text-right font-semibold text-gray-900">{{$resident->education}}</dd>
                </div>
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Pekerjaan</dt>
                    <dd class="text-right font-semibold text-gray-900"> {{ $resident->occupation }} </dd>
                </div>
            </dl>
        </section>

        @if ($resident->family)
            <section class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">
                <div class="mb-5 flex items-center gap-3">
                    <div class="rounded-lg bg-blue-100 p-2 text-blue-700" aria-hidden="true">⌂</div>
                    <div>
                        <h3 class="font-bold text-gray-900">Keluarga</h3>
                        <p class="text-xs text-gray-500">Informasi singkat keluarga</p>
                    </div>
                </div>
                <dl class="divide-y divide-gray-100">
                    <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                        <dt class="text-gray-500">Nomor kartu keluarga</dt>
                        <dd class="text-right font-semibold text-gray-900">
                            {{ $resident->family->family_number }}
                        </dd>
                    </div>
                    <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                        <dt class="text-gray-500">Status dalam keluarga</dt>
                        <dd class="text-right font-semibold text-gray-900"> {{ $resident->family_relationship }} </dd>
                    </div>
                    <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                        <dt class="text-gray-500">Jumlah bersaudara</dt>
                        <dd class="text-right font-semibold text-gray-900">3 bersaudara (belum di implementasikan)</dd>
                    </div>
                    <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                        <dt class="text-gray-500">Anak ke</dt>
                        <dd class="text-right font-semibold text-gray-900">Anak ke-2 (belum di implementasikan)</dd>
                    </div>
                </dl>
                <div class="mt-4 rounded-xl bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">Alamat lengkap</p>
                    <p class="mt-1 text-sm font-semibold leading-6 text-gray-800"> {{ $resident->address }} </p>
                </div>
            </section>    
        @else
            <section class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">
                <div class="mb-5 flex items-center gap-3">
                    <div class="rounded-lg bg-amber-100 p-2 text-amber-700" aria-hidden="true">⌂</div>
                    <div>
                        <h3 class="font-bold text-gray-900">Keluarga</h3>
                        <p class="text-xs text-gray-500">Informasi singkat keluarga</p>
                    </div>
                </div>
                <div class="rounded-xl bg-amber-50 p-4">
                    <p class="text-sm font-semibold text-amber-800">Warga ini belum terdaftar di keluarga manapun.</p>
                </div>
            </section>
        @endif
    </div>
</div>
@endsection