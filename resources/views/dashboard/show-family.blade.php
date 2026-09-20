@extends('dashboard.main')

@section('content')
@php
    $head = $family->headFamily?->resident;
    $members = $family->familyRelationships
        ->map(fn ($relationship) => $relationship->resident)
        ->filter();
@endphp

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-medium text-purple-700">Data Keluarga / Detail</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">Keluarga Besar</h2>
            <p class="mt-1 text-sm text-gray-500">Informasi keluarga dan seluruh anggota yang terdaftar.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('dashboard.list-family') }}" class="inline-flex w-fit items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-purple-300 hover:text-purple-700">
                <span aria-hidden="true">←</span>
                Kembali ke Daftar
            </a>
            <a href="{{ route('dashboard.export-family', $family->family_number) }}" class="inline-flex w-fit items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-2.5 text-sm font-semibold text-emerald-700 shadow-sm transition hover:bg-emerald-100">
                <span aria-hidden="true">⬇️</span>
                Export PDF
            </a>
            <a href="{{ route('dashboard.edit-family', $family->family_number) }}" class="inline-flex w-fit items-center gap-2 rounded-lg bg-purple-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-purple-700">
                <span aria-hidden="true">✏️</span>
                Edit Keluarga
            </a>
        </div>
    </div>

    <section class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">
        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center gap-4">
                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-purple-500 to-violet-600 text-xl font-bold text-white shadow-sm">
                    👨‍👩‍👧‍👦
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h3 class="text-xl font-bold text-gray-900">{{ $family->family_number }}</h3>
                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Aktif</span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Kepala keluarga: {{ $head?->name ?? 'Belum ditentukan' }}</p>
                </div>
            </div>

            <div class="grid w-full gap-3 sm:grid-cols-3 lg:max-w-md">
                <div class="rounded-xl border border-purple-100 bg-purple-50 p-3 text-center">
                    <p class="text-xs font-medium uppercase tracking-wide text-purple-700">Anggota</p>
                    <p class="mt-2 text-2xl font-bold text-purple-900">{{ $members->count() }}</p>
                </div>
                <div class="rounded-xl border border-blue-100 bg-blue-50 p-3 text-center">
                    <p class="text-xs font-medium uppercase tracking-wide text-blue-700">Laki-laki</p>
                    <p class="mt-2 text-2xl font-bold text-blue-900">{{ $members->where('gender', 'Laki-laki')->count() }}</p>
                </div>
                <div class="rounded-xl border border-pink-100 bg-pink-50 p-3 text-center">
                    <p class="text-xs font-medium uppercase tracking-wide text-pink-700">Perempuan</p>
                    <p class="mt-2 text-2xl font-bold text-pink-900">{{ $members->where('gender', 'Perempuan')->count() }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr]">
        <section class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">
            <div class="mb-5 flex items-center gap-3">
                <div class="rounded-lg bg-purple-100 p-2 text-purple-700" aria-hidden="true">●</div>
                <div>
                    <h3 class="font-bold text-gray-900">Informasi Keluarga</h3>
                    <p class="text-xs text-gray-500">Ringkasan data keluarga</p>
                </div>
            </div>

            <dl class="divide-y divide-gray-100">
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Nomor KK</dt>
                    <dd class="text-right font-semibold text-gray-900">{{ $family->family_number }}</dd>
                </div>
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Kepala keluarga</dt>
                    <dd class="text-right font-semibold text-gray-900">{{ $head?->name ?? 'Belum tersedia' }}</dd>
                </div>
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">NIK kepala keluarga</dt>
                    <dd class="text-right font-semibold text-gray-900">{{ $head?->nik ?? 'Belum tersedia' }}</dd>
                </div>
                <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                    <dt class="text-gray-500">Alamat</dt>
                    <dd class="text-right font-semibold text-gray-900">{{ $head?->address ?? 'Alamat belum tercatat' }}</dd>
                </div>
            </dl>
        </section>

        <section class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">
            <div class="mb-5 flex items-center gap-3">
                <div class="rounded-lg bg-amber-100 p-2 text-amber-700" aria-hidden="true">★</div>
                <div>
                    <h3 class="font-bold text-gray-900">Status</h3>
                    <p class="text-xs text-gray-500">Kondisi keluarga saat ini</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="rounded-xl bg-emerald-50 p-4 ring-1 ring-emerald-100">
                    <p class="text-xs font-medium uppercase tracking-wide text-emerald-700">Status</p>
                    <p class="mt-2 text-lg font-bold text-emerald-900">Keluarga terdaftar</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-600">Catatan</p>
                    <p class="mt-2 text-sm leading-6 text-slate-700">Semua data anggota keluarga dapat dilihat di bawah ini sesuai hubungan keluarga masing-masing.</p>
                </div>
            </div>
        </section>
    </div>

    <section class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">
        <div class="mb-5 flex items-center justify-between gap-3">
            <div>
                <h3 class="text-xl font-bold text-gray-900">Daftar Anggota Keluarga</h3>
                <p class="text-sm text-gray-500">{{ $members->count() }} orang terdaftar</p>
            </div>
            <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700">Kelompok keluarga</span>
        </div>

        @if ($family->familyRelationships->isNotEmpty())
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($family->familyRelationships as $relationship)
                    @php $resident = $relationship->resident; @endphp
                    @if (! $resident)
                        @continue
                    @endif

                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4 transition hover:border-purple-200 hover:bg-purple-50/30">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 text-sm font-bold text-white">
                                    {{ strtoupper(substr($resident->name ?? 'A', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $resident->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $resident->nik }}</p>
                                </div>
                            </div>
                            <span class="rounded-full bg-white px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-purple-700 ring-1 ring-purple-200">
                                {{ $relationship->family_relationship }}
                            </span>
                        </div>

                        <dl class="mt-4 space-y-2 text-sm">
                            <div class="flex items-center justify-between gap-2 border-b border-gray-200 pb-2">
                                <dt class="text-gray-500">Jenis Kelamin</dt>
                                <dd class="font-semibold text-gray-900">{{ $resident->gender ?? '-' }}</dd>
                            </div>
                            <div class="flex items-center justify-between gap-2 border-b border-gray-200 pb-2">
                                <dt class="text-gray-500">Usia</dt>
                                <dd class="font-semibold text-gray-900">
                                    {{ $resident->age?->years ?? 0 }} tahun
                                </dd>
                            </div>
                            <div class="flex items-center justify-between gap-2 border-b border-gray-200 pb-2">
                                <dt class="text-gray-500">Agama</dt>
                                <dd class="font-semibold text-gray-900">{{ $resident->religion ?? '-' }}</dd>
                            </div>
                            <div class="flex items-center justify-between gap-2 border-b border-gray-200 pb-2">
                                <dt class="text-gray-500">Pekerjaan</dt>
                                <dd class="font-semibold text-gray-900">{{ $resident->occupation ?? '-' }}</dd>
                            </div>

                            <div class="flex items-center justify-between gap-2">
                                <dt class="text-gray-500">TTL</dt>
                                <dd class="font-semibold text-gray-900 text-right">
                                    {{ $resident->place_of_birth ?? '-' }}, {{ $resident->date_of_birth ? $resident->date_of_birth->translatedFormat('d F Y') : '-' }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-8 text-center">
                <p class="text-lg font-semibold text-gray-700">Belum ada anggota keluarga</p>
                <p class="mt-1 text-sm text-gray-500">Data hubungan keluarga masih kosong untuk nomor KK ini.</p>
            </div>
        @endif
    </section>
</div>
@endsection