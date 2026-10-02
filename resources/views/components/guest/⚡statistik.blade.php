<?php

use App\Models\Family;
use App\Services\ResidentStatService;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    protected ResidentStatService $service;

    private array $palette = [
        '#a855f7', '#f472b6', '#38bdf8', '#34d399',
        '#fbbf24', '#fb7185', '#c084fc', '#60a5fa',
        '#4ade80', '#f9a8d4',
    ];

    public function boot(): void
    {
        $this->service = new ResidentStatService();
    }

    #[Computed]
    public function totalResidents(): int
    {
        return $this->service->count();
    }

    #[Computed]
    public function totalFamilies(): int
    {
        return Family::count();
    }

    #[Computed]
    public function genderStats(): array
    {
        return [
            'male' => [
                'label' => 'Pria',
                'color' => '#7c3aed',
                'count' => $this->service->getGender('laki-laki')->count(),
                'percent' => (float) $this->service->getGenderPercentage('laki-laki'),
            ],
            'female' => [
                'label' => 'Wanita',
                'color' => '#c084fc',
                'count' => $this->service->getGender('perempuan')->count(),
                'percent' => (float) $this->service->getGenderPercentage('perempuan'),
            ],
        ];
    }

    #[Computed]
    public function ageGroups(): array
    {
        $labels = [
            '0-12' => 'Anak-anak (0–12)',
            '13-17' => 'Remaja (13–17)',
            '18-59' => 'Dewasa (18–59)',
            '60+' => 'Lansia (60+)',
        ];

        return $this->toBars(
            collect($this->service->age_clasification()),
            $labels,
            max($this->totalResidents, 1)
        );
    }

    #[Computed]
    public function educationGroups(): array
    {
        $group = $this->service->education_group();

        return $this->toBars($group, [], max((int) $group->max(), 1));
    }

    #[Computed]
    public function occupationChart(): array
    {
        $group = $this->service->occupation_group();
        $total = max($group->sum(), 1);

        $cumulative = 0;
        $items = [];

        foreach ($group as $label => $count) {
            $color = $this->palette[count($items) % count($this->palette)];
            $percent = round($count / $total * 100, 1);
            $start = $cumulative;
            $cumulative += $percent;

            $items[] = [
                'label' => $label,
                'count' => $count,
                'percent' => $percent,
                'color' => $color,
                'start' => $start,
                'end' => $cumulative,
            ];
        }

        $gradient = collect($items)
            ->map(fn ($item) => "{$item['color']} {$item['start']}% {$item['end']}%")
            ->implode(', ');

        return [
            'items' => $items,
            'gradient' => $items ? "conic-gradient({$gradient})" : null,
        ];
    }

    public function refreshStats(): void
    {
        unset(
            $this->totalResidents,
            $this->totalFamilies,
            $this->genderStats,
            $this->ageGroups,
            $this->educationGroups,
            $this->occupationChart,
        );
    }

    private function toBars(Collection $group, array $labels, int $relativeTo): array
    {
        $items = [];

        foreach ($group as $key => $count) {
            $items[] = [
                'label' => $labels[$key] ?? $key,
                'count' => $count,
                'percent' => round($count / $relativeTo * 100, 1),
                'color' => $this->palette[count($items) % count($this->palette)],
            ];
        }

        return $items;
    }
};
?>

<div
    wire:poll.60s="refreshStats"
    wire:loading.class="opacity-60"
    wire:target="refreshStats"
    class="space-y-10 transition-opacity duration-300"
>
    <div class="flex flex-wrap items-center justify-end gap-3">
        <button
            type="button"
            wire:click="refreshStats"
            wire:loading.attr="disabled"
            wire:target="refreshStats"
            class="inline-flex items-center gap-2 rounded-xl bg-purple-600 px-4 py-2 text-sm font-semibold text-white shadow transition hover:-translate-y-0.5 hover:bg-purple-700 hover:shadow-lg disabled:cursor-wait disabled:opacity-60"
        >
            <svg wire:loading wire:target="refreshStats" class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span wire:loading.remove wire:target="refreshStats" aria-hidden="true">🔄</span>
            <span>Perbarui Data</span>
        </button>
    </div>

    <!-- Jumlah Penduduk & Keluarga -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div
            wire:key="card-penduduk-{{ $this->totalResidents }}"
            class="animate-fade-in-up rounded-2xl bg-linear-to-br from-purple-600 to-purple-400 p-6 text-center text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-xl"
        >
            <p
                class="text-5xl font-extrabold"
                x-data="{ value: 0 }"
                x-init="const target = {{ $this->totalResidents }}, start = performance.now(), dur = 900;
                    (function tick(now) {
                        const p = Math.min((now - start) / dur, 1);
                        value = Math.floor(p * target);
                        if (p < 1) requestAnimationFrame(tick);
                    })(start)"
                x-text="value"
            ></p>
            <p class="mt-2 text-lg text-purple-100">Penduduk</p>
        </div>
        <div
            wire:key="card-keluarga-{{ $this->totalFamilies }}"
            class="animate-fade-in-up [animation-delay:100ms] rounded-2xl bg-linear-to-br from-fuchsia-500 to-purple-400 p-6 text-center text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-xl"
        >
            <p
                class="text-5xl font-extrabold"
                x-data="{ value: 0 }"
                x-init="const target = {{ $this->totalFamilies }}, start = performance.now(), dur = 900;
                    (function tick(now) {
                        const p = Math.min((now - start) / dur, 1);
                        value = Math.floor(p * target);
                        if (p < 1) requestAnimationFrame(tick);
                    })(start)"
                x-text="value"
            ></p>
            <p class="mt-2 text-lg text-purple-100">Keluarga</p>
        </div>
    </div>

    <!-- Statistik Gender -->
    <div class="animate-fade-in-up rounded-xl bg-purple-200 p-6">
        <h2 class="mb-6 text-center text-2xl font-semibold text-purple-900">Jenis Kelamin</h2>
        <div class="flex flex-col justify-center gap-10 md:flex-row md:gap-16">
            @foreach ($this->genderStats as $key => $gender)
                <div wire:key="gender-{{ $key }}-{{ $gender['percent'] }}" class="flex flex-col items-center">
                    <div
                        class="ring-animated flex h-32 w-32 items-center justify-center rounded-full text-2xl font-bold text-white shadow-md md:h-40 md:w-40"
                        style="--ring-target: {{ $gender['percent'] }}%; background: conic-gradient({{ $gender['color'] }} var(--p), #ede9fe 0);"
                    >
                        {{ $gender['percent'] }}%
                    </div>
                    <p class="mt-3 text-lg text-purple-700">{{ $gender['label'] }}</p>
                    <p class="text-base text-purple-600">{{ $gender['count'] }} orang</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Statistik Usia -->
    <div class="animate-fade-in-up rounded-xl bg-purple-100 p-6">
        <h2 class="mb-6 text-center text-2xl font-semibold text-purple-900">📊 Statistik Usia</h2>
        @if (empty($this->ageGroups))
            <p class="py-8 text-center text-gray-500">Data usia belum tersedia</p>
        @else
            <div class="space-y-4">
                @foreach ($this->ageGroups as $item)
                    <div wire:key="age-{{ $loop->index }}-{{ $item['percent'] }}">
                        <div class="mb-1 flex justify-between text-sm font-medium text-purple-800">
                            <span>{{ $item['label'] }}</span>
                            <span>{{ $item['count'] }} orang ({{ $item['percent'] }}%)</span>
                        </div>
                        <div class="h-3 w-full overflow-hidden rounded-full bg-purple-200">
                            <div
                                class="grow-bar h-full rounded-full"
                                style="--bar-width: {{ $item['percent'] }}%; background-color: {{ $item['color'] }}; animation-delay: {{ $loop->index * 120 }}ms;"
                            ></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Statistik Pendidikan -->
    <div class="animate-fade-in-up rounded-xl bg-purple-100 p-6">
        <h2 class="mb-6 text-center text-2xl font-semibold text-purple-900">📘 Statistik Pendidikan</h2>
        @if (empty($this->educationGroups))
            <p class="py-8 text-center text-gray-500">Data pendidikan belum tersedia</p>
        @else
            <div class="space-y-4">
                @foreach ($this->educationGroups as $item)
                    <div wire:key="edu-{{ $loop->index }}-{{ $item['percent'] }}">
                        <div class="mb-1 flex justify-between text-sm font-medium text-purple-800">
                            <span>{{ $item['label'] }}</span>
                            <span>{{ $item['count'] }} orang</span>
                        </div>
                        <div class="h-3 w-full overflow-hidden rounded-full bg-purple-200">
                            <div
                                class="grow-bar h-full rounded-full"
                                style="--bar-width: {{ $item['percent'] }}%; background-color: {{ $item['color'] }}; animation-delay: {{ $loop->index * 120 }}ms;"
                            ></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Statistik Pekerjaan -->
    <div class="animate-fade-in-up rounded-xl bg-purple-100 p-6">
        <h2 class="mb-6 text-center text-2xl font-semibold text-purple-900">🛠️ Statistik Pekerjaan</h2>
        @if (empty($this->occupationChart['items']))
            <p class="py-8 text-center text-gray-500">Data pekerjaan belum tersedia</p>
        @else
            <div class="flex flex-col items-center gap-8 md:flex-row md:justify-center">
                <div
                    wire:key="donut-{{ md5(json_encode($this->occupationChart['items'])) }}"
                    class="h-48 w-48 shrink-0 animate-fade-in-up rounded-full shadow-md transition-transform duration-500 hover:scale-105"
                    style="background: {{ $this->occupationChart['gradient'] }};"
                ></div>
                <ul class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    @foreach ($this->occupationChart['items'] as $item)
                        <li class="flex items-center gap-2 text-sm text-purple-800">
                            <span class="h-3 w-3 shrink-0 rounded-full" style="background-color: {{ $item['color'] }};"></span>
                            <span>{{ $item['label'] }} — {{ $item['count'] }} ({{ $item['percent'] }}%)</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <p class="text-center text-xs text-purple-400">
        Diperbarui otomatis setiap menit &middot; terakhir: {{ now()->format('H:i:s') }}
    </p>
</div>
