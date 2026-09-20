@extends('dashboard.main')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-medium text-purple-700">Data Warga / Detail</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">Profil Warga</h2>
            <p class="mt-1 text-sm text-gray-500">Informasi kependudukan warga.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('dashboard.list-resident') }}" class="inline-flex w-fit items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-purple-300 hover:text-purple-700">
                <span aria-hidden="true">←</span>
                Kembali ke Daftar
            </a>
            <a href="{{ route("dashboard.export-resident", $resident->nik) }}" type="button" class="inline-flex w-fit items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-2.5 text-sm font-semibold text-emerald-700 shadow-sm transition hover:bg-emerald-100">
                <span aria-hidden="true">⬇️</span>
                Export
            </button>
            <a href="{{ route('dashboard.edit-resident', $resident->nik) }}" class="inline-flex w-fit items-center gap-2 rounded-lg bg-purple-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-purple-700">
                <span aria-hidden="true">✏️</span>
                Edit
            </a>
        </div>
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
            @if ($resident->date_of_death)
                <span class="inline-flex items-center gap-2 rounded-full bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 ring-1 ring-red-200">
                    <span aria-hidden="true">✦</span>
                    Warga Ini Telah Meninggal
                </span>
            @else
                <p class="text-sm text-gray-500">Usia <span class="font-bold text-gray-900">{{ $resident->age->years }} Tahun</span></p>
            @endif
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

                {{-- Nama lengkap --}}
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Nama lengkap</dt>
                    <dd class="text-right font-semibold text-gray-900"> {{ $resident->name }} </dd>
                </div>
                
                {{-- Tanggal Meninggal --}}
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Tanggal Meninggal</dt>
                    <dd class="text-right font-semibold text-gray-900"> {{ $resident->date_of_death ? $resident->date_of_death->format('d F Y') : 'Belum Meninggal' }} </dd>
                </div>

                {{-- Umur --}}
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">
                        
                        @if($resident->date_of_death)
                            Umur saat meninggal
                        @else
                            Umur
                        @endif
                    </dt>
                    @if ($resident->date_of_death)
                        <dd class="text-right font-semibold text-gray-900">
                            
                            {{ $resident->age_at_death->years }} Tahun
                            {{ $resident->age_at_death->months }} Bulan
                            {{ $resident->age_at_death->days }} Hari
                        </dd>
                    @else
                        <dd class="text-right font-semibold text-gray-900">
                            {{ $resident->age->years }} Tahun
                            {{ $resident->age->months }} Bulan
                            {{ $resident->age->days }} Hari
                        </dd>
                    @endif
                </div>

                {{-- Jenis kelamin --}}
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
                @php
                    $family = $resident->family;
                    $familyHead = $family?->headFamily?->resident;
                    $familyMembersCount = $family?->residents()->count() ?? 0;
                @endphp
                <dl class="divide-y divide-gray-100">
                    <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                        <dt class="text-gray-500">Nomor kartu keluarga</dt>
                        <dd class="text-right font-semibold text-gray-900">
                            {{ $family?->family_number ?? '-' }}
                        </dd>
                    </div>
                    <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                        <dt class="text-gray-500">Status dalam keluarga</dt>
                        <dd class="text-right font-semibold text-gray-900">
                            {{ $resident->familyRelationship?->family_relationship ?? '-' }}
                        </dd>
                    </div>
                    <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                        <dt class="text-gray-500">Kepala keluarga</dt>
                        <dd class="text-right font-semibold text-gray-900">
                            {{ $familyHead?->name ?? 'Belum ada' }}
                        </dd>
                    </div>
                    <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                        <dt class="text-gray-500">Jumlah anggota</dt>
                        <dd class="text-right font-semibold text-gray-900">
                            {{ $familyMembersCount }} orang
                        </dd>
                    </div>
                </dl>
                <div class="mt-4 rounded-xl bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">Alamat lengkap</p>
                    <p class="mt-1 text-sm font-semibold leading-6 text-gray-800"> {{ $resident->address ?: 'Alamat belum dicatat' }} </p>
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