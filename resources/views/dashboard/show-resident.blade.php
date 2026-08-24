@extends('dashboard.main')

@section('content')
@php
    $resident = (object) [
        'id' => 1,
        'nik' => '7103021202980001',
        'name' => 'Muhammad Rizky Saria',
        'gender' => 'Laki-laki',
        'place_of_birth' => 'Manado',
        'date_of_birth' => '1998-02-12',
        'religion' => 'Islam',
        'address' => 'Jaga 4, Desa Kema 3',
        'education' => 'S1 Informatika',
        'occupation' => 'Perangkat Desa',
        'marital_status' => 'Belum Kawin',
        'family_relationship' => 'Anak',
    ];
    $birthDate = \Carbon\Carbon::parse($resident->date_of_birth);
    $initials = collect(explode(' ', $resident->name))
        ->filter()
        ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-medium text-purple-700">Data Warga / Detail</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">Profil Resident</h2>
            <p class="mt-1 text-sm text-gray-500">Ringkasan informasi kependudukan warga.</p>
        </div>
        <a href="{{ route('list-resident') }}" class="inline-flex w-fit items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-purple-300 hover:text-purple-700">
            <span aria-hidden="true">←</span>
            Kembali ke Daftar
        </a>
    </div>

    <section class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
        <div class="h-28 bg-gradient-to-r from-purple-800 via-purple-700 to-indigo-600"></div>
        <div class="px-5 pb-6 sm:px-8">
            <div class="-mt-12 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end">
                    <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-2xl border-4 border-white bg-purple-100 text-2xl font-bold text-purple-700 shadow-md">
                        {{ $initials }}
                    </div>
                    <div class="pb-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <h3 class="text-xl font-bold text-gray-900">{{ $resident->name }}</h3>
                            <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Aktif</span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">NIK {{ $resident->nik }}</p>
                    </div>
                </div>
                <div class="rounded-xl bg-gray-50 px-4 py-3 text-sm sm:text-right">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">Usia</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $birthDate->age }} tahun</p>
                </div>
            </div>
        </div>
    </section>

    <div class="grid gap-6 lg:grid-cols-2">
        <section class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">
            <div class="mb-5 flex items-center gap-3">
                <div class="rounded-lg bg-purple-100 p-2 text-purple-700" aria-hidden="true">●</div>
                <div>
                    <h3 class="font-bold text-gray-900">Informasi Pribadi</h3>
                    <p class="text-xs text-gray-500">Identitas dasar resident</p>
                </div>
            </div>
            @php
                $personalData = [
                    'Nama lengkap' => $resident->name,
                    'Jenis kelamin' => $resident->gender,
                    'Tempat, tanggal lahir' => $resident->place_of_birth . ', ' . $birthDate->translatedFormat('d F Y'),
                    'Agama' => $resident->religion,
                    'Status perkawinan' => $resident->marital_status,
                    'Pendidikan terakhir' => $resident->education,
                    'Pekerjaan' => $resident->occupation,
                ];
            @endphp
            <dl class="divide-y divide-gray-100">
                @foreach ($personalData as $label => $value)
                    <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                        <dt class="text-gray-500">{{ $label }}</dt>
                        <dd class="text-right font-semibold text-gray-900">{{ $value ?: '-' }}</dd>
                    </div>
                @endforeach
            </dl>
        </section>

        <section class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">
            <div class="mb-5 flex items-center gap-3">
                <div class="rounded-lg bg-blue-100 p-2 text-blue-700" aria-hidden="true">⌂</div>
                <div>
                    <h3 class="font-bold text-gray-900">Keluarga &amp; Alamat</h3>
                    <p class="text-xs text-gray-500">Informasi domisili resident</p>
                </div>
            </div>
            @php
                $familyData = [
                    'Status dalam keluarga' => $resident->family_relationship,
                    'Nomor kartu keluarga' => '7103021202980007',
                    'Kepala keluarga' => 'Saria Rumondor',
                    'RT / RW' => '004 / 002',
                    'Desa' => 'Kema 3',
                    'Kecamatan' => 'Kema',
                    'Kabupaten' => 'Minahasa Utara',
                    'Provinsi' => 'Sulawesi Utara',
                ];
            @endphp
            <dl class="divide-y divide-gray-100">
                @foreach ($familyData as $label => $value)
                    <div class="grid grid-cols-2 gap-4 py-3 text-sm">
                        <dt class="text-gray-500">{{ $label }}</dt>
                        <dd class="text-right font-semibold text-gray-900">{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>
            <div class="mt-4 rounded-xl bg-gray-50 p-4">
                <p class="text-xs font-medium uppercase tracking-wide text-gray-400">Alamat lengkap</p>
                <p class="mt-1 text-sm font-semibold leading-6 text-gray-800">{{ $resident->address }}</p>
            </div>
        </section>
    </div>

    <div class="flex items-center gap-2 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
        <span aria-hidden="true">ⓘ</span>
        <span>Data pada halaman ini merupakan contoh tampilan dan belum mengambil data dari database.</span>
    </div>
</div>
@endsection
